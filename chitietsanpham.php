<?php
require_once 'connect.php';
$ma_san_pham=$_GET['ma_san_pham'];
$edit_sql="SELECT * FROM san_pham WHERE ma_san_pham='$ma_san_pham'";
$result = mysqli_query($conn,$edit_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


    
        <div class="container">
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <form action="./gio_hang/addtocart_chitietsp.php" method="post">
            <input type="hidden" name="tensp" value="<?php echo $r['ten_san_pham']; ?>">
            <input type="hidden" name="img" value="<?php echo $r['url_hinh_anh']; ?>">
            <input type="hidden" name="gia" value="<?php echo $r['gia']; ?>">
            <input type="hidden" name="id" value="<?php echo $r['ma_san_pham'] ?>">
            <input type="hidden" name="soluong" id="hidden-quantity" value="1">
            <div class="products">
              <div class="card">
              <div class="row">
      <div class="col">
      <div class="products-img">
                <img src="Img/<?php echo $r['url_hinh_anh']; ?>" class="img">
                </div>
      </div>
      <div class="col">
      <div class="products-content">
                  <h2 class="products-title"><?php echo $r['ten_san_pham']; ?></h2>  
                <div class="products-price">
                    <p><span>Giá <?php echo $r['gia']; ?> VND</span></p>   
                </div>  
                <div class="products-detail">
                 <h2>Mô tả</h2>
                 <p><?php echo $r['mo_ta']; ?></p>
                </div>
                <div class="purchase-info">
                    <input type="number" min="0" value="1" id="quantity" name="quantity" max="<?php echo $r['ton_kho'] ; ?>"onchange="updateQuantity();"><br>
                    <input type="submit" value="Thêm Vào giỏ hàng" name= "btn_add_to_cart">
                </div>
                </form>
                <div class="social-links">
                    <p>Chia sẻ: </p>
                    <a href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
    </div>
  </div>
        </div>
        </div>
            <?php } ?>
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
      //update số lượng sản phẩm 
      function updateQuantity() {
            const quantityInput = document.getElementById('quantity');
            const hiddenQuantityInput = document.getElementById('hidden-quantity');
            hiddenQuantityInput.value = quantityInput.value;
        }
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
        //kiểm tra số lượng
        // function check() {
        //     var quantityInput = document.getElementById('quantity');
        //     var quantity = parseInt(quantityInput.value);
        //     var maxQuantity = parseInt(quantityInput.max);

        //     if (quantity > maxQuantity) {
        //         alert('Số lượng sản phẩm không đủ trong kho. Vui lòng chọn lại số lượng.');
        //         return false; // Ngăn không cho gửi biểu mẫu
        //     }

        //     // Cập nhật giá trị vào input hidden trước khi gửi biểu mẫu
        //     document.getElementById('soluong').value = quantity;
        //     return true;
        // }

        // function updateQuantity() {
        //     var quantityInput = document.getElementById('quantity');
        //     document.getElementById('soluong').value = quantityInput.value;
        // }
    </script>
</body>
</html>