@extends('layout.client')
@section('template_title')
    {{ __($article->title) }}
@endsection

@section('content')
    <div class="container csstransforms3d" id="truyen">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="col-xs-12 col-info-desc">
                <div class="title-list book-intro">
                    <h2>Thông tin truyện</h2>
                </div>
                <h3 class="title" itemprop="name">
                    {{ $article->title }}
                </h3>
                <div class="col-xs-12 col-sm-4 col-md-4 info-holder">
                    <div class="books">
                        <div class="book">
                            <img src="{{ $article->cover_image }}" alt="{{ $article->title }}"
                                 itemprop="image"/>
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            <h3><span class="glyphicon glyphicon-flag"></span>&nbsp;Tác giả:</h3>
                            @foreach ($article->authors as $author)
                                <a itemprop="author" href="{{ route('authors.show', $author->id) }}"
                                   title="{{ $author->name }}">{{ $author->name }}</a>,
                            @endforeach
                        </div>
                        <div>
                            @php
                                $user = $article->user;
                            @endphp
                            <h3><span class="glyphicon glyphicon-user"></span>&nbsp;Người đăng:</h3>
                            <a itemprop="username" href="{{ route('users.show_posted_articles', $user->id) }}"
                               title="{{ $user->username }}">{!! $user->renderUserName() !!}</a>
                        </div>
                        <div>
                            <h3><span class="glyphicon glyphicon-tag"></span>&nbsp;Thể loại:</h3>
                            @foreach($article->genres as $genre)
                                <a itemprop="genre" href="#" title="{{ $genre->name }}">{{ $genre->name }},</a>
                            @endforeach
                        </div>

                        <div>
                            <h3><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Lượt xem:</h3>
                            <a itemprop="view" title="{{ $article->view_text }}">{{ $article->view }}</a>
                        </div>

                        <div>
                            <h3><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Tình trạng:</h3>
                            @if ($article->is_completed)
                                <span class="label label-success">Hoàn thành</span>
                            @else
                                <span class="label label-info">Đang tiến hành</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 desc">
                    <div id="gioi-thieu-truyen" class="desc-text desc-text-full" itemprop="description">
                        {{ $article->description }}
                    </div>

                    <div class="showmore">
                        <a class="btn btn-default btn-xs hide" href="javascript:void(0)"
                           title="See more">Xem thêm »</a>
                    </div>

                    <div class="group-buttons">
                        @if(!$chapters->isEmpty())
                            <a href="{{ route('articles.chapters.show', [$article->id, $article->first_chapter->number]) }}"
                               class="btn btn-danger btn-style btn-border">
                                <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;ĐỌC TỪ ĐẦU
                            </a>
                        @endif
                        <a id="add-bookmark-btn" class="btn btn-info btn-border">
                            <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;BOOKMARK
                        </a>
                        @if($isUserLoggedIn && ($currentUser->is_admin || $currentUser->id === $user->id))
                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                               class="btn btn-success btn-border">
                                <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Sửa bài viết
                            </a>
                        @endif
                    </div>

                    @if(!$chapters->isEmpty())
                        <div class="l-chapter">
                            <div class="l-title">
                                <h3>Chương mới nhất</h3>
                            </div>
                            <ul class="l-chapters">
                                @foreach ($article->getNewestChapters(10)->get() as $chapter)
                                    <li>
                                        <span class="glyphicon glyphicon-certificate"></span>
                                        <a href="{{ route('articles.chapters.show', [$article->id, $chapter->number]) }}"
                                           title="{{ $chapter->title }}">
                                    <span class="chapter-text">
                                        {{ $chapter->number_text . ': ' . $chapter->title }}
                                    </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xs-12" id="list-chapter">
                <div id="danh-sach-chuong" class="title-list">
                    <h2>Danh sách chương</h2>
                </div>
                <div class="row">
                    @if(!$chapters->isEmpty())
                        @foreach(array_chunk($chapters->items(), 25) as $chunk)
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <ul class="list-chapter">
                                    @foreach($chunk as $chapter)
                                        <li>
                                            <span class="glyphicon glyphicon-certificate"></span>
                                            <a href="{{ route('articles.chapters.show', [$article->id, $chapter['number']]) }}"
                                               title="{{ $chapter['title'] }}">
                                    <span class="chapter-text">
                                        {{ $chapter['number_text'] . ': ' . $chapter['title'] }}
                                    </span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @endforeach
                    @else
                        <p>
                            Hiện truyện chưa có chương nào, bạn vui lòng đợi nhé ^^
                        </p>
                    @endif

                    <div id="pagination">
                        {{ $chapters->links() }}
                    </div>

                </div>
                <div id="comment" class="col-xs-12 comment-box">
                    @include('client.partials.comment')
                </div>
            </div>
        </div>
        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            @include('client.partials.right-sidebar')
        </div>
    </div>

    <!-- HTML code for the modal -->
    <div id="bookmark-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="bookmark-form">
                <input type="hidden" id="bookmarkId" name="bookmarkId" value="">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="bookmark-name" name="name" class="form-control" value="@article.Title"
                           required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="bookmark-description" name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="isPublic" name="isPublic">
                    <label for="isPublic">Public</label>
                </div>

                <input type="hidden" id="bookmark-articleId" name="articleId" value="@article.ArticleId" required>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
