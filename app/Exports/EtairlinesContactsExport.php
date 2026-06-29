<?php

namespace App\Exports;

use App\Models\EtairlinesRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;

class EtairlinesContactsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithEvents
{
    public function collection()
    {
        return EtairlinesRegistration::latest()->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Teléfono'
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->name,
            $registration->phone,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Encabezado
        $sheet->getStyle('A1:B1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => [
                    'rgb' => 'FFFFFF'
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '01498D'
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Bordes
        $lastRow = $sheet->getHighestRow();

        $sheet->getStyle("A1:B{$lastRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('D9E2EC'));

        // Centrar teléfonos
        $sheet->getStyle("B2:B{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Altura encabezado
        $sheet->getRowDimension(1)->setRowHeight(24);

        return [];
    }

    public static function afterSheet(AfterSheet $event)
    {
        //
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                // Congelar encabezado
                $sheet->freezePane('A2');

                // Autofiltro
                $sheet->setAutoFilter(
                    $sheet->calculateWorksheetDimension()
                );

                // Color alterno filas
                $lastRow = $sheet->getHighestRow();

                for ($row = 2; $row <= $lastRow; $row++) {

                    if ($row % 2 == 0) {

                        $sheet->getStyle("A{$row}:B{$row}")
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setRGB('F8FBFD');
                    }
                }
            },

        ];
    }
}
