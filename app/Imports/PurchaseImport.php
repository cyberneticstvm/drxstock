<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\PurchaseDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PurchaseImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */

    public $request, $data, $purchase;
    public function __construct($request, $purchase)
    {
        $this->request = $request;
        $this->purchase = $purchase;
    }

    public function model(array $row)
    {
        $product = Product::where('code', strval($row[0]))->first();
        if ($product->exists()) :
            return new PurchaseDetail([
                'purchase_id' => $this->purchase->id,
                'product_id' => $product->id,
                'qty' => $row[1],
                'unit_purchase_price' => $row[2],
                'unit_selling_price' => $row[3],
                'total_purchase_price' => $row[2] * $row[1],
                'total_selling_price' => $row[3] * $row[1],
                'created_at' => $this->purchase->created_at,
                'updated_at' => $this->purchase->updated_at,
            ]);
        else :
            $this->data[] = [
                'product_name' => $row[0],
            ];
        endif;
    }

    public function startRow(): int
    {
        return 2;
    }
}
