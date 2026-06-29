<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    {{-- Check nav style from local-storage --}}
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>

    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Cambiar Navegación">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line"></span>
                </span>
            </button>

        </div><a class="navbar-brand" href="{{ route('dashboard.index') }}">
{{--            <div class="d-flex align-items-center py-3"><img class="me-2" src="{{ asset( 'img/logos/caest.png' ) }}" alt="" width="40" /><span class="font-sans-serif">Caest</span>--}}
{{--            </div>--}}
            <div class="d-flex align-items-center py-3">
                <img class="me-2 mt-n2" src="http://dev.pruebayerror.com/assets/img/MonkeyDevx300-min.png" alt="" width="140" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">

            <ul class="navbar-nav mdev-aside flex-column mb-3 mt-5 mt-lg-3" id="navbarVerticalNav">
                <li class="nav-item {{ (request()->is('admin/')) || (request()->is('admin/dashboard')) ? 'active' : '' }}">
                    <!-- parent page-->
                    <a class="nav-link" href="{{ route('dashboard.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-home"></span></span>
                            <span class="nav-link-text ps-1">Inicio</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-list-alt"></span></span>
                            <span class="nav-link-text ps-1">Pedidos</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-pizza-slice"></span></span>
                            <span class="nav-link-text ps-1">Productos</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#!" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-map"></span></span>
                            <span class="nav-link-text ps-1">Menú</span>
                        </div>
                    </a>
                </li>

                <hr>

                <li class="nav-item">
                    <a class="nav-link" href="" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-archive"></span></span>
                            <span class="nav-link-text ps-1">Facturas</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-user-friends"></span></span>
                            <span class="nav-link-text ps-1">Clientes</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
