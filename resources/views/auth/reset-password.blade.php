@extends('layout.client')
@section('template_title')
    {{ __('Đặt lại mật khẩu') }}
@endsection
@section('content')
    <div id="account-information">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-offset-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email', $request->email) }}" required autofocus
                                           autocomplete="username" readonly>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <!-- Password -->
                                <div class="form-group mt-3">
                                    <label for="password" class="form-label">{{ __('Mật khẩu mới') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" required
                                           autocomplete="new-password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group mt-3">
                                    <label for="password_confirmation"
                                           class="form-label">{{ __('Nhập lại mật khẩu') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Đặt lại mật khẩu') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
