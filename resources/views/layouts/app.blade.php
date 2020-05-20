<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sunshine Laundry') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @php
        $route = Route::current()->uri;
       
    @endphp
   
    <div class="page-wrapper {{$route}}" id="app">
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="#"><img src="{{asset('images/logo.png')}}"> Laundry Management System</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->user_name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header><!-- ./header -->
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-header"></div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="">
                            <a href="dashboard.html">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>

                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Orders</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="/orders/create">Create Order
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/orders">View Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown {{
                            $route == 'clients' || $route == 'clients/create' || $route == 'clients/{item}/edit'
                            ? 'active':''}}">
                            <a href="#">
                                <i class="fas fa-users"></i>
                                <span>Clients</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="/clients/create">Add Client</a>
                                    </li>
                                    <li>
                                        <a href="/clients">All Clients</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <li class="sidebar-dropdown {{
                        $route == 'items' || $route == 'items/create' || $route == 'items/{item}/edit'
                        ? 'active':''}}">
                            <a href="#">
                                <i class="fas fa-th-large"></i>
                                <span>Items</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                   @can('create-item', Auth::user())
                                    <li>
                                        <a href="/items/create">Add Item</a>
                                    </li>
                                    @endcan
                                    <li class="{{$route == 'items' ? 'active':''}}">
                                        <a href="/items">All Items</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="{{route('services.index')}}" class="{{ $route == 'services' ? 'active':'' }}"><i class="fas fa-cubes"></i> Services</a>
                        </li>
                        <li class="sidebar-dropdown {{ $route == 'invoices' ? 'active':'' }}"">
                            <a href="#">
                                <i class="fa fa-list"></i>
                                <span>Invoices</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="/invoices">View Invoices</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="active">
                            <a href="reports.html">
                                <i class="fa fa-chart-line"></i>
                                <span>Reports</span>
                            </a>

                        </li>
                        <li class="header-menu">
                            <span>Settings</span>
                        </li>
                       {{Gate::allows('manage-staff')}}
                      @can('manage-staff', Auth::user())
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Staff Settings</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="/staff/create">Add Staff</a>
                                    </li>
                                    <li>
                                        <a href="/staff">View Staffs</a>
                                    </li>
                                    {{-- <li>
                                        <a href="staff/staff-access.html">Manage Access</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </li>
                      @endcan
                        
                        <li>
                          @if(Auth::check())
                        <a href="/account-settings/{{Auth::id()}}/edit">
                                <i class="fa fa-cog"></i>
                                <span>Account Settings</span>
                            </a>
                           @endif
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- /.sidebar-content -->
        </nav><!-- ./sidebar -->
        <main class="page-content">
            @yield('content')
        </main><!-- ./page-content -->
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(".sidebar-dropdown > a").click(function () {
            $(".sidebar-submenu").slideUp(200);
                $(this)
                    .next(".sidebar-submenu")
                    .slideUp(200);
            if ($(this).parent().hasClass("active")) {
                $(".sidebar-dropdown").removeClass("active");
                $(this).parent().removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .next(".sidebar-submenu")
                    .slideDown(200);
                $(this)
                    .parent()
                    .addClass("active");
            }
        });
    </script>
    <script src="{{ asset('js/app.js') }}" ></script>
    @stack('scripts')
</body>
</html>
