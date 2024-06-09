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
        $category = Category::where('name', strval($row[0]))->first();
        $type = Type::where('name', strval($row[1]))->first();
        $material = Material::where('name', strval($row[2]))->first();
        $coating = Coating::where('name', strval($row[3]))->first();
        $product = Product::where('category_id', $category->id ?? 0)->where('type_id', $type->id ?? 0)->where('material_id', $material->id ?? 0)->where('coating_id', $coating->id ?? 0)->where('sph', strval($row[5]))->where('cyl', strval($row[6]))->where('axis', strval($row[7]))->where('add', strval($row[8]));
        if ($product->exists()) :
            $this->data[] = [
                'product_name' => $row[1],
            ];
        else :
            return new Product([
                'name' => $type->name,
                'code' => productcode('Lens'),
                'category_id' => $category->id,
                'type_id' => $type->id,
                'material_id' => $material->id,
                'coating_id' => $coating->id,
                'eye' => strval($row[4]),
                'sph' => strval($row[5]),
                'cyl' => strval($row[6]),
                'axis' => strval($row[7]),
                'add' => strval($row[8]),
                'shelf' => strval($row[9]),
                'box' => strval($row[10]),
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
