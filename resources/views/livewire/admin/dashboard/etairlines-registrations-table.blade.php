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

                    <div class="col-lg-3">
                        <div class="d-flex gap-2 flex-wrap justify-content-lg-end">

                            <button
                                wire:click="exportRegisters"
                                class="btn export-action-btn export-register"
                                type="button"
                                wire:loading.attr="disabled"
                                wire:target="exportRegisters">

                                <span wire:loading.remove wire:target="exportRegisters">
                                    <i class="fas fa-download me-2"></i>
                                    Registros
                                </span>

                                <span wire:loading wire:target="exportRegisters">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Generando...
                                </span>
                            </button>

                            <button
                                wire:click="exportContacts"
                                class="btn export-action-btn export-contact"
                                type="button"
                                wire:loading.attr="disabled"
                                wire:target="exportContacts">

                                <span wire:loading.remove wire:target="exportContacts">
                                    <i class="fas fa-address-book me-2"></i>
                                    Contactos
                                </span>

                                <span wire:loading wire:target="exportContacts">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Generando...
                                </span>
                            </button>

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
</div>