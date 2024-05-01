<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Main;

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
            $product->id,
            $product->date,
            $product->pf_retry,
            $product->pf_ng,
            $product->atsu_retry,
            $product->atsu_ng,
            // Exclude the action column
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
            // Exclude the action column heading
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
        $rows = $sheet->getHighestRow();
        for ($i = 2; $i <= $rows; $i++) {
            $sheet->getStyle('A'.$i.':F'.$i)->getAlignment()->setHorizontal('center');
        }
    }
}
