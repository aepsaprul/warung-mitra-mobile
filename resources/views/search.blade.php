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
        margin: 2px;
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
        font-size: 10px;
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
                            @if ($produk->data_ulasan->isNotEmpty())
                                <p>
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
                                </p>                                    
                                @else
                                <p class="lead" style="height: 40px;"></p>
                            @endif
                            <p class="lead" style="height: 20px;">
                                <small><b>Rp. {{ rupiah($produk->harga) }}</b></small>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{ $produks->links() }}
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
