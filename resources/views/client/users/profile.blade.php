@extends('layout.client')
@section('content')
    <div id="account-information">
        <div class="container">
            <div class="row">
                <div id="ctl00_divCenter" class="col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <section class="user-sidebar clearfix">
                                <div class="userinfo clearfix">
                                    <figure>
                                        <img alt="{{ $user->username }}" src="{{ $user->avatar }}"
                                             class="avatar user-img">
                                        <figcaption>
                                            <div class="title">Tài khoản của</div>
                                            <div class="user-name">
                                                {{ $user->username }}
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </section>
                            <nav class="user-sidelink clearfix">
                                <ul id="user-sidebar">
                                    <li class="hvr-sweep-to-right {{ set_active('users.show') }}">
                                        <a href="{{ route('users.show', $user->id) }}"><i class="fa fa-tachometer"></i>
                                            Thông tin chung</a>
                                    </li>
                                    @if (isMyAccount($currentUser, $user))
                                        <li class="hvr-sweep-to-right {{ set_active('users.change_info') }}">
                                            <a href="{{ route('users.change_info') }}"><i class="fa fas fa-edit"></i>
                                                Chỉnh sửa thông tin</a>
                                        </li>
                                    @endif
                                    <li class="hvr-sweep-to-right {{ set_active('users.show_bookmarks') }}"><a href="{{ route('users.show_bookmarks', $user->id) }}"><i class="fa fa-solid fa-bookmark"></i>
                                            Bookmark</a></li>
                                    <li class="hvr-sweep-to-right {{ set_active('users.show_posted_articles') }}"><a
                                            href="{{ route('users.show_posted_articles', $user->id) }}"><i
                                                class="fa fa-list"></i> Bài viết đã
                                            đăng</a></li>
                                    <li class="hvr-sweep-to-right {{ set_active('users.show_comments') }}"><a href="{{ route('users.show_comments', $user->id) }}"><i class="fa fa-comments"></i> Bình luận</a>
                                    </li>
                                    @if (isMyAccount($currentUser, $user))
                                        <li class="hvr-sweep-to-right {{ set_active('users.change_password') }}">
                                            <a href="{{ route('users.change_password') }}">
                                                <i
                                                    class="fa fa-lock"></i> Đổi mật khẩu
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-9 col-sm-8">
                            @yield('user_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
