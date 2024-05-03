@extends('layout.admin')

@section('template_title')
    {{ __('Tác giả') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="create" style="margin-bottom: 10px">
                        <a href="{{ route('admin.authors.create') }}" class="btn btn-primary"
                           data-placement="left">
                            {{ __('Thêm tác giả mới') }}
                        </a>
                    </div>

                    <div class="search">
                        <form id="searchForm" action="{{ route('admin.authors.index') }}" method="GET">
                            <input type="search" id="searchInput" class="form-control form-control-sm"
                                   placeholder="Tìm kiếm theo tên tác giả" name="search">
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
                                       class="table table-bordered table-striped dataTable dtr-inline table-hover"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Mô tả</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($authors as $author)
                                        <tr class="even">
                                            <td>{{ $author->id }}</td>
                                            <td><a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a></td>
                                            <td>{{ $author->description }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.authors.destroy', $author->id) }}"
                                                    method="POST" class="formDelete">
                                                    <a class="btn btn-sm btn-success"
                                                       href="{{ route('admin.authors.edit', $author->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Sửa') }}</a>
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
                                {!! $authors->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
