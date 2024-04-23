@extends('layout.admin')
@section('template_title')
    {{ __('Sửa vai trò của tài khoản ' . $user->username) }}
@endsection
@php
    $method = 'PATCH';
@endphp
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                @includeif('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Sửa vai trò') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.update_role', $user->id) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field($method) }}
                            @csrf
                            @method($method)
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group required">
                                        <label for="username">Tên tài khoản</label>
                                        <input type="text" name="username" id="username"
                                               value="{{ old('username', $user->username) }}"
                                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                               disabled>
                                        @if ($errors->has('username'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Vai trò</label>
                                        <select name="role" id="role" class="custom-select form-control">
                                            @foreach(\App\Enums\UserRole::cases() as $role)
                                                <option
                                                    value="{{ $role->value }}" {{ old('role', $user->role) == $role->value ? 'selected' : '' }}>
                                                    {{ $role->label() }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
