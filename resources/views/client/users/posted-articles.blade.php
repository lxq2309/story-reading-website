@extends('client.users.profile')
@section('template_title')
    {{ __('Danh sách các truyện đã đăng') }}
@endsection
@section('user_content')
    <div class="col-xs-12">
        <section class="user-table clearfix">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="nowrap">Danh sách bài viết đã đăng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($articles->isEmpty())
                        <tr>
                            <td></td>
                            <td>Chưa có bài viết nào</td>
                        </tr>
                    @endif
                    @foreach ($articles as $article)
                        <tr>
                            <td>
                                <a class="image" href="{{ route('articles.show', $article->id) }}">
                                    <img src="{{ $article->cover_image }}" class="lazy"
                                         data-original="{{ $article->cover_image }}"
                                         alt="{{ $article->title }}">
                                </a>
                            </td>
                            <td>
                                <a class="comic-name"
                                   href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                                <div class="follow-action">
                                    <time class="time" title="{{ $article->updated_at }}"><i class="fa-solid fa-calendar"></i> {{ $article->updated_at_text }}
                                    </time>
                                </div>
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
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
