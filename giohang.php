<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./Style/giohang.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        <div class="icon">
          <a href="#"><i id="cart-icon" class="fa-solid fa-cart-shopping" number="0"></i></a>
          <a href="Dangnhap.php" class="Login_btn">Đăng Nhập</a>
        </div>
      </nav>
    </article>
    <!-------gio hang-------------->
    <section class="cart">
      <div class="container">
        <div class="cart-content">
          <div class="cart-content-tables">
            <div class="cart-content-left">
              <form action="">
                <table>
                  <thead>
                    <tr>
                      <th colspan="4" class="title">
                        <h2><b>Giỏ hàng của bạn</b></h2>
                      </th>
                    </tr>
                    <tr class="title2">
                      <th>Sản Phẩm</th>
                      <th>Giá</th>
                      <th>Số Lượng</th>
                      <th>Chọn</th>
                    </tr>
                  </thead>
                  <tbody class="danhmuc">
                    <!-- lay ds tu csdl in ra   -->
                     <?php 
                     require_once 'connect.php';
                     $select_giohang = "SELECT gh.ma_gio_hang , sp.ten_san_pham ,sp.url_hinh_anh, sp.gia, gh.tong_tien , gh.so_luong FROM gio_hang gh INNER JOIN san_pham sp ON gh.ma_san_pham = sp.ma_san_pham  ";
                     
                     $result = mysqli_query($conn,$select_giohang);
                     while($rows = mysqli_fetch_assoc($result)){
                      ?>
                      <tr class="product_rows">
                      <td>
                        <img   src="<?php echo $rows['url_hinh_anh']; ?>" alt="" /><?php echo $rows['ten_san_pham'];?>
                      </td>
                      <td>
                        <p><span class="price" ><?php echo $rows['so_luong']*$rows['gia'];  ?></span><sup>đ</sup></p>
                      </td>
                      <td>
                        <input
                        
                          style="width: 35px; outline: none"
                          type="number"
                          value="<?php echo $rows['so_luong'];  ?>"
                          min="1"
                        />
                      </td>
                      <td style="cursor: pointer">
                        <a
                          href="xoa_gio_hang.php?get_ma_gio_hang=<?php echo $rows['ma_gio_hang']; ?>"
                          class="btn btn-danger"
                          onclick=" return confirm('bạn có muốn xóa không ?')"
                          ><i class="fas fa-trash-alt"></i
                        ></a>
                      </td>
                    </tr>
                      <?php
                     }
                     ?>
                  </tbody>
                </table>
              </form>
              <div class="continue-shopping">
                <a href="Trangchu.php" class="btn btn-primary">← Tiếp tục mua hàng</a>
              </div>
            </div>
            <div class="cart-content-right">
              <table>
                <tr class="dd1">
                  <th colspan="2" ><h2><b>THÔNG TIN ĐƠN HÀNG</b></h2></th>
                </tr>
                <div class="dd2">
                  <tr>
                    <td>Tổng Sản Phẩm:</td>
                    <td id="total-products" >0</td>
                  </tr>
                  <tr>
                    <td>Tổng Tiền Hàng:</td>
                    <td id="total-price" >0đ</td>
                  </tr>
                  <tr class="dd5">
                    <td>Tạm tính :</td>
                    <td id="subtotal">0đ</td>
                  </tr>
                </div>
                <tr >
                  <td colspan="2" >
                    <div class="cart-content-right-text">
                      <p>
                        Bạn sẽ được miễn phí vận chuyển nếu đơn hàng của bạn trị
                        giá từ 10.000.000đ trở lên
                      </p>
                    </div>
                  </td>
                </tr>
                <tr >
                  <td colspan="2" >
                    <div class="cart-content-right-text-button">
                      <input
                        type="button"
                        name="btnhome"
                        value="HOME"
                        onclick="Trangchu()"
                      />
                      <input
                        type="submit"
                        name="btnpay"
                        value="THANH TOÁN"
                        onclick="diachi()"
                      />
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
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
    <script>
      function Trangchu() {
        window.location.href = "Trangchu.php";
      }
      function diachi() {
        window.location.href = "location.php";
      }

    </script>
<script src="./JS/giohang.js"></script>



  </body>
</html>
