<div class="title-list">
    <h2>Bình luận</h2>
</div>
<div class="tab">
    <ul class="nav nav-tabs main-tab lazy-module">
        <li class="tablinks active" data-tab="tab1">
            <a data-toggle="tab">
                <i class="fa fa-comments"></i> {{ config('app.name', 'Laravel') }} (<span class="comment-count">{{ $comments->count() }}</span>)
            </a>
        </li>
        <li class="tablinks" data-tab="tab2">
            <a data-toggle="tab">
                <i class="fa fa-facebook-official"></i> Facebook
            </a>
        </li>
    </ul>

    <div class="col-xs-12">
        <div id="bw_comments" class="tabcontent" data-tab="tab1">
            @if ($isUserLoggedIn)
                @if($currentUser->hasVerifiedEmail())
                    <div class="row">
                        @if($message = session('success'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        @if($errors->has('content'))
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                        <form action="{{ route('articles.comments.store', $article->id) }}" method="post"
                              id="commentForm">
                            @csrf
                            <div class="form-group">
                                <textarea id="commentContent" name="content" class="form-control"></textarea>
                            </div>
                            <button type="submit" id="submit-comment" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                @else
                    <div class="form-group">
                        <p style="margin-top: 20px">Vui lòng xác thực email để bình luận!</p>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <p style="margin-top: 20px">Vui đăng nhập để bình luận!</p>
                </div>
            @endif
            <div class="row" id="comment-list">
                @foreach($comments as $comment)
                    <div class="item clearfix" id="comment_{{ $comment->id }}">
                        @php
                            $commentUser = $comment->user;
                        @endphp
                        <figure class="avatar">
                            <img src="{{ $commentUser->avatar }}" class="lazy"
                                 data-original="{{ $commentUser->avatar }}" alt="{{ $commentUser->username }}">
                        </figure>
                        <div class="summary">
                            <i class="fa fa-angle-left fa-arrow">
                            </i>
                            <div class="info">
                                <div class="comment-header">
                                    <a href="{{ route('users.show', $commentUser->id) }}">
                                        <span class="authorname">{!! $commentUser->renderUserName() !!}</span>
                                    </a>
                                    <abbr title="{{ $comment->created_at }}">
                                        <i class="fa-regular fa-clock"></i> {{ $comment->created_at_text }}
                                    </abbr>
                                </div>
                                <div class="comment-content">{!! nl2br($comment->content) !!}</div>
                                @if(isMyAccount($currentUser, $commentUser))
                                    <form
                                        action="{{ route('articles.comments.destroy', [$article->id, $comment->id]) }}"
                                        method="post"
                                        style="border-top: 1px solid rgb(216, 216, 216); background-color: whitesmoke; margin-top: 10px;"
                                        class="formDeleteComment">
                                        @csrf
                                        @method('delete')
                                        <button id="btnDeleteComment" class="btn btn-link glyphicon glyphicon-trash"
                                                style="color: #ff0000;" title="Xoá bình luận"></button>
                                    </form>
                                @endif
                            </div>
                            <div id="comment_form_{{ $comment->id }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="container text-center pagination-container">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div id="comment-pagination">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div id="fb-comments" class="tabcontent" data-tab="tab2">
            <div class="fb-comments" data-href="{{ url()->route('articles.show', $article->id) }}" data-width=""
                 data-numposts="10"></div>
        </div>
    </div>
</div>

@section('comment-article-scripts')
    <script !src="">
        $(document).ready(function () {
            $('#commentForm #commentContent').keydown(function (e) {
                // Ngăn sự kiện "bubbling up"
                e.stopPropagation();

                // Kiểm tra tổ hợp phím Ctrl + Enter
                if (e.ctrlKey && e.keyCode === 13) {
                    $('#commentForm').submit();
                }
            });

            // Xử lý khi click nút xoá comment
            $('.formDeleteComment').each(function (i, el) {
                $(el).find('#btnDeleteComment').on('click', function (event) {
                    event.preventDefault();
                    if (confirm("Bạn có chắc chắn muốn xoá bình luận này không?")) {
                        $(el).submit();
                    }
                });
            });

            // Ẩn tất cả các nội dung tabcontent
            $('.tabcontent').hide();
            $('.tablinks').removeClass('active');
            // Hiển thị nội dung của tab đầu tiên
            $('.tabcontent[data-tab="tab1"]').show();
            $('.tablinks[data-tab="tab1"]').addClass('active');

            // Xử lý khi click vào các tablink
            $('.tablinks').click(function () {
                // Ẩn tất cả các nội dung tabcontent
                $('.tabcontent').hide();
                $('.tablinks').removeClass('active');

                // Lấy giá trị của data-tab của tablink được click
                var tabId = $(this).data('tab');

                // Hiển thị nội dung tabcontent tương ứng
                $('.tabcontent[data-tab="' + tabId + '"]').show();
                $('.tablinks[data-tab="' + tabId + '"]').addClass('active');
            });
        });
    </script>
@endsection
