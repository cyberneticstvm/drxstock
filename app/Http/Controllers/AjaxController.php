<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function getStock($product, $editQty)
    {
        $stock = getInventory($product, $editQty);
        return response()->json($stock);
    }

    function changeType(Request $request)
    {
        $type_id = $request->type_id;
        $type = Type::findOrFail($type_id);
        return response()->json($type);
    }

    function getProducts()
    {
        $products = Product::selectRaw("CAST(CONCAT_WS(' ', code, name, CONCAT(sph,cyl,axis,`add`)) AS CHAR) AS name, id")->get();
        return response()->json($products);
    }
}
