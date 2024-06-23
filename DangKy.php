<?php

require_once 'connect.php';

// Hàm băm email sử dụng sha256
function bam_email($email) {
    return hash('sha256', $email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và thực hiện kiểm tra, làm sạch dữ liệu
    $so_dien_thoai = trim($_POST['so_dien_thoai']);
    $mat_khau = trim($_POST['mat_khau']);
    $nhap_lai_mat_khau = trim($_POST['nhap_lai_mat_khau']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $ho_ten = trim($_POST['ho_ten']);

    if (!preg_match('/^\d{10}$/', $so_dien_thoai)) {
        echo "<script>
            if (confirm('Số điện thoại không hợp lệ. Vui lòng nhập lại số điện thoại là mười số.')) {
                window.location.href = 'Dangnhap_Index.php';
            }
            </script>";
        exit();
    }

    // Kiểm tra mật khẩu phải dài từ 8 đến 30 ký tự và có ít nhất 1 chữ in hoa, 1 chữ số và 1 chữ thường
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,30}$/', $mat_khau)) {
        echo "<script>
            if (confirm('Mật khẩu không hợp lệ. Vui lòng nhập lại mật khẩu dài từ 8 đến 30 ký tự và phải có ít nhất 1 chữ in hoa, 1 chữ số và 1 chữ thường.')) {
                window.location.href = 'Dangnhap_Index.php';
            }
            </script>";
        exit();
    }

    // Kiểm tra xem mật khẩu và nhập lại mật khẩu có khớp nhau không
    if ($mat_khau !== $nhap_lai_mat_khau) {
        echo "<script>
            if (confirm('Mật khẩu nhập lại không trùng khớp. Vui lòng nhập lại?')) {
                window.location.href = 'Dangnhap_Index.php';
            }
            </script>";
        exit();
    }

    // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu chưa
    $stmt_check = $conn->prepare("SELECT ma_nguoi_dung FROM nguoi_dung WHERE so_dien_thoai = ?");
    $stmt_check->bind_param("s", $so_dien_thoai);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "<script>
            if (confirm('Số điện thoại đã tồn tại trong hệ thống. Vui lòng chọn số điện thoại khác.')) {
                window.location.href = 'Dangnhap_Index.php';
            }
            </script>";
        exit();
    }

    // Mã hóa mật khẩu
    $mat_khau_ma_hoa = password_hash($mat_khau, PASSWORD_DEFAULT);

    // Băm email
    $email_bam = bam_email($email);

    // Chuẩn bị câu lệnh SQL với prepared statements để ngăn chặn SQL Injection
    $stmt = $conn->prepare("INSERT INTO nguoi_dung (ma_nguoi_dung, so_dien_thoai, mat_khau, email, ho_ten) VALUES (UUID(), ?, ?, ?, ?)");
    $stmt->bind_param("ssss", $so_dien_thoai, $mat_khau_ma_hoa, $email_bam, $ho_ten);

    // Thực thi câu lệnh SQL
    if ($stmt->execute()) {
        echo "<script>
            if (confirm('Đăng ký thành công. Quay lại đăng nhập?')) {
                window.location.href = 'Dangnhap_Index.php';
            }
            </script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng statement và connection
    $stmt->close();
    $conn->close();
}
?>
