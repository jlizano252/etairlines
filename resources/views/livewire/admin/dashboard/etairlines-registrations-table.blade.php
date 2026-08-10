<div class="container-fluid py-4">

    <div class="card border-0 rounded-4 shadow-lg overflow-hidden bg-white">

        <div class="institutional-bar"></div>

        <div class="card-body p-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <span class="badge rounded-pill bg-light text-navy px-3 py-2 mb-2">
                        <i class="fas fa-plane-departure me-1"></i>
                        ETAIRLINES
                    </span>

                    <h3 class="fw-bold text-navy mb-1">
                        Registros ETAIRLINES
                    </h3>

                    <p class="text-muted mb-0">
                        Gestión de datos recolectados, contactos y exportaciones.
                    </p>
                </div>
            </div>

            {{-- KPIs --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="kpi">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small>Total registros</small>
                                <strong>{{ number_format($total) }}</strong>
                            </div>
                            <i class="fas fa-users kpi-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="kpi green">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small>Con correo</small>
                                <strong>{{ number_format($withEmail) }}</strong>
                            </div>
                            <i class="fas fa-envelope kpi-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="kpi yellow">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small>Boletos enviados</small>
                                <strong>{{ number_format($emailsSent) }}</strong>
                            </div>
                            <i class="fas fa-ticket-alt kpi-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if($campaign)

            <div class="card border-0 shadow-sm mb-4"
                wire:poll.1s="refreshCampaign">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">

                        <strong>
                            Enviando recordatorios
                        </strong>

                        <strong>
                            {{ $campaign->sent + $campaign->failed }}
                            /
                            {{ $campaign->total }}
                            ({{ $progress }}%)
                        </strong>

                    </div>

                    <div class="progress" style="height:25px">

                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                            role="progressbar"
                            style="width: {{ $progress }}%">

                        </div>

                    </div>

                    <div class="mt-2">

                        <small class="text-muted">

                            Enviados:

                            <strong>{{ $campaign->sent }}</strong>

                            &nbsp;|&nbsp;

                            Fallidos:

                            <strong>{{ $campaign->failed }}</strong>

                            &nbsp;|&nbsp;

                            Total:

                            <strong>{{ $campaign->total }}</strong>

                        </small>

                    </div>

                    @if($campaign->status === 'completed')

                    <div class="alert alert-success mt-3 mb-0">

                        <i class="fas fa-check-circle me-2"></i>

                        Todos los correos fueron procesados.

                    </div>

                    @endif

                </div>

            </div>

            @endif

            {{-- Filtros --}}
            <div class="filter-card mb-4">
                <div class="row g-3 align-items-center">

                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-text rounded-start-4 bg-white">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input
                                wire:model.debounce.400ms="search"
                                class="form-control rounded-end-4 border-start-0"
                                placeholder="Buscar nombre, colegio, teléfono o correo...">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <select wire:model="career" class="form-select rounded-4">
                            <option value="">Todas las carreras</option>
                            @foreach($careers as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-1 d-grid">
                        <button
                            wire:click="clearFilters"
                            class="btn btn-light rounded-4 border"
                            title="Limpiar filtros"
                            type="button">
                            <i class="fas fa-broom"></i>
                        </button>
                    </div>

                    {{-- Acciones --}}
                    <div class="col-lg-3 d-flex justify-content-lg-end">

                        <div class="dropdown">

                            <button
                                type="button"
                                class="btn actions-dropdown-btn dropdown-toggle"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-sliders-h me-2"></i>
                                Acciones
                            </button>


                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2">

                                {{-- Recordatorios --}}
                                <li>

                                    <button
                                        type="button"
                                        wire:click="openReminderModal"
                                        class="dropdown-item rounded-3 py-2">
                                        <i class="fas fa-bell text-warning me-2"></i>
                                        Recordatorios
                                    </button>

                                </li>


                                <li>
                                    <hr class="dropdown-divider">
                                </li>


                                {{-- Exportar registros --}}
                                <li>

                                    <button
                                        type="button"
                                        wire:click="exportRegisters"
                                        class="dropdown-item rounded-3 py-2"
                                        wire:loading.attr="disabled"
                                        wire:target="exportRegisters">

                                        <span wire:loading.remove wire:target="exportRegisters">

                                            <i class="fas fa-download text-primary me-2"></i>
                                            Exportar registros

                                        </span>


                                        <span wire:loading wire:target="exportRegisters">

                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            Generando...

                                        </span>

                                    </button>

                                </li>


                                {{-- Exportar contactos --}}
                                <li>

                                    <button
                                        type="button"
                                        wire:click="exportContacts"
                                        class="dropdown-item rounded-3 py-2"
                                        wire:loading.attr="disabled"
                                        wire:target="exportContacts">

                                        <span wire:loading.remove wire:target="exportContacts">

                                            <i class="fas fa-address-book text-success me-2"></i>
                                            Exportar contactos

                                        </span>


                                        <span wire:loading wire:target="exportContacts">

                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            Generando...

                                        </span>

                                    </button>

                                </li>


                                <li>
                                    <hr class="dropdown-divider">
                                </li>


                                {{-- Pantalla en vivo --}}
                                <li>

                                    <a
                                        href="{{ route('admin.etairlines.live-screen') }}"
                                        target="_blank"
                                        class="dropdown-item rounded-3 py-2">

                                        <i class="fas fa-tv text-info me-2"></i>
                                        Pasajeros ETAIrlines
                                    </a>

                                </li>


                                {{-- Usuarios --}}
                                @if(auth()->user()->email === 'jlizano@iacsa.cr')

                                <li>

                                    <a
                                        href="{{ route('admin.users.index') }}"
                                        class="dropdown-item rounded-3 py-2">

                                        <i class="fas fa-users-cog text-dark me-2"></i>
                                        Administración de usuarios

                                    </a>

                                </li>

                                @endif

                            </ul>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="registrations-table-wrap">
                <div class="table-responsive">
                    <table class="table align-middle registrations-table mb-0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Estudiante</th>
                                <th>Contacto</th>
                                <th>Colegio</th>
                                <th>Intereses</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($registrations as $r)
                            <tr>
                                <td class="text-nowrap">
                                    <strong>{{ $r->created_at->format('d/m/Y') }}</strong><br>
                                    <small class="text-muted">{{ $r->created_at->format('h:i A') }}</small>
                                </td>

                                <td>
                                    <strong class="text-navy">{{ $r->name }}</strong><br>
                                    <small class="text-muted">{{ $r->coupon_code }}</small>
                                </td>

                                <td class="text-nowrap">
                                    <i class="fas fa-phone-alt text-success me-1"></i>
                                    {{ $r->phone ?: '-' }}<br>
                                    <small class="text-muted">
                                        <i class="fas fa-envelope me-1"></i>
                                        {{ $r->email ?: 'Sin correo' }}
                                    </small>
                                </td>

                                <td>{{ $r->school ?: '-' }}</td>

                                <td>
                                    <span class="badge bg-light text-navy rounded-pill px-3 py-2">
                                        {{ $r->interest_one ?: '-' }}
                                    </span>

                                    @if($r->interest_two)
                                    <br>
                                    <span class="badge bg-light text-success rounded-pill px-3 py-2 mt-1">
                                        {{ $r->interest_two }}
                                    </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($r->email_sent_at)
                                    <span class="badge rounded-pill bg-success px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Enviado
                                    </span>
                                    @else
                                    <span class="badge rounded-pill bg-secondary px-3 py-2">
                                        <i class="fas fa-clock me-1"></i>
                                        Pendiente
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No hay registros.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $registrations->links() }}
            </div>

        </div>
    </div>
    {{-- ================= MODAL DE RECORDATORIO ================= --}}
    @if($showReminderModal)

    <div class="reminder-modal-wrapper">

        <div class="reminder-backdrop">

            <div class="reminder-panel">


                {{-- Header --}}
                <div class="reminder-header">

                    <div>

                        <span class="badge rounded-pill bg-light text-navy px-3 py-2 mb-2">
                            <i class="fas fa-plane-departure me-1"></i>
                            ETAIRLINES
                        </span>

                        <h4 class="fw-bold text-navy mb-0">
                            Enviar recordatorio
                        </h4>

                        <small class="text-muted">
                            Selecciona destinatarios y redacta tu mensaje
                        </small>

                    </div>


                    <button
                        type="button"
                        class="reminder-close-btn"
                        wire:click="closeReminderModal">

                        <i class="fas fa-times"></i>

                    </button>


                </div>



                {{-- Body --}}
                <div class="reminder-body">

                    <div class="row g-4">


                        {{-- Destinatarios --}}
                        <div class="col-lg-5">


                            <div class="d-flex justify-content-between align-items-center mb-2">


                                <label class="fw-semibold text-navy">

                                    Destinatarios

                                    <span class="text-muted">
                                        ({{ count($reminderSelected) }})
                                    </span>

                                </label>



                                <div class="form-check">


                                    <input
                                        type="checkbox"
                                        id="selectAllReminder"
                                        class="form-check-input"
                                        wire:model="reminderSelectAll"
                                        wire:change="toggleReminderSelectAll">


                                    <label
                                        class="form-check-label small"
                                        for="selectAllReminder">

                                        Todos

                                    </label>


                                </div>


                            </div>




                            <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Buscar..."
                                wire:model.debounce.300ms="reminderSearch">





                            <div class="reminder-filter-tabs mb-3">


                                <button
                                    type="button"
                                    wire:click="$set('reminderFilter','with_email')"
                                    class="reminder-filter-btn {{ $reminderFilter == 'with_email' ? 'active':'' }}">

                                    <i class="fas fa-envelope"></i>

                                    Con correo

                                    <span class="count">
                                        {{ $withEmailCount }}
                                    </span>

                                </button>



                                <button
                                    type="button"
                                    wire:click="$set('reminderFilter','without_email')"
                                    class="reminder-filter-btn {{ $reminderFilter == 'without_email' ? 'active':'' }}">

                                    <i class="fas fa-envelope-open-text"></i>

                                    Sin correo

                                    <span class="count">
                                        {{ $withoutEmailCount }}
                                    </span>

                                </button>


                            </div>





                            <div class="recipient-list">


                                @forelse($this->reminderCandidates as $r)


                                <label class="recipient-item">


                                    <input
                                        type="checkbox"
                                        value="{{ $r->id }}"
                                        wire:model="reminderSelected"
                                        @disabled(!$r->email)>


                                    <div class="recipient-info">

                                        <strong>
                                            {{ $r->name }}
                                        </strong>


                                        <small>
                                            {{ $r->email ?? 'Sin correo registrado' }}
                                        </small>

                                    </div>


                                </label>


                                @empty


                                <div class="text-center text-muted py-4">

                                    No hay registros.

                                </div>


                                @endforelse


                            </div>


                        </div>





                        {{-- Mensaje --}}
                        <div class="col-lg-7">


                            <label class="fw-semibold text-navy">
                                Asunto
                            </label>


                            <input
                                type="text"
                                class="form-control mb-3"
                                wire:model="reminderSubject">





                            <label class="fw-semibold text-navy">
                                Mensaje
                            </label>



                            <textarea
                                rows="9"
                                class="form-control"
                                wire:model="reminderMessage"></textarea>





                            <div class="reminder-preview mt-3">


                                <small class="text-muted">

                                    <i class="fas fa-eye"></i>

                                    Vista previa

                                </small>



                                <div class="reminder-preview-content">

                                    {!! nl2br(e(str_replace(
                                    '{nombre}',
                                    'Nombre del estudiante',
                                    $reminderMessage
                                    ))) !!}

                                </div>


                            </div>


                        </div>


                    </div>


                </div>






                {{-- Footer --}}
                <div class="reminder-footer">


                    <button
                        type="button"
                        class="btn btn-light rounded-3 px-4"
                        wire:click="closeReminderModal">

                        Cancelar

                    </button>





                    <button
                        type="button"
                        class="btn export-reminder rounded-3 px-4"
                        wire:click="sendReminders"
                        wire:loading.attr="disabled">


                        <span wire:loading.remove wire:target="sendReminders">

                            <i class="fas fa-paper-plane me-2"></i>

                            Enviar a {{ count($reminderSelected) }}

                        </span>


                        <span wire:loading wire:target="sendReminders">

                            <span class="spinner-border spinner-border-sm"></span>

                            Enviando...

                        </span>


                    </button>


                </div>


            </div>

        </div>


    </div>

    @endif
</div>