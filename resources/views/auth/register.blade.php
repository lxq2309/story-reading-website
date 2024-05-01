@extends('layout.client')
@section('template_title')
    {{ __('Đăng ký') }}
@endsection

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div id="login-signup-form">
                    <div id="ctl00_mainContent_pnlStandardLogin">
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="user-page clearfix">
                                    <div class="form-group">
                                        <label for="username">UserName</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                               value="{{ old('username') }}" required>
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email') }}" placeholder="example@email.com" required
                                               autocomplete="username">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               value="{{ old('password') }}" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Xác nhận mật khẩu</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" value="{{ old('password_confirmation') }}"
                                               required>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Họ và tên <small>(Tuỳ chọn)</small></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name') }}"
                                               required>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="login-action">
                                        <div class="form-group">
                                            <input type="submit" value="Đăng ký" id="user-login" tabindex="10"
                                                   class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
