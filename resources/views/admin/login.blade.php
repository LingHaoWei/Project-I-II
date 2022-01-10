<html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" integrity="sha384-7ynz3n3tAGNUYFZD3cWe5PDcE36xj85vyFkawcF6tIwxvIecqKvfwLiaFdizhPpN" crossorigin="anonymous">
<link href="{{ url('/css/admin.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

<body>
    <div class="limiter">
		<div class="container">
            <form class="" method="POST" action="{{ route('admin.auth') }}">
                @csrf
                @if(Session::get('error'))
        <div class="col-md-14">
             <div class="alert alert-danger">{{ Session::get('error') }}</div>
        </div>
        @endif
			<div class="log">
				<form class="form">
					<span class="form-logo">
						<i class="fa fa-user"></i>
					</span>
                    <br>
					<span class="form-title">
						Admin Log In
					</span><br>

					<div class="navbar">
                        <span class="">Email</span>
						<input id="email" type="email" class="admin @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="admin@gmail.com">
						@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <span class="line"></span>
					</div>

					<div class="navbar">
                        <span class="">Password</span>
						<input id="password" type="password" class="admin @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password123">
						@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <span class="line"></span>
					</div>

					<div class="login">
						<button class="btn1">
							{{ __('Login') }}
						</button>
					</div>

				</form>
			</div>
            </form>
		</div>
	</div>

</body>
</html>
