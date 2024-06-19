<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="./Style/Quenmatkhau.css?v = <?php echo time();?>">
</head>
<body>
    <div class="container">
        <div class="orangeBG">
            <div class="box forgotpassword">
                <h2><b>Quên Mật Khẩu</b></h2>
                <!-- <p>Nhập địa chỉ email của bạn bên dưới để đặt lại mật khẩu.</p> -->
                <form id="emailForm" action="Quenmatkhau_Email.php" method="post">
                    <input type="text" id="so_dien_thoai" placeholder="Số điện thoại" name="so_dien_thoai" required>
                    <input type="email" id="email" placeholder="Địa chỉ Email" name="email" required>
                    <input type="submit" value="Gửi">
                </form>
                <div class="navigation-buttons">
                    <button onclick="window.location.href='Dangnhap_Index.php'">Quay lại Đăng Nhập?</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./Dangnhap_Index.php"></script>
    <script src="./Quenmatkhau_Index.php"></script>
</body>
</html>
