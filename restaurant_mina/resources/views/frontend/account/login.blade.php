@extends('frontend.layouts.master')
@section('page_name','Mina admin login')
@section('page_specific_css')
<link href="{{asset('/front-assets/css/login.css')}}" type="text/css" rel="stylesheet"/>
@endsection
@section('content')
<section id="__mina_login_form">
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="__login_form_wrapper">
					<div class="__login_details">
						<h5>{{ __('Mina Admin Login') }}</h5>
						<form action="{{route('login')}}" method="POST" name="mina_login_form">
							@csrf
							<div class="form-group">
								<label for="username">{{__('Username')}}*</label>
								<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="username" placeholder="Email or username" value="{{ old('email') }}" required autocomplete="email" autofocus 	/>
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label for="password">{{ __('Password')}}*</label>
								<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="current-password">
							</div>
							<div class="form-group">
								<button type="submit" value="Login" class="btn btn--place--order btn--primary">{{ __('Login') }}</button>
							</div>
							<div class="form-group">
								@if (Route::has('password.request'))
									<a href="{{ route('password.request') }}">{{__('Forgot Password?') }}</a>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('page_specific_js')
@endsection