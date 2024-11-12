<?php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackagesExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\LazyCollection
     */
    public function collection()
    {
        return Package::with(['store', 'commune', 'commune.wilaya', 'deliveryType', 'status'])->cursor();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Tracking Code',
            'Store Name',
            'Package Name',
            'Store Status',
            'Client Name',
            'Client Phone',
            'Commune',
            'Wilaya',
            'Delivery Type',
            'Status Name',
        ];
    }
}
