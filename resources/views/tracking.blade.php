@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>TRACKING</h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group input-group-sm">
                        <input type="text" id="kode" name="kode" class="form-control" placeholder="masukkan kode tagihan">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat btn-kode"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <ul class="timeline">
                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
@endsection

@section('script')
    <script>
        $('document').ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('.alert').hide();
            $('.form-kirim').hide();

            $('.btn-kode').on('click', function() {
                var kode = $('#kode').val();
                $.ajax({
                    url: '{{ URL::route('tracking.show', 'kode') }}',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        kode: kode
                    },
                    success: function(response) {
                        console.log(response);
                        $('.timeline').empty();

                        $.each(response.data, function(i, value){

                            var dataTimeline = "" +
                                "<li>" +
                                "    <i class=\"fa fa-truck bg-blue\"></i>" +
                                "    <div class=\"timeline-item\">" +
                                "        <div class=\"timeline-body\">" +
                                "            " + value.keterangan
                                "        </div>" +
                                "    </div>" +
                                "</li>" +
                            
                            $('.timeline').append(dataTimeline);
                        });
                    }
                });
            });
        });
    </script>
@endsection
