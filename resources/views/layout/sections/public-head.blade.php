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

    <!-- Banderas -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

    <!-- Stylesheets-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset( 'vendors/overlayscrollbars/OverlayScrollbars.min.css' ) }}" rel="stylesheet">
    <link href="{{ asset( 'css/theme.min.css' ) }}" rel="stylesheet" id="style-default">
    <link rel="stylesheet" href="{{ asset('css/ivetc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/etairlines.css') }}">

    <!--    Document Title-->
    <title>Bienvenidos | ETAIrlines {{ date('Y') }}</title>

    {{-- Livewire --}}
    @livewireStyles

</head>

<body>

    {{--@include('layout.sections.private-preloader')--}}
