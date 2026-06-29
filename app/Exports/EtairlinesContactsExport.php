<?php

namespace App\Exports;

use App\Models\EtairlinesRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EtairlinesContactsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return EtairlinesRegistration::latest()->get();
    }

    public function headings(): array
    {
        return ['Nombre', 'Teléfono', 'Correo', 'Colegio', 'Carreras de interés'];
    }

    public function map($registration): array
    {
        return [
            $registration->name,
            $registration->phone,
            $registration->email,
            $registration->school,
            trim(($registration->interest_one ?: '') . ' / ' . ($registration->interest_two ?: ''), ' /'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
