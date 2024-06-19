<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="./Style/Quenmatkhau.css">
</head>
<body>
    <div class="container">
        <div class="orangeBG">
            <div class="box forgotpassword">
                <h2><b>Quên Mật Khẩu</b></h2>
                <div id="resetPasswordForm">
                    <p>Nhập mật khẩu mới của bạn bên dưới.</p>
                    <form action="Quenmatkhau_DatLai.php" method="post">
                        <input type="password" placeholder="Mật Khẩu Mới" name="mat_khau_moi" required>
                        <input type="password" placeholder="Xác Nhận Mật Khẩu" name="nhap_lai_mat_khau" required>
                        <input type="submit" value="Đặt Lại Mật Khẩu">
                    </form>
                </div>
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
