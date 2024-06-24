<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SalesController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    protected $products;

    public function __construct()
    {
        $this->products = Product::leftJoin('coatings AS c', 'products.coating_id', 'c.id')->selectRaw("CONCAT_WS(' ', products.code, products.name, c.name, CONCAT(products.sph, ' ', products.cyl, ' ', products.axis, ' ', products.add)) AS name, products.id AS id")->pluck('name', 'id');
    }

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('sales-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('sales-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('sales-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('sales-delete'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $sales = Sales::withTrashed()->latest()->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
        ]);
        $order = collect();
        try {
            $oid = $request->order_id;
            $secret = apiSecret();
            $url = "https://order.speczone.net/api/order/$oid/$secret";
            $json = file_get_contents($url);
            $order = json_decode($json);
            $products = $this->products;
            $old = Sales::where('order_id', $request->order_id)->first();
            return view('sales.create', compact('order', 'products', 'old'));
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'customer_name' => 'required',
            'branch' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $sales = Sales::create([
                    'order_id' => $request->order_id,
                    'customer_name' => $request->customer_name,
                    'branch' => $request->branch,
                    'notes' => $request->notes,
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ]);
                $data = [];
                foreach ($request->product_id as $key => $item) :
                    $data[] = [
                        'sales_id' => $sales->id,
                        'eye' => $request->eye[$key],
                        'product_id' => $item,
                        'qty' => $request->qty[$key],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                SalesDetail::insert($data);
            });
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('sales.register')->with("success", "Sales created successfully");
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
        $products = $this->products;
        $sales = Sales::findOrFail(decrypt($id));
        $old = Sales::where('order_id', $sales->order_id)->whereNot('id', $sales->id)->first();
        return view('sales.edit', compact('sales', 'products', 'old'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $sales = Sales::findOrFail($id);
                $sales->update([
                    'notes' => $request->notes,
                    'updated_by' => $request->user()->id,
                ]);
                $data = [];
                foreach ($request->product_id as $key => $item) :
                    $data[] = [
                        'sales_id' => $id,
                        'eye' => $request->eye[$key],
                        'product_id' => $item,
                        'qty' => $request->qty[$key],
                        'created_at' => $sales->created_at,
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                SalesDetail::where('sales_id', $id)->delete();
                SalesDetail::insert($data);
            });
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('sales.register')->with("success", "Sales updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sales::findOrFail(decrypt($id))->delete();
        SalesDetail::where('sales_id', decrypt($id))->delete();
        return redirect()->route('sales.register')->with("success", "Sales deleted successfully");
    }
}
