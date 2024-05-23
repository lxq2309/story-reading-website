@extends('layout.client')
@section('template_title')
    {{ __('Xác thực email') }}
@endsection
@section('content')
    <div id="account-information">
        <div class="container mt-4">
            <div class="text-secondary mb-4">
                {{ __('Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết chúng tôi vừa gửi qua email cho bạn không? Nếu bạn không nhận được email, chúng tôi sẵn lòng gửi cho bạn một email khác.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-success">
                    {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp trong quá trình đăng ký.') }}
                </div>
            @endif

            <div class="mt-4 d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('Gửi lại liên kết xác thực') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">
                        {{ __('Đăng xuất') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
