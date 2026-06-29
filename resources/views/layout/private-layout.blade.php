<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador - {{ config('app.name', 'ETAirlines') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/etairlines.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="etairlines-body">

    <div class="admin-shell">

        <header class="admin-topbar">

            <div class="admin-brand">

                <div class="admin-logo-box">
                    <img
                        src="{{ asset('images/ivetc-brand-footer.png') }}"
                        alt="ETAI"
                        class="admin-logo">
                </div>

                <div class="admin-brand-divider"></div>

                <div class="admin-brand-text">
                    <div class="admin-eyebrow">
                        ETAIRLINES
                    </div>

                    <h5>
                        Torre de Control
                    </h5>

                    <small>
                        Gestión de registros y contactos
                    </small>
                </div>

            </div>

            <div class="admin-actions">

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf

                    <button class="btn admin-logout-btn" type="submit">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Salir
                    </button>
                </form>

            </div>

        </header>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts

</body>

</html>