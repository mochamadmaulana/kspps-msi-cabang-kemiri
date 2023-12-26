<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Icon title bar -->
    <link rel="shortcut icon" href="{{ asset('assets/image/logo-msi.png') }}" type="image/png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'KSPPS-MSI' }} | {{ env('APP_NAME') ?? 'KSPPS-MSI' }}</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <span class="d-none d-md-inline mr-2">{{ Auth::user()->nama_lengkap ?? 'Nama Lengkap User' }}</span>
                        @if(!empty(Auth::user()->photo_profile))
                        <img src="{{ asset('storage/image/photo-profile/'.Auth::user()->photo_profile) }}" class="user-image img-circle elevation-2" alt="Avatar">
                        @else
                        <img src="{{ asset('assets/image/default.jpg') }}" class="user-image img-circle elevation-2" alt="Avatar">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Avatar -->
                        <li class="user-header bg-secondary">
                            @if(!empty(Auth::user()->photo_profile))
                            <img src="{{ asset('storage/image/photo-profile/'.Auth::user()->photo_profile) }}" class="img-circle elevation-2" alt="Avatar">
                            @else
                            <img src="{{ asset('assets/image/default.jpg') }}" class="img-circle elevation-2" alt="Avatar">
                            @endif

                            <p>
                                {{ Auth::user()->nama_lengkap ?? 'Nama Lengkap' }}
                                <small class="font-italic">{{ Auth::user()->role }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-sm btn-success shadow-sm"><i class="fas fa-user mr-1"></i> Profile</a>
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-danger float-right shadow-sm"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="javascript:void(0)" class="brand-link">
                <img src="{{ asset('assets/image/logo-msi.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
                <span class="brand-text font-weight-light ml-3">{{ env('APP_NAME') ?? 'KSPPS-MSI' }}<sup class="ml-2">V1</sup></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->nama_lengkap ?? 'Nama Lengkap' }}</a>
                        <small class="text-warning">
                            <i>KC - {{ Auth::user()->kantor->nama }}</i>
                        </small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-header">MENU</li>

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('staff-lapangan.dashboard') }}"
                                class="nav-link {{ (request()->is('staff-lapangan/dashboard')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <!-- Pembiayaan -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/pembiayaan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>
                                    Pembiayaan
                                </p>
                            </a>
                        </li> --}}

                        <!-- Penyaluran Pembiayaan -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/pembiayaan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Penyaluran Pembiayaan
                                </p>
                            </a>
                        </li> --}}

                        <!-- Distribusi -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/distribusi*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Distribusi
                                </p>
                            </a>
                        </li> --}}

                        <!-- Dafnom -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/dafnom*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Dafnom
                                </p>
                            </a>
                        </li> --}}

                        <!-- Anggota -->
                        <li class="nav-item">
                            <a href="{{ route('staff-lapangan.anggota.index') }}" class="nav-link {{ Request::is('staff-lapangan/anggota*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-address-book"></i>
                                <p>
                                    Anggota
                                </p>
                            </a>
                        </li>

                        <!-- Majelis -->
                        <li class="nav-item">
                            <a href="{{ route('staff-lapangan.majlis.index') }}" class="nav-link {{ Request::is('staff-lapangan/majlis*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-house-user"></i>
                                <p>
                                    Majlis
                                </p>
                            </a>
                        </li>

                        <!-- Komoditi Usaha -->
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/komoditi-usaha*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Komoditi Usaha
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-header">LAPORAN</li> --}}

                        <!-- Anggota -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/anggota*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-address-book"></i>
                                <p>
                                    Pengajuan Anggota
                                </p>
                            </a>
                        </li> --}}

                        <!-- Pengajuan Pembiayaan -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/anggota*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>
                                    Pengajuan Pembiayaan
                                </p>
                            </a>
                        </li> --}}

                        <!-- Rekap Penyaluran -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/anggota*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Rekap Penyaluran
                                </p>
                            </a>
                        </li> --}}

                        {{-- <li class="nav-header">APPROVEMENT BY</li> --}}

                        <!-- Branch Manager -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/kantor*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Branch Manager
                                </p>
                            </a>
                        </li> --}}

                        <!-- Kasi Pembiayaan -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/kantor*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Kasi Pembiayaan
                                </p>
                            </a>
                        </li> --}}

                        <!-- Admin -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('admin/kantor*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Admin
                                </p>
                            </a>
                        </li> --}}


                        <li class="nav-header">PENGATURAN</li>

                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item mb-5">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
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
                            <h1 class="m-0"><i class="{{ $icon ?? '' }} mr-1"></i> {{ $title ?? '' }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @stack('breadcrumb')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Small boxes (Stat box) -->
                    @yield('content')
                    <!-- /.row -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 @if(date('Y') != '2023') &mdash; {{ date('Y') }} @endif <a href="#" target="_blank">KSPPS Mitra Sejahtera Raya Indonesia</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Versi 1</b>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @stack('modal')

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- daterangepicker -->
    {{-- <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    @stack('js')

    @if(session()->has('success'))
    <script>
        $(document).ready(function () {
            toastr.success('{{ session("success") }}')
        })
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        $(document).ready(function () {
            toastr.error('{{ session("error") }}')
        })
    </script>
    @endif
</body>

</html>
