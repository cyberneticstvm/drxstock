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
        $product = Product::where('code', strval($row[0]));
        if (!$product->exists()) :
            $this->data[] = [
                'product_code' => $row[0],
            ];
        else :
            $product = Product::where('code', strval($row[0]))->first();
            $product->update([
                'shelf' => $row[1],
                'box' => $row[2],
            ]);
            return $product;
        endif;
    }

    public function startRow(): int
    {
        return 2;
    }
}
