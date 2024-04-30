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
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               required>
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

@section('hide')
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                              required autofocus autocomplete="username"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>
@endsection
