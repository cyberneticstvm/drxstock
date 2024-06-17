<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function order()
    {
        $order = [];
        return view('order.index', compact('order'));
    }

    function orderFetch(Request $request)
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
            if ($order) :
                if ($request->type == "order") :
                    return view('order.index', compact('order'));
                else :
                    $products = Product::selectRaw("CONCAT_WS(' ', code, name, CONCAT(sph,cyl,axis,`add`)) AS name, id")->pluck('name', 'id');
                    return view('sales.create', compact('order', 'products'));
                endif;
            else :
                return redirect()->back()->with("error", "No order found with provided order id!")->withInput($request->all());
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }
}
