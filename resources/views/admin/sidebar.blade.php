<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/main" class="brand-link">
        <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <li class="nav-item">
                    <a href="/admin/category/add" class="nav-link active">
                        <i  class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Thể loại
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

{{--                Danh mục--}}

                <li class="nav-item menu-opening">
                    <a href="#" class="nav-link active">
                        <i  class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item nav-is-opening">
                            <a href="/admin/menu/add"  class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/menu/addcate" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thể loại của danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>

{{--                Nhạc sĩ--}}
                <li class="nav-item">
                    <a href="/admin/musican/add" class="nav-link active">
                        <i  class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Nhạc sĩ
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

{{--                Ca sĩ--}}

                <li class="nav-item">
                    <a href="/admin/singer/add" class="nav-link active">
                        <i  class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Ca sĩ
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                {{--            Song--}}
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Bài Hát
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/song/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Bài Hát Mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/song/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Bài Hát</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--            Playlist--}}
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Playlist
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/playlist/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Playlist Mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/playlist/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Playlist</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--            Slider--}}
                <li class="nav-item">
                    <a href="/admin/slider/add" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                {{--            duyet--}}
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Duyệt
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/browse/song" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bài Hát</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/browse/playlist" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Playlist</p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{--            Thanh viên--}}
                <li class="nav-item">
                    <a href="/admin/user/list" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Thành Viên
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                {{--            Thanh viên--}}
                <li class="nav-item">
                    <a href="/admin/training" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Hệ thống tìm kiếm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
