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
        $type = Type::where('name', strval($row[0]))->first();
        $material = Material::where('name', strval($row[1]))->first();
        $coating = Coating::where('name', strval($row[2]))->first();
        $product = Product::where('category_id', $type?->category_id ?? 0)->where('type_id', $type?->id ?? 0)->where('material_id', $material?->id ?? 0)->where('coating_id', $coating?->id ?? 0)->where('sph', strval($row[4]))->where('cyl', strval($row[5]))->where('axis', strval($row[6]))->where('add', strval($row[7]));
        if ($product->exists()) :
            $this->data[] = [
                'product_name' => $row[1],
            ];
        else :
            return new Product([
                'name' => $type?->name,
                'code' => productcode('Lens'),
                'category_id' => $type->category_id,
                'type_id' => $type->id,
                'material_id' => $material->id,
                'coating_id' => $coating->id,
                'eye' => strval($row[3]),
                'sph' => strval($row[4]),
                'cyl' => strval($row[5]),
                'axis' => strval($row[6]),
                'add' => strval($row[7]),
                'shelf' => strval($row[8]),
                'box' => strval($row[9]),
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
