<?php 
session_start();
require_once 'connect.php';
$sql = "SELECT *FROM khuyen_mai ";
$result = mysqli_query($conn,$sql);
if(isset($_SESSION['so_dien_thoai'])){
  
}
$giam_gia =0;
if(isset($_POST['btnapdung_KM']) && isset($_POST['voucher'])){
  //gán mã khuyến mãi vào sesion
  $_SESSION['payment_info']['ma_khuyen_mai'] = $_POST['voucher'];
  //
  $voucher_name = $_POST['voucher'];
  $sql_giamgia = "SELECT giam_gia FROM khuyen_mai WHERE ma_khuyen_mai = '$voucher_name'";
  $result_giamgia=mysqli_query($conn,$sql_giamgia);
  if ($result_giamgia && mysqli_num_rows($result_giamgia) > 0) {
    $row = mysqli_fetch_assoc($result_giamgia);
    $giam_gia = (int) $row['giam_gia'];
} else {
    $giam_gia =0;
}
}

$phivanchuyen = 0;
if (isset($_POST['shippingFee'])) {
    $phivanchuyen = (int)$_POST['shippingFee'];
} else {
    // Default shipping fee if not set
    // $phivanchuyen = 40000;
    // if (isset($_GET['province']) && $_GET['province'] === '1') { // assuming '1' is the ID for Hà Nội
    //     $phivanchuyen = 30000;
    // }
    $phivanchuyen=0;
}
// Khởi tạo biến $tam_tinh ban đầu là 0
$tam_tinh = 0;
// Kiểm tra xem giá trị 'cartTotalPrice' có tồn tại trong mảng $_POST hay không
if (isset($_POST['cartTotalPrice'])) {
    // Nếu 'cartTotalPrice' tồn tại, lấy giá trị này từ $_POST và gán cho $tam_tinh
    $tam_tinh = (int)$_POST['cartTotalPrice'] ;
    $tam_tinh -= $giam_gia; 
} 
$tong_tien = $tam_tinh+$phivanchuyen;

// <!-- tỉnh thành vn -->

$sql_city = "SELECT * FROM province";
$result_city = mysqli_query($conn,$sql_city);


// Lưu thông tin giao hàng vào session
if (isset($_POST['txtname']) && isset($_POST['txtemail']) && isset($_POST['txtphone']) && isset($_POST['txtaddress']) && isset($_POST['province']) && isset($_POST['district']) && isset($_POST['wards'])) {
  $_SESSION['shipping_info'] = [
      'name' => $_POST['txtname'],
      'email' => $_POST['txtemail'],
      'phone' => $_POST['txtphone'],
      'address' => $_POST['txtaddress'],
  ];
}

// Lưu thông tin thanh toán vào session
$_SESSION['payment_info'] = [
  'tam_tinh' => $tam_tinh,
  'phivanchuyen' => $phivanchuyen,
  'giam_gia' => $giam_gia,
  'tong_tien' => $tong_tien,
  'ma_khuyen_mai' => isset($_SESSION['payment_info']['ma_khuyen_mai']) ? $_SESSION['payment_info']['ma_khuyen_mai'] : ''
  
];

