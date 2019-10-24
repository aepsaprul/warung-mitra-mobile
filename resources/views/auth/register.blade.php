<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Warung Mitra</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('logreg/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('logreg/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('logreg/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
					@csrf
					<span class="login100-form-logo">
						<img src="{{ asset('logreg/images/logo.png') }}" alt="">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
                        Register <br>
                        <i style="font-size: 0.4em; color: black;">
                            @if ($errors->has('nama'))
                                {{ $errors->first('nama') }}
                            @endif
                            @if ($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                            @if ($errors->has('nomor_hp'))
                                {{ $errors->first('nomor_hp') }}
                            @endif
                            @if ($errors->has('jenkel'))
                                {{ 'jenis kelamin tidak boleh kosong' }}
                            @endif
                            @if ($errors->has('alamat'))
                                {{ $errors->first('alamat') }}
                            @endif
                            @if ($errors->has('username'))
                                {{ $errors->first('username') }}
                            @endif
                            @if ($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                            @if ($errors->has('setuju'))
                                {{ 'persetujuan belum di centang' }}
                            @endif
                        </i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter nama">
						<input class="input100" type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter nomor hp">
						<input class="input100" type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" placeholder="Nomor HP">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <label class="radio-inline"><input type="radio" name="jenkel" value="L"> <span style="color: white;"> Laki - Laki </span></label>
                    <label class="radio-inline"><input type="radio" name="jenkel" value="P"> <span style="color: white;"> Perempuan </span></label>
					<br><br>

					<div class="wrap-input100 validate-input" data-validate = "Enter alamat">
						<input class="input100" type="text" name="alamat" value="{{ old('alamat') }}" placeholder="alamat">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" value="{{ old('username') }}" placeholder="username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter password">
						<input class="input100" type="password" name="password" value="{{ old('password') }}" placeholder="password">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password confirm">
						<input class="input100" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirm">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="setuju" value="1">
						<label class="label-checkbox100" for="ckb1">
							Saya telah membaca dan menyetujui <a href="#" style="color: white; text-decoration-line: underline;">Aturan Penggunaan</a> dan <a href="#" style="color: white; text-decoration-line: underline;">Kebijakan Privasi</a> Warung Mitra
						</label>
					</div>
                    
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('logreg/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('logreg/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('logreg/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('logreg/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('logreg/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('logreg/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('logreg/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('logreg/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('logreg/js/main.js') }}"></script>

</body>
</html>
