<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tags <sup>App</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Config.
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Administración</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/user') }}">
                    <i class="fa-solid fa-users fa-fw"></i> Usuarios
                </a>
                <a class="collapse-item" href="{{ url('/valortag') }}">
                    <i class="fa-solid fa-money-bill-trend-up"></i> Valor Tag
                </a>
                <a class="collapse-item" href="{{ url('/valordelivery') }}">
                    <i class="fa-solid fa-truck-front"></i> Valor Delivery
                </a>
                <a class="collapse-item" href="{{ url('/valordev') }}">
                    <i class="fa-solid fa-arrow-rotate-left"></i> Valor Devolución
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#asociados"
            aria-expanded="true" aria-controls="asociados">
            <i class="fa-solid fa-building-user"></i>
            <span>Asociados</span>
        </a>
        <div id="asociados" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/local') }}">
                    <i class="fa-solid fa-shop"></i> Locales
                </a>
                <a class="collapse-item" href="{{ url('/empleado') }}">
                    <i class="fa-solid fa-user-group"></i> Colaboradores
                </a>
            </div>
        </div>
    </li>       

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Logistica
    </div>


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('request_tag.index')}}">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Solicitudes Tags</span></a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('devoluciones.list')}}">
            <i class="fa-solid fa-rotate-left"></i>
            <span>Devoluciones Tags</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>