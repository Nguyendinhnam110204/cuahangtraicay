<?php
require_once 'connect.php';
session_start();

if (!isset($_SESSION['ma_nguoi_dung'])) {
    echo "<script>
            alert('Phiên làm việc của bạn đã hết hạn. Vui lòng thử lại.');
            window.location.href = 'Quenmatkhau_IndexEmail.php';
        </script>";
    exit();
}

$ma_nguoi_dung = $_SESSION['ma_nguoi_dung'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mat_khau_moi = trim($_POST['mat_khau_moi']);
    $nhap_lai_mat_khau = trim($_POST['nhap_lai_mat_khau']);

    if ($mat_khau_moi !== $nhap_lai_mat_khau) {
        echo "<script>
                alert('Mật khẩu nhập lại không khớp. Vui lòng thử lại.');
                window.location.href = 'Quenmatkhau_IndexDatLai.php';
            </script>";
        exit();
    }

    $mat_khau_ma_hoa = password_hash($mat_khau_moi, PASSWORD_DEFAULT);

    // Cập nhật mật khẩu mới vào cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE nguoi_dung SET mat_khau = ? WHERE ma_nguoi_dung = ?");
    $stmt->bind_param("ss", $mat_khau_ma_hoa, $ma_nguoi_dung);

    if ($stmt->execute()) {
        // Đặt lại mật khẩu thành công, thông báo và chuyển hướng đến trang đăng nhập
        echo "<script>
                alert('Đặt lại mật khẩu thành công. Vui lòng đăng nhập lại.');
                window.location.href = 'Dangnhap_Index.php';
            </script>";
    } else {
        // Xảy ra lỗi trong quá trình cập nhật mật khẩu
        echo "<script>
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
                window.location.href = 'Quenmatkhau_IndexDatLai.php';
            </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
