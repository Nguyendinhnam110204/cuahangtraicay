<?php
require_once 'connect.php';

$selected_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$min_price = isset($_POST['min_price']) ? $_POST['min_price'] : null;
$max_price = isset($_POST['max_price']) ? $_POST['max_price'] : null;

$hienthi_sql = "SELECT * FROM san_pham";

$where_conditions = [];

// Filter by product name
if ($selected_name != '') {
    $where_conditions[] = "ten_san_pham = '$selected_name'";
}

// Filter by price range
if ($min_price !== null && is_numeric($min_price)) {
    $where_conditions[] = "gia >= $min_price";
}
if ($max_price !== null && is_numeric($max_price)) {
    $where_conditions[] = "gia <= $max_price";
}

// Combine all conditions
if (!empty($where_conditions)) {
    $hienthi_sql .= " WHERE " . implode(" AND ", $where_conditions);
}

// Finalize the SQL query
$hienthi_sql .= " ORDER BY ma_san_pham, ten_san_pham, gia, mo_ta, url_hinh_anh, ton_kho, ngay_tao, ngay_cap_nhat, ma_doi_tac";

// Execute the query
$result = mysqli_query($conn, $hienthi_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="./Style/menu.css?v=<?php echo time();?>">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- HEADER -->
    <section id="Home">
        <nav>
            <div class="logo">
                <img src="Img/fresh-fruit-logo_25327-200.jpg">
            </div>
            <ul style="padding-top: 15px;">
                <li><a href="Trangchu.php" style="text-decoration: none;">Trang chủ</a></li>
                <li><a href="menu.php" style="text-decoration: none;">Sản phẩm</a></li>
                <li><a href="#Menu" style="text-decoration: none;">Tin tức</a></li>
                <li><a href="#Review" style="text-decoration: none;">Giới thiệu</a></li>
            </ul>
            <div class="search-container">
                <form action="/search" method="get">
                    <input type="text" placeholder="Tìm kiếm..." name="query">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="icon-cart"> 
          <!-- mới phần giỏ hàng -->
                <a href="giohang.php" target="_self">
                    <i class="fa-solid fa-cart-shopping" number="0"></i>
                </a>
            </div> 

        <div class="icon">
                <?php if (isset($_SESSION['so_dien_thoai'])): ?>
                    <div class="user-avatar" id="avatar">
                        <img src="https://i.pinimg.com/564x/49/3f/a0/493fa0f13970ab3ef29375669f670451.jpg" alt="Avatar" id="avatar" style="margin-left: -40px; margin-right: -80px;">
                        <div class="dropdown-menu" id="dropdown-menu">
                            <a href="#" onclick="logout()">Đăng xuất</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="./Dangnhap_Index.php" class="Login_btn" style="margin:0 -20px 0 -50px; ">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </nav>


        <!-- MENU -->
        <div class="menu" id="Menu">
            <h1><span>MENU</span></h1>
            <div class="row">
    <div class="column">
        <div class="filter">
            <form method="POST" action="">
                <h4>Sản phẩm</h4>
                <div class="form-check">
                    <?php
                    $name_query = "SELECT DISTINCT ten_san_pham FROM san_pham";
                    $name_result = mysqli_query($conn, $name_query);
                    while ($row = mysqli_fetch_assoc($name_result)) {
                        $name = $row['ten_san_pham'];
                        echo '<label class="form-check-label" for="flexCheckChecked"><input class="form-check-input" type="checkbox" value="'.$name.'" '.($selected_name == $name ? 'checked' : '').'> '.$name.'</label><br>';
                    }
                    ?>
                </div>
                <h4>Giá</h4>
                <div class="form-group" >
                    <label for="min_price">Giá thấp nhất:</label>
                    <input type="text" style="width: 100px;" name="min_price" class="form-control" value="<?php echo isset($_POST['min_price']) ? $_POST['min_price'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="max_price">Giá cao nhất:</label>
                    <input type="text" style="width: 100px;" name="max_price" class="form-control" value="<?php echo isset($_POST['max_price']) ? $_POST['max_price'] : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
            </div>
    </div>
    
    <div class="column">
        <div class="menu_box">
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
            <form action="./gio_hang/addtocart_menu.php" method="POST" class="box">
            <input type="hidden" name="tensp" value="<?php echo $r['ten_san_pham']; ?>">
            <input type="hidden" name="img" value="<?php echo $r['url_hinh_anh']; ?>">
            <input type="hidden" name="gia" value="<?php echo $r['gia']; ?>">
            <input type="hidden" name="id" value="<?php echo $r['ma_san_pham'] ?>">
                <div class="menu_card">
                    <div class="menu_image">
                        <img src="Img/<?php echo $r['url_hinh_anh']; ?>" class="img">
                    </div>
                    <div class="menu_info">
                        <h2 class="name"><?php echo $r['ten_san_pham']; ?></h2>
                        <h3><p class="gia">Giá <?php echo $r['gia']; ?> VND</p></h3>
                    </div>
                    <div class="button-container">
                    <input type="submit" style="height:60px;font-size:18px;" value="Thêm Sản Phẩm vào giỏ " class="btn btn-danger" name= "btn_add_to_cart">
                    <a class="btn btn-primary" style="height:60px;font-size:18px; margin-left:5px; " href="chitietsanpham.php?ma_san_pham=<?php echo $r['ma_san_pham'];?> ">Chi tiết</a>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
    </div>
        </div>

        <!-- Phần cuối trang web -->
        <!-- ---------------Footer---------------- -->
        <footer>
            <div class="footer_main">
                <div class="footer_tag">
                    <h2>THÔNG TIN CỬA HÀNG</h2>
                    <p>Địa chỉ: Số 16 Nguyễn Xiển - Phường Thanh Xuân Nam - Quận Thanh Xuân - Hà Nội</p>
                    <p>Email: nguyendinhnam204211@gmail.com</p>
                    <p>Sđt: 0941234789 - 0942568456</p>
                    <p>Giấy chứng nhận ĐKKD số: 41A6003434 | Ngày cấp: 1/1/2024</p>
                </div>
                <div class="footer_tag">
                    <h2>CHÍNH SÁCH - QUY ĐỊNH</h2>
                    <p><i class="fa-solid fa-angle-right"></i>HƯỚNG DẪN ĐẶT HÀNG VÀ THANH TOÁN</p>
                    <p><i class="fa-solid fa-angle-right"></i>CHÍNH SÁCH GIAO HÀNG VÀ ĐỔI TRẢ</p>
                    <p><i class="fa-solid fa-angle-right"></i>CHÍNH SÁCH BẢO MẬT THÔNG TIN</p>
                </div>
                <div class="footer_tag">
                    <h2>Follows</h2>
                    <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.messenger.com/t/101520886067712/" target="_blank"><i class="fa-brands fa-facebook-messenger"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </footer>
    </section>

    <script>
      document.addEventListener("DOMContentLoaded", (event) => {
        function updateCartIcon() {
          const cartIcon = document.querySelector(".fa-cart-shopping");
          const productCount = localStorage.getItem("cartItemCount") || 0;
          cartIcon.setAttribute("number", productCount);
        }

        // Gọi hàm để cập nhật biểu tượng giỏ hàng khi tải trang
        updateCartIcon();
      });
    </script>


    <script>
        document.getElementById('avatar').addEventListener('click', function() {
            var dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        function logout() {
            window.location.href = 'Dangxuat.php';
        }

        window.onclick = function(event) {
            if (!event.target.matches('#avatar')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
    </script>
</body>
</html>
