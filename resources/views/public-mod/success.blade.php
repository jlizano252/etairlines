@extends('layout.public-layout')

@section('main-content')

<link rel="stylesheet" href="{{ asset('css/registration.css') }}">

<div class="registration-page d-flex align-items-center">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-12 col-md-10 col-lg-7 col-xl-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden text-center">

                    {{-- Línea superior institucional --}}
                    <div style="height:6px;background:linear-gradient(90deg,#01498d,#42ab34,#fcd841);"></div>

                    <div class="card-body p-4 p-lg-5">

                        {{-- Logo --}}
                        <img
                            src="{{ asset('images/Acronimo_year.png') }}"
                            class="img-fluid mb-4"
                            style="max-width:180px;"
                            alt="Logo">

                        {{-- Ícono éxito --}}
                        <div class="mb-3">
                            <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center"
                                style="width:90px;height:90px;background:rgba(66,171,52,.10);">
                                <span style="font-size:42px;color:#42ab34;">✓</span>
                            </div>
                        </div>

                        {{-- Título --}}
                        <h2 class="fw-bold mb-2" style="color:#42ab34;">
                            ¡Registro enviado exitosamente!
                        </h2>

                        <h5 class="fw-bold mb-2" style="color:#01498d;">
                            Hemos recibido tu información correctamente.
                        </h5>

                        <p class="text-muted mb-4">
                            Gracias por completar el formulario. Nos pondremos en contacto contigo si es necesario.
                        </p>

                        {{-- Botón --}}
                        <a href="{{ route('public.postularse.index') }}"
                            class="btn px-4 py-2 rounded-3 fw-bold text-white border-0"
                            style="background:#01498d;">
                            Regresar a la página principal
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
@endsection