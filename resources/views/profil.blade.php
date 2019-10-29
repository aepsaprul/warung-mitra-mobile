@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning col-md-12">
                <div class="box-header">
                    <h3 class="text-center">PROFIL</h3>
                </div>
                <div class="box-body">
                    <p class="lead">Nama <span class="pull-right">{{ $profil->nama }}</span></p>
                    <p class="lead">Email <span class="pull-right">{{ $profil->email }}</span></p>
                    <p class="lead">Jenis Kelamin <span class="pull-right">{{ $profil->jenkel == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span></p>
                    <p class="lead">Alamat <span class="pull-right">{{ $profil->alamat }}</span></p>
                    <p class="lead">Nomor HP <span class="pull-right">{{ $profil->nomor_hp }}</span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
