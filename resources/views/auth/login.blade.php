@extends('layouts.app')

@section('content')
<!-- AUTHENTICATION SECTION -->
<div class="signup-form">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- CARD OVERLAY -->
        <div class="card bg-dark text-white">
            <img src="{{ asset('images/non-monster-images/temple-of-the-six.jpg') }}" class="card-img" alt="authentication-image">
            <div class="card-img-overlay d-flex flex-column justify-content-center">
                <h2>{{ __('Login') }}</h2>
                <p class="hint-text">Login your account. Be active in our Community.</p>

                <!-- EMAIL -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- REMEMBER ME -->
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label">&nbsp;&nbsp;{{ __('Remember Me') }}</label>
                </div>

                <!-- RESET PASSWORD -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">{{ __('Login') }}</button>

                    @if (Route::has('password.request'))
                        <a class="text-white" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </div>
        </div> 

    </form>
</div>
@endsection
