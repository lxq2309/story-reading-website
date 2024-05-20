@extends('layout.client')
@section('template_title')
    {{ __($chapter->title) }}
@endsection
@section('content')
    <div id="chapter-big-container" class="container chapter">
        <div class="row">
            <div class="col-xs-12">
                <a class="truyen-title" href="{{ route('articles.show', $article->id) }}"
                   title="{{ $article->title }}">
                    {{ $article->title }}
                </a>
                <h2>
                    <a class="chapter-title"
                       href="{{ route('articles.chapters.show', [$article->id, $chapter->number]) }}"
                       title="{{ $chapter->title }}">
                    <span class="chapter-text">
                        <span>
                            {{ $chapter->number_text }}
                        </span>
                    </span>
                    </a>
                    @if($isUserLoggedIn && ($currentUser->is_admin || $currentUser->id === $user->id))
                        <a href="{{ route('admin.articles.edit_chapter', [$article->id, $chapter->id]) }}"
                           class="btn btn-block btn-primary btn-border" style="margin-top: 10px">
                            <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Sửa chương
                        </a>
                        <a href="{{ route('admin.articles.create_chapter', $article->id) }}"
                           class="btn btn-warning btn-border" style="margin-top: 10px">
                            <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Chương mới
                        </a>
                    @endif
                </h2>


                <hr class="chapter-start"/>
                <div class="chapter-nav" id="chapter-nav-top">
                    @include('client.partials.select-chapter')
                </div>

                <hr class="chapter-end"/>
                <div id="chapter-c" class="chapter-c">
                    {!! nl2br($chapter->content) !!}
                </div>

                <hr class="chapter-end" id="chapter-end-bot"/>
                <div class="chapter-nav" id="chapter-nav-bot">
                    @include('client.partials.select-chapter')
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" id="chapter_error">
                            <span class="glyphicon glyphicon-flag"></span> Báo lỗi chương
                        </button>

                        <button class="btn btn-info" data-toggle="collapse" data-target="#demo">
                            <span class="glyphicon glyphicon-comment"></span> Bình Luận
                        </button>
                    </div>
                </div>
                <div class="bg-info text-center visible-md visible-lg box-notice">
                    Tip: You can use left, right, A and D
                    keyboard keys to browse between chapters.
                </div>

                <div class="col-xs-12">
                    <div id="demo" class="collapse">
                        @include('client.partials.comment')
                    </div>
                    <div class="row" id="chapter_comment">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .related-box .realted-body.row img {
            width: 200px;
        }

        .related-box {
            background-color: #e6e6e6;
            padding: 10px;
        }


        .related-box .related-head-title {
            font-weight: bold;
            font-size: 16px;
        }

        .related-box .related-head {
            margin: 10px 0;
            text-align: left;
        }

        .related-box .title {
            padding: 5px 0;
        }

        .related-box .background-FFF {
            background: #fff;
        }

        .related-box .col-md-3.text-center {
            font-weight: bold;
        }

        @media screen and (max-width: 769px) {
            .related-box .realted-body.row img {
                width: 100%;
            }
        }

        #demo {
            text-align: left;
        }
    </style>


    <script>
        // Ẩn hiện menu chọn chapter
        $(document).ready(function () {
            $('select.chapter_jump').hide();
            $('button.chapter_jump').click(function () {
                $('button.chapter_jump').hide();
                $('select.chapter_jump').show();
            });
        });

        // Chuyển chapter bằng bàn phím
        $(document).keydown(function (event) {
            if (event.keyCode == 65 || event.keyCode == 37) { // A or Left arrow
                // Chuyển đến chương trước
                window.location.href = '{{ $chapter->previous?->number }}';
            } else if (event.keyCode == 68 || event.keyCode == 39) { // D or Right arrow
                // Chuyển đến chương sau

                window.location.href = '{{ $chapter->next?->number }}';
            }
        });
    </script>
@endsection
