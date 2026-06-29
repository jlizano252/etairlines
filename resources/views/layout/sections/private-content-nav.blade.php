<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="{{ route('dashboard.index') }}">
        <div class="d-flex align-items-center py-3">
            <img class="me-2 mt-n2" src="http://dev.pruebayerror.com/assets/img/MonkeyDevx300-min.png" alt="" width="120" />
        </div>
    </a>

    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center justify-content-between">

        <li class="nav-item dropdown">
            <a class="nav-link pe-0 ps-2 d-flex align-items-center" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="me-2 d-flex justify-content-end flex-column">
                    <span class="text-uppercase mt-1">Gilberth A. Rojas Alfaro</span>
                    <span class="text-primary text-end small mt-n1">Admin</span>
                </div>
                <div class="avatar avatar-xl">
                    <img class="rounded-circle shadow-sm" src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
{{--                    <a class="dropdown-item fw-bold text-warning" href="#!"><span class="fas fa-crown me-1"></span><span>Go Pro</span></a>--}}

{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item" href="#!">Set status</a>--}}
{{--                    <a class="dropdown-item" href="../pages/user/profile.html">Profile &amp; account</a>--}}
{{--                    <a class="dropdown-item" href="#!">Feedback</a>--}}

{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item" href="../pages/user/settings.html">Settings</a>--}}
                    <form method="POST" action="#!">@csrf<button class="dropdown-item" type="submit">Cerrar Sesión</button></form>
                </div>
            </div>
        </li>
    </ul>
</nav>
