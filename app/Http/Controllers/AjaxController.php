<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function changeType(Request $request)
    {
        $type_id = $request->type_id;
        $type = Type::findOrFail($type_id);
        return response()->json($type);
    }
}
