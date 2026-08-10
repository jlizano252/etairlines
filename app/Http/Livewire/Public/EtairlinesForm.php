<?php

namespace App\Http\Livewire\Public;

use App\Jobs\SendEtairlinesBoardingPassMailJob;
use App\Models\EtairlinesRegistration;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EtairlinesForm extends Component
{
    public string $name = '';
    public string $school = '';
    public string $residence = '';

    public string $country_prefix = '+506';
    public string $phone_local = '';
    public string $phone = '';

    public string $email = '';
    public string $interest_one = '';
    public string $interest_two = '';

    public bool $accepted = false;
    public bool $completed = false;

    public ?EtairlinesRegistration $registration = null;

    public array $careers = [
        [
            'name' => 'Administración de Empresas Agropecuarias',
            'image' => 'admin-emp-agro.png',
        ],
        [
            'name' => 'Administración de Empresas Virtual',
            'image' => 'admin-emp-virt.png',
        ],
        [
            'name' => 'Ciencias Agropecuarias',
            'image' => 'agro.png',
        ],
        [
            'name' => 'Biotecnología',
            'image' => 'bio.png',
        ],
        [
            'name' => 'Contabilidad y Finanzas',
            'image' => 'conta.png',
        ],
        [
            'name' => 'Gestión Empresarial',
            'image' => 'gestion.png',
        ],
        [
            'name' => 'Desarrollo de Software',
            'image' => 'software.png',
        ],
        [
            'name' => 'Turismo Sostenible',
            'image' => 'turismo.png',
        ],
        [
            'name' => 'Gestión de la Calidad',
            'image' => 'gestion-calidad.png',
        ],
    ];

    public function updatedCountryPrefix(): void
    {
        $this->syncPhone();

        $this->validateOnly('country_prefix', [
            'country_prefix' => [
                'required',
                Rule::in($this->allowedPrefixes()),
            ],
        ], [
            'country_prefix.required' => 'Seleccione el prefijo de su país.',
            'country_prefix.in' => 'El prefijo seleccionado no es válido.',
        ]);
    }

    public function updatedPhoneLocal(): void
    {
        $this->syncPhone();
    }

    private function syncPhone(): void
    {
        $digits = preg_replace('/\D/', '', $this->phone_local);
        $prefix = preg_replace('/[^\+\d]/', '', $this->country_prefix);

        $this->phone = $digits !== ''
            ? $prefix . $digits
            : '';
    }

    private function allowedPrefixes(): array
    {
        return [
            '+506',
            '+507',
            '+505',
            '+503',
            '+502',
            '+504',
            '+52',
            '+57',
            '+1',
        ];
    }

    private function careerNames(): array
    {
        return collect($this->careers)
            ->pluck('name')
            ->values()
            ->all();
    }

    public function getCanSubmitProperty(): bool
    {
        $phoneDigits = preg_replace('/\D/', '', $this->phone_local);

        return
            mb_strlen(trim($this->name)) >= 5 &&
            mb_strlen(trim($this->school)) >= 3 &&
            mb_strlen(trim($this->residence)) >= 3 &&
            in_array($this->country_prefix, $this->allowedPrefixes(), true) &&
            strlen($phoneDigits) >= 7 &&
            strlen($phoneDigits) <= 12 &&
            filter_var(trim($this->email), FILTER_VALIDATE_EMAIL) !== false &&
            trim($this->interest_one) !== '' &&
            trim($this->interest_two) !== '' &&
            $this->interest_one !== $this->interest_two &&
            $this->accepted;
    }

    public function submit(): void
    {
        $this->normalizeFields();
        $this->syncPhone();

        $careerNames = $this->careerNames();

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'min:5',
                'max:150',
                "regex:/^[\pL\pM\s.'’-]+$/u",
            ],

            'school' => [
                'required',
                'string',
                'min:3',
                'max:180',
            ],

            'residence' => [
                'required',
                'string',
                'min:3',
                'max:180',
            ],

            'country_prefix' => [
                'required',
                Rule::in($this->allowedPrefixes()),
            ],

            'phone_local' => [
                'required',
                function ($attribute, $value, $fail) {
                    $digits = preg_replace('/\D/', '', $value);

                    if (strlen($digits) < 7 || strlen($digits) > 12) {
                        $fail('El número de teléfono debe contener entre 7 y 12 dígitos.');
                    }
                },
            ],

            'phone' => [
                'required',
                'regex:/^\+\d{8,15}$/',
            ],

            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:180',
            ],

            'interest_one' => [
                'required',
                'string',
                Rule::in($careerNames),
            ],

            'interest_two' => [
                'required',
                'string',
                'different:interest_one',
                Rule::in($careerNames),
            ],

            'accepted' => [
                'accepted',
            ],
        ], [
            'name.required' => 'Digite su nombre completo.',
            'name.min' => 'Digite su nombre y al menos un apellido.',
            'name.max' => 'El nombre no puede superar los 150 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, espacios, apóstrofes, puntos y guiones.',

            'school.required' => 'Digite el colegio de procedencia.',
            'school.min' => 'El nombre del colegio debe tener al menos 3 caracteres.',
            'school.max' => 'El nombre del colegio no puede superar los 180 caracteres.',

            'residence.required' => 'Digite su lugar de residencia.',
            'residence.min' => 'El lugar de residencia debe tener al menos 3 caracteres.',
            'residence.max' => 'El lugar de residencia no puede superar los 180 caracteres.',

            'country_prefix.required' => 'Seleccione el prefijo de su país.',
            'country_prefix.in' => 'El prefijo seleccionado no es válido.',

            'phone_local.required' => 'Digite su número de teléfono.',
            'phone.required' => 'Digite su número de teléfono.',
            'phone.regex' => 'Seleccione el país e ingrese un número de teléfono válido.',

            'email.required' => 'Digite su correo electrónico.',
            'email.email' => 'Digite un correo electrónico válido.',
            'email.max' => 'El correo no puede superar los 180 caracteres.',

            'interest_one.required' => 'Seleccione la primera carrera de interés.',
            'interest_one.in' => 'La primera carrera seleccionada no es válida.',

            'interest_two.required' => 'Seleccione la segunda carrera de interés.',
            'interest_two.different' => 'La segunda carrera debe ser diferente a la primera.',
            'interest_two.in' => 'La segunda carrera seleccionada no es válida.',

            'accepted.accepted' => 'Debe aceptar el uso de sus datos para continuar.',
        ]);

        $registration = EtairlinesRegistration::create([
            'name' => $validated['name'],
            'school' => $validated['school'],
            'residence' => $validated['residence'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'interest_one' => $validated['interest_one'],
            'interest_two' => $validated['interest_two'],
            'coupon_code' => 'ETAI-'
                . now()->format('y')
                . '-'
                . strtoupper(Str::random(6)),
        ]);

        SendEtairlinesBoardingPassMailJob::dispatch($registration->id)
            ->delay(now()->addSeconds(2));

        $this->registration = $registration;
        $this->completed = true;

        $this->resetForm();
    }

    private function normalizeFields(): void
    {
        $this->name = preg_replace('/\s+/', ' ', trim($this->name));
        $this->school = preg_replace('/\s+/', ' ', trim($this->school));
        $this->residence = preg_replace('/\s+/', ' ', trim($this->residence));
        $this->email = mb_strtolower(trim($this->email));
        $this->interest_one = trim($this->interest_one);
        $this->interest_two = trim($this->interest_two);
    }

    private function resetForm(): void
    {
        $this->reset([
            'name',
            'school',
            'residence',
            'phone_local',
            'phone',
            'email',
            'interest_one',
            'interest_two',
            'accepted',
        ]);

        $this->country_prefix = '+506';

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.public.etairlines-form');
    }
}
