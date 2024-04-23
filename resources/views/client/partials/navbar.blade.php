<div class="navbar-collapse collapse" itemscope itemtype="https://schema.org/WebSite">
    <meta itemprop="url" content="/"/>
    <ul class="control nav navbar-nav">
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-list"></span> Danh mục <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                @foreach ($links as $link)
                    <li><a href="{{ $link->link }}" title="{{ $link->name }}">{{ $link->name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="dropdown">
            @php
                $SIZE = 16;
            @endphp

            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-list"></span> Thể loại <span class="caret"></span>
            </a>
            <div class="dropdown-menu multi-column">
                <div class="row">
                    @foreach (array_chunk($genres->toArray(), $SIZE) as $chunk)
                        <div class="col-md-4">
                            <ul class="dropdown-menu">
                                @foreach ($chunk as $genre)
                                    <li><a href="{{ route('genres.show', $genre['id']) }}" title="{{ $genre['name'] }}">{{ $genre['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
        <li class="dropdown">
            @if (\Illuminate\Support\Facades\Auth::check() == false)
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> Tài khoản <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">

                    <li><a href="/login" title="Đăng nhập">Đăng nhập</a></li>
                    <li><a href="/register" title="Đăng ký">Đăng ký</a></li>
                </ul>
            @else
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> @Model.UserName <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    @if (session('role') == \App\Enums\UserRole::ADMIN)
                        <li><a href="{{ route('admin.dashboard') }}" title="Admin Panel"><i class="fa fa-cog"
                                                                                            aria-hidden="true"></i>
                                Admin
                                Panel</a></li>
                        <li><a href="{{ route('admin.articles.create') }}" title="Thêm bài viết"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>
                                Thêm bài viêt</a>
                        </li>
                        <li><a href="{{ route('admin.authors.create') }}" title="Thêm tác giả"><i class="fa fa-plus"
                                                                                                  aria-hidden="true"></i>
                                Thêm tác giả</a></li>
                        <li><a href="{{ route('admin.genres.create') }}" title="Thêm thể loại"><i class="fa fa-plus"
                                                                                                  aria-hidden="true"></i>
                                Thêm thể loại</a></li>
                        <li><a href="{{ route('admin.menus.create') }}" title="Thêm link"><i class="fa fa-plus"
                                                                                             aria-hidden="true"></i>
                                Thêm link</a></li>
                    @endif
                    <li><a href="/tai-khoan/" title="Thông tin tài khoản"><i class="fa fa-solid fa-circle-info"></i>
                            Thông tin tài khoản</a></li>
                    <li><a href="/tai-khoan/?query=bookmark" title="Bookmark"><i
                                class="fa fa-solid fa-bookmark"></i> Bookmark</a></li>
                    <li><a href="/tai-khoan/?query=posted_article" title="Bài viết đã đăng"><i
                                class="fa fa-list"></i> Bài viết đã đăng</a></li>
                    <li>
                        <form asp-controller="User" asp-action="Logout" method="post" id="logout">
                            <button type="submit"><i class="fa fa-sign-out"></i> Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            @endif
        </li>
    </ul>

    <form class="navbar-form navbar-right" role="search" action="{{ route('home.search') }}">
        <div class="input-group search-holder">
            <input aria-label="Keyword search" class="form-control" type="search" name="keyword"
                   placeholder="Tìm kiếm theo tên truyện" value="" itemprop="query-input" required/>
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit" aria-label="Search">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>
        <div class="list-group list-search-res hide"></div>
    </form>
</div>
