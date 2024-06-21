<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $products = Product::orderBy('code', 'ASC')->get();
        return $products->map(function ($data, $key) {
            return [
                '2' => $data->name,
                '3' => $data->code,
                '4' => $data->type->name,
                '5' => $data->material->name,
                '6' => $data->coating->name,
                '7' => $data->eye,
                '8' => strval($data->sph) . ' ',
                '9' => strval($data->cyl) . ' ',
                '10' => $data->axis,
                '11' => strval($data->add) . ' ',
                '12' => $data->shelf,
                '13' => $data->box,
                '14' => $data->reorder_qty,
                '15' => '0.00',
                '16' => '0.00',
            ];
        });
    }

    public function headings(): array
    {
        return ['Product Name', 'Product Code', 'Type', 'Material', 'Coating', 'Eye', 'SPH', 'CYL', 'AXIS', 'ADD', 'Shelf', 'Box', 'Re-order Qty', 'Purchase Price', 'Selling Price'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:O1')->getFont()->setBold(true);
    }
}
