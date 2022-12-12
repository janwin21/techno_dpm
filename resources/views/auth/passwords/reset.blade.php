@extends('layouts.app')

@section('content')
<!-- AUTHENTICATION SECTION -->
<div class="signup-form">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <!-- CARD OVERLAY -->
        <div class="card bg-dark text-white">
            <img src="{{ asset('images/non-monster-images/temple-of-the-six.jpg') }}" class="card-img" alt="authentication-image">
            <div class="card-img-overlay d-flex flex-column justify-content-center">
                <h2>{{ __('Reset Your Password') }}</h2>
                <p class="hint-text">Reset your password before login. Try not to lose it again.</p>    

                <!-- Email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <!-- PASSWORD -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">{{ __('Reset Password') }}</button>
                </div>
            </div>
        </div>  
    </form>
</div>
@endsection
