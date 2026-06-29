<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Exports\EtairlinesContactsExport;
use App\Exports\EtairlinesRegistrationsExport;
use App\Models\EtairlinesRegistration;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class EtairlinesRegistrationsTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $career = '';
    protected $paginationTheme = 'bootstrap';

    public array $careers = [
        'Administración de Empresa Virtual',
        'Gestión Empresarial',
        'Administración de Empresas Agropecuarias',
        'Ciencias Agropecuarias',
        'Contabilidad y Finanzas',
        'Desarrollo de Software',
        'Turismo Sostenible',
        'Gestión de la Calidad',
        'Biotecnología',
    ];

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

    public function exportRegisters()
    {
        return Excel::download(new EtairlinesRegistrationsExport(), 'ETAirlines-Registros-' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }

    public function exportContacts()
    {
        return Excel::download(new EtairlinesContactsExport(), 'ETAirlines-Contactos-' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }

    public function render()
    {
        $query = EtairlinesRegistration::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('school', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->career) {
            $query->where(function ($q) {
                $q->where('interest_one', $this->career)
                    ->orWhere('interest_two', $this->career);
            });
        }

        return view('livewire.admin.dashboard.etairlines-registrations-table', [
            'registrations' => $query->latest()->paginate(10),
            'total' => EtairlinesRegistration::count(),
            'withEmail' => EtairlinesRegistration::whereNotNull('email')->count(),
            'emailsSent' => EtairlinesRegistration::whereNotNull('email_sent_at')->count(),
        ]);
    }
}
