<?php 
require_once 'connect.php';
$sql = "SELECT *FROM khuyen_mai ";
$result = mysqli_query($conn,$sql);
$giam_gia =0;
if(isset($_POST['btnapdung_KM']) && isset($_POST['voucher'])){
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

$phivanchuyen = 30000;
// Khởi tạo biến $tam_tinh ban đầu là 0
$tam_tinh = 0;
// Kiểm tra xem giá trị 'cartTotalPrice' có tồn tại trong mảng $_POST hay không
if (isset($_POST['cartTotalPrice'])) {
    // Nếu 'cartTotalPrice' tồn tại, lấy giá trị này từ $_POST và gán cho $tam_tinh
    $tam_tinh = (int)$_POST['cartTotalPrice'] ;
    $tam_tinh = $tam_tinh - $giam_gia;
} 
$tong_tien = $tam_tinh+$phivanchuyen;
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

        <div class="icon">
          <a href="giohang.php" class="cart-icon"
            ><i class="fa-solid fa-cart-shopping" number="0"></i
          ></a>
          <a href="Dangnhap.php" class="Login_btn">Đăng Nhập</a>
        </div>
      </nav>
    </article>
    <!-- than -->
    <section>
      <div class="title">
        <div class="tieude">
          <a href="Trangchu.php"><h1>FRUIT STORE</h1></a>
        </div>
        <div class="auth-section">
           <div style="display: flex;">
            <a href="Dangnhap.php" class="btn-login btn btn-dark">ĐĂNG NHẬP</a>
            <a href="Dangnhap.php" class="btn-register btn btn-light">ĐĂNG KÝ</a>
           </div>
            <p>
                Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ FRUIT STORE.
            </p>
         </div>
        <div class="dieukhien">
          <ul>
            <li><a href="./giohang.php">Giỏ hàng</a> <span> > </span></li>
            <li><a href="#">Thông tin giao hàng</a> <span> > </span></li>
            <li>phương thức thanh toán</li>
          </ul>
        </div>
        <div>
          <h2>Thông tin giao hàng</h2>
        </div>
      </div>
      <!-- noidung -->
      <form action="" method = "post">
      <input type="hidden" id="cartTotalPriceInput" name="cartTotalPrice" value="" />
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
                  <label for="phone">Số điện thoại</label>
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
              <label for="address">Địa chỉ</label>
            </td>
          </tr>
          <tr id="info_an1" style="display: flex">
            <td colspan="3">
              <input
                class="address"
                type="text"
                id="address"
                name="txtaddress"
                value ="<?php echo isset($_POST['txtaddress']) ? $_POST['txtaddress'] : ''; ?>"
              />
            </td>
          </tr>
          <tr id="info_an2" style="display: flex">
            <td colspan="3">
              <select id="city" name="city">
                <option value="">Chọn tỉnh / thành</option>
                <!-- Thêm các tùy chọn khác vào đây -->
              </select>
            </td>
            <td colspan="3">
              <select id="district" name="district">
                <option value="">Chọn quận / huyện</option>
                <!-- Thêm các tùy chọn khác vào đây -->
                 
              </select>
            </td>
            <td colspan="3">
              <select id="ward" name="ward">
                <option value="">Chọn phường / xã</option>

                <!-- Thêm các tùy chọn khác vào đây -->
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3" style="display: flex; text-align: right">
              <input type="checkbox" id="ckbstore" name="ckbstore" <?php if(isset($_POST['ckbstore'])) echo "checked"; ?> />
              <label style="margin-left: 7px" for="ckbstore"
                >Nhận tại cửa hàng</label
              >
            </td>
          </tr>
          <tr id="storeInfomation" style="<?php if(isset($_POST['ckbstore'])) echo 'display: block'; else echo 'display: none'; ?>" >
            <td colspan="3">
              <div style="justify-content: center; text-align: center">
                <p >
                  Địa chỉ: Số 16 Nguyễn Xiển - Phường Thanh Xuân Nam - Quận
                  Thanh Xuân- Hà Nội
                </p>
                <p>Sđt: 0941234789 - 0942568456</p>
              </div>
            </td>
          </tr>
        </table>
        <!-- table-left -->
        <table class="ship">
          
            <tr>
            <td style="display: flex">
              <select id="voucher" name="voucher">
                <option value="">Mã free Ship/Mã giảm giá</option>
                <?php 
                while($rows_KM = mysqli_fetch_assoc($result)){
                 
                  echo '<option value="' . $rows_KM['ma_khuyen_mai'] . '">' . $rows_KM['ten_khuyen_mai'] . '</option>';
                
                }
                ?>
                <!-- Thêm các tùy chọn khác vào đây -->
              </select>
              <div class="button_apdung">
                <button type="submit" name="btnapdung_KM" >Áp dụng</button>
              </div>
            </td>
          </tr>
          
          <tr>
            <td>Giảm</td>
            <td>
              <div class="giam_gia"><span id="giamgia-value" ><?php echo $giam_gia; ?></span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td>Tạm tính</td>
            <td>
              <div class="tamtinh"><span id="tamtinh-value" ><?php echo $tam_tinh; ?> </span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td>Phí vận chuyển</td>
            <td>
              <div class="phivanchuyen"><span><?php echo $phivanchuyen; ?></span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td><strong>Tổng tiền</strong></td>
            <td>
              <strong class="tongtien"><span id="total-value"><?php echo $tong_tien; ?></span><sup>đ</sup></strong>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="buttun_thanhtoan">
                <input
                  type="button"
                  name="btnthanhtoan"
                  value=" Hoàn tất thanh toán"
                  onclick="pay()"
                />
              </div>
            </td>
          </tr>
        </table>
      </form>
    </section>
    <script>
      function pay() {
        window.location.href = "./pay.php";
      }

      document.addEventListener("DOMContentLoaded", (event) => {
        function updateCartIcon() {
          const cartIcon = document.querySelector(".fa-cart-shopping");
          const productCount = localStorage.getItem("cartItemCount") || 0;
          cartIcon.setAttribute("number", productCount);
        }
        // Gọi hàm để cập nhật biểu tượng giỏ hàng khi tải trang
        updateCartIcon();

        function setCartTotalPrice(){
           // Lấy giá trị từ localStorage
           var cartTotalPrice = localStorage.getItem("cartTotalPrice");
            // Đặt giá trị vào input ẩn
            document.getElementById("cartTotalPriceInput").value = cartTotalPrice;
            var tamTinhValue = parseInt(cartTotalPrice) || 0;
 var giamGiaValue = parseInt(document.getElementById("giamgia-value").innerText) || 0;
 var phiVanChuyenValue = parseInt(document.querySelector(".phivanchuyen span").innerText) || 0;

var tamTinh = tamTinhValue - giamGiaValue;
 var tongTien = tamTinh + phiVanChuyenValue;

document.getElementById("tamtinh-value").innerText = tamTinh;
 document.getElementById("total-value").innerText = tongTien;
        }
        setCartTotalPrice();
      });
    </script>
    <script src="JS/location.js"></script>
  </body>
</html>

