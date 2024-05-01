<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

// class MainValueBinder implements WithMapping, WithHeadings
// {
//     public function map($product): array
//     {
//         return [
//             $product->part->name,
//             $product->customer->name,
//             $product->rak,
//             $product->shift->name,
//             $product->in->name,
//             $product->out->name,
//             $product->sisa->name,
//             $product->pic,
//             $product->pic_name,
//             $product->keterangan,
//             Carbon::parse($product->created_at)->timezone('Asia/Jakarta')->format('Y/m/d - H:i'),
//             Carbon::parse($product->updated_at)->timezone('Asia/Jakarta')->format('Y/m/d - H:i'),
//         ];
//     }

//     public function headings(): array
//     {
//         return [
//             'Part Model',
//             'Customer',
//             'Rak',
//             'Shift',
//             'In (pcs)',
//             'Out (pcs)',
//             'Sisa',
//             'PIC',
//             'Nama PIC',
//             'keterangan',
//             'Dibuat Pada',
//             'Diubah Pada',
//         ];
//     }
// }
