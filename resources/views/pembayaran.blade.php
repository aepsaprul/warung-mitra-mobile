<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Warung Mitra') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/all.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
        <style>
            .tf-aplikasi {
                max-width: 80px;
            }
        </style>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('adminlte/dist/img/c.png') }}" style="max-width: 100px;" alt="Logo Image"></a>
                            <button type="button" class="navbar-toggle collapsed">
                                DETAIL BELANJA
                            </button>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <form class="form-horizontal"action="{{ route('pembayaran.store', ['kode' => $orders->kode]) }}" method="POST">
                                @csrf
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <p class="lead">Pilih Metode Pembayaran</p>
                                    </div>
                                    <div class="box-body">
                                        <table>
                                            {{-- <tr>
                                                <td><input type="radio" name="metode_pembayaran" class="minimal" value="2" checked></td>
                                                <td><img src="{{ asset('koperasi-mitra.jpeg') }}" alt="warung-image" class="tf-aplikasi"></td>
                                                <td>Transfer Aplikasi koperasi mitra berkah usaha atas nama Warung mitra</td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="metode_pembayaran" class="minimal" value="3"></td>
                                                <td><img src="{{ asset('logo-bank-bca.png') }}" alt="warung-image" class="tf-aplikasi" style="padding: 10px;"></td>
                                                <td>Pembayaran ke rekening 434-0071-439 a.n <strong>Endro prasetyo,se</strong></td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="metode_pembayaran" class="minimal" value="4"></td>
                                                <td><img src="{{ asset('logo_bank_mandiri.png') }}" alt="warung-image" class="tf-aplikasi" style="padding: 10px;"></td>
                                                <td>Pembayaran ke rekening 434-0071-439 a.n <strong>Endro prasetyo,se</strong></td>
                                            </tr> --}}
                                            <tr>
                                                <td><input type="radio" name="metode_pembayaran" class="minimal" value="6" checked></td>
                                                <td><img src="{{ asset('koperasi-mitra.jpeg') }}" alt="warung-image" class="tf-aplikasi"></td>
                                                <td>Transfer Aplikasi koperasi mitra berkah usaha ke 11100-00093-0000001 a.n Warung mitra</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><p style="padding-left: 30px; font-style: italic;">Belum install aplikasi? <a href="">klik disini</a></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><label><input type="radio" name="metode_pembayaran" class="minimal" value="1"> &nbsp&nbsp Cash</label></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><label><input type="radio" name="metode_pembayaran" class="minimal" value="2"> &nbsp&nbsp Tempo 1 Minggu</label></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><label><input type="radio" name="metode_pembayaran" class="minimal" value="3"> &nbsp&nbsp Tempo 2 Minggu</label></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><label><input type="radio" name="metode_pembayaran" class="minimal" value="4"> &nbsp&nbsp Tempo 3 Minggu</label></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><label><input type="radio" name="metode_pembayaran" class="minimal" value="5"> &nbsp&nbsp Tempo 4 Minggu</label></td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                </div>
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <p class="lead">Jadwal Pengiriman</p>
                                    </div>
                                    <div class="box-body">
                                        <ul>
                                            <li>Pagi pukul 10:00 s/d 12:00 (batas maksimal transfer pukul 09:00)</li>
                                            <li>Sore pukul 15:00 s/d 17:00 (transfer diatas pukul 09:00 s/d 14:00)</li>
                                            <li>Transfer diatas pukul 15:00 diantar besoknya pukul 10:00</li>
                                            <li>kurir pakai <img src="{{ asset('kawanexpress.png') }}" alt="kawan express" class="tf-aplikasi" style="padding: 10px;"> </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <p class="lead">Detail Pembayaran</p>
                                    </div>
                                    <div class="box-body">
                                        <table class="table-bayar" style="width: 100%;">
                                            <tr>
                                                <td class="lead">Total Harga</td>
                                                <td class="nominal lead" style="text-align: right;">Rp. <span>{{ rupiah($orders->total_harga) }}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="lead">Ongkir</td>
                                                {{-- <td class="nominal lead" style="text-align: right;">Rp. <span>{{ rupiah($orders->ongkir) }}</span></td> --}}
                                                <td class="nominal lead" style="text-align: right;"><span>Gratis</span></td>
                                            </tr>
                                            <tr>
                                                <td class="lead">Tas Plastik</td>
                                                <td class="nominal lead" style="text-align: right;">Rp. <span class="plastik">{{ rupiah(100) }}</span></td>
                                            </tr>
                                            {{-- <tr>
                                                <td class="lead">Margin</td>
                                                <td class="nominal lead" style="text-align: right;">Rp. <span class="margine">{{ rupiah(0) }}</span></td>
                                            </tr> --}}
                                            <tr>
                                                <td class="lead"><label for="poin"><input type="checkbox" name="poin" class="minimal poin" id="poin" value="{{ $orders->data_customer->poin }}"> Poin: </label></td>
                                                <td class="nominal lead" style="text-align: right;"><span class="val_poin">{{ rupiah($orders->data_customer->poin) }}</span></td>
                                                <input type="hidden" id="hidden_poin" value="{{ $orders->data_customer->poin }}">
                                            </tr>
                                        </table>
                                        <hr>
                                        <table class="table-bayar" style="width: 100%;">
                                            <tr>
                                                <td class="lead"><strong> Total Bayar: </strong></td>
                                                <td class="nominal lead" style="text-align: right;"><strong> Rp. <span class="total_bayar">{{ rupiah($orders->total_bayar) }}</span> </strong></td>
                                                <input type="hidden" name="total_bayar" id="hidden_total_bayar" value="{{ $orders->total_bayar }}">
                                            </tr>
                                        </table>
                                        {{-- <table class="table-bayar" style="width: 100%;">
                                            <tr>
                                                <td class="lead"><strong> Margin: </strong></td>
                                                <td class="nominal lead" style="text-align: right;"><strong>Rp. <span class="margine">{{ rupiah(0) }}</span></strong></td>
                                            </tr>
                                        </table> --}}
                                        <table class="table-bayar" style="width: 100%;">
                                            <tr>
                                                <td class="lead"><strong> Angsuran: </strong></td>
                                                <td class="nominal lead" style="text-align: right;"><strong>Rp. <span class="angsuran">{{ rupiah(0) }}</span> / Minggu</strong></td>
                                            </tr>
                                        </table>
                                        <table class="table-bayar tgl_mulai" style="width: 100%;">
                                            <tr>
                                                <td class="lead"><strong> Tgl Mulai: </strong></td>
                                                <td class="nominal lead" style="text-align: right;"><strong><span class="tgl_mulai">{{ tgl_indo(date('Y-m-d')) }}</span></strong></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn bg-orange btn-block">Bayar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->
            
            {{-- <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights reserved. --}}
                
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- iCheck 1.0.1 -->
        <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

        <script>
            $('document').ready(function() {
                function rupiah(bilangan) {
                    var bilangan = bilangan;
                        
                    var	number_string = bilangan.toString(),
                        sisa 	= number_string.length % 3,
                        rupiah 	= number_string.substr(0, sisa),
                        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                            
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    return rupiah;
                }

                $('.tgl_mulai').hide();

                $('#poin').on('ifChanged', function() {
                    var poin = $('#hidden_poin').val();
                    var total_bayar = $('#hidden_total_bayar').val();

                    if(this.checked) {
                        var hitung = parseInt(total_bayar) - parseInt(poin);
                        $('#hidden_total_bayar').val("");
                        $('#hidden_total_bayar').val(hitung);
                        $('.total_bayar').text(rupiah(hitung));
                    } else {
                        var hitung = parseInt(total_bayar) + parseInt(poin);
                        $('#hidden_total_bayar').val("");
                        $('#hidden_total_bayar').val(hitung);
                        $('.total_bayar').text(rupiah(hitung));
                    }
                });

                // ifChecked
                $('input[type="radio"].minimal').on('ifChecked', function() {
                    var valueRadio = $(this).val();
                    var total_bayar = $('#hidden_total_bayar').val();

                    if(valueRadio == '2') {
                        var margine = parseInt(total_bayar) * 0.01;
                        var total = parseInt(total_bayar) + parseInt(margine);
                        var angsuran = parseInt(total) / 1;
                        $('.margine').text(rupiah(margine));
                        $('.total_bayar').text(rupiah(total));
                        $('.angsuran').text(rupiah(Math.ceil(angsuran)));
                        $('.tgl_mulai').show();
                    } else if(valueRadio == '3') {
                        var margine = parseInt(total_bayar) * 0.02;
                        var total = parseInt(total_bayar) + parseInt(margine);
                        var angsuran = parseInt(total) / 2;
                        $('.margine').text(rupiah(margine));
                        $('.total_bayar').text(rupiah(total));
                        $('.angsuran').text(rupiah(Math.ceil(angsuran)));
                        $('.tgl_mulai').show();
                    } else if(valueRadio == '4') {
                        var margine = parseInt(total_bayar) * 0.03;
                        var total = parseInt(total_bayar) + parseInt(margine);
                        var angsuran = parseInt(total) / 3;
                        $('.margine').text(rupiah(margine));
                        $('.total_bayar').text(rupiah(total));
                        $('.angsuran').text(rupiah(Math.ceil(angsuran)));
                        $('.tgl_mulai').show();
                    } else if(valueRadio == '5') {
                        var margine = parseInt(total_bayar) * 0.04;
                        var total = parseInt(total_bayar) + parseInt(margine);
                        var angsuran = parseInt(total) / 4;
                        $('.margine').text(rupiah(margine));
                        $('.total_bayar').text(rupiah(total));
                        $('.angsuran').text(rupiah(Math.ceil(angsuran)));
                        $('.tgl_mulai').show();
                    } else {
                        $('.margine').text(rupiah(0));
                    }
                })
                // ifChanged
                // ifClicked
                // ifUnchecked
                // ifToggled
                // ifDisabled
                // ifEnabled
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass   : 'iradio_minimal-blue'
                })
            });
        </script>
    </body>
</html>
