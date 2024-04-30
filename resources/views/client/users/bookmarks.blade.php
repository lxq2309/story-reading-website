@extends('client.users.profile')
@section('template_title')
    {{ __('Danh sách dấu trang') }}
@endsection

@section('user_content')
    @php
        $isMyAccount = isMyAccount($currentUser, $user);
    @endphp
    <div class="col-xs-12" id="bookmarks">
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
                                        <a href="javascript:void(0)" class="follow-link"
                                           data-bookmark-id="@bookmark.BookmarkId">
                                            <i class="fa fa-times">
                                            </i> Xoá
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td class="chapter">
                                @php
                                    $newestChapter = $article->newest_chapter;
                                @endphp
                                @if (empty($newestChapter))
                                    <a href="#">Chưa có chương nào</a>
                                @else
                                    <a href="{{ route('articles.chapters.show', [$article->id, $newestChapter->number]) }}"
                                       title="{{ $newestChapter->title }}">{{ $newestChapter->number_text }}</a>
                                @endif
                                <br>
                                <time class="time">{{ $newestChapter->updated_at }}</time>
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name">{{ $bookmark->name }}</a>
                            </td>
                            <td class="chapter">
                                <a class="comic-name">{{ $bookmark->description }}</a>
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name">{{ $bookmark->created_at }}</a>
                            </td>
                            <td class="nowrap chapter">
                                <a class="comic-name">{{ $bookmark->updated_at }}</a>
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
