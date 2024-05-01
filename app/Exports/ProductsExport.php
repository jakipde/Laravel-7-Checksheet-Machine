<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MainExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{

    protected $filteredData;

    public function __construct($filteredData)
    {
        $this->filteredData = $filteredData;
    }

    public function collection()
    {
        return $this->filteredData;
    }

    public function map($product): array
    {
        return (new ProductsValueBinder)->map($product);
    }

    public function headings(): array
    {
        return (new ProductsValueBinder)->headings();
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
        $rows = $sheet->getHighestRow();
        for ($i = 2; $i <= $rows; $i++) {
            $sheet->getStyle('A'.$i.':L'.$i)->getAlignment()->setHorizontal('center');
        }
    }
}
