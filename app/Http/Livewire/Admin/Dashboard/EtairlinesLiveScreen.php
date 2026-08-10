<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\EtairlinesRegistration;
use Livewire\Component;

class EtairlinesLiveScreen extends Component
{
    /**
     * ID del último registro que la pantalla ya conoce.
     */
    public int $lastRegistrationId = 0;

    /**
     * Participantes que se mostrarán en pantalla.
     */
    public array $participants = [];

    /**
     * Total de registros.
     */
    public int $totalParticipants = 0;

    /**
     * ID del participante que acaba de entrar.
     * Lo utilizaremos después para la animación.
     */
    public ?int $newParticipantId = null;

    /**
     * Se ejecuta cuando se abre la pantalla.
     */
    public function mount(): void
    {
        /*
         * Cargamos inicialmente los últimos 12 participantes.
         */
        $initialParticipants = EtairlinesRegistration::query()
            ->latest('id')
            ->take(12)
            ->get()
            ->reverse();

        foreach ($initialParticipants as $registration) {
            $this->participants[] = [
                'id' => $registration->id,
                'name' => $registration->name,
            ];
        }

        /*
         * Guardamos el ID más reciente que existe actualmente.
         *
         * Esto es importante porque NO queremos que al abrir
         * la pantalla vuelva a mostrar todos los registros antiguos
         * como si fueran nuevos.
         */
        $this->lastRegistrationId =
            (int) (EtairlinesRegistration::max('id') ?? 0);

        /*
         * Contador inicial.
         */
        $this->totalParticipants =
            EtairlinesRegistration::count();
    }

    /**
     * Busca nuevos registros.
     *
     * Este método será ejecutado automáticamente
     * por Livewire cada 500 ms.
     */
    public function checkForNewRegistrations(): void
    {
        /*
         * Buscamos solamente registros cuyo ID sea
         * mayor al último que ya conocemos.
         */
        $newRegistrations = EtairlinesRegistration::query()
            ->where('id', '>', $this->lastRegistrationId)
            ->orderBy('id')
            ->get();

        /*
         * Si no hay registros nuevos,
         * solamente actualizamos el contador.
         */
        if ($newRegistrations->isEmpty()) {

            $this->totalParticipants =
                EtairlinesRegistration::count();

            return;
        }

        /*
         * Procesamos todos los registros nuevos.
         */
        foreach ($newRegistrations as $registration) {

            $this->participants[] = [
                'id' => $registration->id,
                'name' => $registration->name,
            ];

            /*
             * Guardamos cuál fue el último participante recibido.
             */
            $this->newParticipantId =
                $registration->id;

            /*
             * Actualizamos el último ID conocido.
             */
            $this->lastRegistrationId =
                (int) $registration->id;
        }

        /*
         * Solo mostramos los últimos 12 participantes.
         */
        $this->participants =
            array_slice($this->participants, -12);

        /*
         * Actualizamos el contador.
         */
        $this->totalParticipants =
            EtairlinesRegistration::count();
    }

    /**
     * Render de Livewire.
     */
    public function render()
    {
        return view(
            'livewire.admin.dashboard.etairlines-live-screen'
        );
    }
}
