<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use Exception;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            $products = Product::selectRaw("CONCAT_WS(' ', code, name, CONCAT(sph,cyl,axis,`add`)) AS name, id")->pluck('name', 'id');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
