<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductShelfBoxImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public $request, $data;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function model(array $row)
    {
        $product = Product::where('code', strval($row[1]));
        if (!$product->exists()) :
            $this->data[] = [
                'product_code' => $row[0],
            ];
        else :
            $product = Product::where('code', strval($row[1]))->first();
            $product->update([
                'shelf' => $row[10],
                'box' => $row[11],
            ]);
            return $product;
        endif;
    }

    public function startRow(): int
    {
        return 2;
    }
}
