<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream:Trangchu.php
    <title>Document</title>
    <link rel="stylesheet" href="./Style/Trangchu.css?v = <?php echo time();?>">
=======
    <title>Trang chủ</title>
    <link rel="stylesheet" href="./Style/Trangchu.css">
>>>>>>> Stashed changes:Trangchu.html
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Phần đầu trang web -->
    <section>
        <nav>
            <div class="logo">
<<<<<<< Updated upstream:Trangchu.php
                <img src="https://img.freepik.com/premium-vector/fresh-fruit-logo_25327-200.jpg?w=2000">
=======
                <img src="./Img/snapedit_1716797293114.jpeg">
>>>>>>> Stashed changes:Trangchu.html
            </div>

            <ul style="margin-left: 190px">
                <li><a href="#Home">Trang chủ</a></li>
                <li><a href="./menu.html">Sản phẩm</a></li>
                <li><a href="#Menu">Tin tức</a></li>
                <li><a href="#Review">Giới thiệu</a></li>
            </ul>

            <div class="search-container" style="margin-left:-150px">
                <form action="/search" method="get">
                    <input type="text" placeholder="Tìm kiếm..." name="query">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass" style="margin-left:-1px"></i></button>
                </form>
            </div>

            <i class="fa-solid fa-cart-shopping" ></i>

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


        <!-- ---------------Giới thiệu------------------- -->
        <div class="main" id="Home">
            <div class="men_text">
                <h1>The Fresh and<br>Organic<span>Fruits</span></h1>
            </div>

            <div class="main_img">
                <img src="./img/—Pngtree—summer beach_9047594.png" alt="">
            </div>
        </div>

        <p>
            Xin chào! Chúng tôi hân hạnh giới thiệu đến quý khách hàng những loại trái cây nhập khẩu tươi ngon, chất lượng cao
            từ khắp nơi trên thế giới. Với tiêu chí mang đến cho khách hàng những sản phẩm an toàn và bổ dưỡng, chúng tôi đã
            lựa chọn kỹ càng các đối tác uy tín từ những quốc gia có nền nông nghiệp tiên tiến.
        </p>

        <div class="main_btn">
            <a href="#">Order Now</a>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </section>


    

    <!-- ----------------About----------------- -->
    <div class="about" id="About">
        <div class="about_main">

            <div class="img">
                <img src="./img/—Pngtree—3d illustration mango fruit splash_15290716.png" alt="">
            </div>

            <div class="about_text">
                <h1><span>About</span>Us</h1>
                <h3>Why Choose Us?</h3>
                <p>
                    Tại đây, sứ mệnh của chúng tôi là mang đến cho khách hàng những trải nghiệm tuyệt vời về hương vị 
                    và dinh dưỡng qua những loại trái cây nhập khẩu tươi ngon và chất lượng cao nhất. Chúng tôi không chỉ
                    đơn thuần là nhà cung cấp trái cây, mà còn là người bạn đồng hành trong hành trình chăm sóc sức khỏe
                    và nâng cao chất lượng cuộc sống của bạn. Chúng tôi tin rằng với những nỗ lực không ngừng, chúng tôi
                    sẽ là lựa chọn hàng đầu cho những ai yêu thích và trân trọng giá trị của trái cây nhập khẩu.
                </p>
            </div>
        </div>

        <div class="main_btn">
            <a href="#">Order Now</a>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </div>


    <!-- -------------------Sản phẩm------------------ -->

    <div class="menu" id="Menu">
        <h1>Our<span>Menu</span></h1>
        <!-- Dứa -->
        <div class="menu_box">
            <div class="menu_card">
                <div class="menu_img">
                    <img src="./img/pngegg.png" alt="">
                </div>

                <div class="small_card">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <div class="menu_info">
                    <h2>Dứa</h2>
                    <p>
                        Hương Vị: Ngọt thanh, chua nhẹ, giòn, mọng nước và thơm mát.<br>
                        Dinh Dưỡng: Giàu vitamin C, mangan, chất xơ và enzyme bromelain.
                    </p>
                    <h3>$1.99</h3>
                    <div class="menu_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <a href="#" class="menu_btn">Learn More</a>
                </div>
                <div class="card_shopping">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            
            <!-- Táo -->


            <div class="menu_card">
                <div class="menu_img">
                    <img src="./img/pngegg (3).png" alt="">
                </div>

                <div class="small_card">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <div class="menu_info">
                    <h2>Táo</h2>
                    <p>
                        Hương Vị: Ngọt thanh, chua nhẹ, giòn, mọng nước và thơm mát.<br>
                        Dinh Dưỡng: Giàu vitamin C, mangan, chất xơ và enzyme bromelain.
                    </p>
                    <h3>$1.99</h3>
                    <div class="menu_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <a href="#" class="menu_btn">Learn More</a>
                </div>
                <div class="card_shopping">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            
            <!-- Lựu -->

            <div class="menu_card">
                <div class="menu_img">
                    <img src="./img/pngegg (2).png" alt="">
                </div>

                <div class="small_card">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <div class="menu_info">
                    <h2>Lựu</h2>
                    <p>
                        Hương Vị: Ngọt thanh, chua nhẹ, giòn, mọng nước và thơm mát.<br>
                        Dinh Dưỡng: Giàu vitamin C, mangan, chất xơ và enzyme bromelain.
                    </p>
                    <h3>$1.99</h3>
                    <div class="menu_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <a href="#" class="menu_btn">Learn More</a>
                </div>
                <div class="card_shopping">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>

            <!-- Cam -->

            <div class="menu_card">
                <div class="menu_img">
                    <img src="./img/pngegg (1).png" alt="">
                </div>

                <div class="small_card">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <div class="menu_info">
                    <h2>Cam</h2>
                    <p>
                        Hương Vị: Ngọt thanh, chua nhẹ, giòn, mọng nước và thơm mát.<br>
                        Dinh Dưỡng: Giàu vitamin C, mangan, chất xơ và enzyme bromelain.
                    </p>
                    <h3>$1.99</h3>
                    <div class="menu_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <a href="#" class="menu_btn">Learn More</a>
                </div>
                <div class="card_shopping">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- ----------------Nhà cung cấp----------------- -->
    <!-- <div class="supplier">
        <h1>Our<span>Supplier</span></h1>

        <div class="supplier_box">
            <div class="profile">
                <img src="" alt="">

                <div class="info">
                    <h2 class="name">Supplier</h2>
                    <p></p>


                </div>
            </div>
        </div>
    </div> -->





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
                <h2 >CHÍNH SÁCH - QUY ĐỊNH</h2>
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