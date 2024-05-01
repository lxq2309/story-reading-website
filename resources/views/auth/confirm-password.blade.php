@extends('layout.client')
@section('template_title')
    {{ __('Xác nhận mật khẩu') }}
@endsection
@section('content')
    <div class="container my-4">
        <div class="text-muted mb-4">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control mt-1 w-full" name="password" required
                       autocomplete="current-password">

                @error('password')
                <span class="text-danger mt-2 d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
@endsection
