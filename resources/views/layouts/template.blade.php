<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wisata Religi | </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('template/plugins/select2/css/select2.min.css')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url('template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('template/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{url('template/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">WISATA KHASANTUKA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{url('template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->role_id == 1)
                        <li class="nav-item {{ request()->is('roles*') || request()->is('user*') || request()->is('jabatan*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-boxes"></i>
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link {{ request()->is('roles*') ? 'active' : ''}}">
                                        <i class="fa fa-list-alt nav-icon" aria-hidden="true"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('user.index')}}" class="nav-link {{ request()->is('user*') ? 'active' : ''}}">
                                        <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('jabatan.index')}}" class="nav-link {{ request()->is('jabatan*') ? 'active' : ''}}">
                                        <i class="far fa-building nav-icon"></i>
                                        <p>Jabatan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(in_array(Auth::user()->role_id, [1, 2, 3, 4]))
                        <li class="nav-item {{ request()->is('kategoris*') || request()->is('kategori-rekening*') || request()->is('transaksi*')|| request()->is('donation*') || request()->is('laporan*') || request()->is('bendahara*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-money-bill"></i>
                                <p>
                                    Keuangan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('kategoris.index')}}" class="nav-link  {{request()->is('kategoris*') ? 'active' : ''}}">
                                        <i class="fa fa-tags nav-icon" aria-hidden="true"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('kategori-rekening.index')}}" class="nav-link  {{request()->is('kategori-rekening*') ? 'active' : ''}}">
                                        <i class="fa-solid fa-wallet nav-icon" aria-hidden="true"></i>
                                        <p>Kategori Rekening</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('transaksi.index')}}" class="nav-link  {{request()->is('transaksi*') ? 'active' : ''}}">
                                        <i class="fa-solid fa-money-bill-transfer  nav-icon" aria-hidden="true"></i>
                                        <p>Transaksi Keuangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('laporan.index')}}" class="nav-link  {{request()->is('laporan*') ? 'active' : ''}}">
                                        <i class="fa-solid fa-coins nav-icon" aria-hidden="true"></i>
                                        <p>Laporan Keuangan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(in_array(Auth::user()->role_id, [1,2]))
                        <li class="nav-item {{ request()->is('kategori-surat*') || request()->is('surat-masuk*') || request()->is('surat-keluar*') || request()->is('agenda*')  ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-file-invoice"></i>
                                <p>
                                    Transaksi Surat
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('kategori-surat.index')}}" class="nav-link  {{request()->is('kategori-surat*') ? 'active' : ''}}">
                                        <i class="fa fa-tags nav-icon" aria-hidden="true"></i> <!-- Ikon kategori -->
                                        <p>Kategori Surat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('surat-masuk.index')}}" class="nav-link  {{request()->is('surat-masuk*') ? 'active' : ''}}">
                                        <i class="fa fa-envelope-open-text nav-icon" aria-hidden="true"></i> <!-- Ikon surat masuk -->
                                        <p>Surat Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('surat-keluar.index')}}" class="nav-link  {{request()->is('surat-keluar*') ? 'active' : ''}}">
                                        <i class="fa fa-paper-plane nav-icon" aria-hidden="true"></i> <!-- Ikon surat keluar -->
                                        <p>Surat Keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('agenda.index')}}" class="nav-link  {{request()->is('agenda*') ? 'active' : ''}}">
                                        <i class="fa fa-book nav-icon" aria-hidden="true"></i> <!-- Ikon buku agenda -->
                                        <p>Buku Agenda</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->is('jam-reservasi*') || request()->is('reservasi*') || request()->is('surat-keluar*')  ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-file-invoice"></i>
                                <p>
                                    Reservasi
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('reservasi.index')}}" class="nav-link  {{request()->is('reservasi*') ? 'active' : ''}}">
                                        <i class="fa fa-calendar nav-icon" aria-hidden="true"></i> 
                                        <p>Data Reservasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('jam-reservasi.index')}}" class="nav-link  {{request()->is('jam-reservasi*') ? 'active' : ''}}">
                                        <i class="fa fa-clock nav-icon" aria-hidden="true"></i>
                                        <p>Jam Reservasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav">
                            <a href="{{route('donation.index')}}" class="nav-link  {{request()->is('donasi*') ? 'active' : ''}}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Jumlah Pengunjung
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(in_array(Auth::user()->role_id, [5]))
                        <li class="nav">
                            <a href="{{ route('donation.index') }}" class="nav-link {{request()->is('donasi*') ? 'active' : ''}}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Donasi
                                </p>
                            </a>
                        </li>
                        <li class="nav">
                            <a href="{{ route('reservasi.create') }}" class="nav-link {{request()->is('reservasi*') ? 'active' : ''}}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Reservasi
                                </p>
                            </a>
                        </li>
                        @endif
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
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
                                <li class="breadcrumb-item active">@yield('sub-title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @include('sweetalert::alert')
                        @yield('content')
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @stack('prepend-script')
    <!-- jQuery -->
    <script src="{{url('template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{url('template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- AdminLTE App -->
    <!-- DataTables  & Plugins -->
    <script src="{{url('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('template/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{url('template/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{url('template/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{url('template/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('template/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{url('template/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('template/dist/js/adminlte.min.js')}}"></script>

    @yield('scripts')
    <script>
        $(function() {
            $('.select2').select2()
        });
    </script>


    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
            })
        });
    </script>
    @stack('addon-script')
</body>

</html>
