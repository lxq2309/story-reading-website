@extends('layout.admin')
@section('template_title')
    {{ __('Sửa thông tin ' . $chapter->title) }}
@endsection
@php
    $method = 'PATCH';
@endphp
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                @includeif('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __($article->title) }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.articles.show_chapters', $article->id) }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.articles.update_chapter', [$article->id, $chapter->id]) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field($method) }}
                            @csrf
                            @method($method)
                            @include('admin.chapters.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
