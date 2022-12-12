@extends('layouts.app')

@section('content')
<!-- AUTHENTICATION SECTION -->
<div class="signup-form">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- CARD OVERLAY -->
        <div class="card bg-dark text-white">
            <img src="{{ asset('images/non-monster-images/temple-of-the-six.jpg') }}" class="card-img" alt="authentication-image">
            <div class="card-img-overlay d-flex flex-column justify-content-center">
                <h2>{{ __('Register') }}</h2>
                <p class="hint-text">Create your account to open more features.</p>

                <!-- Username -->
                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('Username') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   	
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email">

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
                    <button type="submit" class="btn btn-success btn-lg btn-block">{{ __('Register Now') }}</button>
                </div>
            </div>
        </div>  
    </form>
    <div class="text-center">Already have an account? <a href="{{ route('login') }}">Login</a></div>
</div>
@endsection
