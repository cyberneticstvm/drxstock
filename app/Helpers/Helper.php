<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;

function getInventory($product, $editQty)
{
    /*$stock = DB::select("SELECT tbl1.product_id, tbl1.pcode, tbl1.product_name, tbl1.purchasedQty, SUM(IFNULL(sd.qty, 0)) AS soldQty, ((tbl1.purchasedQty + ?)-SUM(IFNULL(sd.qty, 0))) AS balanceQty FROM (SELECT p.id AS product_id, p.code AS pcode, p.name AS product_name, SUM(IFNULL(pd.qty, 0)) AS purchasedQty FROM purchase_details pd LEFT JOIN products p ON pd.product_id = p.id WHERE IF(? > 0, pd.product_id = ?, 1) AND pd.is_return IS NULL AND pd.deleted_at IS NULL GROUP BY p.id, p.name, p.code) AS tbl1 LEFT JOIN sales_details sd ON sd.product_id = tbl1.product_id WHERE sd.is_return IS NULL AND sd.deleted_at IS NULL GROUP BY tbl1.product_id, tbl1.pcode, tbl1.product_name, tbl1.purchasedQty", [$editQty, $product, $product]);*/
    $stock = DB::select("SELECT tbl2.product_id, tbl2.pcode, tbl2.product_name, tbl2.purchasedQty, tbl2.damagedQty, SUM(IFNULL(sd.qty, 0)) AS soldQty, ((tbl2.purchasedQty + ?)-(SUM(IFNULL(sd.qty, 0)) + tbl2.damagedQty)) AS balanceQty FROM (SELECT tbl1.*, SUM(CASE WHEN d.deleted_at IS NULL THEN d.qty ELSE 0 END) AS damagedQty FROM (SELECT p.id AS product_id, p.code AS pcode, p.name AS product_name, SUM(IFNULL(pd.qty, 0)) AS purchasedQty FROM purchase_details pd LEFT JOIN products p ON pd.product_id = p.id WHERE IF(0 > ?, pd.product_id = ?, 1) AND pd.is_return IS NULL AND pd.deleted_at IS NULL GROUP BY p.id, p.name, p.code) AS tbl1 LEFT JOIN damages d ON d.product_id = tbl1.product_id GROUP BY tbl1.product_id, tbl1.pcode, tbl1.product_name, tbl1.purchasedQty) AS tbl2 LEFT JOIN sales_details sd ON sd.product_id = tbl2.product_id WHERE sd.is_return IS NULL AND sd.deleted_at IS NULL GROUP BY tbl2.product_id, tbl2.pcode, tbl2.product_name, tbl2.purchasedQty, tbl2.damagedQty", [$editQty, $product, $product]);
    return collect($stock);
}

function apiSecret()
{
    return 'fdjsvsgdf4dhgf687f4bg54g4hf787';
}

function roles()
{
    return array('admin' => 'Admin', 'staff' => 'Staff', 'manager' => 'Manager', 'optician' => 'Optician');
}

function productcode($category)
{
    /*$key = '0123456789';    
    return substr(strtoupper($category), 0, 1) . substr(str_shuffle($key), 0, 6);*/
    $str = substr(strtoupper($category), 0, 1);
    return Product::selectRaw("CONCAT_WS('-', '$str', IFNULL(MAX(CAST(SUBSTRING_INDEX(code, '-', -1) AS INTEGER))+1, 1001)) AS pcode")->first()->pcode;
}
