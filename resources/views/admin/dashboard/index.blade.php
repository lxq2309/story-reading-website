@extends('layout.admin')
@section('template_title')
    {{ __('Trang tổng quan') }}
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $articleCount }}</h3>

                    <p>Truyện</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-book"></i>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $authorCount }}</h3>

                    <p>Tác giả</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-people"></i>
                </div>
                <a href="{{ route('admin.authors.index') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $genreCount }}</h3>

                    <p>Thể loại</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ route('admin.genres.index') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>

                    <p>Tài khoản</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-printer"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    </div>
    <!-- /.row (main row) -->
@endsection
