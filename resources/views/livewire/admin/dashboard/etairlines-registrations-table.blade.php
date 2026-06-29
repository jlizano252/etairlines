<div class="container-fluid py-4">
    <div class="card border-0 rounded-4 shadow-lg overflow-hidden bg-white">
        <div class="institutional-bar"></div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h3 class="fw-bold text-navy mb-1">Registros ETAIRLINES</h3>
                    <p class="text-muted mb-0">Gestión de datos recolectados y exportaciones.</p>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4"><div class="kpi"><small>Total registros</small><strong>{{ number_format($total) }}</strong></div></div>
                <div class="col-md-4"><div class="kpi green"><small>Con correo</small><strong>{{ number_format($withEmail) }}</strong></div></div>
                <div class="col-md-4"><div class="kpi yellow"><small>Boletos enviados</small><strong>{{ number_format($emailsSent) }}</strong></div></div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-lg-5">
                    <input wire:model.debounce.400ms="search" class="form-control rounded-4" placeholder="Buscar nombre, colegio, teléfono o correo...">
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
                    <button wire:click="clearFilters" class="btn btn-light rounded-4"><i class="fas fa-broom"></i></button>
                </div>
                <div class="col-lg-1 d-grid">
                    <button wire:click="exportRegisters" class="btn btn-navy rounded-4 text-white" wire:loading.attr="disabled">Registros</button>
                </div>
                <div class="col-lg-2 d-grid">
                    <button wire:click="exportContacts" class="btn btn-green rounded-4 text-white" wire:loading.attr="disabled">Contactos</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="text-navy">
                        <tr>
                            <th>Fecha</th><th>Nombre</th><th>Contacto</th><th>Colegio</th><th>Intereses</th><th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $r)
                            <tr>
                                <td class="text-nowrap"><strong>{{ $r->created_at->format('d/m/Y') }}</strong><br><small>{{ $r->created_at->format('h:i A') }}</small></td>
                                <td><strong>{{ $r->name }}</strong><br><small class="text-muted">{{ $r->coupon_code }}</small></td>
                                <td>{{ $r->phone }}<br><small class="text-muted">{{ $r->email ?: 'Sin correo' }}</small></td>
                                <td>{{ $r->school ?: '-' }}</td>
                                <td><span class="badge bg-light text-navy rounded-pill">{{ $r->interest_one ?: '-' }}</span><br>@if($r->interest_two)<span class="badge bg-light text-success rounded-pill mt-1">{{ $r->interest_two }}</span>@endif</td>
                                <td>{!! $r->email_sent_at ? '<span class="badge bg-success">Enviado</span>' : '<span class="badge bg-secondary">Pendiente</span>' !!}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5">No hay registros.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $registrations->links() }}
        </div>
    </div>
</div>
