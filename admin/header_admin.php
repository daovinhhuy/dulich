<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/circular-std/style.css">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="../assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <script src="../assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <title>Trang quản trị</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.php">Tây Đô Travel</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/user_admin.png" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <?php
                                // print_r($_SESSION);
                                if (isset($_SESSION['nhanvien'])) {
                                ?>
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name"><?php echo 'Xin chào ' . $_SESSION['nhanvien'] ?></h5>
                                    </div>
                                    <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Đăng xuất</a>
                                <?php
                                } else {
                                ?>
                                    <a class="dropdown-item" href="login.php"><i class="fa fa-user-circle"></i> Đăng Nhập</a>
                                <?php }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">

                            <?php
                            if (isset($_SESSION['nhanvien'])) {
                                if ($_SESSION['nhanvien'] == 'admin') {
                                    echo 'QUYỀN ADMIN';
                            ?>
                                    <li class="nav-divider">
                                        Menu
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link active" href="?page_admin" aria-expanded="false" aria-controls="submenu-1"><i class="fas fa-fw fa-chart-pie"></i>Thống kê <span class="badge badge-success"></span></a>
                                        <div id="submenu-1" class="collapse submenu">
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Quản lý danh mục</a>
                                        <div id="submenu-2" class="collapse submenu">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtintuc">Tin tức</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachloaitour">Loại Tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtour">Tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachchitietlt">Lịch trình</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtinhthanh">Tỉnh thành</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachddl">Điểm du lịch</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachsklh">Sự kiện -Lễ hội</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachphieudattour">Phiếu đặt tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachphieudangkytour">Phiếu đăng ký tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachkhachhang">Khách hàng</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachphanhoi">Phản hồi</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fa fa-fw fa-user-circle"></i>Quản lý</a>
                                        <div id="submenu-3" class="collapse submenu">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachchucvu">Chức vụ</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachnhanvien">Nhân viên</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtrangthai">Trạng thái</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php
                                } else if ($_SESSION['nhanvien'] != 'admin') {
                                    echo 'QUYỀN NHÂN VIÊN';
                                ?>
                                    <li class="nav-divider">
                                        Menu
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link active" href="?page_admin" aria-expanded="false" aria-controls="submenu-1"><i class="fas fa-fw fa-chart-pie"></i>Thống kê <span class="badge badge-success"></span></a>
                                        <div id="submenu-1" class="collapse submenu">
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Quản lý danh mục</a>
                                        <div id="submenu-2" class="collapse submenu">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtintuc">Tin tức</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachloaitour">Loại Tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtour">Tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachchitietlt">Lịch trình</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachtinhthanh">Tỉnh thành</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachddl">Điểm du lịch</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachsklh">Sự kiện -Lễ hội</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachphieudattour">Phiếu đặt tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachphieudangkytour">Phiếu đăng ký tour</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachkhachhang">Khách hàng</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="?page_admin=danhsachphanhoi">Phản hồi</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">