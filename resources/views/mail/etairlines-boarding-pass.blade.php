@php
$wa = '50663252828';
$text = 'Hola, recibí mi pase de abordaje ETAIRLINES y deseo información para matricular.';
$url = 'https://wa.me/' . $wa . '?text=' . urlencode($text);

$baseId = $registration->id ?? 1;

$flight = 'ET' . now()->format('y') . str_pad($baseId, 3, '0', STR_PAD_LEFT);
$gate = 'B-' . str_pad(($baseId % 20) + 1, 2, '0', STR_PAD_LEFT);

$letters = ['A', 'B', 'C', 'D', 'E', 'F'];
$seat = (($baseId % 30) + 1) . $letters[$baseId % 6];

$month = now()->month;
$year = now()->year;

if ($month <= 4) {
    $quarter='II' ;
    } elseif ($month <=8) {
    $quarter='III' ;
    } else {
    $quarter='I' ;
    $year++;
    }

    $departure=$quarter . ' Cuatrimestre ' . $year;

    $careers=[
    ['name'=> 'Administración de Empresa Virtual', 'image' => 'admin-emp-virt.png'],
    ['name' => 'Gestión Empresarial', 'image' => 'gestion.png'],
    ['name' => 'Administración de Empresas Agropecuarias', 'image' => 'admin-emp-agro.png'],
    ['name' => 'Ciencias Agropecuarias', 'image' => 'agro.png'],
    ['name' => 'Contabilidad y Finanzas', 'image' => 'conta.png'],
    ['name' => 'Desarrollo de Software', 'image' => 'software.png'],
    ['name' => 'Turismo Sostenible', 'image' => 'turismo.png'],
    ['name' => 'Gestión de la Calidad', 'image' => 'gestion-calidad.png'],
    ['name' => 'Biotecnología', 'image' => 'bio.png'],
    ];
    @endphp


    <!doctype html>
    <html lang="es">

    <head>
        <meta charset="utf-8">

        <style>
            @media only screen and (max-width: 640px) {
                .email-wrapper {
                    width: 100% !important;
                    max-width: 100% !important;
                    border-radius: 0 !important;
                }

                .email-body {
                    padding: 12px !important;
                }

                .email-col {
                    display: block !important;
                    width: 100% !important;
                    max-width: 100% !important;
                }

                .email-left,
                .email-right {
                    padding: 18px !important;
                }

                .email-right {
                    border-left: none !important;
                    border-top: 2px dashed #8b99aa !important;
                }

                .header-logo-cell,
                .header-plane-cell {
                    display: none !important;
                }

                .header-title {
                    font-size: 30px !important;
                    letter-spacing: 2px !important;
                }

                .header-slogan {
                    font-size: 10px !important;
                    letter-spacing: 2px !important;
                }

                .email-title {
                    font-size: 34px !important;
                }

                .email-subtitle {
                    font-size: 16px !important;
                }

                .career-col {
                    display: block !important;
                    width: 100% !important;
                    padding: 5px 0 !important;
                }

                .help-cell {
                    display: block !important;
                    width: 100% !important;
                    text-align: center !important;
                    border-left: none !important;
                    border-right: none !important;
                    border-bottom: 1px solid #00833e !important;
                }

                .help-cell:last-child {
                    border-bottom: none !important;
                }

                .flight-cell {
                    display: block !important;
                    width: 100% !important;
                    border-right: none !important;
                    border-bottom: 1px dashed #8b99aa !important;
                }

                .flight-cell:last-child {
                    border-bottom: none !important;
                }

                .coupon-percent {
                    font-size: 54px !important;
                }
            }
        </style>
    </head>

    <body style="margin:0;padding:0;background:#edf4f7;font-family:Arial,Helvetica,sans-serif;color:#061a44;">

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#edf4f7;">
            <tr>
                <td class="email-body" align="center" style="padding:24px 10px;">

                    <table class="email-wrapper" width="920" cellpadding="0" cellspacing="0" style="max-width:920px;background:#ffffff;border-radius:22px;overflow:hidden;border:1px solid #d8e2ec;box-shadow:0 14px 35px rgba(6,26,68,.12);">

                        {{-- HEADER --}}
                        <tr>
                            <td colspan="2" style="background:#01498d;color:#fff;padding:18px 24px;border-bottom:4px solid #f3c900;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="header-logo-cell" width="170" valign="middle">
                                            <table cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:14px;padding:9px 12px;box-shadow:0 8px 18px rgba(0,0,0,.16);">
                                                <tr>
                                                    <td align="center" valign="middle">
                                                        <img
                                                            src="{{ $message->embed(public_path('images/ivetc-brand-footer.png')) }}"
                                                            alt="ETAI"
                                                            style="max-width:145px;height:auto;display:block;">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td align="center" valign="middle">
                                            <div class="header-title" style="font-size:38px;font-weight:900;letter-spacing:4px;line-height:1;color:#ffffff;">
                                                ETAI<span style="color:#f3c900;">RLINES</span>
                                            </div>

                                            <div class="header-slogan" style="font-size:12px;letter-spacing:4px;margin-top:8px;color:#ffffff;font-weight:bold;">
                                                TU FUTURO, NUESTRO DESTINO
                                            </div>
                                        </td>

                                        <td class="header-plane-cell" width="80" align="right" valign="middle" style="font-size:38px;color:#fff;">
                                            ✈
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            {{-- PANEL IZQUIERDO --}}
                            <td class="email-col email-left" width="68%" style="padding:24px 24px 18px 24px;vertical-align:top;background:#ffffff;">

                                <div class="email-title" style="font-size:44px;font-weight:900;letter-spacing:1px;line-height:1;color:#061a44;">
                                    PASE DE ABORDAJE
                                </div>

                                <div class="email-subtitle" style="font-size:21px;font-weight:900;letter-spacing:1px;color:#00833e;margin-top:6px;margin-bottom:20px;">
                                    RECORRE. DESCUBRE. SELLA TU FUTURO
                                </div>

                                {{-- CARRERAS --}}
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    @foreach(array_chunk($careers, 3) as $row)
                                    <tr>
                                        @foreach($row as $career)
                                        <td class="career-col" width="33.33%" style="padding:6px;">
                                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:14px;background:#ffffff;">
                                                <tr>
                                                    <td width="54" align="center" style="padding:12px 6px 12px 12px;">
                                                        <img
                                                            src="{{ $message->embed(public_path('images/careers-images/' . $career['image'])) }}"
                                                            alt="{{ $career['name'] }}"
                                                            style="width:42px;height:42px;object-fit:contain;display:block;">
                                                    </td>

                                                    <td style="padding:12px 10px 12px 4px;">
                                                        <div style="font-size:11px;font-weight:900;line-height:1.25;color:#061a44;text-transform:uppercase;">
                                                            {{ $career['name'] }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        @endforeach

                                        @for($i = count($row); $i < 3; $i++)
                                            <td class="career-col" width="33.33%" style="padding:6px;">
                            </td>
                            @endfor
                        </tr>
                        @endforeach
                    </table>

                    {{-- AYUDA --}}
                    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:18px;border:2px solid #00833e;border-radius:16px;overflow:hidden;">
                        <tr>
                            <td class="help-cell" width="52" align="center" style="padding:13px;color:#00833e;font-size:30px;">
                                ☎
                            </td>

                            <td class="help-cell" style="padding:13px 10px;color:#00833e;font-size:14px;font-weight:800;line-height:1.35;">
                                ¿Dudas o consultas?<br>
                                ¡Estamos para ayudarte!
                            </td>

                            <td class="help-cell"
                                align="center"
                                style="
                                padding:13px 16px;
                                border-left:1px solid #00833e;
                                border-right:1px solid #00833e;
                                color:#061a44;
                                font-size:28px;
                                font-weight:900;
                                white-space:nowrap;
                            ">
                                6325&nbsp;2828
                            </td>

                            <td class="help-cell" align="center" style="padding:13px;color:#00833e;font-size:15px;font-family:Georgia,serif;font-style:italic;">
                                Tu viaje comienza hoy,<br>
                                tu futuro despega aquí.
                            </td>
                        </tr>
                    </table>

                    {{-- DATOS DEL VUELO --}}
                    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:18px;border-top:2px dashed #8b99aa;border-bottom:2px dashed #8b99aa;">
                        <tr align="center">
                            <td class="flight-cell" style="padding:14px 6px;border-right:1px dashed #8b99aa;">
                                <div style="font-size:10px;font-weight:900;color:#061a44;">PASAJERO</div>
                                <div style="font-size:23px;margin:7px 0;">👤</div>
                                <div style="font-size:13px;font-weight:900;color:#061a44;">{{ $registration->name }}</div>
                            </td>

                            <td class="flight-cell" style="padding:14px 6px;border-right:1px dashed #8b99aa;">
                                <div style="font-size:10px;font-weight:900;color:#061a44;">VUELO</div>
                                <div style="font-size:23px;margin:7px 0;">✈</div>
                                <div style="font-size:15px;font-weight:900;color:#061a44;">{{ $flight }}</div>
                            </td>

                            <td class="flight-cell" style="padding:14px 6px;border-right:1px dashed #8b99aa;">
                                <div style="font-size:10px;font-weight:900;color:#061a44;">PUERTA</div>
                                <div style="font-size:23px;margin:7px 0;">🚪</div>
                                <div style="font-size:15px;font-weight:900;color:#061a44;">{{ $gate }}</div>
                            </td>

                            <td class="flight-cell" style="padding:14px 6px;border-right:1px dashed #8b99aa;">
                                <div style="font-size:10px;font-weight:900;color:#061a44;">DESTINO</div>
                                <div style="font-size:23px;margin:7px 0;">📍</div>
                                <div style="font-size:13px;font-weight:900;color:#061a44;">ETAI San Carlos</div>
                            </td>

                            <td class="flight-cell" style="padding:14px 6px;border-right:1px dashed #8b99aa;">
                                <div style="font-size:10px;font-weight:900;color:#061a44;">ASIENTO</div>
                                <div style="font-size:23px;margin:7px 0;">💺</div>
                                <div style="font-size:15px;font-weight:900;color:#061a44;">{{ $seat }}</div>
                            </td>

                            <td class="flight-cell" style="padding:14px 6px;">
                                <div style="font-size:10px;font-weight:900;color:#061a44;">SALIDA</div>
                                <div style="font-size:23px;margin:7px 0;">🕘</div>
                                <div style="font-size:12px;font-weight:900;color:#061a44;">{{ $departure }}</div>
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top:18px;background:#061a44;color:#ffffff;border-radius:0 0 16px 16px;padding:14px 18px;text-align:center;font-family:Georgia,serif;font-size:21px;font-style:italic;">
                        Cada destino te acerca más a tus sueños ✈
                    </div>

                </td>

                {{-- PANEL DERECHO --}}
                <td class="email-col email-right" width="32%" style="padding:24px 20px;background:#f7fafc;border-left:2px dashed #8b99aa;vertical-align:top;">

                    <div style="background:#061a44;color:#fff;border-radius:16px;padding:14px;text-align:center;margin-bottom:18px;">
                        <div style="font-size:25px;font-weight:900;letter-spacing:2px;">
                            ETAI<span style="color:#f3c900;">RLINES</span>
                        </div>
                    </div>

                    <p><strong>Nombre:</strong><br>{{ $registration->name }}</p>
                    <p><strong>Colegio:</strong><br>{{ $registration->school ?: '-' }}</p>
                    <p><strong>Residencia:</strong><br>{{ $registration->residence ?: '-' }}</p>
                    <p><strong>Teléfono:</strong><br>{{ $registration->phone }}</p>

                    <p>
                        <strong>Carreras de interés:</strong><br>
                        <span style="color:#00833e;font-weight:bold;">1.</span> {{ $registration->interest_one ?: '-' }}<br>
                        <span style="color:#00833e;font-weight:bold;">2.</span> {{ $registration->interest_two ?: '-' }}
                    </p>

                    <div style="background:linear-gradient(180deg,#061a44 0%,#053f3a 55%,#00833e 100%);color:#fff;border-radius:18px;padding:20px 14px;text-align:center;margin-top:20px;border:2px dashed #ffffff;">

                        <div style="font-size:17px;font-weight:900;letter-spacing:2px;">
                            CUPÓN ESPECIAL
                        </div>

                        <div class="coupon-percent" style="font-size:62px;font-weight:900;color:#f3c900;line-height:1;margin:8px 0;">
                            50%
                        </div>

                        <div style="font-size:22px;font-weight:900;line-height:1.1;">
                            DE DESCUENTO
                        </div>

                        <p style="font-size:12px;font-weight:bold;line-height:1.4;margin:14px 0 0;">
                            AL PRESENTAR ESTE PASE DE ABORDAJE A LA HORA DE MATRICULAR
                        </p>

                        <div style="margin-top:14px;background:rgba(255,255,255,.16);border-radius:10px;padding:8px;font-size:11px;font-weight:bold;">
                            VÁLIDO SOLO PARA NUEVOS ESTUDIANTES
                        </div>
                    </div>

                    <a href="{{ $url }}"
                        style="display:block;background:#00833e;color:#ffffff;text-decoration:none;text-align:center;padding:13px;border-radius:13px;margin-top:18px;font-weight:900;font-size:14px;">
                        Consultar por WhatsApp
                    </a>

                </td>
            </tr>
        </table>

        </td>
        </tr>
        </table>

    </body>

    </html>