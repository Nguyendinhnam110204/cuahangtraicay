<?php
session_start();
// Kiểm tra nếu có dữ liệu được gửi từ form, lưu vào session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['payment_info']['ma_phuong_thuc_thanh_toan'] = $_POST['ma_phuong_thuc_thanh_toan'];
}
if (!isset($_SESSION['shipping_info'])) {
    $_SESSION['shipping_info'] = [];
}

if (!isset($_SESSION['payment_info'])) {
    $_SESSION['payment_info'] = [
        'tam_tinh' => 0,
        'phivanchuyen' => 0,
        'giam_gia' => 0,
        'tong_tien' => 0,
        'ma_khuyen_mai' => '',
    ];
}

//  Kiểm tra session
echo "<script>
        console.log('Session ma_nguoi_dung: " . $_SESSION['ma_nguoi_dung'] . "');
      </script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phương Thức Thanh Toán</title>
    <link rel="stylesheet" href="./Style/thanhtoan.css">
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

</head>
<body>
    <!-- Phần đầu trang web -->
    <article>
      <nav>
        <div class="logo">
          <img src="Img/fresh-fruit-logo_25327-200.jpg" />
        </div>
        <ul style="margin-top:12px;" >
          <li><a href="Trangchu.php" style="text-decoration: none;">Trang chủ</a></li>
          <li><a href="#About" style="text-decoration: none;">Sản phẩm</a></li>
          <li><a href="#Menu" style="text-decoration: none;">Tin tức</a></li>
          <li><a href="#Review" style="text-decoration: none;">Giới thiệu</a></li>
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
    <div class="order-summary">
        <h2>Vận chuyển và đơn hàng đã đặt</h2>
        <ul>
        <li>Khách Hàng: <?php echo isset($_SESSION['shipping_info']['name']) ? $_SESSION['shipping_info']['name'] : ''; ?></li>
        <li>Email: <?php echo isset($_SESSION['shipping_info']['email']) ? $_SESSION['shipping_info']['email'] : ''; ?></li>
        <li>Số điện thoại: <?php echo isset($_SESSION['shipping_info']['phone']) ? $_SESSION['shipping_info']['phone'] : ''; ?></li>
        <li>Địa chỉ nhận hàng: <?php echo isset($_SESSION['shipping_info']['address']) ? $_SESSION['shipping_info']['address'] : ''; ?></li>
        <li>Phí vận chuyển: <?php echo number_format($_SESSION['payment_info']['phivanchuyen'], 0, ',', '.'); ?> đ</li>
        <li>Giảm giá: <?php echo number_format($_SESSION['payment_info']['giam_gia'], 0, ',', '.'); ?> đ</li>
        <li>Tổng tiền: <?php echo number_format($_SESSION['payment_info']['tong_tien'], 0, ',', '.'); ?> đ</li>
        </ul>
        <table>
            <tr>
                <th>Mã sp</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá sản phẩm</th>
                <th>Thành tiền</th>
            </tr>
            </tr>
            <?php foreach ($_SESSION['giohang'] as $item): ?>
                <tr>
                    <td style="text-align:center;"><?php echo $item['id']; ?></td>
                    <td style="text-align:center;"><?php echo $item['tensp']; ?></td>
                    <td style="text-align:center;"><img src="Img/<?php echo $item['img']; ?>" alt="Hình ảnh sản phẩm"></td>
                    <td style="text-align:center;"><?php echo $item['soluong']; ?></td>
                    <td style="text-align:center;"><?php echo number_format($item['gia'], 0, ',', '.'); ?> đ</td>
                    <td style="text-align:center;"><?php echo number_format($item['soluong'] * $item['gia'], 0, ',', '.'); ?> đ</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="payment-method">
            <h3>Chọn hình thức thanh toán</h3>
            <form action="xu_ly_don_hang.php" method="POST">
                <?php 
                require_once 'connect.php';
                $sql_phuongthucthanhtoan = "SELECT * FROM phuong_thuc_thanh_toan";
                $result = mysqli_query($conn,$sql_phuongthucthanhtoan);
                while($rows=mysqli_fetch_assoc($result)){
                   ?> 
                   <input type="radio" id="<?php echo $rows['ma_phuong_thuc']; ?>" name="ma_phuong_thuc_thanh_toan" value="<?php echo $rows['ma_phuong_thuc']; ?>">
                   <label for="<?php echo $rows['ma_phuong_thuc']; ?>"><?php echo $rows['ten_phuong_thuc'];?></label><br>
                   <?php
                }
                ?>
                <p>Tổng tiền cần thanh toán: <?php echo number_format($_SESSION['payment_info']['tong_tien'], 0, ',', '.'); ?>đ</p>
                <input type="hidden" name="ma_nguoi_dung" value="<?php echo isset($_SESSION['ma_nguoi_dung']) ? $_SESSION['ma_nguoi_dung'] : ''; ?>">
                   <input type="hidden" name="ten_nguoi_mua" value="<?php echo $_SESSION['shipping_info']['name']; ?>">
                   <input type="hidden" name="email_nguoi_mua" value="<?php echo $_SESSION['shipping_info']['email']; ?>">
                   <input type="hidden" name="so_dien_thoai_nguoi_mua" value="<?php echo $_SESSION['shipping_info']['phone']; ?>">
                   <input type="hidden" name="dia_chi_nguoi_mua" value="<?php echo $_SESSION['shipping_info']['address']; ?>">
                   <input type="hidden" name="tong_tien" value="<?php echo $_SESSION['payment_info']['tong_tien']; ?>">
                   <input type="hidden" name="ma_khuyen_mai" value="<?php echo $_SESSION['payment_info']['ma_khuyen_mai']; ?>">
                <button type="submit" id="complete_pay" data-toggle="modal" data-target="#myModal" >Xác nhận thanh toán</button>
                <button type="button" class="btn btn-success" onclick="back()" style="margin-top:5px;">Home <i class="fa-solid fa-house"></i></button>
            </form>
            
        </div>
    </div>

<script>
    function back(){
        window.location.href = "Trangchu.php";
    }
</script>

    <script src="script.js"></script>
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
    <script>
         document.addEventListener("DOMContentLoaded", function () {
            // Update cart icon
            function updateCartIcon() {
                const cartIcon = document.querySelector(".fa-cart-shopping");
                const productCount = localStorage.getItem("cartItemCount") || 0;
                cartIcon.setAttribute("number", productCount);
            }

            updateCartIcon();
        });
    </script>


<script>

document.addEventListener("DOMContentLoaded", function () {
  const complete_pay = document.getElementById("complete_pay");

  complete_pay.addEventListener("click", function (event) {
    var ischecked = false;
    var phuongthucradio = document.getElementsByName("ma_phuong_thuc_thanh_toan");

    for (let i = 0; i < phuongthucradio.length; i++) {
      if (phuongthucradio[i].checked) {
        ischecked = true;
        break;
      }
    }

    if (!ischecked) {
      alert("Vui lòng chọn một phương thức thanh toán.");
      event.preventDefault(); // Ngăn không cho mở modal nếu chưa chọn phương thức thanh toán
      window.location.href = "thanhtoandonhang.php"; // Chuyển hướng về trang pay.html
    } 
  });
});
  </script>

</body>
</html>
