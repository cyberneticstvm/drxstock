<?php

use App\Models\Product;

function apiSecret()
{
    return 'fdjsvsgdf4dhgf687f4bg54g4hf787';
}

function roles()
{
    return array('admin' => 'Admin', 'staff' => 'Staff', 'manager' => 'Manager');
}

function productcode($category)
{
    /*$key = '0123456789';    
    return substr(strtoupper($category), 0, 1) . substr(str_shuffle($key), 0, 6);*/
    $str = substr(strtoupper($category), 0, 1);
    return Product::selectRaw("CONCAT_WS('-', '$str', IFNULL(MAX(CAST(SUBSTRING_INDEX(code, '-', -1) AS INTEGER))+1, 1001)) AS pcode")->first()->pcode;
}
