<div class="users-admin-page">

    {{-- Barra institucional --}}
    <div class="institutional-bar"></div>

    <div class="p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <h3 class="fw-bold text-navy mb-0">
                        Administración de usuarios
                    </h3>
                </div>

                <p class="text-muted mb-0 ms-1">
                    Gestiona los usuarios con acceso al sistema.
                </p>
            </div>

            {{-- Nuevo usuario --}}
            <button
                type="button"
                class="users-create-btn"
                wire:click="openCreateModal">

                <i class="bi bi-person-plus-fill me-2"></i>
                Nuevo usuario

            </button>

        </div>


        {{-- Mensaje de éxito --}}
        @if (session()->has('message'))

        <div class="users-alert-success mb-4">

            <div class="d-flex align-items-center gap-2">

                <span class="users-alert-icon">
                    <i class="bi bi-check-lg"></i>
                </span>

                <div>
                    <div class="fw-bold">
                        Operación completada
                    </div>

                    <div class="small">
                        {{ session('message') }}
                    </div>
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                onclick="this.closest('.users-alert-success').remove()">
            </button>

        </div>

        @endif


        {{-- Filtros --}}
        <div class="filter-card mb-4">

            <div class="row align-items-center g-3">

                <div class="col-12">

                    <label class="users-filter-label">
                        Buscar usuario
                    </label>

                    <div class="users-search-wrapper">

                        <i class="bi bi-search users-search-icon"></i>

                        <input
                            type="text"
                            class="users-search-input"
                            placeholder="Buscar por nombre o correo..."
                            wire:model.debounce.400ms="search">

                        @if($search)

                        <button
                            type="button"
                            class="users-search-clear"
                            wire:click="$set('search', '')"
                            title="Limpiar búsqueda">

                            <i class="bi bi-x-lg"></i>

                        </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Tabla --}}
        <div class="users-table-wrap">

            <div class="table-responsive">

                <table class="users-table">

                    <thead>

                        <tr>

                            <th>
                                Usuario
                            </th>

                            <th>
                                Correo electrónico
                            </th>

                            <th class="text-end">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            {{-- Usuario --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="user-id">
                                            Usuario #{{ $user->id }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Correo --}}
                            <td>

                                <div class="user-email">

                                    <i class="bi bi-envelope me-2"></i>

                                    {{ $user->email }}

                                </div>

                            </td>


                            {{-- Acciones --}}
                            <td>

                                <div class="users-actions justify-content-end">

                                    <button
                                        type="button"
                                        class="user-action-btn user-edit-btn"
                                        wire:click="openEditModal({{ $user->id }})"
                                        title="Editar usuario">

                                        <i class="bi bi-pencil-square"></i>
                                        <span>Editar</span>

                                    </button>

                                    <button
                                        type="button"
                                        class="user-action-btn user-delete-btn"
                                        wire:click="confirmDelete({{ $user->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="confirmDelete"
                                        title="Eliminar usuario">

                                        <i class="bi bi-trash3"></i>

                                        <span>
                                            Eliminar
                                        </span>

                                    </button>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3">

                                <div class="users-empty">

                                    <div class="users-empty-icon">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <h5>
                                        No se encontraron usuarios
                                    </h5>

                                    <p>
                                        @if($search)
                                        No hay usuarios que coincidan con "{{ $search }}".
                                        @else
                                        Todavía no hay usuarios registrados.
                                        @endif
                                    </p>

                                    @if($search)

                                    <button
                                        type="button"
                                        class="users-empty-btn"
                                        wire:click="$set('search', '')">

                                        Limpiar búsqueda

                                    </button>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Paginación --}}
        @if($users->hasPages())

        <div class="users-pagination mt-4">

            {{ $users->links() }}

        </div>

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL CREAR / EDITAR USUARIO --}}
    {{-- ========================================================= --}}

    @if($showModal)

    <div
        class="users-modal-backdrop"
        wire:click.self="closeModal">

        <div class="users-modal">

            {{-- Barra institucional --}}
            <div class="institutional-bar"></div>


            {{-- Header --}}
            <div class="users-modal-header">

                <div class="d-flex align-items-center gap-3">

                    <div class="users-modal-icon">

                        <i class="bi {{ $userId
                            ? 'bi-person-gear'
                            : 'bi-person-plus-fill'
                        }}"></i>

                    </div>

                    <div>

                        <h4 class="users-modal-title">
                            {{ $modalTitle }}
                        </h4>

                        <p class="users-modal-subtitle">

                            {{ $userId
                                ? 'Actualiza la información del usuario.'
                                : 'Registra un nuevo usuario en el sistema.'
                            }}

                        </p>

                    </div>

                </div>


                {{-- Cerrar --}}
                <button
                    type="button"
                    class="users-modal-close"
                    wire:click="closeModal">

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>


            {{-- Body --}}
            <div class="users-modal-body">

                {{-- Nombre --}}
                <div class="users-form-group">

                    <label class="users-form-label">
                        Nombre completo
                    </label>

                    <div class="users-input-wrapper">

                        <i class="bi bi-person users-input-icon"></i>

                        <input
                            type="text"
                            class="users-form-input @error('name') is-invalid @enderror"
                            wire:model.defer="name"
                            placeholder="Ingrese el nombre completo">

                    </div>

                    @error('name')

                    <div class="users-error">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>

                    @enderror

                </div>


                {{-- Correo --}}
                <div class="users-form-group">

                    <label class="users-form-label">
                        Correo electrónico
                    </label>

                    <div class="users-input-wrapper">

                        <i class="bi bi-envelope users-input-icon"></i>

                        <input
                            type="email"
                            class="users-form-input @error('email') is-invalid @enderror"
                            wire:model.defer="email"
                            placeholder="correo@ejemplo.com">

                    </div>

                    @error('email')

                    <div class="users-error">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>

                    @enderror

                </div>


                {{-- Contraseña --}}
                <div class="users-form-group mb-0">

                    <label class="users-form-label">

                        Contraseña

                        @if($userId)

                        <span class="users-form-hint">
                            Opcional al editar
                        </span>

                        @endif

                    </label>

                    <div class="users-input-wrapper">

                        <i class="bi bi-lock users-input-icon"></i>

                        <input
                            type="password"
                            class="users-form-input @error('password') is-invalid @enderror"
                            wire:model.defer="password"
                            placeholder="{{ $userId
                                ? 'Dejar vacío para conservarla'
                                : 'Ingrese una contraseña'
                            }}">

                    </div>

                    @error('password')

                    <div class="users-error">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>

                    @enderror

                    @if(!$userId)

                    <div class="users-password-hint">

                        <i class="bi bi-shield-check me-1"></i>

                        La contraseña debe tener al menos 8 caracteres.

                    </div>

                    @endif

                </div>

            </div>


            {{-- Footer --}}
            <div class="users-modal-footer">

                {{-- Cancelar --}}
                <button
                    type="button"
                    class="users-cancel-btn"
                    wire:click="closeModal"
                    wire:loading.attr="disabled"
                    wire:target="saveUser">

                    Cancelar

                </button>


                {{-- Guardar --}}
                <button
                    type="button"
                    class="users-save-btn"
                    wire:click="saveUser"
                    wire:loading.attr="disabled"
                    wire:target="saveUser">

                    <span
                        wire:loading.remove
                        wire:target="saveUser">

                        <i class="bi bi-check2-circle me-2"></i>

                        {{ $userId
                            ? 'Guardar cambios'
                            : 'Crear usuario'
                        }}

                    </span>


                    <span
                        wire:loading
                        wire:target="saveUser">

                        <span
                            class="spinner-border spinner-border-sm me-2"
                            role="status">
                        </span>

                        {{ $userId
                            ? 'Guardando...'
                            : 'Creando...'
                        }}

                    </span>

                </button>

            </div>

        </div>

    </div>

    @endif

    {{-- ========================================================= --}}
    {{-- MODAL CONFIRMAR ELIMINACIÓN --}}
    {{-- ========================================================= --}}

    @if($showDeleteModal)

    <div
        class="users-delete-backdrop"
        wire:click.self="closeDeleteModal">
        <div class="users-delete-modal">

            {{-- Barra institucional --}}
            <div class="institutional-bar"></div>


            {{-- Contenido --}}
            <div class="users-delete-body">

                {{-- Icono --}}
                <div class="users-delete-icon">

                    <i class="bi bi-trash3"></i>

                </div>


                {{-- Título --}}
                <h4 class="users-delete-title">
                    ¿Eliminar usuario?
                </h4>


                {{-- Mensaje --}}
                <p class="users-delete-message">

                    ¿Está seguro de que desea eliminar al usuario

                    <strong>
                        {{ $deleteUserName }}
                    </strong>?

                </p>


                <div class="users-delete-warning">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <span>
                        Esta acción no se puede deshacer.
                    </span>

                </div>

            </div>


            {{-- Footer --}}
            <div class="users-delete-footer">

                {{-- Cancelar --}}
                <button
                    type="button"
                    class="users-cancel-btn"
                    wire:click="closeDeleteModal"
                    wire:loading.attr="disabled"
                    wire:target="deleteUser">

                    <i class="bi bi-x-lg me-2"></i>

                    Cancelar

                </button>


                {{-- Confirmar eliminación --}}
                <button
                    type="button"
                    class="users-confirm-delete-btn"
                    wire:click="deleteUser"
                    wire:loading.attr="disabled"
                    wire:target="deleteUser">

                    {{-- Estado normal --}}
                    <span
                        wire:loading.remove
                        wire:target="deleteUser">

                        <i class="bi bi-trash3 me-2"></i>

                        Sí, eliminar

                    </span>


                    {{-- Estado cargando --}}
                    <span
                        wire:loading
                        wire:target="deleteUser">

                        <span
                            class="spinner-border spinner-border-sm me-2"
                            role="status">
                        </span>

                        Eliminando...

                    </span>

                </button>

            </div>

        </div>
    </div>

    @endif