<!-- ===============================================-->
<!-- Main Content Premium -->
<!-- ===============================================-->

<style>
    .page-link {
        font-size: .78rem !important;
        border-radius: 10px !important;
    }
</style>

{{-- Overlay Cerrando Sesión --}}
<div id="logout-overlay"
    style="display:none;position:fixed;inset:0;z-index:9999;background:linear-gradient(135deg,#01498d,#0d63ba);
           flex-direction:column;justify-content:center;align-items:center;gap:1.5rem;">

    <img src="{{ asset('images/ivetc-brand-footer.png') }}"
        style="width:160px;opacity:.95;"
        alt="Logo">

    <div class="spinner-border text-white"
        style="width:3rem;height:3rem;"
        role="status">
    </div>

    <div class="text-white text-center">
        <div class="fw-bold fs-5">Cerrando sesión</div>
        <small style="opacity:.75;">Por favor espere...</small>
    </div>

</div>

<main class="main admin-layout" id="top">

    <div class="container py-3" data-layout="container">

        {{-- Navbar Premium --}}
        <nav class="navbar navbar-expand-lg admin-navbar mb-4 px-4 py-3 rounded-4 shadow-sm bg-white border-0">

            <div class="container-fluid p-0">

                {{-- Logo / Marca --}}
                <a class="navbar-brand d-flex align-items-center gap-3 m-0"
                    href="#">

                    <div class="rounded-4 p-2 shadow-sm bg-light">
                        <img
                            src="{{ asset('images/ivetc-brand-loading-sm-min.png') }}"
                            style="height:52px;width:auto;"
                            alt="Logo">
                    </div>

                    <div class="d-none d-md-flex flex-column lh-sm">

                        <span class="fw-bold fs-5 mb-0">
                            <span class="text-etc-blue">Panel</span>
                            <span class="text-etc-green">Administrativo</span>
                        </span>

                        <small class="fw-semibold">
                            <span class="text-etc-blue">Registros</span>
                            <span class="text-etc-yellow"> Test Vocacional ETAI</span>
                        </small>

                    </div>

                </a>

                {{-- Right Side --}}
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item dropdown">

                        <a class="nav-link p-0"
                            id="navbarDropdownUser"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <div class="user-profile-box d-flex align-items-center">

                                {{-- Info deslizante --}}
                                <div class="user-slide-info text-end lh-sm">

                                    <div class="fw-semibold text-etc-blue" style="font-size:.95rem;">
                                        {{ Auth::user()->name }}
                                        {{ Auth::user()->lastname }}
                                    </div>

                                    <small class="text-muted">
                                        ID: {{ Auth::user()->ide }}
                                    </small>

                                </div>

                                {{-- Avatar --}}
                                <div class="position-relative user-avatar-box">

                                    <img class="rounded-circle shadow"
                                        src="{{ asset('images/team/avatar.png') }}"
                                        style="width:46px;height:46px;object-fit:cover;"
                                        alt="Avatar">

                                    <span class="position-absolute bottom-0 end-0 rounded-circle border border-white"
                                        style="width:12px;height:12px;background:#42ab34;">
                                    </span>

                                </div>

                            </div>

                        </a>

                        {{-- Dropdown Premium --}}
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-3 py-0 overflow-hidden"
                            style="min-width:260px;">

                            {{-- Header --}}
                            <div class="px-4 py-3 text-white"
                                style="background:linear-gradient(135deg,#01498d,#0d63ba);">

                                <div class="fw-bold">
                                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                    {{ \Illuminate\Support\Facades\Auth::user()->lastname }}
                                </div>

                                <small style="opacity:.85;">
                                    Sesión iniciada correctamente
                                </small>

                            </div>

                            {{-- Body --}}
                            <div class="px-4 py-3">

                                <div class="small text-muted mb-3">
                                    Identificación:
                                    {{ \Illuminate\Support\Facades\Auth::user()->ide }}
                                </div>

                                <form action="{{ route('logout') }}"
                                    method="post"
                                    id="logout-form">
                                    @csrf

                                    <button class="btn w-100 rounded-4 fw-semibold text-white"
                                        style="background:#dc3545;"
                                        type="submit">

                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Cerrar sesión

                                    </button>

                                </form>

                            </div>

                        </div>

                    </li>

                </ul>

            </div>
        </nav>

        {{-- Main Card Content --}}
        <div class="content">
            <div class="admin-content-card">
                @yield('main-content')
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('logout-form').addEventListener('submit', function() {
        document.getElementById('logout-overlay').style.display = 'flex';
    });
</script>

<!-- ===============================================-->
<!-- End Main Content -->
<!-- ===============================================-->