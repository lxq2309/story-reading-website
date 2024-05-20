@extends('client.users.profile')
@section('template_title')
    {{ __('Danh sách dấu trang') }}
@endsection

@section('user_content')
    @php
        $isMyAccount = isMyAccount($currentUser, $user);
    @endphp
    <div class="col-xs-12" id="bookmarks">
        @if($message = session('bookmark_success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <section class="comics-followed comics-followed-nopaging user-table clearfix">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                        </th>
                        <th class="nowrap">Truyện</th>
                        <th class="nowrap">Chương mới nhất</th>
                        <th>Tên dấu trang</th>
                        <th class="nowrap">Mô tả về dấu trang</th>
                        <th>Ngày tạo</th>
                        <th>Ngày sửa</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if ($bookmarks->isEmpty())

                        <tr>
                            <td></td>
                            <td>Chưa có bookmark nào</td>
                        </tr>
                    @endif
                    @foreach ($bookmarks as $bookmark)
                        @if (!$bookmark->is_public && !$isMyAccount)
                            <tr>
                                <td colspan="7">Đây là bookmark riêng tư nên đã bị ẩn đi</td>
                            </tr>
                            @continue
                        @endif
                        @php
                            $article = $bookmark->article;
                        @endphp
                        <tr>
                            <td>
                                <a class="image" href="{{ route('articles.show', $article->id) }}">
                                    <img src="{{ $article->cover_image }}" class="lazy"
                                         data-original="{{ $article->cover_image }}" alt="{{ $article->title }}">
                                </a>
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name"
                                   href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                                @if ($isMyAccount)
                                    <div class="follow-action">
                                        <form
                                            action="{{ route('articles.bookmarks.destroy', [$article->id, $bookmark->id]) }}"
                                            method="post">
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
                            <td class="chapter">
                                @php
                                    $newestChapter = $article->newest_chapter;
                                    $isEmptyNewestChapter = empty($newestChapter);
                                @endphp
                                @if ($isEmptyNewestChapter)
                                    <a href="#">Chưa có chương nào</a>
                                @else
                                    <a href="{{ route('articles.chapters.show', [$article->id, $newestChapter->number]) }}"
                                       title="{{ $newestChapter->title }}">{{ $newestChapter->number_text }}</a>
                                    <br>
                                    <time class="time"
                                          title="{{ $newestChapter->updated_at }}">
                                        {{ $newestChapter->updated_at_text }}
                                    </time>
                                @endif
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name">{{ $bookmark->name }}</a>
                            </td>
                            <td class="chapter">
                                <a class="comic-name">{{ $bookmark->description }}</a>
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name"
                                   title="{{ $bookmark->created_at }}">{{ $bookmark->created_at_text }}</a>
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name"
                                   title="{{ $bookmark->updated_at }}">{{ $bookmark->updated_at_text }}</a>
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
                    {{ $bookmarks->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
