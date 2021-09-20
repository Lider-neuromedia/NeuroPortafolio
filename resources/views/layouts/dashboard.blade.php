<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NeuroMedia</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,400&display=swap">

    <script src="https://use.fontawesome.com/eb01d11666.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}?v={{ env('ASSETS_VERSION', 1) }}" rel="stylesheet">

    @yield('scripts')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('projects.index')}}" class="brand-link">
                <div class="">
                    <img src="{{url('images/logo.png')}}" class="brand-image img-circle elevation-3 bg-white">
                </div>
                <span class="brand-text font-weight-light">{{ \Auth::user()->name }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        @php
                            $current = url()->current();
                        @endphp

                        <li class="nav-header text-primary"><span>PORTAFOLIO</span></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('categories.index')) active @endif" href="{{ route('categories.index') }}"><i class="nav-icon far fa fa-tag"></i> <p>Categorías</p></a></li>
                        <li class="nav-item"><a class="nav-link @if(url()->full() == route('projects.index')) active @endif" href="{{ route('projects.index') }}"><i class="nav-icon far fa fa-briefcase"></i> <p>Portafolio</p></a></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('links.index')) active @endif" href="{{ route('links.index') }}"><i class="nav-icon far fa fa-link"></i> <p>Enlaces</p></a></li>

                        <li class="nav-header text-primary"><span>BRIEF</span></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('brief.index'))) active @endif" href="{{ route('brief.index') }}"><i class="nav-icon far fa fa-list-ol"></i> <p>Briefs</p></a></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('clients.index'))) active @endif" href="{{ route('clients.index') }}"><i class="nav-icon far fa fa-users"></i> <p>Clientes</p></a></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('brief-assign.index')) active @endif" href="{{ route('brief-assign.index') }}"><i class="nav-icon far fa fa-id-card-o"></i> <p>Brief Asignados</p></a></li>

                        <li class="nav-header text-primary"><span>GRÁFICAS</span></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('charts.monthly')) active @endif" href="{{ route('charts.monthly') }}"><i class="nav-icon far fa fa-area-chart"></i> <p>Meses</p></a></li>
                        <li class="nav-item"><a class="nav-link @if($current == route('charts.events'))) active @endif" href="{{ route('charts.events') }}"><i class="nav-icon far fa fa-table"></i> <p>Eventos</p></a></li>

                        @hasrole('admin')

                            <li class="nav-header text-primary"><span>ADMINISTRACIÓN</span></li>
                            <li class="nav-item"><a class="nav-link @if($current == route('users.index'))) active @endif" href="{{ route('users.index') }}"><i class="nav-icon far fa fa-user-circle-o"></i> <p>Usuarios</p></a></li>

                        @endhasrole

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link  text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon far fa fa-door-closed"></i><p>Cerrar Sesión</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'Neuromedia')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumbs')
                            </ol>
                        </div>
                    </div>

                    @include('layouts.partials.messages')

                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer text-right">
            Desarrollador por <strong><a href="https://neuromedia.com.co" target="_blank">NeuroMedia</a>.</strong>
        </footer>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('js/app.js') }}?v={{ env('ASSETS_VERSION', 1) }}" defer></script>
    @yield('post-scripts')
</body>

</html>