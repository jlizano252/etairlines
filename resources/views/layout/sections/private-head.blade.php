<!DOCTYPE html>
<html lang="es-ES" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset( 'images/favicons/apple-touch-icon.png' ) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset( 'images/favicons/favicon-32x32.png' ) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset( 'images/favicons/favicon-16x16.png' ) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset( 'images/favicons/favicon.ico' ) }}">
    <link rel="manifest" href="{{ asset( 'images/favicons/manifest.json' ) }}">
    <meta name="msapplication-TileImage" content="{{ asset( 'images/favicons/mstile-150x150.png' ) }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset( 'js/config.js' ) }}"></script>
    <script src="{{ asset( 'vendors/overlayscrollbars/OverlayScrollbars.min.js' ) }}"></script>

    <!-- Stylesheets-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset( 'vendors/overlayscrollbars/OverlayScrollbars.min.css' ) }}" rel="stylesheet">
    <link href="{{ asset( 'css/theme.min.css' ) }}" rel="stylesheet" id="style-default">
    <link rel="stylesheet" href="{{ asset('css/ivetc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/etairlines.css') }}">
    
    <!--    Document Title-->
    <title>{{ $pageTitle ?? 'Torre de control | ETAIrlines' }}</title>

    {{-- Livewire --}}
    @livewireStyles

    {{-- Modal Animations --}}
    <style>
        @keyframes backdropIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(32px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-backdrop-anim {
            animation: backdropIn 0.25s ease forwards;
        }

        .modal-dialog-anim {
            animation: modalIn 0.35s cubic-bezier(0.34, 1.20, 0.64, 1) forwards;
        }

        .modal-section-1 {
            animation: slideUp 0.4s ease 0.15s both;
        }

        .modal-section-2 {
            animation: slideUp 0.4s ease 0.25s both;
        }

        .modal-section-3 {
            animation: slideUp 0.4s ease 0.30s both;
        }

        .modal-section-4 {
            animation: slideUp 0.4s ease 0.35s both;
        }

        @keyframes modalOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            to {
                opacity: 0;
                transform: translateY(24px) scale(0.97);
            }
        }

        .modal-dialog-out {
            animation: modalOut 0.28s cubic-bezier(0.4, 0, 1, 1) forwards;
        }

        body {
            background-image:
                radial-gradient(circle, rgba(200, 216, 232, 0.6) 1px, transparent 1px),
                linear-gradient(135deg, #daeaf7 0%, #d9f0d3 50%, #fdf4cc 100%);
            background-size: 24px 24px, cover;
        }

        .main.admin-layout {
            background: transparent !important;
        }

        /* Animación filas tabla */
        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        tbody tr {
            animation: fadeInRow 0.3s ease forwards;
        }

        tbody tr:nth-child(1) {
            animation-delay: 0.03s;
        }

        tbody tr:nth-child(2) {
            animation-delay: 0.06s;
        }

        tbody tr:nth-child(3) {
            animation-delay: 0.09s;
        }

        tbody tr:nth-child(4) {
            animation-delay: 0.12s;
        }

        tbody tr:nth-child(5) {
            animation-delay: 0.15s;
        }

        tbody tr:nth-child(6) {
            animation-delay: 0.18s;
        }

        tbody tr:nth-child(7) {
            animation-delay: 0.21s;
        }

        tbody tr:nth-child(8) {
            animation-delay: 0.24s;
        }

        tbody tr:nth-child(9) {
            animation-delay: 0.27s;
        }

        tbody tr:nth-child(10) {
            animation-delay: 0.30s;
        }

        @keyframes barSlide {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .modal-bar-animated {
            height: 6px;
            background: linear-gradient(90deg, #01498d, #42ab34, #fcd841, #42ab34, #01498d);
            background-size: 300% 300%;
            animation: barSlide 2.5s ease infinite;
        }
    </style>

</head>

<body>

    @include('layout.sections.private-preloader')
