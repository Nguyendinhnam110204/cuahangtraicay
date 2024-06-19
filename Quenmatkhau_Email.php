<?php
require_once 'connect.php';

// Hàm băm email sử dụng sha256
function bam_email($email) {
    return hash('sha256', $email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Làm sạch và kiểm tra dữ liệu đầu vào từ form
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Email không hợp lệ.');
                window.location.href = 'Quenmatkhau_IndexEmail.php';
            </script>";
        exit();
    }

    if (!isset($_POST['so_dien_thoai']) || !preg_match('/^\d{10}$/', $_POST['so_dien_thoai'])) {
        echo "<script>
                alert('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại là mười số.');
                window.location.href = 'Quenmatkhau_IndexEmail.php';
            </script>";
        exit();
    }

    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $so_dien_thoai = trim($_POST['so_dien_thoai']);
    $email_bam = bam_email($email);

    // Lấy tất cả các email đã băm và số điện thoại từ cơ sở dữ liệu để tìm khớp
    $stmt = $conn->prepare("SELECT ma_nguoi_dung FROM nguoi_dung WHERE email = ? AND so_dien_thoai = ?");
    $stmt->bind_param("ss", $email_bam, $so_dien_thoai);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($ma_nguoi_dung);
        $stmt->fetch();

        // Chuyển hướng đến form đặt lại mật khẩu mới
        session_start();
        $_SESSION['ma_nguoi_dung'] = $ma_nguoi_dung; // Lưu trữ ID người dùng trong session để dùng ở trang đặt lại mật khẩu
        echo "<script>
                window.location.href = 'Quenmatkhau_IndexDatLai.php';
            </script>";
    } else {
        echo "<script>
                alert('Không tìm thấy email và số điện thoại này trong hệ thống.');
                window.location.href = 'Quenmatkhau_IndexEmail.php';
            </script>";
    }

    // Đóng statement và kết nối
    $stmt->close();
    $conn->close();
}
?>
