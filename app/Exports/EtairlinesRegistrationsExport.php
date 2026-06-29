<?php

namespace App\Exports;

use App\Models\EtairlinesRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EtairlinesRegistrationsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return EtairlinesRegistration::latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Colegio de procedencia', 'Teléfono', 'Correo',
            'Carrera de interés 1', 'Carrera de interés 2', 'Cupón', 'Correo enviado', 'Registrado el',
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->id,
            $registration->name,
            $registration->school,
            $registration->phone,
            $registration->email,
            $registration->interest_one,
            $registration->interest_two,
            $registration->coupon_code,
            optional($registration->email_sent_at)->format('d/m/Y h:i A') ?: 'No',
            optional($registration->created_at)->format('d/m/Y h:i A'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
