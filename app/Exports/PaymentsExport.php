<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::all()->select;
    }

    public function headings(): array
    {
        return [
            'Payment ID',
            'Tipi',
            'Shuma',
            'Prej',
            'Deri',
            'Shenim'
            ];
    }
}
