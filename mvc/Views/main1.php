<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đọc truyện</title>
    <link rel="stylesheet" href="/Project/mvc/Views/publics/css/normalize.css">
    <link rel="stylesheet" href="/Project/mvc/Views/publics/css/style.css">
    <link rel="stylesheet" href="/Project/mvc/Views/publics/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Project/mvc/Views/publics/css/owl.carousel.min.css">
    <link rel="shortcut icon" type="image/png" href="/Project/Data/favicon.png">
    <link rel="stylesheet" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <header class="header">
            <div class="header_top">
                <nav class="nav">
                    <ul class="navlist">
                        <a href="http://localhost:81/Project/home/"><img src="/Project/Data/logo.png" alt="logo" id="logo_nav"></a>
                        <li class="navitem">
                            <a href="http://localhost:81/Project/home/" class="navlink">Trang chủ</a>
                        </li>
                        <li class="navitem">
                            <a href="http://localhost:81/Project/search/" class="navlink">Tìm kiếm</a>
                        </li>
                        <?php 
                            if(isset($_SESSION["Admin"])){ ?>
                            <div class="dropdown">
                            <div class="mainmenubtn">Admin</div>
                                <div class="dropdown-child">
                                    <a href="http://localhost:81/Project/manage/">Quản Lý</a>
                                    <a href="http://localhost:81/Project/manage_manga/">Thêm Truyện</a>
                                    <a href="http://localhost:81/Project/manage_manga/DisplayUpdateChap">Cập Nhật Chương</a>
                                </div>
                            </div>
                            <?php }
                        ?>
                    </ul>
                    <ul class="navlist">
                        <li class="navitem">
                            <?php
                                if(isset($_SESSION["username"])){?>
                                    <a href="http://localhost:81/Project/home/logout/" class="navlink">Đăng xuất</a>
                                    <?php }
                                    ?>
                            <?php
                                if(isset($_SESSION["username"])==false){?>
                            <a href="http://localhost:81/Project/login/" class="navlink">Đăng nhập</a>
                                    <?php }
                                    ?>
                        </li>
                        <li class="navitem">
                            <?php
                                if(isset($_SESSION["username"])){ ?>
                                    <a href="http://localhost:81/Project/home/tutruyen/" class="navlink">Tủ Truyện</a>
                              <?php  }
                            ?>
                            <?php
                                if(isset($_SESSION["username"])==false){?>
                            <a href="http://localhost:81/Project/register/" class="navlink">Đăng ký</a>
                            <?php }
                                    ?>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="banner">
            </div>
        </header>
        <div class="container">
            <div class="container_body">

            <?php
                    require_once "./mvc/Views/page/".$data["page"].".php";
                ?>
            </div>
        </div>
        <footer class="footer">
            <div class="footertop">
                <ul class="footlist">
                    <li class="foottitle">Giới thiệu</li>
                    <li class="footnd"><p>Thuê Truyện là website thuê truyện online cập nhật liên tục và nhanh nhất các truyện tiên hiệp, kiếm hiệp, huyền ảo được các thành viên liên tục đóng góp rất nhiều truyện hay và nổi bật</p></li>
                </ul>
                <ul class="footlist">
                    <li class="foottitle">Liên hệ quảng cáo</li>
                    <li class="footnd">Nhóm TLD</li>
                    <li class="footnd">Email: abc@email.com</li>
                    <li class="footnd">Số điện thoại: 0123456789</li>
                </ul>
            </div>
            <div class="footerbot">
                <h6 id="footer_line">Copyright © TLD 2020 . All rights reserved</h6>
            </div>
        </footer>
    </div>
</body>
</html>