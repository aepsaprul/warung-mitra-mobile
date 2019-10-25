@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        @foreach ($produks as $produk) 
                <div class="col-lg-3 col-xs-6">
                    <a href="google"> 
                        <!-- small box -->
                        <div class="small-box" style="background-color: #fff;">
                            <div class="inner" style="height: 200px;">                    
                                <img src="http://warung-mitra-admin.test/img/{{ $produk->gambar1 }}" style="max-width: 100%;" alt="Logo Image">
                            </div>
                            <div class="small-box-footer bg-orange">
                                <div style="height: 30px;">
                                    <small>{{ substr($produk->nama, 0, 20) }}...</small>
                                </div>
                                <div style="height: 20px;">
                                    <small>Rp. {{ rupiah($produk->harga) }}</small></small>
                                </div>
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
