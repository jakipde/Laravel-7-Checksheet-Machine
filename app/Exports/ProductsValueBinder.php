<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class MainValueBinder implements WithMapping, WithHeadings
{
    public function map($product): array
    {
        return [
            $product->line_id,
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
}