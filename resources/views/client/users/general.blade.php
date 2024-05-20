@extends('client.users.profile')
@section('template_title')
    {{ __('Tài khoản ' . $user->username) }}
@endsection
@section('user_content')
    <div class="user-page clearfix">
        <h1 class="postname">
            Thông tin chung
        </h1>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="account-info clearfix">
                    <h2 class="posttitle">
                        Thông tin tài khoản
                    </h2>
                    <div class="info-detail">
                        <div class="group">
                            <div class="label">Username</div>
                            <div class="detail">
                                {!! $user->renderUserName() !!}
                            </div>
                        </div>
                        <div class="group">
                            <div class="label">Họ và tên</div>
                            <div class="detail">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="group">
                            <div class="label">Email</div>
                            <div class="detail">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="group">
                            <div class="label">Giới tính</div>
                            <div class="detail">
                                {{ $user->gender_text }}
                            </div>
                        </div>

                        <div class="group">
                            <div class="label">Ngày sinh</div>
                            <div class="detail">
                                {{ $user->date_of_birth_text }}
                            </div>
                        </div>

                        @if (!empty($user->phone_number))
                            <div class="group">
                                <div class="label">Số điện thoại</div>
                                <div class="detail">
                                    {{ $user->phone_number }}
                                </div>
                            </div>
                        @endif

                        @if (!empty($user->address))
                            <div class="group">
                                <div class="label">Địa chỉ</div>
                                <div class="detail">
                                    {{ $user->address }}
                                </div>
                            </div>
                        @endif

                        <div class="group">
                            <div class="label">Vai trò</div>
                            <div class="detail">
                                {!! $user->renderRoleText() !!}
                            </div>
                        </div>

                        <div class="group">
                            <div class="label">Trạng thái</div>
                            <div class="detail">
                                {{ $user->verified_status_text }}
                            </div>
                        </div>

                        @if (!empty($user->description))
                            <div class="group">
                                <div class="label">Giới thiệu</div>
                                <div class="detail">
                                    {!! nl2br($user->description) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
