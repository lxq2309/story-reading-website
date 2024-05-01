@extends('layout.client')
@section('template_title')
    {{ __('Đăng nhập') }}
@endsection
@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div id="login-signup-form">
                    <div id="ctl00_mainContent_pnlStandardLogin">
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="user-page clearfix">
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email') }}" placeholder="example@email.com" required>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="remember" name="remember" value="true">
                                        <label for="remember">Ghi nhớ</label>
                                    </div>
                                    <div class="login-action">
                                        <div class="form-group">
                                            <a id="user-password-recovery" class="login-link" href="{{ route('password.request') }}">Quên
                                                mật khẩu</a>
                                            <a id="user-signup-link" class="login-link" href="{{ route('register') }}">Đăng ký mới</a>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Đăng nhập" id="user-login" tabindex="10"
                                                   class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="open-login mrb20">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <a class="btn login-facebook" href="/facebook-login">--}}
{{--                                            <i class="fa fa-brands fa-facebook-f"></i>--}}
{{--                                            <span>Đăng nhập bằng Facebook</span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <a class="btn login-google" href="/google-login">--}}
{{--                                            <i class="fa fa-sharp fa-solid fa-g"></i>--}}
{{--                                            <span>Đăng nhập bằng Google</span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
