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
        return [
            $product->date,
            $product->pf_retry,
            $product->pf_ng,
            $product->atsu_retry,
            $product->atsu_ng,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'PF_RETRY',
            'PF_NG',
            'ATSU_RETRY',
            'ATSU_NG',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('G:G')->getAlignment()->setHorizontal('');
        $rows = $sheet->getHighestRow();
        for ($i = 2; $i <= $rows; $i++) {
            $sheet->getStyle('A'.$i.':F'.$i)->getAlignment()->setHorizontal('center');
        }
    }      
}
