<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ Hàng</title>
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
    <link rel="stylesheet" href="./Style/payment.css?v = <?php echo time();?>" />
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
          <img src="Img/fresh-fruit-logo_25327-200.jpg" />
        </div>
        <ul style="margin-top:12px;">
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
      <!-- Phần nội dung chính -->
      <div class="main-content">
        <!-- Tiêu đề và phần đăng nhập/đăng ký -->
        <div class="header">
          <div class="title">
            <a href="Trangchu.php"><h2>FRUIT STORE</h2></a>
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
        </div>
      </div>
    <!-- than -->
    <section>
        <div class="dieukhien">
          <ul>
            <li><a href="giohang.php">Giỏ hàng</a> <span> > </span></li>
            <li>
              <a href="location.php">Thông tin giao hàng</a> <span> > </span>
            </li>
            <li><a href="#">phương thức thanh toán</a></li>
          </ul>
        </div>
        <div style="text-align: center;">
          <h3>Hãy chọn phương thức thanh toán</h3>
        </div>
      </div>
      <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="thanhtoanmomo/xulythanhtoanmomo.php">
        <!-- chứa giá trị tổng tiền -->
      <input type="hidden" id="cartTotalPriceInput" name="cartTotalPrice" value="" />
        <table class="pay_table">
          <tr>
            <td>
               <input type="radio" id="cod" name="payment" value="cod" />
              <label for="cod">
                <img src="./Img/cod2.jpg" alt="COD" />
                Thanh toán khi giao hàng  ('Trả Sau')
              </label>
            </td>
          </tr>
          <tr>
            <td>
              <input type="radio" id="cash" name="payment" value="cash" />
              <label for="cash">
                <img src="./Img/Airtel-Business-Solution-Graphics-5.webp" alt="cash"  />
                Thanh toán tại cửa hàng ('Trả Sau')
              </label>
            </td>
          </tr>
          <tr id="momo_row" >
            <td>
              <div>
                 <input style="height:40px;" type="submit"  name="momo" value="Thanh Toán MoMo QRcode" class="btn btn-danger" />
              </div>
               <label for="momo">
                <img src="Img/momo2.jpg" alt="momoQR" />
                Chuyển khoản qua MOMO_QR ('Trả trước')
              </label>
            </td>
          </tr>
        </table>
        <!-- <div id="bidv" style="display: none; text-align: center">
          <img style="width: 460px" src="./Img/IMG_0428.JPG" alt="" />
          <div class="contentck">
            <p class="noidung">
              Nội dung chuyển khoản:CK+sđtKH+TenKH+16nguyenxien
            </p>
            <p class="vidu">VD : CK+0123456789+nguyenvana+16nguyenxien</p>
          </div>
        </div> -->


<!-- bootrap  -->
<div class="container">
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="complete_pay">
    Hoàn tất lựa chọn
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Đơn hàng của bạn đã được đặt thành công! Chúng tôi sẽ xác nhận trong thời gian sớm nhất.</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" style="text-align: center;">
          <p>Cảm ơn bạn đã tin tưởng và mua sắm tại FRUIT STORE! <span><i class="fa-solid fa-heart" style="color: red;"></i>&nbsp;<i class="fa-solid fa-heart" style="color: red;"></i></span></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="modalOKButton" class="btn btn-primary">OK</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>  
 </form>
<!-- bootrap 4  -->

        <!-- js -->
        <script src="./JS/pay.js"></script>
       <script>

document.addEventListener("DOMContentLoaded", function () {
  const complete_pay = document.getElementById("complete_pay");
  const phuongthucradio = document.getElementsByName("payment");

  complete_pay.addEventListener("click", function (event) {
    var ischecked = false;
    for (let i = 0; i < phuongthucradio.length; i++) {
      if (phuongthucradio[i].checked) {
        ischecked = true;
        break;
      }
    }
    if (!ischecked) {
      alert("Vui lòng chọn một phương thức thanh toán.");
      event.preventDefault(); // Ngăn không cho mở modal nếu chưa chọn phương thức thanh toán
      window.location.href = "pay.php"; // Chuyển hướng về trang pay.html
    } else {
      // Hiển thị modal nếu đã chọn phương thức thanh toán
      $('#myModal').modal('show');
    }
  });

  // Xử lý khi modal được hiển thị
  $('#myModal').on('shown.bs.modal', function (e) {
    // Thêm sự kiện click cho nút "OK" trong modal
    $('#modalOKButton').on('click', function() {
      window.location.href = "pay.php"; // Chuyển hướng về trang pay.html khi ấn nút "OK"
    });
  });
});

       </script>

        <!-- js -->
   
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


        function setCartTotalPrice(){
          // Lấy giá trị từ localStorage
          var cartTotalPrice = localStorage.getItem("totalAmountToPay");
            // Đặt giá trị vào input ẩn
          document.getElementById("cartTotalPriceInput").value = cartTotalPrice;
        }
        setCartTotalPrice();
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
