<div class="title-list">
    <h2>Bình luận</h2>
</div>
<div class="tab">
    <ul class="nav nav-tabs main-tab lazy-module">
        <li class="tablinks active" data-tab="tab1">
            <a data-toggle="tab">
                <i class="fa fa-comments"></i> {{ config('app.name', 'Laravel') }} (<span class="comment-count"></span>)
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
                        <form id="comment-form">
                            <div class="form-group">
                                <textarea id="comment-content" name="content" class="form-control"></textarea>
                            </div>
                            <button id="submit-comment" class="btn btn-primary">Submit</button>
                            <div id="comment-success" class="alert alert-success mt-3" role="alert">
                                Gửi bình luận thành công !
                            </div>
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
            </div>
            <div class="container text-center pagination-container">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div id="comment-pagination"></div>
                </div>
            </div>
        </div>
        <div id="fb-comments" class="tabcontent" data-tab="tab2">
            <div class="fb-comments" data-href="https://lxq.id.vn" data-width="" data-numposts="10"></div>
        </div>
    </div>
</div>

@section('comment-article-scripts')
    <script !src="">
        $(document).ready(function () {
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
