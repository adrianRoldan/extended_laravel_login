<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('users.show', auth()->user()->uuid) }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ auth()->user()->avatar }}" referrerPolicy="no-referrer" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                    <span class="text-secondary text-small"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route("dashboard") }}">
                <span class="menu-title">{{ __('Home') }}</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.show', auth()->user()->uuid) }}">
                <span class="menu-title">{{ __('Mi Perfil') }}</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">{{ __('Usuarios') }}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-account-multiple-plus menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route("users.index") }}"> Listado de Usuarios </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
