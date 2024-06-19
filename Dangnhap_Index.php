<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Style/Dangnhap.css">
</head>
<body>
    <div class="container">
        <div class="orangeBG">
            <div class="box signin">
                <h2>Tạo một tài khoản?</h2>
                <button class="signinbtn">Đăng nhập</button>
            </div>
            <div class="box signin">
                <h2>Bạn đã có tài khoản chưa?</h2>
                <button class="signupbtn">Đăng ký</button>
            </div>
        </div>
        <div class="form-box">
            <div class="form signinform">
                <form action="DangNhap.php" method="post">
                    <h3>Đăng nhập</h3>
                    <input type="text" placeholder="Số điện thoại" name="so_dien_thoai" required>
                    <input type="password" placeholder="Mật khẩu" name="mat_khau" required>
                    <input type="submit" value="Đăng nhập">
<!-- <<<<<<<< HEAD:Dangnhap.php -->
                    <a href="Quenmatkhau.php">Quên mật khẩu?</a>
<!-- ======== -->
                    <a href="./Quenmatkhau_IndexEmail.php">Quên mật khẩu?</a>
<!-- >>>>>>>> d02620c53d929759e4284523b6281fe7d4d399d9:Dangnhap_Index.php -->
                </form>
            </div>
            <div class="form signupform">
                <form action="DangKy.php" method="post">
                    <h3>Đăng ký</h3>
                    <input type="text" placeholder="Họ và tên" name="ho_ten" required>
                    <input type="text" placeholder="Số điện thoại" name="so_dien_thoai" required>
                    <input type="email" placeholder="Địa chỉ Email" name="email" required>
                    <input type="password" placeholder="Mật khẩu" name="mat_khau" required>
                    <input type="password" placeholder="Nhập lại mật khẩu" name="nhap_lai_mat_khau" required>
                    <input type="submit" value="Đăng ký">
                </form>
            </div>
        </div>
    </div>


    <script src="./JS/Dangnhap.js"></script>
</body>
</html>