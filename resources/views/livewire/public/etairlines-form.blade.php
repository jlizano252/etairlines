@php
$baseId = $registration?->id ?? 1;

$flight = 'ET' . now()->format('y') . str_pad($baseId, 3, '0', STR_PAD_LEFT);

$gate = 'B-' . str_pad(($baseId % 20) + 1, 2, '0', STR_PAD_LEFT);

$letters = ['A', 'B', 'C', 'D', 'E', 'F'];
$seatRow = ($baseId % 30) + 1;
$seatLetter = $letters[$baseId % 6];
$seat = $seatRow . $seatLetter;

$month = now()->month;
$year = now()->year;

if ($month <= 4) {
    $nextQuarter='II' ;
    } elseif ($month <=8) {
    $nextQuarter='III' ;
    } else {
    $nextQuarter='I' ;
    $year++;
    }

    $departure=$nextQuarter . ' Cuatrimestre ' . $year;
    @endphp

    <div class="etairlines-page etairlines-mobile-first">

    <div class="etairlines-shell">

        <div class="boarding-card">

            {{-- Encabezado --}}
            <div class="boarding-header">
                <div class="brand-block">

                    <div class="brand-logo-box">
                        <img
                            src="{{ asset('images/ivetc-brand-footer.png') }}"
                            alt="ETAI"
                            class="brand-logo">
                    </div>

                    <div class="brand-divider"></div>

                    <div class="brand-copy">
                        <div class="airline-title">
                            <span>ETAI</span>RLINES
                        </div>

                        <div class="airline-subtitle">
                            TU FUTURO, NUESTRO DESTINO
                        </div>
                    </div>

                </div>

                <div class="plane-badge">
                    <i class="fas fa-plane"></i>
                </div>
            </div>

            <div class="boarding-body">

                {{-- Panel principal --}}
                <div class="boarding-main">

                    <div class="ticket-label">PASE DE ABORDAJE</div>

                    <h1>RECORRE. DESCUBRE. SELLA TU FUTURO</h1>

                    <p class="boarding-intro">
                        Completa tus datos, elige tus carreras de interés y recibe tu pase
                        de abordaje para iniciar tu ruta académica.
                    </p>

                    <div class="career-grid">
                        @foreach($careers as $career)
                        <div class="career-pill">
                            <img
                                src="{{ asset('images/careers-images/' . $career['image']) }}"
                                alt="{{ $career['name'] }}"
                                class="career-image">

                            <span>{{ $career['name'] }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="help-strip">
                        <div class="help-left">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <span>¿Dudas o consultas?</span>
                                <strong>¡Estamos para ayudarte!</strong>
                            </div>
                        </div>

                        <div class="help-phone">
                            6325 2828
                        </div>

                        <div class="help-script">
                            Tu viaje comienza hoy, tu futuro despega aquí.
                        </div>
                    </div>

                    <div class="flight-strip">
                        <div>
                            <small>VUELO</small>
                            <strong>{{ $flight }}</strong>
                        </div>

                        <div>
                            <small>PUERTA</small>
                            <strong>{{ $gate }}</strong>
                        </div>

                        <div>
                            <small>DESTINO</small>
                            <strong>ETAI San Carlos</strong>
                        </div>

                        <div>
                            <small>ASIENTO</small>
                            <strong>{{ $seat }}</strong>
                        </div>

                        <div>
                            <small>SALIDA</small>
                            <strong>{{ $departure }}</strong>
                        </div>
                    </div>

                </div>

                {{-- Panel lateral / formulario --}}
                <div class="boarding-side">

                    @if($completed && $registration)

                    <div class="success-panel">
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>

                        <h3>¡Pase generado!</h3>

                        <p>
                            Gracias,
                            <strong>{{ $registration->name }}</strong>.
                            Tu registro fue guardado correctamente.
                        </p>

                        @if($registration->email)
                        <p class="small mb-0">
                            Te enviaremos el pase de abordaje al correo indicado.
                        </p>
                        @endif
                    </div>

                    <button
                        class="btn btn-navy w-100 rounded-4 mt-3"
                        wire:click="$set('completed', false)">
                        Registrar otra persona
                    </button>

                    <div class="text-center mt-4">
                        <a
                            href="{{ route('login') }}"
                            class="admin-access-link">
                            <i class="fas fa-lock me-1"></i>
                            Acceso administrativo
                        </a>
                    </div>

                    @else

                    <div class="form-title">
                        <span>Datos del pasajero</span>
                        <small>Completa la información solicitada</small>
                    </div>

                    <form wire:submit.prevent="submit">

                        <div class="mobile-progress">
                            <div class="mobile-progress-item {{ trim($name) !== '' ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                            </div>

                            <div class="mobile-progress-line"></div>

                            <div class="mobile-progress-item {{ preg_match('/^\+\d{8,20}$/', trim($phone)) ? 'active' : '' }}">
                                <i class="fas fa-phone"></i>
                            </div>

                            <div class="mobile-progress-line"></div>

                            <div class="mobile-progress-item {{ trim($interest_one) !== '' ? 'active' : '' }}">
                                <i class="fas fa-graduation-cap"></i>
                            </div>

                            <div class="mobile-progress-line"></div>

                            <div class="mobile-progress-item {{ $accepted ? 'active' : '' }}">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nombre Completo</label>
                            <input
                                type="text"
                                wire:model.debounce.300ms="name"
                                class="form-control rounded-4 @error('name') is-invalid @enderror"
                                placeholder="Nombre completo">

                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Colegio de procedencia</label>
                            <input
                                type="text"
                                wire:model.defer="school"
                                class="form-control rounded-4 @error('school') is-invalid @enderror"
                                placeholder="Nombre del colegio">

                            @error('school')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Lugar de residencia</label>
                            <input
                                type="text"
                                wire:model.defer="residence"
                                class="form-control rounded-4 @error('residence') is-invalid @enderror"
                                placeholder="Ej. Ciudad Quesada, San Carlos">

                            @error('residence')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Número de teléfono</label>

                            <div class="phone-combo @error('phone') is-invalid @enderror">

                                <select
                                    wire:model="country_prefix"
                                    class="phone-prefix-select"
                                    aria-label="Prefijo del país">
                                    <option value="+506">🇨🇷 +506</option>
                                    <option value="+507">🇵🇦 +507</option>
                                    <option value="+505">🇳🇮 +505</option>
                                    <option value="+503">🇸🇻 +503</option>
                                    <option value="+502">🇬🇹 +502</option>
                                    <option value="+504">🇭🇳 +504</option>
                                    <option value="+52">🇲🇽 +52</option>
                                    <option value="+57">🇨🇴 +57</option>
                                    <option value="+1">🇺🇸 +1</option>
                                </select>

                                <input
                                    type="tel"
                                    wire:model.debounce.300ms="phone_local"
                                    class="phone-local-input"
                                    placeholder="8888-8888"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    maxlength="15"
                                    oninput="formatPhone(this)">
                            </div>

                            @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <small class="text-muted d-block mt-1">
                                Selecciona tu país e ingresa tu número.
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input
                                type="email"
                                wire:model.defer="email"
                                class="form-control rounded-4 @error('email') is-invalid @enderror"
                                placeholder="Para enviar el pase">

                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Carrera de interés 1</label>
                            <select
                                wire:model="interest_one"
                                class="form-select rounded-4 @error('interest_one') is-invalid @enderror">
                                <option value="">Seleccione una carrera</option>

                                @foreach($careers as $career)
                                <option value="{{ $career['name'] }}">
                                    {{ $career['name'] }}
                                </option>
                                @endforeach
                            </select>

                            @error('interest_one')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Carrera de interés 2</label>
                            <select
                                wire:model.defer="interest_two"
                                class="form-select rounded-4 @error('interest_two') is-invalid @enderror">
                                <option value="">Opcional</option>

                                @foreach($careers as $career)
                                <option value="{{ $career['name'] }}">
                                    {{ $career['name'] }}
                                </option>
                                @endforeach
                            </select>

                            @error('interest_two')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="coupon-box">
                            <div>
                                <span>CUPÓN ESPECIAL</span>
                                <strong>50%</strong>
                                <em>DE DESCUENTO</em>
                            </div>

                            <small>
                                Al presentar este pase de abordaje a la hora de matricular.
                            </small>
                        </div>

                        <div class="form-check consent-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model="accepted"
                                id="accepted">

                            <label class="form-check-label small" for="accepted">
                                Acepto que ETAI utilice mis datos para brindarme información académica.
                            </label>
                        </div>

                        @error('accepted')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror

                        <button
                            class="btn w-100 rounded-4 fw-bold mt-3 boarding-submit-btn {{ $this->canSubmit ? 'btn-green' : 'btn-locked' }}"
                            type="submit"
                            wire:loading.attr="disabled"
                            @if(!$this->canSubmit) disabled="disabled" @endif>

                            <span wire:loading.remove>
                                @if($this->canSubmit)
                                <i class="fas fa-ticket-alt me-2"></i>
                                Generar pase de abordaje
                                @else
                                <i class="fas fa-lock me-2"></i>
                                Complete los datos para abordar
                                @endif
                            </span>

                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-2"></span>
                                Guardando...
                            </span>
                        </button>

                    </form>

                    <div class="text-center mt-4">
                        <a
                            href="{{ route('login') }}"
                            class="admin-access-link">
                            <i class="fas fa-lock me-1"></i>
                            Acceso administrativo
                        </a>
                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

    </div>

    <script>
        function formatPhone(input) {
            let phoneValue = input.value.replace(/\D/g, '');

            if (phoneValue.length > 12) {
                phoneValue = phoneValue.substring(0, 12);
            }

            if (phoneValue.length >= 8) {
                phoneValue =
                    phoneValue.substring(0, 4) +
                    '-' +
                    phoneValue.substring(4);
            }

            input.value = phoneValue;
        }
    </script>