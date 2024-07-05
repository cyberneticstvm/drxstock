<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductLimitExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $params;
    public function __construct($params)
    {
        $this->params = $params;
    }
    public function collection()
    {
        $params = $this->params;
        $products = Product::withTrashed()->when($params[8], function ($q) use ($params) {
            return $q->where('type_id', $params[8]);
        })->when($params[9], function ($q) use ($params) {
            return $q->where('material_id', $params[9]);
        })->when($params[10], function ($q) use ($params) {
            return $q->where('coating_id', $params[10]);
        })->when($params[0] && $params[1], function ($q) use ($params) {
            return $q->whereRaw("CAST(sph AS DECIMAL(4,2)) BETWEEN CAST($params[0] AS DECIMAL(4,2)) AND CAST($params[1] AS DECIMAL(4,2))");
        })->when($params[2] && $params[3], function ($q) use ($params) {
            return $q->whereRaw("CAST(cyl AS DECIMAL(4,2)) BETWEEN CAST($params[2] AS DECIMAL(4,2)) AND CAST($params[3] AS DECIMAL(4,2))");
        })->when($params[4] && $params[5], function ($q) use ($params) {
            return $q->whereBetween('axis', [$params[4], $params[5]]);
        })->when($params[6] && $params[7], function ($q) use ($params) {
            return $q->whereRaw("CAST(`add` AS DECIMAL(4,2)) BETWEEN CAST($params[6] AS DECIMAL(4,2)) AND CAST($params[7] AS DECIMAL(4,2))");
        })->get();

        return $products->map(function ($data, $key) {
            return [
                '2' => $data->name,
                '3' => $data->code,
                '4' => $data->type?->name,
                '5' => $data->material?->name,
                '6' => $data->coating?->name,
                '7' => $data->eye,
                '8' => strval($data->sph) . ' ',
                '9' => strval($data->cyl) . ' ',
                '10' => $data->axis,
                '11' => strval($data->add) . ' ',
                '12' => $data->shelf,
                '13' => $data->box,
                '14' => getInventory($data->id, 0)->sum('balanceQty'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Product Name', 'Product Code', 'Type', 'Material', 'Coating', 'Eye', 'SPH', 'CYL', 'AXIS', 'ADD', 'Shelf', 'Box', 'Available Qty'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:M1')->getFont()->setBold(true);
    }
}
