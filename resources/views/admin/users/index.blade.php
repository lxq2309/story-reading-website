@extends('layout.admin')

@section('template_title')
    {{ __( $title ) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="search">
                        <form id="searchForm" action="{{ route('admin.users.index') }}" method="GET">
                            <input type="search" id="searchInput" class="form-control form-control-sm"
                                   placeholder="Tìm kiếm theo tên người dùng" name="search">
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
                                        <th>Ảnh đại diện</th>
                                        <th>Tên người dùng</th>
                                        <th>Tên đầy đủ</th>
                                        @if(is_route('admin.users.banned'))
                                            <th>Lý do bị cấm</th>
                                            <th>Thời hạn cấm còn lại</th>
                                            <th>Ngày cấm</th>
                                            <th>Ngày sửa lý do cấm</th>
                                            <th>Người cấm</th>
                                        @else
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày sinh</th>
                                            <th>Giới tính</th>
                                            <th>Vai trò</th>
                                        @endif
                                        <th>Ngày tạo tài khoản</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr class="even">
                                            <td>{{ $user->id }}</td>
                                            <td><img src="{{ asset($user->avatar) }}" alt="{{ $user->username }}" width="50px"></td>
                                            <td>
                                                @if($user->banned)
                                                    <s>{{ $user->username }}</s>
                                                @else
                                                    {{ $user->username }}
                                                @endif

                                            </td>
                                            <td>{{ $user->name }}</td>
                                            @if(is_route('admin.users.banned'))
                                                <td>{{ $user->banned->reason }}</td>
                                                <td>{{ $user->banned->remaining_days }}</td>
                                                <td title="{{ $user->banned->created_at }}">{{ $user->banned->created_at_text }}</td>
                                                <td title="{{ $user->banned->updated_at }}">{{ $user->banned->updated_at_text }}</td>
                                                <td>{{ $user->banned->admin->name }}</td>
                                            @else
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->date_of_birth_text }}</td>
                                                <td>{{ $user->gender_text }}</td>
                                                <td>
                                                    @switch($user->role)
                                                        @case(\App\Enums\UserRole::ADMIN->value)
                                                            <span style="color: red">{{ $user->role_text }}</span>
                                                            @break
                                                        @case(\App\Enums\UserRole::POSTER->value)
                                                            <span style="color: blue">{{ $user->role_text }}</span>
                                                            @break
                                                        @case(\App\Enums\UserRole::USER->value)
                                                            {{ $user->role_text }}
                                                            @break
                                                    @endswitch
                                                </td>
                                            @endif
                                            <td title="{{ $user->created_at }}">{{ $user->created_at_text }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                   href="{{ route('admin.users.edit', $user->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i> {{ __('Chi tiết') }}</a>
                                                @if(!$user->banned)
                                                    <a class="btn btn-sm btn-success"
                                                       href="{{ route('admin.users.edit_role', $user->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Sửa vai trò') }}</a>
                                                    @if($user->role != \App\Enums\UserRole::ADMIN->label())
                                                        <a class="btn btn-sm btn-danger"
                                                           href="{{ route('admin.users.create_ban', $user->id) }}"><i
                                                                class="fa fa-fw fa-ban"></i> {{ __('Cấm') }}</a>
                                                    @endif
                                                @else
                                                    <a class="btn btn-sm btn-success"
                                                       href="{{ route('admin.users.edit_ban', $user->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Sửa lý do') }}</a>
                                                    <form
                                                        action="{{ route('admin.users.unban', $user->id) }}"
                                                        method="POST" class="formUnban">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-info btn-sm btnUnban">
                                                            <i
                                                                class="fa fa-fw fa-xmark"></i> {{ __('Bỏ cấm') }}
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
