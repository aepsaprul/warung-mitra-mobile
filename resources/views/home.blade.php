@extends('layouts.app')

@section('style')
<!-- Owl Carousel Assets -->
<link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ asset('css/owl.theme.css') }}" rel="stylesheet">

<style>
    #owl-demo .item{
        background: #42bdc2;
        padding: 30px 0px;
        margin: 5px;
        color: #FFF;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
    }
    #owl-demo2 .item{
        background: #42bdc2;
        padding: 30px 0px;
        margin: 5px;
        color: #FFF;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
    }
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
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($sliders as $slider)
                            <div class="item {{ $slider->link }}">
                                <img src="http://localhost/warung-mitra/public/img/{{ $slider->gambar }}">
                            </div>                                
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                    </a>
                </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Produk Kebutuhan Pokok Terbaru</h3>
                </div>
                <div class="box-body">
                    <div id="demo">
                        <div id="owl-demo" class="owl-carousel">            
                            @foreach ($kebutuhanPokoks as $kebutuhanPokok) 
                            <div class="item" style="background-color: white; height: 320px;">
                                <a href="{{ route('detail_produk', ['id' => $kebutuhanPokok->id]) }}">
                                    <div class="col-md-3 col-sm-6">
                                        <figure class="card card-product">
                                            <div class="img-wrap" style="height: 180px;"> 
                                                <img src="http://localhost/warung-mitra/public/img/{{ $kebutuhanPokok->gambar1 }}" style="max-width: 100%;">
                                            </div>
                                            <figcaption class="info-wrap" style="height: 15px;">
                                                <a href="{{ route('detail_produk', ['id' => $kebutuhanPokok->id]) }}" class="title" style="font-size: 11px;">{{ substr($kebutuhanPokok->nama, 0, 30) }}</a>
                                            </figcaption>
                                            @if ($kebutuhanPokok->data_ulasan->isNotEmpty())
                                                <p>
                                                    @php
                                                        $jml_star = 0;
                                                    @endphp
                                                    @foreach ($kebutuhanPokok->data_ulasan as $item)
                                                        @php
                                                            $jml_star = $jml_star + $item->star;
                                                        @endphp
                                                    @endforeach
                                                    @php
                                                        $jml_ulasan = count($kebutuhanPokok->data_ulasan);
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
                                                <p>
                                                    <div class="box-body" style="visibility: hidden;">
                                                        <form id='rating' class="rating">  
                                                            <input type="radio" class="rate" id="star1" name="rating" value="1" disabled/>
                                                            <label for="star1" title="Buruk - 1 Bintang"></label>                                
                                                        </form>
                                                    </div>
                                                </p>
                                            @endif
                                            <b style="color: #000;">Rp. {{ rupiah($kebutuhanPokok->harga) }}</b>
                                        </figure> <!-- card // -->
                                    </div> <!-- col // -->
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Produk Barang Paketan Terbaru</h3>
                    </div>
                    <div class="box-body">
                        <div id="demo2">
                            <div id="owl-demo2" class="owl-carousel">            
                                @foreach ($barangPaketans as $barangPaketan) 
                                <div class="item" style="background-color: white; height: 320px;">
                                    <a href="{{ route('detail_produk', ['id' => $barangPaketan->id]) }}">
                                        <div class="col-md-3 col-sm-6">
                                            <figure class="card card-product">
                                                <div class="img-wrap" style="height: 180px;"> 
                                                    <img src="http://localhost/warung-mitra/public/img/{{ $barangPaketan->gambar1 }}" style="max-width: 100%;">
                                                </div>
                                                <figcaption class="info-wrap" style="height: 15px;">
                                                    <a href="{{ route('detail_produk', ['id' => $barangPaketan->id]) }}" class="title" style="font-size: 11px;">{{ substr($barangPaketan->nama, 0, 30) }}</a>
                                                </figcaption>
                                                @if ($barangPaketan->data_ulasan->isNotEmpty())
                                                    <p>
                                                        @php
                                                            $jml_star = 0;
                                                        @endphp
                                                        @foreach ($barangPaketan->data_ulasan as $item)
                                                            @php
                                                                $jml_star = $jml_star + $item->star;
                                                            @endphp
                                                        @endforeach
                                                        @php
                                                            $jml_ulasan = count($barangPaketan->data_ulasan);
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
                                                    <p>
                                                        <div class="box-body" style="visibility: hidden;">
                                                            <form id='rating' class="rating">  
                                                                <input type="radio" class="rate" id="star1" name="rating" value="1" disabled/>
                                                                <label for="star1" title="Buruk - 1 Bintang"></label>                                
                                                            </form>
                                                        </div>
                                                    </p>
                                                @endif
                                                <b style="color: #000;">Rp. {{ rupiah($barangPaketan->harga) }}</b>
                                            </figure> <!-- card // -->
                                        </div> <!-- col // -->
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- /.content -->
@endsection

@section('script')
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script>
    $(document).ready(function() {

        var owl = $("#owl-demo");
        owl.owlCarousel({
        // Define custom and unlimited items depending from the width
        // If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled
        // For better preview, order the arrays by screen size, but it's not mandatory
        // Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available.
        // In the example there is dimension with 0 with which cover screens between 0 and 450px    
        itemsCustom : [
            [0, 2],
            [450, 4],
            [600, 7],
            [700, 9],
            [1000, 10],
            [1200, 12],
            [1400, 13],
            [1600, 15]
        ],
        navigation : true
        });
        var owl2 = $("#owl-demo2");
        owl2.owlCarousel({
        // Define custom and unlimited items depending from the width
        // If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled
        // For better preview, order the arrays by screen size, but it's not mandatory
        // Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available.
        // In the example there is dimension with 0 with which cover screens between 0 and 450px
        itemsCustom : [
            [0, 2],
            [450, 4],
            [600, 7],
            [700, 9],
            [1000, 10],
            [1200, 12],
            [1400, 13],
            [1600, 15]
        ],
        navigation : true
        });
    });
</script>
@endsection
