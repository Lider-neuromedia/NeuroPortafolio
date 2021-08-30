@php
    $current = url()->current();
@endphp

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse bg-white">
    <div class="sidebar-sticky pt-3">

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Portafolio</span>
        </h6>

        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link @if(url()->full() == route('projects.index')) active @endif" href="{{ route('projects.index') }}"><i class="bi bi-record-circle"></i> Portafolio <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('projects.create')) active @endif" href="{{ route('projects.create') }}"><i class="bi bi-record-circle"></i> Crear Proyecto</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('links.index')) active @endif" href="{{ route('links.index') }}"><i class="bi bi-record-circle"></i> Enlaces</a></li>
            <li class="nav-item"><a class="nav-link @if(url()->full() == route('projects.index') . "?create-link=1") active @endif" href="{{ route('projects.index') }}?create-link=1"><i class="bi bi-record-circle"></i> Crear Enlace</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('categories.index')) active @endif" href="{{ route('categories.index') }}"><i class="bi bi-record-circle"></i> Categorías</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('categories.create')) active @endif" href="{{ route('categories.create') }}"><i class="bi bi-record-circle"></i> Crear Categoría</a></li>
        </ul>

        <div class="dropdown-divider"></div>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Brief</span>
        </h6>

        <ul class="nav flex-column mb-2">
            <li class="nav-item"><a class="nav-link @if($current == route('brief-assign.index')) active @endif" href="{{ route('brief-assign.index') }}"><i class="bi bi-record-circle"></i> Brief Asignados</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('brief.index') )) active @endif" href="{{ route('brief.index') }}"><i class="bi bi-record-circle"></i> Briefs</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('brief.create') )) active @endif" href="{{ route('brief.create') }}"><i class="bi bi-record-circle"></i> Crear Brief</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('clients.index') )) active @endif" href="{{ route('clients.index') }}"><i class="bi bi-record-circle"></i> Clientes</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('clients.create') )) active @endif" href="{{ route('clients.create') }}"><i class="bi bi-record-circle"></i> Crear Cliente</a></li>
        </ul>

        <div class="dropdown-divider"></div>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Administración</span>
        </h6>

        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link @if($current == route('users.index') )) active @endif" href="{{ route('users.index') }}"><i class="bi bi-record-circle"></i> Usuarios</a></li>
            <li class="nav-item"><a class="nav-link @if($current == route('users.create') )) active @endif" href="{{ route('users.create') }}"><i class="bi bi-record-circle"></i> Crear Usuario</a></li>
        </ul>

    </div>
</nav>