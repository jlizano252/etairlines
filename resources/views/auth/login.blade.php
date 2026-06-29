@include('layout.sections.private-head')

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

@include('layout.sections.messages')

<main class="main" id="top">
    <div class="container login-wrapper" data-layout="container">

        <div class="row flex-center min-vh-100 py-6">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4">

                <div class="card premium-card border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <img class="brand-logo" src="{{ asset('images/ivetc-brand-footer.png') }}" width="170" alt="Logo">
                        </div>
                        <div class="text-center mb-4">
                            <h3 class="login-title mb-1">Bienvenido</h3>
                            <p class="login-subtitle mb-0">Ingrese sus credenciales para continuar</p>
                        </div>

                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <input name="email"
                                    class="form-control premium-input"
                                    type="text"
                                    placeholder="ID">
                            </div>

                            <div class="mb-3">
                                <input name="password"
                                    class="form-control premium-input"
                                    type="password"
                                    placeholder="Password">
                            </div>

                            <button class="btn premium-btn w-100" type="submit" id="login-btn">
                                <span id="btn-text">Log in</span>
                                <span id="btn-spinner" class="d-none">
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                    Ingresando...
                                </span>
                            </button>

                            @if ($errors->has('email') || $errors->has('password'))
                            <div class="text-danger small text-center mt-2">
                                Error de autenticación!!!
                            </div>
                            @endif
                        </form>

                        <div class="text-center mt-4 footer-note">
                            Portal de Acceso Institucional
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
<script>
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('btn-text').classList.add('d-none');
        document.getElementById('btn-spinner').classList.remove('d-none');
        document.getElementById('login-btn').disabled = true;
    });
</script>
@include('layout.sections.private-foot')