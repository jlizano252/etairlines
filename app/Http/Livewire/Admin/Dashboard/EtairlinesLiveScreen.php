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
         * Guardamos el ID más reciente existente.
         *
         * De esta manera, los registros antiguos NO se
         * consideran nuevos cuando abrimos la pantalla.
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
     * Comprueba si existe un nuevo registro.
     *
     * Este método se ejecuta cada 500 ms.
     */
    public function checkForNewRegistrations(): void
    {
        /*
         * PRIMERA CONSULTA:
         *
         * Solo preguntamos cuál es el ID más reciente.
         *
         * Esta consulta es muy pequeña porque "id"
         * normalmente es la PRIMARY KEY de la tabla.
         */
        $latestId = (int) (
            EtairlinesRegistration::max('id') ?? 0
        );

        /*
         * Si el ID no cambió, significa que NO hay
         * registros nuevos.
         *
         * Terminamos aquí y no hacemos ninguna consulta adicional.
         */
        if ($latestId <= $this->lastRegistrationId) {
            return;
        }

        /*
         * Llegamos aquí únicamente si apareció
         * al menos un registro nuevo.
         *
         * Ahora sí buscamos los registros nuevos.
         */
        $newRegistrations = EtairlinesRegistration::query()
            ->where('id', '>', $this->lastRegistrationId)
            ->orderBy('id')
            ->get();

        /*
         * Agregamos los nuevos participantes.
         */
        foreach ($newRegistrations as $registration) {

            $this->participants[] = [
                'id' => $registration->id,
                'name' => $registration->name,
            ];

            /*
             * Guardamos el último participante recibido.
             */
            $this->newParticipantId =
                (int) $registration->id;

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
         * Actualizamos el contador solamente
         * porque realmente hubo registros nuevos.
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
