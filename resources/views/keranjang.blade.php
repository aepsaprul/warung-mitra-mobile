@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-12 list">
            
        </div>
        <div class="col-lg-12 col-xs-12">
            <a href="{{ route('order.index') }}" class="btn bg-orange btn-block"> Selanjutnya <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('script')
<script>
    $('document').ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        tampil_keranjang();

        function rupiah(bilangan) {
            var bilangan = bilangan;
                
            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
        
        function tampil_keranjang() {
            $.ajax({
                url: '{{ URL::route('keranjang.data') }}',
                type: 'GET',
                success: function(response) {
                    $.each(response.data, function(i, value) {
                        var data = " " +
                            "<div class=\"box box-solid\">" +
                            "   <div class=\"box-body\">" +
                            "        <div class=\"col-xs-6\">" +
                            "            <img src=\"http://warung-mitra-admin.test/img/" + value.data_produk.gambar1 + "\" style=\"max-width: 100%;\" alt=\"image\">" +
                            "       </div>" +
                            "       <div class=\"col-xs-6\">" +
                            "           <p class=\"lead\">" +
                            "               " + value.data_produk.nama + "" +
                            "           </p>" +
                            "           <p class=\"lead\">" +
                            "               Jumlah: <input type=\"number\" id=\"quantity\" data-id=\"" + value.produk_id + "\" name=\"quantity\" class=\"form-control input-number\" value=\"" + value.qty + "\" min=\"1\" max=\"100\">" +
                            "           </p>" +
                            "           <p class=\"lead\">" +
                            "               Rp. " + rupiah(value.harga) + "" +
                            "           </p>" +
                            "           <p class=\"lead\">" +
                            "               <a href=\"{{ url('hapus_keranjang') }}/" + value.id + "\"><u>Hapus</u></a>" +
                            "           </p>" +
                            "       </div>" +
                            "   </div>" +
                            "</div>";
                        $('.list').append(data);
                    })
                }
            })
        }
        $('.list').on('change', '.input-number', function() {
            $('.list').empty();
            var produkId = $(this).attr('data-id');
            var valQty = $(this).val();

            $.ajax({
                url: '{{ URL::route('keranjang.tambah_data') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    id: produkId,
                    qty: valQty
                },
                success: function(response) {
                    tampil_keranjang();
                }
            });
        });
    });
</script>
@endsection
