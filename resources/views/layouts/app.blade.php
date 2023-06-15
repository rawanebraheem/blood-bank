<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Bank</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">




</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <div class="btn-group">
                    <button type="button" class="btn btn-default">{{ Auth::user()->name }}</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <input type="submit" value="     Log Out">
                        </form>
                        <a class="dropdown-item" href="{{ url('/dashboard') }}">dashboard</a>

                    </div>



            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            


            <!-- Sidebar -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                

            </div>




            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                    {{-- client --}}
                    <li class="nav-header">Clients</li>
                    <li class="nav-item">
                        <a href="{{ url(route('clients.index')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View All Clients</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(route('clients.create')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Clients</p>
                        </a>
                    </li>

                    {{-- client --}}

                    {{-- Governorates --}}
                    <li class="nav-header">Governorates</li>
                    <li class="nav-item">
                        <a href="{{ url(route('governorates.index')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View All Governorates</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(route('governorates.create')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Governorates</p>
                        </a>
                    </li>


                    {{-- Governorates --}}

                    {{-- Cities --}}
                    <li class="nav-header">Cities</li>
                    <li class="nav-item">
                        <a href="{{ url(route('cities.index')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View All Cities</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(route('cities.create')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Cities</p>
                        </a>
                    </li>


                    {{-- Cities --}}

                    {{-- Categories --}}
                    <li class="nav-header">Categories</li>
                    <li class="nav-item">
                        <a href="{{ url(route('categories.index')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View All Categories</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(route('categories.create')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Categories</p>
                        </a>
                    </li>


                    {{-- Categories --}}

                    {{-- Articles --}}
                    <li class="nav-header">Articles</li>
                    <li class="nav-item">
                        <a href="{{ url(route('articles.index')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View All Articles</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(route('articles.create')) }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Articles</p>
                        </a>
                    </li>


                    {{-- Articles --}}

                    {{-- Donation Requests --}}
                    <li class="nav-header">Donation Requests</li>
                    <li class="nav-item">
                        <a href="{{ url('donation-requests-index') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View Donation Requests</p>
                        </a>
                    </li>

                    {{-- Donation Requests --}}

                    {{-- Contacts --}}
                    <li class="nav-header">Contacts</li>
                    <li class="nav-item">
                        <a href="{{ url('contacts-index') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>View All Contacts</p>
                        </a>
                    </li>


                    {{-- Contacts --}}

                    {{-- Settings --}}
                    <li class="nav-header">Settings</li>
                    <li class="nav-item">
                        <a href="{{ url('settings-edit') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Edit Settings</p>
                        </a>
                    </li>

                    {{-- Settings --}}




                </ul>
            </nav>
            <!-- /.sidebar-menu -->

            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{ $header }}</h1>
                        </div>
                       
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">


                {{ $slot }}


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
</body>

</html>



