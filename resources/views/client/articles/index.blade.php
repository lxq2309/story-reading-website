@extends('layout.client')
@section('template_title')
    {{ __($title) }}
@endsection

@section('content')
    <div class="container" id="list-page">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="text-center"></div>
            <div class="list list-truyen col-xs-12">
                <div class="title-list">
                    <h2>{{ __($title) }}</h2>
                </div>
                @foreach ($articles as $article)
                    <div class="row" itemscope itemtype="https://schema.org/Book">
                        <div class="col-xs-3">
                            <div><img src="{{ $article->cover_image }}" class="cover" alt="title"></div>
                        </div>
                        <div class="col-xs-7">
                            <div>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3 class="truyen-title" itemprop="name">
                                    <a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title }}"
                                       itemprop="url">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                @if ($article->is_completed)
                                    <span class="label-title label-full"></span>
                                @endif
                                @foreach ($article->authors as $author)
                                    <span class="author" itemprop="author">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        <a href="{{ route('authors.show', $author->id) }}" title="{{ $author->name }}"
                                           itemprop="author">
                                        {{ $author->name }}
                                    </a>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-2 text-info">
                            <div>
                                @if ($article->chapters->isEmpty())
                                    <span class="chapter-text">Chưa có chương nào</span>
                                @else
                                    @php
                                        $newestChapter = $article->newest_chapter;
                                    @endphp
                                    <a title="{{ $newestChapter->title }}"
                                       href="{{ route('articles.chapters.show', [$article->id, $newestChapter->number]) }}">
                                        <span class="chapter-text">{{ $newestChapter->number_text }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            @include('client.partials.right-sidebar')
        </div>
    </div>
    <div class="row category">
        <div class="container text-center pagination-container">
            <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
