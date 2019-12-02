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
    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: #f7d106;
    }
    .rating > input:checked + label:hover,
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label,
    .rating > input:checked ~ label:hover ~ label {
        color: #fce873;
    }
    #hasil {
        font-size: 40px;
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

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid col-md-12">
                <div class="box-header">
                    <h3 class="text-center">ULASAN</h3>
                </div>
                <div class="box-body text-center">
                    <img src="http://warung-mitra-admin.test/img/{{ $produk->gambar1 }}" style="max-width: 50%;" alt="image">
                    <input type="hidden" id="ulasan_id" value="{{ $ulasan->id }}">
                </div>
                <div class="box-body">
                    <div style="width: 140px; margin: auto;">
                        <form id='rating' class="rating">
                            <input type="radio" class="rate" id="star5" name="rating" value="5" />
                            <label for="star5" title="Sempurna - 5 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star4" name="rating" value="4" />
                            <label for="star4" title="Sangat Bagus - 4 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star3" name="rating" value="3" />
                            <label for="star3" title="Bagus - 3 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star2" name="rating" value="2" />
                            <label for="star2" title="Tidak Buruk - 2 Bintang"></label>
                    
                            <input type="radio" class="rate" id="star1" name="rating" value="1" />
                            <label for="star1" title="Buruk - 1 Bintang"></label>                        
                        </form>
                        <input type="hidden" id="data_star" class="data_star">
                    </div>
                </div>
                <div class="box-body">
                    <input type="text" id="komentar" class="form-control" style="border-top: none; border-left: none; border-right: none;" placeholder="komentar...">
                    <br>
                    <button class="btn btn-primary btn-block btn-ulasan">Submit</button>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Modal -->
    {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> --}}
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p>Terima kasih sudah bersedia memberikan ulasan pelayanan kami</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block btn-ulasan-ok">OK</button>
                </div>
            </div>            
        </div>
    </div>

</section>
@endsection

@section('script')
    <script>
        $('document').ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $("#rating .rate").click(function () {
                var data = $(this).val();
                $('#data_star').val(data);
            });

            $('.btn-ulasan').on('click', function() {
                var rate = $('#data_star').val();
                var komentar = $('#komentar').val();
                var ulasan_id = $('#ulasan_id').val();
                
                if (rate.length == 0) {
                    alert('Bintang belum diisi');
                } else if (komentar.length == 0) {
                    alert('Komentar belum diisi');
                } else {
                    $.ajax({
                        url: '{{ URL::route('ulasan.store') }}',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            rate: rate,
                            komentar: komentar,
                            ulasan_id: ulasan_id
                        },
                        success: function (response) {
                            console.log(response);
                            $('#myModal').modal();
                        }
                    });
                }
            });

            $('.btn-ulasan-ok').on('click', function() {
                window.location.href = "http://warung-mitra-mobile.test/";
            });
        });
    </script>
@endsection
