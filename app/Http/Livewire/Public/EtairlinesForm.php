<?php

namespace App\Http\Livewire\Public;

use App\Jobs\SendEtairlinesBoardingPassMailJob;
use App\Models\EtairlinesRegistration;
use Illuminate\Support\Str;
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
        ['name' => 'Administración de Empresas Agropecuarias', 'image' => 'admin-emp-agro.png'],
        ['name' => 'Administración de Empresas Virtual', 'image' => 'admin-emp-virt.png'],
        ['name' => 'Ciencias Agropecuarias', 'image' => 'agro.png'],
        ['name' => 'Biotecnología', 'image' => 'bio.png'],
        ['name' => 'Contabilidad y Finanzas', 'image' => 'conta.png'],
        ['name' => 'Gestión Empresarial', 'image' => 'gestion.png'],
        ['name' => 'Desarrollo de Software', 'image' => 'software.png'],
        ['name' => 'Turismo Sostenible', 'image' => 'turismo.png'],
        ['name' => 'Gestión de la Calidad', 'image' => 'gestion-calidad.png'],
    ];

    public function updatedCountryPrefix(): void
    {
        $this->syncPhone();
    }

    public function updatedPhoneLocal(): void
    {
        $this->syncPhone();
    }

    private function syncPhone(): void
    {
        $digits = preg_replace('/\D/', '', $this->phone_local);
        $prefix = preg_replace('/[^\+\d]/', '', $this->country_prefix);

        $this->phone = $digits ? $prefix . $digits : '';
    }

    public function getCanSubmitProperty(): bool
    {
        return
            trim($this->name) !== '' &&
            preg_match('/^\+\d{8,20}$/', trim($this->phone)) &&
            trim($this->interest_one) !== '' &&
            $this->accepted;
    }

    public function submit(): void
    {
        $this->syncPhone();

        $this->validate([
            'name' => 'required|string|min:3|max:150',
            'school' => 'nullable|string|max:180',
            'residence' => 'required|string|max:180',
            'phone' => ['required', 'regex:/^\+\d{8,20}$/'],
            'email' => 'nullable|email|max:180',
            'interest_one' => 'required|string|max:150',
            'interest_two' => 'nullable|string|max:150|different:interest_one',
            'accepted' => 'accepted',
        ], [
            'name.required' => 'Digite su nombre completo.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'residence.required' => 'Digite su lugar de residencia.',
            'phone.required' => 'Digite su número de teléfono.',
            'phone.regex' => 'Seleccione el país e ingrese un número de teléfono válido.',
            'email.email' => 'Digite un correo electrónico válido.',
            'interest_one.required' => 'Seleccione al menos una carrera de interés.',
            'interest_two.different' => 'La segunda carrera debe ser diferente a la primera.',
            'accepted.accepted' => 'Debe aceptar el uso de sus datos para continuar.',
        ]);

        $registration = EtairlinesRegistration::create([
            'name' => trim($this->name),
            'school' => trim($this->school) ?: null,
            'residence' => trim($this->residence),
            'phone' => trim($this->phone),
            'email' => trim($this->email) ?: null,
            'interest_one' => $this->interest_one,
            'interest_two' => $this->interest_two ?: null,
            'coupon_code' => 'ETAI-' . now()->format('y') . '-' . strtoupper(Str::random(6)),
        ]);

        if ($registration->email) {
            SendEtairlinesBoardingPassMailJob::dispatch($registration->id)
                ->delay(now()->addSeconds(2));
        }

        $this->registration = $registration;
        $this->completed = true;

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
    }

    public function render()
    {
        return view('livewire.public.etairlines-form');
    }
}
