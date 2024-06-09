<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Coating;
use App\Models\Material;
use App\Models\Product;
use App\Models\Type;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel, WithStartRow
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
        $category = Category::where('name', strval($row[1]))->first();
        $type = Type::where('name', strval($row[2]))->first();
        $material = Material::where('name', strval($row[3]))->first();
        $coating = Coating::where('name', strval($row[4]))->first();
        $product = Product::where('category_id', $category->id ?? 0)->where('type_id', $type->id ?? 0)->where('material_id', $material->id ?? 0)->where('coating_id', $coating->id ?? 0)->where('sph', strval($row[6]))->where('cyl', strval($row[7]))->where('axis', strval($row[8]))->where('add', strval($row[9]));
        if ($product->exists()) :
            $this->data[] = [
                'product_name' => $row[0],
            ];
        else :
            return new Product([
                'name' => $type->name,
                'code' => productcode('Lens'),
                'category_id' => $category->id,
                'type_id' => $type->id,
                'material_id' => $material->id,
                'coating_id' => $coating->id,
                'eye' => strval($row[5]),
                'sph' => strval($row[6]),
                'cyl' => strval($row[7]),
                'axis' => strval($row[8]),
                'add' => strval($row[9]),
                'shelf' => strval($row[10]),
                'box' => strval($row[11]),
                'created_by' => $this->request->user()->id,
                'updated_by' => $this->request->user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        endif;
    }

    public function startRow(): int
    {
        return 2;
    }
}
