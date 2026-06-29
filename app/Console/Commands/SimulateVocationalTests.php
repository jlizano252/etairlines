<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use App\Jobs\SendVocationalResultMailJob;

class SimulateVocationalTests extends Command
{
    protected $signature = 'test:simulate {count=1000}';

    protected $description = 'Simula estudiantes completando el test vocacional';

    public function handle(): int
    {
        $count = (int) $this->argument('count');

        $questions = Question::all();

        if ($questions->isEmpty()) {
            $this->error('No existen preguntas registradas.');
            return self::FAILURE;
        }

        $this->info("Generando {$count} estudiantes...");

        for ($i = 1; $i <= $count; $i++) {

            $province = rand(1, 7);

            $middle = str_pad(
                (($i - 1) % 9999) + 1,
                4,
                '0',
                STR_PAD_LEFT
            );

            $end = str_pad(
                (($i - 1) % 9999) + 1,
                4,
                '0',
                STR_PAD_LEFT
            );

            $names = [
                'Juan',
                'María',
                'José',
                'Daniel',
                'Sofía',
                'Andrés',
                'Valeria',
                'Kevin',
                'Camila',
                'Gabriel',
                'Fernanda',
                'Luis',
                'Paula',
                'Sebastián',
                'Ana',
            ];

            $lastNames = [
                'Rodríguez',
                'González',
                'Vargas',
                'Jiménez',
                'Rojas',
                'Ramírez',
                'Castro',
                'Mora',
                'Solano',
                'Chaves',
                'Araya',
                'Cordero',
                'Herrera',
                'Quesada',
                'Alvarado',
            ];

            $firstName = $names[array_rand($names)];
            $lastName1 = $lastNames[array_rand($lastNames)];
            $lastName2 = $lastNames[array_rand($lastNames)];

            $student = Student::create([
                'ide'              => $province . $middle . $end,
                'name'             => $firstName,
                'lastname'         => $lastName1 . ' ' . $lastName2,
                'email'            => strtolower($firstName) . $i . '@mail.com',
                'mobile'           => '8' . rand(1000000, 9999999),
                'secondary_mobile' => '7' . rand(1000000, 9999999),
                'school'           => 'Colegio de Prueba ' . rand(1, 50),
                'province_id'      => 1,
                'canton_id'        => 1,
                'district_id'      => 1,
                'exact_address'    => 'Dirección de prueba #' . $i,
            ]);

            $answers = [];
            $scores = [];

            foreach ($questions as $question) {

                $value = rand(1, 3);

                $answers[] = [
                    'student_id' => $student->id,
                    'question_id' => $question->id,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $scores[$question->career_id] =
                    ($scores[$question->career_id] ?? 0) + $value;
            }

            Answer::insert($answers);

            $results = collect($scores)
                ->map(function ($score, $careerId) use ($student) {

                    return [
                        'student_id' => $student->id,
                        'career_id' => $careerId,
                        'score' => $score,
                        'percentage' => round(($score / 24) * 100, 1),
                        'level' => match (true) {
                            $score >= 22 => 'Muy alta afinidad',
                            $score >= 18 => 'Alta afinidad',
                            $score >= 14 => 'Afinidad moderada',
                            $score >= 10 => 'Baja afinidad',
                            default => 'Muy baja afinidad',
                        },
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })
                ->values()
                ->toArray();

            Result::insert($results);

            // Cargar relaciones para el correo
            $student = Student::with([
                'results.career',
                'province',
                'canton',
                'district'
            ])->find($student->id);

            // Despachar Job
            SendVocationalResultMailJob::dispatch($student)
                ->delay(now()->addSeconds(rand(1, 60)));

            if ($i % 100 === 0) {
                $this->info("Procesados: {$i}");
            }
        }

        $this->info("Finalizado. {$count} estudiantes creados.");

        return self::SUCCESS;
    }
}
