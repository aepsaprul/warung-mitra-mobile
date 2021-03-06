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
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <section class="content">
                        <!-- title row -->
                        <div class="row">
                            <div class="box box-solid">
                                <div class="box-header">
                                        <div class="box-header bg-primary">
                                                <a href="{{ url('/') }}"><img src="{{ asset('adminlte/dist/img/c.png') }}" style="max-width: 200px;" alt="Logo Image"></a>
                                                <p class="pull-right lead" style="color: white;">INVOICE</p>
                                            </div>
                                </div>
                                <div class="box-header text-center lead">
                                    <strong>Pembayaran
                                        @php
                                            $totalmargin = $order->total_bayar + $order->margin;    
                                        @endphp
                                        
                                        @if ($order->jenis_bayar == 2)
                                            @php
                                                $angsuran = $totalmargin;
                                            @endphp 
                                            <span>Tempo 1 Minggu</span>
                                        @elseif ($order->jenis_bayar == 3)
                                            @php
                                                $angsuran = $totalmargin / 2;
                                            @endphp
                                            <span>Tempo 2 Minggu</span>
                                        @elseif ($order->jenis_bayar == 4)
                                            @php
                                                $angsuran = $totalmargin / 3;
                                            @endphp
                                            <span>Tempo 3 Minggu</span>
                                        @elseif ($order->jenis_bayar == 5)
                                            @php
                                                $angsuran = $totalmargin / 4;
                                            @endphp
                                            <span>Tempo 4 Minggu</span>
                                        @else
                                            <span>Cash</span>
                                        @endif
                                        
                                    </strong>
                                </div>
                                <div class="box-body">
                                    {{-- <p class="batas_pembayaran text-center lead">Batas Pembayaran: <strong>2 Jam</strong></p> --}}
                                    <p class="jumlah_tagihan text-center lead">Detail tagihan:</p>
                                    <table style="width: 100%;">
                                        <tr>
                                            <th style="border-bottom: solid 1px;">Produk</th>
                                            <th style="text-align: center; border-bottom: solid 1px;">Jml</th>
                                            <th style="text-align: center; border-bottom: solid 1px;">Harga</th>
                                        </tr>
                                        @foreach ($orders as $order_item)
                                        <tr>
                                            <td>{{ $order_item->data_produk->nama }}</td>
                                            <td style="text-align: center;">{{ $order_item->qty }}</td>
                                            <td style="text-align: right;">{{ $order_item->harga }}</td>
                                        </tr>                                            
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Plastik</td>
                                            <td style="text-align: right;">100</td>
                                        </tr>
                                        {{-- <tr>
                                            <td colspan="2">Margin</td>
                                            <td style="text-align: right;">{{ $order->margin }}</td>
                                        </tr> --}}
                                        <tr>
                                            <td colspan="2" style="text-align: left; font-weight: bold;">Total</td>
                                            <td style="text-align: right; font-weight: bold;">Rp. {{ rupiah($order->total_bayar + $order->margin) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left; font-weight: bold;">Angsuran</td>
                                            <td style="text-align: right; font-weight: bold;">Rp. {{ rupiah(ceil($angsuran)) }} / Minggu</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left; font-weight: bold;">Tgl Mulai</td>
                                            <td style="text-align: right; font-weight: bold;">{{ tgl_indo(date('Y-m-d')) }}</td>
                                        </tr>
                                    </table>
                                    {{-- <p class=" text-center lead"><strong class="total_bayar">Rp. {{ rupiah($order->total_bayar) }}</strong></p> --}}
                                    <br>
                                    <p class="kode_tagihan">Kode Tagihan:</p>
                                    <p>
                                        <input type="text" style="border: none; font-weight: bold;" value="{{ $order->kode }}" id="kodeTagihan" readonly/>
                                        <button type="button" style="border: none; background: none; color: grey;" id="copyKodeTagihan" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Salin</button>
                                    </p>

                                    <p class="title_rekening">Pembayaran dapat dilakukan ke rekening a.n <strong>Endro prasetyo,se</strong> berikut:  </p>        
                                    <p>
                                        <strong>Bank BCA, </strong><input type="text" style="border: none; font-weight: bold;" value="434-0071-439" id="no_rek" readonly/>
                                        <button type="button" style="border: none; background: none; color: grey;" id="copy" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Salin</button>
                                    </p>

                                    {{-- @if ($order->jenis_bayar == 2)
                                        <p class="title_rekening">Pembayaran dapat dilakukan ke rekening a.n <strong>Warung mitra</strong> berikut: </p>        
                                        <p>
                                            <input type="text" style="border: none; font-weight: bold;" value="11100-00093-0000001" id="no_rek" readonly/>
                                            <button type="button" style="border: none; background: none; color: grey;" id="copy" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Salin</button>
                                        </p>
                                    @elseif ($order->jenis_bayar == 3)
                                        <p class="title_rekening">Pembayaran dapat dilakukan ke rekening a.n <strong>Endro prasetyo,se</strong> berikut:  </p>        
                                        <p>
                                            <strong>Bank BCA, </strong><input type="text" style="border: none; font-weight: bold;" value="434-0071-439" id="no_rek" readonly/>
                                            <button type="button" style="border: none; background: none; color: grey;" id="copy" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Salin</button>
                                        </p>
                                    @elseif ($order->jenis_bayar == 4)
                                        <p class="title_rekening">Pembayaran dapat dilakukan ke rekening a.n <strong>Endro prasetyo,se</strong> berikut:  </p>        
                                        <p>
                                            <strong>Bank Mandiri, </strong><input type="text" style="border: none; font-weight: bold;" value="139-00-1002330-1" id="no_rek" readonly/>
                                            <button type="button" style="border: none; background: none; color: grey;" id="copy" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Salin</button>
                                        </p>
                                    @elseif ($order->jenis_bayar == 5)
                                        <p class="title_rekening">Pembayaran dapat dilakukan ke rekening a.n <strong>Endro prasetyo,se</strong> berikut:  </p>        
                                        <p>
                                            <strong>Bank Mandiri, </strong><input type="text" style="border: none; font-weight: bold;" value="139-00-1002330-1" id="no_rek" readonly/>
                                            <button type="button" style="border: none; background: none; color: grey;" id="copy" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Salin</button>
                                        </p> --}}
                                    {{-- @else
                                        <span>bertemu langsung dengan penjual</span>
                                    @endif --}}
                                </div>
                                <div class="box-body">
                                    <p style="text-align: justify;">
                                        Warung mitra akan melakukan verifikasi paling lama 30 menit setelah kamu melakukan pembayaran. Jika kamu menghadapi kendala mengenai pembayaran, silahkan langsung hubungi melalui kontak atau chat yang tersedia di website <a href="http://warungmitra.com" target="blank">www.warungmitra.com</a>.
                                    </p>
                                    <p><button class="btn btn-warning btn-block btn-cetak">CETAK</button></p>
                                </div>
                            </div>
                        </div>                        
                    </section>
                    <!-- /.content -->
                    <div class="clearfix"></div>
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
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

        <script>
            $('document').ready(function() {
                $('.btn-cetak').on('click', function() {
                    $('.btn-cetak').hide();
                    window.print();
                })
                $('#copy').on('click', function(){
                    $('#no_rek').select();
                    document.execCommand("copy");
                    $('#copy').text('Tersalin');
                    $('#copyKodeTagihan').text('Salin');
                })
                $('#copyKodeTagihan').on('click', function(){
                    $('#kodeTagihan').select();
                    document.execCommand("copy");
                    $('#copyKodeTagihan').text('Tersalin');
                    $('#copy').text('Salin');
                })
            });
        </script>
    </body>
</html>
