@extends('layout.client')
@section('template_title')
    {{ __('Xác thực email') }}
@endsection
@section('content')
    <div class="container mt-4">
        <div class="text-secondary mb-4">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-success">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-secondary rounded-md">
                    {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
@endsection
