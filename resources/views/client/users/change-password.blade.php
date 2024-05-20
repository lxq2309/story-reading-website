@extends('client.users.profile')
@section('template_title')
    {{ __('Thay đổi mật khẩu') }}
@endsection
@section('user_content')
    <div class="col-md-9 col-sm-8">
        <div id="pnlPassword" class="user-page clearfix">
            <h1 class="postname">
                Đổi mật khẩu
            </h1>
            <div class="row">
                <div class="col-sm-9">
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        @method('put')
                        @if($message = session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="current_password">Mật khẩu hiện tại</label>
                            <input value="{{ old('current_password') }}" name="current_password" id="current_password" type="password" class="form-control"/>
                            @if ($errors->has('current_password'))
                                <span class="text-danger">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu mới</label>
                            <input value="{{ old('password') }}" name="password" id="password" type="password" class="form-control"/>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control"/>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
