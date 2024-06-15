<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminHome</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Style/Admin.css">
</head>
<body>

    <!-- -----------Thanh bên------------- -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="./img/logo.png" alt="">
            <span class="text">FruitAdmin</span>
        </a>
        <ul class="side_menu top">
            <li class="active">
                <a href="order.php">
                    <i class='bx bxs-store-alt'></i>
                    <span class="text">Giỏ hàng</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-lemon' ></i>
                    <span class="text">Sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-discount' ></i>
                    <span class="text">Chương trình khuyến mãi</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-report' ></i>
                    <span class="text">Thống kê và báo cáo</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-archive-in'></i>
                    <span class="text">Nhà cung cấp</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-news' ></i>
                    <span class="text">Tin tức</span>
                </a>
            </li>
        </ul>
        <ul class="side_menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out' ></i>
                    <span class="text">Đăng xuất</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- -----------Thanh bên------------- -->





    <!-- -----------Content----------- -->
    <section id="content">
        <!-- ----------Thanh điều hướng----------- -->
        <nav>   
            <i class='bx bx-menu' ></i>
            <a href="#" class="nav-link">Thể loại</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Tìm kiếm...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="https://www.enewsletterhome.com/_eNewsletter/2020/2007_J_avatar.jpg?" alt="">
            </a>
        </nav>
        <!-- ----------Thanh điều hướng----------- -->
    </section>
    <!-- -----------Content----------- -->
    <script src="../JS/Admin.js"></script>
</body>
</html>
