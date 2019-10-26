@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="box box-solid">
                <div class="box-header">
                    <img src="http://warung-mitra-admin.test/img/{{ $produk->gambar1 }}" style="max-width: 100%;" alt="image">
                </div>
                <div class="box-body">
                    <div class="col-xs-12">
                        <p class="lead">
                            {{ $produk->nama }}
                        </p>
                    </div>
                    <p class="lead">
                        <div class="col-xs-4">Rp. {{ rupiah($produk->harga) }}</div>
                        <div class="col-xs-4">Stok: {{ $produk->stok }}</div>
                        <div class="col-xs-4">Terjual: {{ $produk->terjual }}</div>
                    </p>
                </div>
                <div class="box-body">
                    <div class="col-xs-12">
                        @if(session('stok'))
                            <div class="alert alert-danger">
                                {{session('stok')}}
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-6"><a href="{{ route('keranjang.masukkan_keranjang', ['id' => $produk->id]) }}" class="btn btn-primary btn-block">Keranjang</a></div>
                    <div class="col-xs-6"><a href="{{ route('keranjang.beli', ['id' => $produk->id]) }}" class="btn bg-orange btn-block">Beli</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
