@extends('layout.public-layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="institutional-bar"></div>
                <div class="card-body p-4">
                    <h3 class="fw-bold text-navy mb-1">Acceso administrativo</h3>
                    <p class="text-muted">Panel de registros ETAIRLINES</p>

                    @if($errors->any())
                        <div class="alert alert-danger rounded-4">Credenciales inválidas.</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label class="form-label">Correo</label>
                        <input type="email" name="email" class="form-control rounded-4" required autofocus>

                        <label class="form-label mt-3">Contraseña</label>
                        <input type="password" name="password" class="form-control rounded-4" required>

                        <button class="btn btn-navy w-100 rounded-4 fw-bold mt-4" type="submit">
                            Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