// Đoạn mã kiểm tra session để quyết định có hiển thị phần chọn khuyến mãi hay không
$show_khuyen_mai = isset($_SESSION['so_dien_thoai']); // Kiểm tra nếu đã đăng nhập
// đóng kết nối
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fruit store</title>
    <link rel="stylesheet" href="./Style/Loction.css?v = <?php echo time();?>" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- api loc quan huyen -->
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
  </head>
  <body>
    <!-- Phần đầu trang web -->
    <article>
      <nav>
        <div class="logo">
          <img src="Img/fresh-fruit-logo_25327-200.jpg" />
        </div>
        <ul style="margin-top:12px;">
          <li><a href="Trangchu.php" style="text-decoration: none;">Trang chủ</a></li>
          <li><a href="#About" style="text-decoration: none;">Sản phẩm</a></li>
          <li><a href="#Menu"style="text-decoration: none;">Tin tức</a></li>
          <li><a href="#Review"style="text-decoration: none;">Giới thiệu</a></li>
        </ul>
        <div class="search-container">
          <form action="/search" method="get">
            <input type="text" placeholder="Tìm kiếm..." name="query" />
            <button type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>

         <div class="icon-cart"> 
        <a href="giohang.php"><i id="cart-icon" class="fa-solid fa-cart-shopping" number="0"></i></a>
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
    </article>
    <!-- than -->
    <section>
      <div class="title">
        <div class="tieude">
          <a href="Trangchu.php"><h1>FRUIT STORE</h1></a>
        </div>
        <?php if (!isset($_SESSION['so_dien_thoai'])): ?>
                <div class="auth-section">
                    <div style="display: flex;">
                        <a href="Dangnhap_Index.php" class="btn-login btn btn-dark">ĐĂNG NHẬP</a>
                        <a href="Dangnhap_Index.php" class="btn-register btn btn-light">ĐĂNG KÝ</a>
                    </div>
                    <p>
                        Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ FRUIT STORE.
                    </p>
                </div>
            <?php endif; ?>
        <div>
          <h2 style="text-align:center;">Thông tin giao hàng</h2>
        </div>
      </div>
      <div style="display:flex; justify-content: center">
        <!-- noidung -->
      <form id="checkoutForm" action="" method = "post">
        <table class="add_KH">
          <tr >
            <td colspan="3">
              <label for="name">Họ và Tên</label>
            </td>
          </tr>
          <tr >
            <td colspan="3">
              <input
                class="ten"
                type="text"
                id="name"
                name="txtname"
              
                value="<?php echo isset($_POST['txtname']) ? $_POST['txtname'] : ''; ?>"
              />
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <div class="info_row">
                <div>
                  <label for="email">Email</label>
                  <input
                    class="email"
                    type="email"
                    id="email"
                    name="txtemail"
                   
                    value="<?php echo isset($_POST['txtemail']) ? $_POST['txtemail'] : ''; ?>"
                  />
                </div>
                <div>
                  <label for="phone" style="margin-left:98px;">Số điện thoại</label>
                  <input
                    class="phone"
                    type="text"
                    id="phone"
                    name="txtphone"
                    
                    value="<?php echo isset($_POST['txtphone']) ? $_POST['txtphone'] : ''; ?>"
                  />
                </div>
              </div>
            </td>
          </tr>
          <tr id="info_an" style="display: flex">
            <td colspan="3">
              <label for="address">Địa chỉ cụ thể</label>
            </td>
          </tr>
          <tr id="info_an1" style="display: flex">
            <td colspan="3">
              <input
                class="address"
                type="text"
                id="address"
                name="txtaddress"
                required
                value ="<?php echo isset($_POST['txtaddress']) ? $_POST['txtaddress'] : ''; ?>"
              />
            </td>
          </tr>
          <tr id="info_an2" style="display: flex">
           <td>
           <div class="province-district-ward">
            <select name="province" id="province"  required>
            <option  value="">chọn một tỉnh</option>
              <?php
              while($row_city = mysqli_fetch_assoc($result_city)){
              echo '<option value="' . $row_city['province_id'] . '"' . (isset($_POST['province']) && $_POST['province'] == $row_city['province_id'] ? ' selected' : '') . '>' . $row_city['name'] . '</option>';
              }
              ?>
            </select>
            <select name="district" id="district" required>
              <option value="">Quận/Huyện</option>
            </select>
            <select name="wards" id="wards" required>
              <option value="">Phường/Xã</option>
            </select>
          </div>
           </td>
          </tr>
        </table>
        <input type="hidden" id="cartTotalPriceInput" name="cartTotalPrice" value="" />
        <input type="hidden" id="cartvanchuyenInput" name="shippingFee" value="0" />
          <!-- table-left -->
        <table class="ship" style="height: 50px;">
            <tr>
            <td style="display: flex">
            <?php if ($show_khuyen_mai): ?>
              <select id="voucher" name="voucher">
                <option value="">Mã free Ship/Mã giảm giá</option>
                <?php while ($rows_KM = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $rows_KM['ma_khuyen_mai']; ?>"<?php echo (isset($_POST['voucher']) && $_POST['voucher'] == $rows_KM['ma_khuyen_mai']) ? ' selected' : ''; ?>><?php echo $rows_KM['ten_khuyen_mai']; ?></option>
                <?php endwhile; ?>
            </select>
              <div class="button_apdung">
                <button type="submit" name="btnapdung_KM" >Áp dụng</button>
              </div>
              <?php else: ?>
            <p>Vui lòng đăng nhập để áp dụng khuyến mãi.</p>
        <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>Giảm</td>
            <td>
              <div class="giam_gia"><span id="giamgia-value" ><?php echo number_format($giam_gia, 0, ',', '.'); ?></span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td>Tạm tính</td>
            <td>
              <div class="tamtinh"><span id="tamtinh-value" ><?php echo number_format($tam_tinh, 0, ',', '.'); ?> </span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td>Phí vận chuyển</td>
            <td>
              <div class="phivanchuyen"><span id="shippingFee" ><?php echo number_format($phivanchuyen, 0, ',', '.'); ?></span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td><strong>Tổng tiền</strong></td>
            <td>
              <strong class="tongtien"><span id="total-value"><?php echo number_format($tong_tien, 0, ',', '.'); ?></span><sup>đ</sup></strong>
            </td>
          </tr>
        </table>
      </div>
      <div class="buttun_thanhtoan " style="text-align:center;"> <button type="submit" class="btn btn-dark" onclick="pay()">Tiếp tục thanh toán</button></div>
       </form>
    </section>
    <!-- Phần cuối trang web -->
    <!-- ---------------Footer---------------- -->
    <footer>
      <div class="footer_main">
        <div class="footer_tag">
          <h2>THÔNG TIN CỬA HÀNG</h2>
          <p>
            Địa chỉ: Số 16 Nguyễn Xiển - Phường Thanh Xuân Nam - Quận Thanh Xuân
            - Hà Nội
          </p>
          <p>Email: nguyendinhnam204211@gmail.com</p>
          <p>Sđt: 0941234789 - 0942568456</p>
          <p>Giấy chứng nhận ĐKKD số: 41A6003434 | Ngày cấp: 1/1/2024</p>
        </div>

        <div class="footer_tag">
          <h2>CHÍNH SÁCH - QUY ĐỊNH</h2>
          <p>
            <i class="fa-solid fa-angle-right"></i>HƯỚNG DẪN ĐẶT HÀNG VÀ THANH
            TOÁN
          </p>
          <p>
            <i class="fa-solid fa-angle-right"></i>CHÍNH SÁCH GIAO HÀNG VÀ ĐỔI
            TRẢ
          </p>
          <p>
            <i class="fa-solid fa-angle-right"></i>CHÍNH SÁCH BẢO MẬT THÔNG TIN
          </p>
        </div>

        <div class="footer_tag">
          <h2>Follows</h2>
          <a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a>
          <a href="#" target="_blank"
            ><i class="fa-brands fa-facebook-messenger"></i
          ></a>
          <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
        </div>
      </div>
    </footer>

    <!-- js -->
    <script>
      function pay() {
        
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var province = document.getElementById('province').value;
    var district = document.getElementById('district').value;
    var wards = document.getElementById('wards').value;

  
    if (!name || !email || !phone || !address || !province /*|| !district || !wards*/) {
        alert('Vui lòng điền đầy đủ thông tin.');
        return;
    }

    window.location.href = "./thanhtoandonhang.php";
      }

      document.addEventListener("DOMContentLoaded", (event) => {
        function updateCartIcon() {
          const cartIcon = document.querySelector(".fa-cart-shopping");
          const productCount = localStorage.getItem("cartItemCount") || 0;
          cartIcon.setAttribute("number", productCount);
        }
        // Gọi hàm để cập nhật biểu tượng giỏ hàng khi tải trang
        updateCartIcon();
        function updateShippingFee() {
        var province = document.getElementById("province").options[document.getElementById("province").selectedIndex].text;
        var shippingFee = 0; 
        if (province === "Hà Nội") {
            shippingFee = 30000;
        }else if(province === "chọn một tỉnh"){
          shippingFee = 0;
        }else{
          shippingFee = 40000;
        }
        document.getElementById("shippingFee").innerText = shippingFee.toLocaleString("vi-VN");
        
        document.getElementById("cartvanchuyenInput").value = shippingFee;
        updateTotalAmount(); 
    }

    function setCartTotalPrice() {
      
        var cartTotalPrice = localStorage.getItem("cartTotalPrice") || 0;
        
        document.getElementById("cartTotalPriceInput").value = cartTotalPrice;

        
        var tamTinhValue = parseInt(cartTotalPrice) || 0;
        var giamGiaValue = parseInt(document.getElementById("giamgia-value").textContent.replace(/\D/g, '')) || 0;
        var phiVanChuyenValue = parseInt(document.getElementById("shippingFee").textContent.replace(/\D/g, '')) || 0;

        
        var tamTinh = tamTinhValue - giamGiaValue;
        var tongTien = tamTinh + phiVanChuyenValue;

     
        document.getElementById("tamtinh-value").innerText = tamTinh.toLocaleString('vi-VN');
        document.getElementById("total-value").innerText = tongTien.toLocaleString('vi-VN');

        
        localStorage.setItem("totalAmountToPay", tongTien);
    }

    function updateTotalAmount() {
        setCartTotalPrice();
    }

    // Call updateShippingFee initially
    updateShippingFee();

    // Attach change event listener to province dropdown
    document.getElementById("province").addEventListener("change", function() {
        updateShippingFee();
    });

    // Call setCartTotalPrice initially
    setCartTotalPrice();
   // Xử lý việc gửi biểu mẫu
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
    
<script src="JS/diachi.js"></script>
  </body>
</html>

