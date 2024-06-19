<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminHome</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/Admin.css?v = <?php echo time(); ?>">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</head>
 <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Fresh Fruit</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="order.php" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Danh mục</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Sản phẩm</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Admin.php?page=CTKM" class="sidebar-link">Chương trình khuyến mãi</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Nhà cung cấp</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-layout"></i>
                        <span>Thống kê và báo cáo</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="index.php?page=thethuvien" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Tin tức</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Cài đặt</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div>
                <?php
                    // Kiểm tra xem có tham số 'page' trong URL hay không
                    if (isset($_GET['page']) && $_GET['page'] == 'CTKM') {
                         // Nếu có, bao gồm file list_TheLoai.php
                        include '../Index_CTKM.php';
                    }
                ?>
            </div>
            
        </div>
    </div>
    <body>
   
    <script src="../JS/Admin.js?v = <?php echo time(); ?>"></script>
</body>
</html>
