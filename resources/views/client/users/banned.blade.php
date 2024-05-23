@extends('layout.client')
@section('template_title')
    {{ __('Tài khoản của bạn đã bị cấm') }}
@endsection
@section('content')
    <div id="account-information">
        <div class="container mt-4">
            <div class="text-secondary" style="margin-bottom: 10px">
                {{ __('Tài khoản của bạn đã bị cấm, lệnh cấm sẽ hết hạn sau ' . $bannedUser->remaining_days . ' nữa.') }}
            </div>
            <div class="text-secondary" style="margin-bottom: 50px">
                {{ __('Lý do bị cấm: ' . $bannedUser->reason) }}
            </div>
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        {{ __('Đăng xuất') }}
            </button>
        </form>
    </div>
</div>
    </div>
@endsection
