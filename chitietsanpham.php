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
                <img src="./Img/snapedit_1716797293114.jpeg">
            </div>
            <ul>
                <li><a href="./Trangchu.html">Trang chủ</a></li>
                <li><a href="./menu.html">Sản phẩm</a></li>
                <li><a href="#Menu">Tin tức</a></li>
                <li><a href="#Gallary">Liên hệ</a></li>
                <li><a href="#Review">Giới thiệu</a></li>
            </ul>
            <div class="search-container">
                <form action="/search" method="get">
                    <input type="text" placeholder="Tìm kiếm..." name="query">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="icon">
                <i class="fa-solid fa-cart-shopping"></i>
                <a href="./Dangnhap.html" class="Login_btn">Login</a>
            </div>
        </nav>


    
        <div class="container">
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
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
                    <input type="number" min="0" value="1" max="<?php echo $r['ton_kho']; ?>"><br>
                    <button type="button" class="btn">Thêm vào giỏ hàng</button>
                </div>
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
</body>
</html>