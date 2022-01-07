@extends('shoppingPageLayout')
@section('content')

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Login / Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Login/Register</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="{{ url('customerRegisterPage') }}">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
                    <form class="" method="POST" action="{{ route('login') }}">
                        @csrf
					<div class="login_form_inner">
                        <br><br><br>
						<h3>Log in to enter</h3>
						<form class="row login_form" action="#/" id="contactForm" >
							<div class="col-md-12 form-group">
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'"required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required autocomplete="current-password">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">{{ __('Login') }}</button>
								<a href="#">Forgot Password?</a>
							</div>
                            <br><br><br><br><br><br><br>
						</form>
					</div>
                </form>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

@endsection
