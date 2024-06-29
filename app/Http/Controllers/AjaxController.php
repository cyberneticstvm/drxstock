<?php

namespace App\Http\Controllers;

use App\Models\Power;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //Product::selectRaw("CAST(CONCAT_WS(' ', code, name, CONCAT(sph,cyl,axis,`add`)) AS CHAR) AS name, id")->get();
        $products = Product::leftJoin('coatings AS c', 'products.coating_id', 'c.id')->selectRaw("CONCAT_WS(' ', products.code, products.name, c.name, CONCAT(products.sph, ' ', products.cyl, ' ', products.axis, ' ', products.add)) AS name, products.id AS id")->get();
        return response()->json($products);
    }

    function getPower($type)
    {
        $minmax = collect(DB::select("SELECT IFNULL(MAX(CAST(sph AS DECIMAL(4, 2))), 0) AS sphmax, IFNULL(MIN(CAST(sph AS DECIMAL(4, 2))), 0) AS sphmin, IFNULL(MAX(CAST(cyl AS DECIMAL(4, 2))), 0) AS cylmax, IFNULL(MIN(CAST(cyl AS DECIMAL(4, 2))), 0) AS cylmin FROM `products` WHERE coating_id = 3;"))->first();

        $sph = Power::where('name', 'sph')->whereRaw("CAST(value AS DECIMAL(4,2)) BETWEEN " . $minmax->sphmin . " AND " . $minmax->sphmax)->selectRaw("value AS name, value AS id")->get();
        $cyl = Power::where('name', 'cyl')->whereRaw("CAST(value AS DECIMAL(4,2)) BETWEEN " . $minmax->cylmin . " AND " . $minmax->cylmax)->selectRaw("value AS name, value AS id")->get();

        return response()->json([
            'sph' => $sph,
            'cyl' => $cyl,
            'minmax' => $minmax,
        ]);
    }
}
