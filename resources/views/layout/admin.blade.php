<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (trim($__env->yieldContent('template_title')))
            @yield('template_title') |
        @endif {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="/dist/css/custom.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/dist/img/loading.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.index') }}" role="button">Về trang khách</a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.change_password') }}"
                   role="button" title="Đổi mật khẩu">
                    <i class="fa-solid fa-key"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button"
                   title="Hiển thị toàn màn hình">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-link nav-link" role="button" title="Đăng xuất">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ $currentUser->avatar }}" class="img-circle elevation-2"
                         alt="{{ $currentUser->username }}">
                </div>
                <div class="info">
                    <a href="{{ route('users.show', $currentUser->id) }}"
                       class="d-block">{!! $currentUser->renderUserName() !!}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search"
                           placeholder="Nhập nội dung tìm kiếm" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if($currentUser->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                               class="nav-link {{ set_active('admin.dashboard') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Trang tổng quan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-is-opening menu-open">
                            <a href="#" class="nav-link {{ set_active('admin.users.*') }}">
                                <i class="fa-solid fa-user"></i>
                                <p>
                                    Quản lý tài khoản
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                       class="nav-link {{ set_active('admin.users.index') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Tất cả tài khoản
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.banned') }}"
                                       class="nav-link {{ set_active('admin.users.banned') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Tài khoản bị cấm
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.poster') }}"
                                       class="nav-link {{ set_active('admin.users.poster') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Tài khoản người đăng bài
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.admin') }}"
                                       class="nav-link {{ set_active('admin.users.admin') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Tài khoản quản trị viên
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if($currentUser->is_poster || $currentUser->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('admin.articles.index') }}"
                               class="nav-link {{ set_active('admin.articles.*') }}">
                                <i class="fa-solid fa-newspaper"></i>
                                <p>
                                    Truyện
                                </p>
                            </a>
                        </li>
                    @endif
                    @if($currentUser->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('admin.authors.index') }}"
                               class="nav-link {{ set_active('admin.authors.*') }}">
                                <i class="fa-solid fa-pen"></i>
                                <p>
                                    Tác giả
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.genres.index') }}"
                               class="nav-link {{ set_active('admin.genres.*') }}">
                                <i class="fa-solid fa-bars"></i>
                                <p>
                                    Thể loại
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.menus.index') }}"
                               class="nav-link {{ set_active('admin.menus.*') }}">
                                <i class="fa-solid fa-folder"></i>
                                <p>
                                    Menu
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @if (trim($__env->yieldContent('template_title')))
                                @yield('template_title')
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (trim($__env->yieldContent('template_title')))
                                    @yield('template_title')
                                @endif
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
         aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your password change form goes here -->
                    <form method="POST" action="{{ route('admin.dashboard') }}">
                        @csrf
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<script src="/dist/js/custom.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script !src="">
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            let context = this, args = arguments;
            let later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            let callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
</script>
@yield('ArticleScripts');
<script>
    function logout() {
        event.preventDefault();
        if (confirm('Bạn có muốn đăng xuất không ?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
        $('.formDelete').each(function (i, el) {

            $(el).find('.btnDelete').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn muốn xoá không?")) {
                    $(el).submit();
                }
            });
        });
        $('.formUnban').each(function (i, el) {

            $(el).find('.btnUnban').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn muốn gỡ lệnh cấm cho người dùng này không?")) {
                    $(el).submit();
                }
            });
        });
        $('.formSetCompleted').each(function (i, el) {

            $(el).find('.btnSetCompleted').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn muốn đặt bài viết thành đã hoàn thành?")) {
                    $(el).submit();
                }
            });
            $(el).find('.btnSetNotCompleted').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn muốn đặt bài viết thành chưa hoàn thành?")) {
                    $(el).submit();
                }
            });
        });
        $('.formApprove').each(function (i, el) {

            $(el).find('.btnApprove').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn duyệt bài này không?")) {
                    $(el).submit();
                }
            });
            $(el).find('.btnVisible').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn hiển thị bài này không?")) {
                    $(el).submit();
                }
            });
        });
        $('.formHidden').each(function (i, el) {

            $(el).find('.btnHidden').on('click', function (event) {
                event.preventDefault();
                if (confirm("Bạn có chắc chắn muốn ẩn bài viết này không?")) {
                    $(el).submit();
                }
            });
        });
    });
</script>

</body>

</html>
