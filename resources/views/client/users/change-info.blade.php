@extends('client.users.profile')
@section('template_title')
    {{ __('Chỉnh sửa thông tin') }}
@endsection

@section('user_content')
    <div id="changeInfoResult">
        <form action="{{ route('users.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="user-page clearfix">
                <h1 class="postname">
                    Thông tin tài khoản
                </h1>
                <div class="account-info clearfix">
                    <h2 class="posttitle">Cập nhật thông tin tài khoản</h2>
                    <div class="account-form clearfix">
                        <div class="row">
                            <div class="col-md-9 col-sm-8">
                                @if($message = session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="username" class="control-label">UserName</label>
                                    <input value="{{ old('username', $user->username) }}" name="username" id="username" type="text"
                                           class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input value="{{ old('email', $user->email) }}" name="email" id="email" type="email"
                                           class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Tên đầy đủ</label>
                                    <input value="{{ old('name', $user->name) }}" name="name" id="name" type="text"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="control-label">Giới tính</label>
                                    <select name="gender" id="gender">
                                        @foreach(\App\Enums\Gender::cases() as $gender)
                                            <option value="{{ $gender->value }}"
                                                    class="form-control" {{ $user->gender == $gender->value ? 'selected' : '' }}>{{ $gender->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth" class="control-label">Ngày sinh</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input value="{{ $user->date_of_birth_text }}" type="date" name="date_of_birth"
                                               id="date_of_birth" class="form-control">
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="control-label">Địa chỉ</label>
                                    <input value="{{ $user->address }}" name="address" id="address" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="avatar" class="control-label">Avatar</label>
                                    <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*"/>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="control-label">Giới thiệu</label>
                                    <textarea name="description" id="description" rows="5" class="form-control">{{ $user->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
