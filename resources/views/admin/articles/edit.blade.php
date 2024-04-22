@extends('layout.admin')
@section('template_title')
    {{ __('Sửa thông tin ' . $article->title) }}
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
                            <span class="card-title">{{ __('Sửa thông tin') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.articles.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field($method) }}
                            @csrf
                            @method($method)
                            @include('admin.articles.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
