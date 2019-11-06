<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Warung mitra | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">

        <!-- chat whatsapp -->
        <link href="{{ asset('css/floating-wpp.css') }}" rel="stylesheet" type="text/css"/>

        @yield('style')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue-light sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>WM</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="{{ asset('adminlte/dist/img/a.png') }}" style="max-width: 40px;" class="img-circle" alt="Logo Image"><b>warungmitra</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <form action="{{ route('search') }}" method="GET">
                                        <li class="header">
                                            <div class="input-group margin">
                                                <input type="text" name="attr" class="form-control" placeholder="cari produk">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </li>
                                    </form>
                                </ul>
                            </li>
                            @guest
                                <li class="dropdown notifications-menu">
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="dropdown notifications-menu">
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            @else
                                <li class="dropdown notifications-menu">
                                    <a href="{{ route('tracking') }}">
                                        <i class="fa fa-truck"></i>
                                    </a>
                                </li><li class="dropdown notifications-menu">
                                    <a href="{{ route('transaksi.index') }}">
                                        <i class="fa fa-exchange"></i>
                                        @if ($transaksi == 0)
                                            <span></span>
                                        @else                                                
                                            <span class="label label-warning">{{ $transaksi }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="dropdown notifications-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-database"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">Poin sebanyak {{ rupiah(Auth::user()->poin) }}</li>
                                    </ul>
                                </li>
                                <li class="dropdown notifications-menu">
                                    <a href="{{ route('keranjang.index') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="label label-warning">{{ $order_sementara == 0 ? '' : $order_sementara }}</span>
                                    </a>
                                </li>
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown notifications-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">halo, {{ strtoupper(Auth::user()->username) }}</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <li>
                                                    <a href="{{ route('profil') }}">
                                                        <i class="fa fa-angle-right text-aqua"></i> Profil
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i class="fa fa-angle-right text-aqua"></i> Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU NAVIGASI</li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-arrow-circle-o-right"></i> <span>Beranda</span></a></li>
                    @foreach ($kategoris as $grup => $kategori)
                        @if (count($kategori) > 1)
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-arrow-circle-o-right"></i> <span>{{ $grup }}</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>                                    
                                </a>
                                <ul class="treeview-menu">
                                    @foreach ($kategori as $kategori_sub)
                                        <li>
                                            <a href="{{ url('search?attr=' . $kategori_sub->nama) }}"><i class="fa fa-circle-o"></i>{{ $kategori_sub->nama }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>            
                        @else
                            @foreach ($kategori as $kategori_sub)
                                <li><a href="{{ url('search?attr=' . $kategori_sub->nama) }}"><i class="fa fa-arrow-circle-o-right"></i> <span>{{ $kategori_sub->nama }}</span></a></li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="row">
                    <div class="box box-solid col-xs-12">
                        <div class="box-header">
                            <h5>PETA SITUS WARUNGMITRA.COM</h5>
                        </div>
                        <div class="box-body">
                            <p class="lead">Aturan Penggunaan</p>
                            <p class="lead">Kebijakan Privasi</p>
                            <p class="lead">Cara Beli</p>
                            <p class="lead">Sejarah</p>
                        </div>
                    </div>
                    <div class="box box-solid col-xs-12">
                        <div class="box-header">
                            <h5>KONTAK</h5>
                        </div>
                        <div class="box-body">
                            <p class="lead">Phone / WhatsApp: 085228348588</p>
                            <p class="lead">Phone / WhatsApp: 088215425668</p>
                            <p class="lead">
                                <div class="text-center">
                                    <a class="btn btn-social-icon btn-facebook" title="Facebook" target="_blank" href="https://www.facebook.com/warungMitraa/"><i class="fa fa-facebook"></i></a>
                                    <a class="btn btn-social-icon btn-instagram" title="Instagram" target="_blank" href="https://www.instagram.com/warungmitra/"><i class="fa fa-instagram"></i></a>
                                    <a class="btn btn-social-icon btn-instagram" title="Youtube" target="_blank" href="https://youtu.be/xcL1po_LHzw"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="text-center">Copyright © 2019 warungmitra.com</div>
                </div>
                <div id="btnWhatsapp"></div>
            </footer>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

        <script src="{{ asset('js/floating-wpp.js') }}"></script>

        <script type="text/javascript">
            $(function () {
                $('#btnWhatsapp').floatingWhatsApp({
                    phone: '+6281337667055',
                    popupMessage: 'Ada yang bisa kami bantu?',
                    message: "",
                    showPopup: true,
                    showOnIE: false,
                    headerTitle: 'Welcome!',
                    headerColor: 'crimson',
                    backgroundColor: 'crimson',
                    buttonImage: '<img src="http://warung-mitra-client.test/whatsapp.svg" />',
                    position: "right"
                });
            });
        </script>

        @yield('script')
    </body>
</html>
