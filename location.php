<?php 
// test phần lọc quận huyện tỉnh thành từ sql
$servername='localhost';
$user='root';
$pass='';
$db='address';
$conn=mysqli_connect($servername,$user,$pass,$db);

$sql = "SELECT * FROM district";
$sql_city = "SELECT * FROM city";
$sql_ward = "SELECT * FROM ward";


$result = mysqli_query($conn, $sql);
if (!$result) {
    mysqli_close($conn);
}

$result_city = mysqli_query($conn, $sql_city);
if (!$result_city) {
  mysqli_close($conn);
}

$result_ward = mysqli_query($conn, $sql_ward);
if (!$result_ward) {
  mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fruit store</title>
    <link rel="stylesheet" href="./Style/Loction.css" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <!-- Phần đầu trang web -->
    <article>
      <nav>
        <div class="logo">
          <img src="./img/logo.png" />
        </div>
        <ul>
          <li><a href="./Trangchu.html">Trang chủ</a></li>
          <li><a href="#About">Sản phẩm</a></li>
          <li><a href="#Menu">Tin tức</a></li>
          <li><a href="#Gallary">Liên hệ</a></li>
          <li><a href="#Review">Giới thiệu</a></li>
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
          <a href="./giohang.html" class="cart-icon"
            ><i class="fa-solid fa-cart-shopping" number="0"></i
          ></a>
          <a href="./Dangnhap.html" class="Login_btn">Login</a>
        </div>
      </nav>
    </article>
    <!-- than -->
    <section>
      <div class="title">
        <div class="tieude">
          <a href="./Trangchu.html"><h1>FRUIT STORE</h1></a>
        </div>
        <div class="dieukhien">
          <ul>
            <li><a href="./giohang.html">Giỏ hàng</a> <span> > </span></li>
            <li><a href="#">Thông tin giao hàng</a> <span> > </span></li>
            <li>phương thức thanh toán</li>
          </ul>
        </div>
        <div>
          <h2>Thông tin giao hàng</h2>
        </div>
      </div>
      <!-- noidung -->
      <form action="">
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
                value=""
                required
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
                    value=""
                  />
                </div>
                <div>
                  <label for="phone">Số điện thoại</label>
                  <input
                    class="phone"
                    type="text"
                    id="phone"
                    name="txtphone"
                    value=""
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
              />
            </td>
          </tr>
          <tr id="info_an2" style="display: flex">
            <td colspan="3">
              <select id="city" name="city">
                <option value="">Chọn tỉnh / thành</option>
                <!-- Thêm các tùy chọn khác vào đây -->
                 <!-- test nha -->
                 <?php 
                 while($row_city = mysqli_fetch_assoc($result_city)){
                  ?>
                  <option value="<?php echo $row_city['city_id']; ?>"> <?php echo $row_city['name']; ?></option>
                  <?php
                 }
                 ?>
              </select>
            </td>
            <td colspan="3">
              <select id="district" name="district">
                <option value="">Chọn quận / huyện</option>
                <!-- Thêm các tùy chọn khác vào đây -->
                 <!-- test nha -->
                 <?php 
                 while($row_district = mysqli_fetch_assoc($result)){
                  ?>
                  <option value="<?php echo $row_district['district_id'] ?>"><?php echo $row_district['name_district']; ?></option>
                  <?php
                 }
                 ?>
              </select>
            </td>
            <td colspan="3">
              <select id="ward" name="ward">
                <option value="">Chọn phường / xã</option>
                <!-- test nha -->
                <?php 
                 while($row_ward = mysqli_fetch_assoc($result_ward)){
                  ?>
                  <option value="<?php echo $row_ward['ward_id'] ?>"><?php echo $row_ward['name']; ?></option>
                  <?php
                 }
                 ?>
                <!-- Thêm các tùy chọn khác vào đây -->
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3" style="display: flex; text-align: right">
              <input type="checkbox" id="ckbstore" name="ckbstore" />
              <label style="margin-left: 7px" for="ckbstore"
                >Nhận tại cửa hàng</label
              >
            </td>
          </tr>
          <tr id="storeInfomation" style="display: none">
            <td colspan="3">
              <div style="justify-content: center; text-align: center">
                <p>
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
                <option value="">Mã Ship/Mã giảm giá</option>
                <!-- Thêm các tùy chọn khác vào đây -->
              </select>
              <div class="button_apdung">
                <input type="button" name="btnapdung" value=" Áp Dụng" />
              </div>
            </td>
          </tr>
          <tr>
            <td>Tạm tính</td>
            <td>
              <div class="tamtinh"><span>320.000</span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td>Phí vận chuyển</td>
            <td>
              <div class="tamtinh"><span>30.000</span><sup>đ</sup></div>
            </td>
          </tr>
          <tr>
            <td><strong>Tổng tiền</strong></td>
            <td>
              <strong class="tamtinh"><span>350.000</span><sup>đ</sup></strong>
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
        window.location.href = "./pay.html";
      }
    </script>
    <script src="JS/location.js"></script>
  </body>
</html>
