<?php

namespace App\Console\Commands;

use App\Models\Citizen;
use App\Models\TseLocation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportTsePadron extends Command
{
    protected $signature = 'tse:import';

    protected $description = 'Importa el padrón electoral del TSE y la división electoral';

    public function handle(): int
    {
        $this->importLocations();
        $this->importCitizens();

        $this->info('Importación del TSE finalizada correctamente.');

        return self::SUCCESS;
    }

    private function importLocations(): void
    {
        $path = storage_path('app/tse/distelec.txt');

        if (!file_exists($path)) {
            $this->error("No existe el archivo: {$path}");
            return;
        }

        DB::table('tse_locations')->truncate();

        $handle = fopen($path, 'r');
        $rows = [];

        while (($line = fgets($handle)) !== false) {
            $data = str_getcsv(trim($line));

            if (count($data) < 4) {
                continue;
            }

            $rows[] = [
                'codelec' => trim($data[0]),
                'province' => $this->cleanText($data[1]),
                'canton' => $this->cleanText($data[2]),
                'district' => $this->cleanText($data[3]),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($rows) >= 1000) {
                DB::table('tse_locations')->insert($rows);
                $rows = [];
            }
        }

        fclose($handle);

        if (!empty($rows)) {
            DB::table('tse_locations')->insert($rows);
        }

        $this->info('División electoral importada.');
    }

    private function importCitizens(): void
    {
        $path = storage_path('app/tse/PADRON_COMPLETO.txt');

        if (!file_exists($path)) {
            $this->error("No existe el archivo: {$path}");
            return;
        }

        DB::table('citizens')->truncate();

        $handle = fopen($path, 'r');

        $rows = [];
        $count = 0;
        $now = now();

        while (($line = fgets($handle)) !== false) {
            $data = str_getcsv(trim($line));

            if (count($data) < 8) {
                continue;
            }

            $rows[] = [
                'ide' => trim($data[0]),
                'codelec' => trim($data[1]),
                'name' => $this->cleanText($data[5]),
                'lastname' => trim($this->cleanText($data[6]) . ' ' . $this->cleanText($data[7])),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($rows) >= 1000) {
                DB::table('citizens')->insertOrIgnore($rows);

                $count += count($rows);
                $rows = [];

                gc_collect_cycles();

                $this->line("Importados: {$count}");
            }
        }

        fclose($handle);

        if (!empty($rows)) {
            DB::table('citizens')->insertOrIgnore($rows);
        }

        $this->info("Padrón importado. Total procesado: {$count}");
    }

    private function cleanText(string $value): string
    {
        return Str::of($value)
            ->lower()
            ->title()
            ->squish()
            ->toString();
    }
}
