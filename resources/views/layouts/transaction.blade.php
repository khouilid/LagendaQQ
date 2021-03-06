<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield(('title'))</title>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <!-- App script -->
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>

    @stack('scripts')

    <!-- Theme style -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="{{ route('welcome') }}" class="navbar-brand">
                <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}" class="brand-image">
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="nav-link {{ side_nav_bar_menu_status('dashboard','active') }}"><i class="fa fa-user-cog"></i> Portrait</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.events.index') }}" class="nav-link {{ side_nav_bar_menu_status('events','active') }}"><i class="fas fa-calendar-check"></i> Mes ??v??nements</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-bullhorn"></i> Mes annonces</a>
                    </li>
                    @hasanyrole('chef-vendeur|vendeur')
                        <li class="nav-item"><a class="nav-link" href="{{route('vendeurs.my_team')}}"><i class="fa fa-user-friends"></i> Mon ??quipe</a></li>
                    @endrole
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Mon Compte</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{route('user.infosperso')}}/infos-perso"><i class="fa fa-user"></i> Infos personelles</a></li>
                            <li><a class="dropdown-item link-success" href="{{route('user.infosperso')}}/transactions" title="Lsite de mes transactions"><i class="fas fa-exchange-alt" aria-hidden="true"></i> Mes Transactions</a></li>
                            <li><a class="dropdown-item link-primary" href="{{route('user.infosperso')}}/wallet" title="Mon Portefeuille"><i class="fa fa-wallet" aria-hidden="true"></i> Mon Portefeuille </a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-power-off"></i> Se d??connecter</a></li>
                        </ul>
                    </li>
                    @hasanyrole('super-admin|admin')
                        <li class="nav-item dropdown">
                            <a href="{{route('admin.dashboard')}}" class="btn btn-primary"><i class="fa fa-user-shield"></i> Tableau de bord</a>
                        </li>
                    @endrole
                    <li>
                        <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off mr-2"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('layouts.back.partials.user-breadcrumb')

        <div class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
@include('layouts.back.alerts.sweetalerts')
</body>
</html>
