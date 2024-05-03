@extends('layout.admin')

@section('template_title')
    {{ __('Danh sách truyện') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="create" style="margin-bottom: 10px">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary"
                           data-placement="left">
                            {{ __('Thêm truyện mới') }}
                        </a>
                    </div>

                    <div class="search">
                        <form id="searchForm" action="{{ route('admin.articles.index') }}" method="GET">
                            <input type="search" id="searchInput" class="form-control form-control-sm"
                                   placeholder="Tìm kiếm theo tên truyện" name="search">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = session('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table data-bs-spy="scroll"
                                       class="table table-responsive table-bordered table-striped dataTable dtr-inline table-hover"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên truyện</th>
                                        <th>Tác giả</th>
                                        <th>Thể loại</th>
                                        <th>Số chương đã đăng</th>
                                        <th>Mô tả</th>
                                        <th>Lượt xem</th>
                                        <th>Trạng thái hoàn thành</th>
                                        <th>Trạng thái duyệt</th>
                                        <th>Người tạo</th>
                                        <th>Thời gian tạo</th>
                                        <th>Thời gian cập nhật</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($articles as $article)
                                        <tr class="even">
                                            <td>{{ $article->id }}</td>
                                            <td>
                                                <img src="{{ $article->cover_image }}" alt="{{ $article->title }}"
                                                     width="100px">
                                            </td>
                                            <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                                            <td>
                                                @foreach($article->authors as $author)
                                                    <a href="{{ route('authors.show', $author->id) }}"
                                                       class="badge badge-primary">
                                                        {{ $author->name }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($article->genres as $genre)
                                                    <a href="{{ route('genres.show', $genre->id) }}"
                                                       class="badge badge-success">
                                                        {{ $genre->name }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.articles.show_chapters', $article->id) }}">
                                                    {{ $article->chapters_text }}
                                                </a>
                                            </td>
                                            <td> {{ $article->description }}</td>
                                            <td> {{ $article->view_text }}</td>
                                            <td> {{ $article->completed_text }}</td>
                                            <td> {{ $article->status_text }}</td>
                                            <td>{{ $article->user->name }}</td>
                                            <td title="{{ $article->created_at }}">{{ $article->created_at_text }}</td>
                                            <td title="{{ $article->updated_at }}">{{ $article->updated_at_text }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                   href="{{ route('articles.show', $article->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i> {{ __('Chi tiết') }}</a>
                                                <a class="btn btn-sm btn-info"
                                                   href="{{ route('admin.articles.create_chapter', $article->id) }}"><i
                                                        class="fa fa-fw fa-plus"></i> {{ __('Thêm chương') }}</a>
                                                <a class="btn btn-sm btn-success"
                                                   href="{{ route('admin.articles.edit', $article->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i> {{ __('Sửa') }}</a>
                                                @if($currentUser->is_admin)
                                                    <form
                                                        action="{{ route('admin.articles.change_status', [$article->id, \App\Enums\ArticleStatus::APPROVED]) }}"
                                                        method="POST" class="formApprove">
                                                        @csrf
                                                        @method('PATCH')
                                                        @if($article->status == \App\Enums\ArticleStatus::PENDING->value)
                                                            <button type="submit"
                                                                    class="btn btn-secondary btn-sm btnApprove">
                                                                <i
                                                                    class="fa fa-fw fa-check"></i> {{ __('Duyệt bài') }}
                                                            </button>
                                                        @elseif ($article->status == \App\Enums\ArticleStatus::HIDDEN->value)
                                                            <button type="submit"
                                                                    class="btn btn-warning btn-sm btnVisible">
                                                                <i
                                                                    class="fa fa-fw fa-check"></i> {{ __('Hiện bài') }}
                                                            </button>
                                                        @endif
                                                    </form>
                                                    @if($article->status == \App\Enums\ArticleStatus::APPROVED->value)
                                                        <form
                                                            action="{{ route('admin.articles.change_status', [$article->id, \App\Enums\ArticleStatus::HIDDEN]) }}"
                                                            method="POST" class="formHidden">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-dark btn-sm btnHidden">
                                                                <i
                                                                    class="fa fa-fw fa-eye-slash"></i> {{ __('Ẩn bài') }}
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form
                                                        action="{{ route('admin.articles.change_complete_status', $article->id) }}"
                                                        method="POST" class="formSetCompleted">
                                                        @csrf
                                                        @method('PATCH')
                                                        @if($article->is_completed == \App\Enums\ArticleCompleteStatus::COMPLETED->value)
                                                            <button type="submit"
                                                                    class="btn btn-outline-secondary btn-sm btnSetNotCompleted">
                                                                <i
                                                                    class="fa fa-fw fa-close"></i> {{ __(\App\Enums\ArticleCompleteStatus::NOT_COMPLETED->label()) }}
                                                            </button>
                                                        @elseif ($article->is_completed == \App\Enums\ArticleCompleteStatus::NOT_COMPLETED->value)
                                                            <button type="submit"
                                                                    class="btn btn-outline-primary btn-sm btnSetCompleted">
                                                                <i
                                                                    class="fa fa-fw fa-check"></i> {{ __(\App\Enums\ArticleCompleteStatus::COMPLETED->label()) }}
                                                            </button>
                                                        @endif

                                                    </form>
                                                @endif
                                                <form
                                                    action="{{ route('admin.articles.destroy', $article->id) }}"
                                                    method="POST" class="formDelete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btnDelete">
                                                        <i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Xoá') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                {!! $articles->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
