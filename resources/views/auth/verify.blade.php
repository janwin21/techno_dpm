@extends('layouts.app')

@section('content')
<!-- AUTHENTICATION SECTION -->
<div class="signup-form">
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf

        <!-- CARD OVERLAY -->
        <div class="card bg-dark text-white">
            @if (session('resent'))
                <div class="alert alert-success" role="alert" style="border-radius: 0;">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <div class="form-group p-4 pb-2">
                <p>Before proceeding, please check your email for a verification link. If you did not receive the email, click the button below to request another.</p>
                <button type="submit" class="btn btn-success btn-lg btn-block">Request Again</button>
            </div>
        </div> 

    </form>
</div>
@endsection
