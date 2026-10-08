<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class ProductExport implements FromCollection, WithHeadings, WithStyles
{

    protected $ids;

    function __construct($ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if(empty($this->ids)) {
            return Product::all();
        } else {
            return Product::whereIn("id", $this->ids)->get();
        }

    }

    public function headings(): array
    {
        return [
            'Id',
            'Barcode',
            'Sku',
            'Name',
            'Price',
            'discount_percentage',
            'discount_from_date',
            'discount_to_date',
            'featured_image',
            'inventory_qty',
            'category_id',
            'brand_id',
            'created_date',
            'description',
            'star',
            'featured',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'font' => [
                'color' => ['argb' => '000'],
            ],
            'fpriceill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'E9ECEF',
                ]
            ]
        ];
        $sheet->getStyle('A1:P1')->applyFromArray($styleArray);
    }
}
