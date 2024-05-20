@extends('client.users.profile')
@section('template_title')
    {{ __('Danh sách dấu trang') }}
@endsection

@section('user_content')
    <div class="col-xs-12" id="comments">
        @if($message = session('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <section class="user-table clearfix">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="nowrap">Tên truyện</th>
                        <th class="nowrap">Thời gian bình luận</th>
                        <th class="nowrap">Nội dung</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($comments->isEmpty())
                        <tr>
                            <td></td>
                            <td>Chưa có comment nào</td>
                        </tr>
                    @endif
                    @foreach ($comments as $comment)
                        @php
                            $commentUser = $comment->user;
                            $article = $comment->article;
                        @endphp
                        <tr>
                            <td>
                                <a class="image" href="{{ route('articles.show', $article->id) }}">
                                    <img src="{{ $article->cover_image }}" class="lazy"
                                         data-original="{{ $article->cover_image }}" alt="{{ $article->title }}">
                                </a>
                            </td>
                            <td>
                                <a class="comic-name"
                                   href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                                @if (isMyAccount($currentUser, $commentUser))
                                    <div class="follow-action">
                                        <form action="{{ route('articles.comments.destroy', [$comment->article_id, $comment->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-link follow-link">
                                                <i class="fa fa-times">
                                                </i> Xoá
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td class="nowrap chapter">
                                <time class="time" title="{{ $comment->created_at }}">{{ $comment->created_at_text }}</time>
                            </td>
                            <td class="nowrap chapter">
                                <time class="time">{!! nl2br($comment->content) !!}</time>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <div class="container text-center pagination-container">
            <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                <div class="pagination">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
