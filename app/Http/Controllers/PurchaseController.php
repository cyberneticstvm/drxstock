<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $suppliers, $products;

    public function __construct()
    {
        $this->suppliers = Supplier::pluck('name', 'id');
        $this->products = Product::selectRaw("CONCAT_WS(' ', code, name, CONCAT(sph, ' ', cyl, ' ', axis, ' ', `add`)) AS name, id")->pluck('name', 'id');
    }

    public function index()
    {
        $purchases = Purchase::withTrashed()->latest()->get();
        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = $this->suppliers;
        $products = $this->products;
        return view('purchase.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $purchase = Purchase::create([
                    'supplier_id' => $request->supplier_id,
                    'supplier_invoice' => $request->supplier_invoice,
                    'order_date' => $request->order_date,
                    'delivery_date' => $request->delivery_date,
                    'purchase_note' => $request->purchase_note,
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ]);
                $data = [];
                foreach ($request->product_id as $key => $item) :
                    $data[] = [
                        'purchase_id' => $purchase->id,
                        'product_id' => $item,
                        'qty' => $request->qty[$key],
                        'unit_purchase_price' => $request->unit_purchase_price[$key],
                        'unit_selling_price' => $request->unit_selling_price[$key],
                        'total_purchase_price' => $request->unit_purchase_price[$key] * $request->qty[$key],
                        'total_selling_price' => $request->unit_selling_price[$key] * $request->qty[$key],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                PurchaseDetail::insert($data);
            });
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('purchase.register')->with("success", "Purchase created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suppliers = $this->suppliers;
        $products = $this->products;
        $purchase = Purchase::findOrFail(decrypt($id));
        return view('purchase.edit', compact('suppliers', 'products', 'purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_id' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                $purchase = Purchase::findOrFail($id);
                $purchase->update([
                    'supplier_id' => $request->supplier_id,
                    'supplier_invoice' => $request->supplier_invoice,
                    'order_date' => $request->order_date,
                    'delivery_date' => $request->delivery_date,
                    'purchase_note' => $request->purchase_note,
                    'updated_by' => $request->user()->id,
                ]);
                $data = [];
                foreach ($request->product_id as $key => $item) :
                    $data[] = [
                        'purchase_id' => $purchase->id,
                        'product_id' => $item,
                        'qty' => $request->qty[$key],
                        'unit_purchase_price' => $request->unit_purchase_price[$key],
                        'unit_selling_price' => $request->unit_selling_price[$key],
                        'total_purchase_price' => $request->unit_purchase_price[$key] * $request->qty[$key],
                        'total_selling_price' => $request->unit_selling_price[$key] * $request->qty[$key],
                        'created_at' => $purchase->created_at,
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                PurchaseDetail::where('purchase_id', $purchase->id)->delete();
                PurchaseDetail::insert($data);
            });
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('purchase.register')->with("success", "Purchase updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Purchase::findOrFail(decrypt($id))->delete();
        PurchaseDetail::where('purchase_id', decrypt($id))->delete();
        return redirect()->route('purchase.register')->with("success", "Purchase deleted successfully");
    }
}
