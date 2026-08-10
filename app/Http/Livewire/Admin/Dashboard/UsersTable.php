<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public bool $showDeleteModal = false;
    public $deleteUserId = null;
    public $deleteUserName = null;
    // Modal
    public bool $showModal = false;

    // Usuario que estamos editando
    public ?int $userId = null;

    // Campos
    public string $name = '';
    public string $email = '';
    public string $password = '';

    // Título del modal
    public string $modalTitle = 'Nuevo usuario';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();

        $this->modalTitle = 'Nuevo usuario';
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';

        $this->modalTitle = 'Editar usuario';
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;

        $this->resetForm();
        $this->resetValidation();
    }

    public function saveUser(): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
        ];

        // La contraseña es obligatoria solamente al crear
        if (!$this->userId) {
            $rules['password'] = [
                'required',
                'string',
                'min:8',
            ];
        } else {
            // Al editar es opcional
            $rules['password'] = [
                'nullable',
                'string',
                'min:8',
            ];
        }

        $this->validate($rules);

        if ($this->userId) {

            $user = User::findOrFail($this->userId);

            $user->name = $this->name;
            $user->email = $this->email;

            // Solo cambia la contraseña si escribieron una nueva
            if (!empty($this->password)) {
                $user->password = Hash::make($this->password);
            }

            $user->save();

            session()->flash('message', 'Usuario actualizado correctamente.');
        } else {

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            session()->flash('message', 'Usuario creado correctamente.');
        }

        $this->closeModal();
    }

    public function confirmDelete(int $id): void
    {
        $user = User::findOrFail($id);

        $this->deleteUserId = $user->id;
        $this->deleteUserName = $user->name;

        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;

        $this->deleteUserId = null;
        $this->deleteUserName = null;
    }

    public function deleteUser(): void
    {
        if (!$this->deleteUserId) {
            return;
        }

        $user = User::findOrFail($this->deleteUserId);

        $user->delete();

        $this->closeDeleteModal();

        session()->flash('message', 'Usuario eliminado correctamente.');

        $this->resetPage();
    }


    private function resetForm(): void
    {
        $this->reset([
            'userId',
            'name',
            'email',
            'password',
        ]);
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.dashboard.users-table', [
            'users' => $users,
        ]);
    }
}
