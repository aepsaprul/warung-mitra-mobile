@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            @foreach ($orders as $order)
                <div class="box box-solid">
                    <div class="box-body">
                        <p class="lead">Kode Tagihan <span class="pull-right">{{ $order->kode }}</span></p>
                        <div class="row">
                            @foreach ($order->data_order_detail as $key => $order_detail)
                                <div class="col-xs-6">
                                    <img style="max-width: 100px;" src="http://warung-mitra-admin.test/img/{{ $order_detail->data_produk->gambar1 }}">
                                </div>
                                <div class="col-xs-6">
                                    {{ $order_detail->data_produk->nama }}<br>
                                    Jumlah: {{ $order_detail->qty }}
                                </div>
                            @endforeach
                        </div>
                        <p>Total Bayar <span class="pull-right">Rp. {{ rupiah($order->total_bayar) }}</span></p>
                        @if ($order->status_bayar == 1)
                            <p>Status: <span class="pull-right">LUNAS</span></p>
                            <p><a href="#"><u></u></a></p>
                        @elseif($order->status_bayar == 0 && $order->jenis_bayar == null)
                            <p>Status: <span class="pull-right">PILIH METODE PEMBAYARAN</span></p>
                            <p><a href="{{ route('transaksi.detail', ['kode' => $order->kode]) }}"><u>DETAIL</u></a></p>
                        @elseif($order->status_bayar == 0 && $order->jenis_bayar != null)
                            <p>Status: <span class="pull-right">LANJUT PEMBAYARAN</span></p>
                            <p><a href="{{ route('invoice.index', ['kode' => $order->kode]) }}"><u>DETAIL</u></a></p>
                        @else
                            <p>Status: <span class="pull-right">BATAL / KADALUWARSA</span></p>
                            <p><a href="#"><u></u></a></p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
