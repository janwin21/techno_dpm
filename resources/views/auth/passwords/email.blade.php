@extends('layouts.app')

@section('content')
<!-- AUTHENTICATION SECTION -->
<div class="signup-form">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- CARD OVERLAY -->
        <div class="card bg-dark text-white">
            <img src="{{ asset('images/non-monster-images/temple-of-the-six.jpg') }}" class="card-img" alt="authentication-image">
            <div class="card-img-overlay d-flex flex-column justify-content-center">
                <h2>{{ __('Reset Password') }}</h2>
                <p class="hint-text">Place your email and re-verify for confirmation.</p>

                <!-- STATUS IS OK -->
                @if (session('status'))
                    <div class="alert alert-success p-2" role="alert" style="border-radius: 0;">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- EMAIL -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <!-- SUBMIT BUTTON -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">{{ __('Send Password Reset Link') }}</button>
                </div>
            </div>
        </div>  

    </form>
</div>
@endsection
