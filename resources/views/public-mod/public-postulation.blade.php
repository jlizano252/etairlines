@extends('layout.public-layout')

@section('main-content')

<link rel="stylesheet" href="{{ asset('css/registration.css') }}">

<div class="registration-page">

    {{-- Imagen de fondo --}}
    <img src="{{ asset('images/pattern-min.png') }}"
        style="
        position:fixed;
        top:0;left:0;
        width:100%;
        height:100%;
        object-fit:fill;
        z-index:0;
        pointer-events:none;
    "
        alt="">

    {{-- Overlay --}}
    <div style="position:fixed;inset:0;background:rgba(255,255,255,.72);z-index:1;pointer-events:none;"></div>

    {{-- Contenido --}}
    <div class="container py-5" style="position:relative;z-index:2;">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">
                @livewire('public.enrollment-form.v1.student-form')
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    window.addEventListener('load', function() {
        let preloader = document.querySelector('#preloader');

        if (preloader) {
            preloader.classList.add('hide-element');

            setTimeout(() => {
                preloader.classList.add('d-none');
            }, 500);
        }
    });
</script>
@endsection