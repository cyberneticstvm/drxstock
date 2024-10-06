<?php

namespace App\Http\Controllers;

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
            $url = api_url() . "/api/order/$oid/$secret";
            $json = file_get_contents($url);
            $order = json_decode($json);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return view('order.index', compact('order'));
    }
}
