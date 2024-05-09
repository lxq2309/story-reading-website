@extends('layout.client')

@section('template_title')
    {{ __( 'Trang chủ' ) }}
@endsection

@section('content')
    <div class="container" id="intro-index">
        <div class="title-list">
            <h2><a href="{{ route('home.show_hot_articles') }}" title="Đọc nhiều nhất">Được đọc nhiều nhất</a>
            </h2>
            <a href="{{ route('home.show_hot_articles') }}" title="Đọc nhiều nhất"><span
                        class="glyphicon glyphicon-fire"></span></a>
        </div>
        @php
            $i = 1;
        @endphp
        @foreach($hotArticles as $article)
            <div class="index-intro">
                <div class="item top-{{ $i }}" itemscope itemtype="https://schema.org/Book">
                    <a href="{{ route('articles.show', $article->id) }}" itemprop="url">
                        <!-- nếu đã hoàn thành thì hiện full-label -->
                        @if ($article->is_completed)
                            <span class="full-label"></span>
                        @endif
                        <img src="{{ $article->cover_image }}" width="129" height="192" alt="#"
                             class="img-responsive item-img"
                             itemprop="image"/>
                        <div class="title">
                            <h3 itemprop="name">
                                {{ $article->title }}
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    </div>


    <div class="container" id="list-index">
        <div id="novel-history-main" class="list list-truyen list-history col-xs-12 col-sm-12 col-md-8 col-truyen-main">
        </div>
        <div class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">
            <div class="title-list">
                <h2>
                    <a href="{{ route('home.show_new_update_articles') }}" title="Latest Release">
                        Mới cập nhật
                    </a>
                </h2>
                <a href="{{ route('home.show_new_update_articles') }}" title="Latest Release">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </div>

            @foreach ($newUpdateArticles as $article)
                <div class="row" itemscope="" itemtype="https://schema.org/Book">
                    <div class="col-xs-9 col-sm-6 col-md-5 col-title">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <h3 itemprop="name">
                            <a href="{{ route('articles.show', $article->id) }}" itemprop="url">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <span class="label-title label-new"></span>
                        @if ($article->is_completed)
                            <span class="label-title label-full"></span>
                        @endif
                    </div>
                    <div class="hidden-xs col-sm-3 col-md-3 col-cat text-888">
                        @foreach ($article->genres as $genre)
                            <a itemprop="genre" href="{{ route('genres.show', $genre->id) }}" title="{{ $genre->name }}">{{ $genre->name }}</a>,
                        @endforeach
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-2 col-chap text-info">
                        @if ($article->chapters->isEmpty())
                            <span class="chapter-text">
                            Chưa có chương nào
                        </span>
                        @else
                            @php
                                $newestChapter = $article->newest_chapter;
                            @endphp
                            <a title="{{ $newestChapter->title }}"
                               href="{{ route('articles.chapters.show', [$article->id, $newestChapter->number]) }}">
                            <span class="chapter-text">
                                {{ $newestChapter->number_text }}
                            </span>
                            </a>
                        @endif
                    </div>
                    <div class="hidden-xs hidden-sm col-md-2 col-time text-888">
                        {{ $article->updated_at_text }}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="visible-md-block visible-lg-block col-md-4 text-center col-truyen-side">
            @include('client.partials.right-sidebar')
        </div>
    </div>

    <div class="container" id="truyen-slide">
        <div class="list list-thumbnail col-xs-12">
            <div class="title-list">
                <h2>
                    <a href="{{ route('home.show_completed_articles') }}" title="Truyện đã hoàn thành">
                        Đã hoàn thành
                    </a>
                </h2>
                <a href="{{ route('home.show_completed_articles') }}" title="Truyện đã hoàn thành">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </div>
            <div class="row">
                @foreach($completedArticles as $article)
                    <div class="col-xs-4 col-sm-3 col-md-2">
                        <a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title }}">
                            <img src="{{ $article->cover_image }}" width="164" height="245" alt="#"/>
                            <div class="caption">
                                <h3>
                                    {{ $article->title }}
                                </h3>
                                <small class="btn-xs label-primary">
                                    Full - {{ $article->chapters->count() }} chương
                                </small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
