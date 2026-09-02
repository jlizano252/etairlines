<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Exports\EtairlinesContactsExport;
use App\Exports\EtairlinesRegistrationsExport;
use App\Mail\EtairlinesReminderMail;
use App\Models\EtairlinesRegistration;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\SendEtairlinesReminderMailJob;
use App\Models\EmailCampaign;

class EtairlinesRegistrationsTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $career = '';

    protected $paginationTheme = 'bootstrap';

    public ?EmailCampaign $campaign = null;

    public int $progress = 0;

    public array $careers = [
        'Administración de Empresas Virtual',
        'Gestión Empresarial',
        'Administración de Empresas Agropecuarias',
        'Ciencias Agropecuarias',
        'Contabilidad y Finanzas',
        'Desarrollo de Software',
        'Turismo Sostenible',
        'Gestión de la Calidad',
        'Biotecnología',
    ];

    // =========================================================
    // MODAL DE RECORDATORIO
    // =========================================================

    public bool $showReminderModal = false;

    public string $reminderSearch = '';

    public string $reminderFilter = 'with_email';

    /**
     * Carrera seleccionada para el envío.
     *
     * '' = Todas las carreras
     */
    public string $reminderCareer = '';

    public array $reminderSelected = [];

    public bool $reminderSelectAll = false;

    public string $reminderSubject = 'ETAIRLINES | Recordatorio importante';

    public string $reminderMessage = "Hola {nombre},\n\nQueremos recordarte que tenemos información pendiente relacionada con tu registro. Nos encantaría continuar acompañándote en este proceso.\n\nSi ya tomaste una decisión o tienes alguna consulta, no dudes en contactarnos.\n\nSaludos,\nEquipo ETAIRLINES";


    // =========================================================
    // FILTROS PRINCIPALES
    // =========================================================

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCareer(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'career']);

        $this->resetPage();
    }


    // =========================================================
    // EXPORTACIONES
    // =========================================================

    public function exportRegisters()
    {
        return Excel::download(
            new EtairlinesRegistrationsExport(),
            'ETAirlines-Registros-' . now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    public function exportContacts()
    {
        return Excel::download(
            new EtairlinesContactsExport(),
            'ETAirlines-Contactos-' . now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }


    // =========================================================
    // MODAL DE RECORDATORIO
    // =========================================================

    public function openReminderModal(): void
    {
        $this->reset([
            'reminderSelected',
            'reminderSelectAll',
            'reminderSearch',
            'reminderCareer',
        ]);

        $this->reminderFilter = 'with_email';

        $this->showReminderModal = true;
    }

    public function closeReminderModal(): void
    {
        $this->showReminderModal = false;
    }


    // =========================================================
    // FILTROS DEL MODAL
    // =========================================================

    public function updatedReminderFilter(): void
    {
        $this->reminderSelected = [];

        $this->reminderSelectAll = false;
    }

    public function updatedReminderCareer(): void
    {
        /*
         * Cuando se cambia de carrera,
         * eliminamos las selecciones anteriores.
         */
        $this->reminderSelected = [];

        $this->reminderSelectAll = false;
    }

    public function updatedReminderSearch(): void
    {
        /*
         * Evita conservar selecciones que ya no
         * pertenecen a los resultados visibles.
         */
        $this->reminderSelected = [];

        $this->reminderSelectAll = false;
    }


    // =========================================================
    // DESTINATARIOS DEL MODAL
    // =========================================================

    public function getReminderCandidatesProperty()
    {
        $query = EtairlinesRegistration::query();


        // -----------------------------------------------------
        // Filtro por correo
        // -----------------------------------------------------

        if ($this->reminderFilter === 'with_email') {

            $query->whereNotNull('email')
                ->where('email', '!=', '');

        } else {

            $query->where(function ($q) {

                $q->whereNull('email')
                    ->orWhere('email', '');

            });

        }


        // -----------------------------------------------------
        // Filtro por carrera
        // -----------------------------------------------------

        if ($this->reminderCareer) {

            $query->where(function ($q) {

                $q->where('interest_one', $this->reminderCareer)
                    ->orWhere('interest_two', $this->reminderCareer);

            });

        }


        // -----------------------------------------------------
        // Búsqueda
        // -----------------------------------------------------

        if ($this->reminderSearch) {

            $query->where(function ($q) {

                $q->where(
                    'name',
                    'like',
                    "%{$this->reminderSearch}%"
                )
                ->orWhere(
                    'email',
                    'like',
                    "%{$this->reminderSearch}%"
                );

            });

        }


        return $query
            ->orderBy('name')
            ->get();
    }


    // =========================================================
    // SELECCIONAR TODOS
    // =========================================================

    public function toggleReminderSelectAll(): void
    {
        if ($this->reminderSelectAll) {

            $this->reminderSelected = $this->reminderCandidates
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();

        } else {

            $this->reminderSelected = [];

        }
    }


    // =========================================================
    // ENVIAR RECORDATORIOS
    // =========================================================

    public function sendReminders()
    {
        $this->validate([
            'reminderMessage' => 'required|string',
            'reminderSubject' => 'required|string',
            'reminderSelected' => 'required|array|min:1',
        ]);


        /*
         * IMPORTANTE:
         *
         * Aquí volvemos a aplicar el filtro de carrera.
         *
         * Esto garantiza que aunque alguien manipule
         * el frontend, solamente se envíen correos a
         * personas de la carrera seleccionada.
         */

        $query = EtairlinesRegistration::whereIn(
            'id',
            $this->reminderSelected
        )
        ->whereNotNull('email')
        ->where('email', '!=', '');


        // -----------------------------------------------------
        // Aplicar carrera nuevamente al envío
        // -----------------------------------------------------

        if ($this->reminderCareer) {

            $query->where(function ($q) {

                $q->where(
                    'interest_one',
                    $this->reminderCareer
                )
                ->orWhere(
                    'interest_two',
                    $this->reminderCareer
                );

            });

        }


        $registros = $query->get();


        // Si por alguna razón no quedaron registros válidos
        if ($registros->isEmpty()) {

            session()->flash(
                'error',
                'No hay destinatarios válidos para enviar el recordatorio.'
            );

            return;
        }


        // -----------------------------------------------------
        // Crear campaña
        // -----------------------------------------------------

        $campaign = EmailCampaign::create([
            'type' => 'etairlines_reminder',
            'subject' => $this->reminderSubject,
            'total' => $registros->count(),
            'sent' => 0,
            'failed' => 0,
            'status' => 'processing',
        ]);


        $this->campaign = $campaign;

        $this->progress = 0;


        // -----------------------------------------------------
        // Programar correos
        // -----------------------------------------------------

        foreach ($registros as $index => $registro) {

            SendEtairlinesReminderMailJob::dispatch(
                $campaign->id,
                $registro->email,
                $registro->name,
                $this->reminderSubject,
                $this->reminderMessage
            )
            ->delay(
                now()->addSeconds($index * 5)
            );

        }


        // -----------------------------------------------------
        // Limpiar modal
        // -----------------------------------------------------

        $this->showReminderModal = false;

        $this->reminderSelected = [];

        $this->reminderSelectAll = false;


        session()->flash(
            'message',
            "Se programaron {$registros->count()} recordatorios. El envío se está procesando."
        );
    }


    // =========================================================
    // PROGRESO DE CAMPAÑA
    // =========================================================

    public function refreshCampaign(): void
    {
        if (!$this->campaign) {

            $this->campaign = EmailCampaign::where(
                'status',
                'processing'
            )
            ->latest()
            ->first();


            if (!$this->campaign) {
                return;
            }
        }


        $this->campaign->refresh();


        if ($this->campaign->total > 0) {

            $this->progress = (int) round(

                (
                    ($this->campaign->sent + $this->campaign->failed)
                    /
                    $this->campaign->total
                ) * 100

            );

        }


        if ($this->campaign->status === 'completed') {

            $this->progress = 100;

        }
    }


    // =========================================================
    // RENDER
    // =========================================================

    public function render()
    {
        $query = EtairlinesRegistration::query();


        // -----------------------------------------------------
        // Búsqueda principal
        // -----------------------------------------------------

        if ($this->search) {

            $query->where(function ($q) {

                $q->where(
                    'name',
                    'like',
                    '%' . $this->search . '%'
                )
                ->orWhere(
                    'school',
                    'like',
                    '%' . $this->search . '%'
                )
                ->orWhere(
                    'phone',
                    'like',
                    '%' . $this->search . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $this->search . '%'
                );

            });

        }


        // -----------------------------------------------------
        // Carrera principal
        // -----------------------------------------------------

        if ($this->career) {

            $query->where(function ($q) {

                $q->where(
                    'interest_one',
                    $this->career
                )
                ->orWhere(
                    'interest_two',
                    $this->career
                );

            });

        }


        return view(
            'livewire.admin.dashboard.etairlines-registrations-table',
            [

                'registrations' =>
                    $query
                        ->latest()
                        ->paginate(10),

                'total' =>
                    EtairlinesRegistration::count(),

                'withEmail' =>
                    EtairlinesRegistration::whereNotNull('email')
                        ->where('email', '!=', '')
                        ->count(),

                'emailsSent' =>
                    EtairlinesRegistration::whereNotNull('email_sent_at')
                        ->count(),

                'withEmailCount' =>
                    EtairlinesRegistration::whereNotNull('email')
                        ->where('email', '!=', '')
                        ->count(),

                'withoutEmailCount' =>
                    EtairlinesRegistration::where(function ($q) {

                        $q->whereNull('email')
                            ->orWhere('email', '');

                    })
                    ->count(),

            ]
        );
    }
}