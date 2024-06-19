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
                <h2>Quên Mật Khẩu</h2>
                <!-- <p>Nhập địa chỉ email của bạn bên dưới để đặt lại mật khẩu.</p> -->
                <form id="emailForm">
                    <input type="email" id="email" placeholder="Địa chỉ Email" required>
                    <input type="submit" value="Gửi">
                </form>
                <div id="resetPasswordForm" style="display:none;">
                    <p>Nhập mật khẩu mới của bạn bên dưới.</p>
                    <form>
                        <input type="password" id="newPassword" placeholder="Mật Khẩu Mới" required>
                        <input type="password" id="confirmPassword" placeholder="Xác Nhận Mật Khẩu" required>
                        <input type="submit" value="Đặt Lại Mật Khẩu">
                    </form>
                </div>
                <div class="navigation-buttons">
                    <button onclick="window.location.href='Dangnhap.html'">Quay lại Đăng Nhập?</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./Dangnhap.html"></script>
    <script src="./Quenmatkhau.html"></script>
</body>
</html>
