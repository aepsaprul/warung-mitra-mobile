@extends('layouts.app')

@section('style')
<style>
    form,label { 
        margin: 0; padding: 0; 
    }
    .rating {
        border: none;
        float: left;
    }
    .rating > input { display: none; }
    .rating > label::before {
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }
    .rating > label {
        color: #ddd;
        float: right;
    }
    .rating > input:checked ~ label,
    .rating:not(:checked),
    .rating:not(:checked) ~ label {
        color: #f7d106;
    }
    .rating > input:checked,
    .rating > input:checked,
    .rating > input:checked ~ label,
    .rating > input:checked ~ label {
        color: #fce873;
    }
    
    #hasil {
        font-size: 20px;
    }
    #star {
        float: left;
        padding-right: 20px;
    }
    #star span{
        padding: 3px;
        font-size: 20px;
    }
    .on { color:#f7d106 }
    .off { color:#ddd; }
</style>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="box box-solid" style="padding-bottom: 15px;">
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
                @if ($produk->data_ulasan->isNotEmpty())
                    @php
                        $jml_star = 0;
                    @endphp
                    @foreach ($produk->data_ulasan as $item)
                        @php
                            $jml_star = $jml_star + $item->star;
                        @endphp
                    @endforeach
                    @php
                        $jml_ulasan = count($produk->data_ulasan);
                        $hitung_rate = ceil($jml_star/$jml_ulasan);
                    @endphp
                    <div class="box-body">
                        <form id='rating' class="rating">

                            <input type="radio" class="rate" id="star5" name="rating" value="5" 
                                @if ($hitung_rate == 5)
                                    checked
                                @endif disabled />
                            <label for="star5" title="Sempurna - 5 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star4" name="rating" value="4" 
                                @if ($hitung_rate == 4)
                                    checked
                                @endif disabled/>
                            <label for="star4" title="Sangat Bagus - 4 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star3" name="rating" value="3" 
                                @if ($hitung_rate == 3)
                                    checked
                                @endif disabled/>
                            <label for="star3" title="Bagus - 3 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star2" name="rating" value="2" 
                                @if ($hitung_rate == 2)
                                    checked
                                @endif disabled/>
                            <label for="star2" title="Tidak Buruk - 2 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star1" name="rating" value="1" 
                                @if ($hitung_rate == 1)
                                    checked
                                @endif disabled/>
                            <label for="star1" title="Buruk - 1 Bintang"></label>
                    
                        </form>
                    </div>
                @endif
                <div class="box-body">
                    <div class="col-xs-12">
                        <h4>Deskripsi</h4>
                        <p class="lead">
                            {!! $produk->deskripsi !!}
                        </p>
                    </div>
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

            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-xs-12">
                        <h4 class="text-center"><strong>ULASAN</strong></h4>
                    </div>
                </div>
                <div class="box-body">
                    @foreach ($produk->data_ulasan as $ulasan)                        
                        <div class="box-footer box-comments">
                            <div class="box-comment">            
                                <div class="comment-text" style="margin-left: 0;">
                                    <span class="username">
                                        {{ $ulasan->data_customer->username}}
                                        <span class="text-muted pull-right">{{ $ulasan->created_at }}</span>
                                    </span>
                                    <span class="username">
                                        <form id='rating' class="rating">

                                            <input type="radio" class="rate" id="star5" name="rating" value="5"
                                            @if ($ulasan->star == 5)
                                                checked
                                            @endif disabled/>
                                            <label for="star5" title="Sempurna - 5 Bintang"></label>
                                    
                                            <input type="radio" class="rate" id="star4" name="rating" value="4" 
                                            @if ($ulasan->star == 4)
                                                checked
                                            @endif disabled/>
                                            <label for="star4" title="Sangat Bagus - 4 Bintang"></label>
                                    
                                            <input type="radio" class="rate" id="star3" name="rating" value="3"
                                            @if ($ulasan->star == 3)
                                                checked
                                            @endif disabled/>
                                            <label for="star3" title="Bagus - 3 Bintang"></label>
                                    
                                            <input type="radio" class="rate" id="star2" name="rating" value="2"
                                            @if ($ulasan->star == 2)
                                                checked
                                            @endif disabled/>
                                            <label for="star2" title="Tidak Buruk - 2 Bintang"></label>
                                    
                                            <input type="radio" class="rate" id="star1" name="rating" value="1"
                                            @if ($ulasan->star == 1)
                                                checked
                                            @endif disabled/>
                                            <label for="star1" title="Buruk - 1 Bintang"></label>
                                    
                                        </form>
                                    </span>
                                    <br><br>
                                    {{ $ulasan->komentar }}
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
