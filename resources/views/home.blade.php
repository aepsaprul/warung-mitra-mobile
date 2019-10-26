@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        @foreach ($produks as $produk) 
            <div class="col-lg-3 col-xs-6">
                <a href="{{ route('detail_produk', ['id' => $produk->id]) }}"> 
                    <!-- small box -->
                    <div class="box box-solid" style="background-color: #fff;">
                        <div class="box-header with-border" style="height: 180px;">                    
                            <img src="http://warung-mitra-admin.test/img/{{ $produk->gambar1 }}" style="max-width: 100%;" alt="Logo Image">
                        </div>
                        <div class="box-body">
                            <p class="lead" style="height: 20px;">
                                <small>{{ substr($produk->nama, 0, 30) }}...</small>
                            </p>
                            <p class="lead" style="height: 20px;">
                                <small><b>Rp. {{ rupiah($produk->harga) }}</b></small>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
