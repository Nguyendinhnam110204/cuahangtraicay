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

    // Chuẩn bị câu lệnh SQL với prepared statements để ngăn chặn SQL Injection
    $stmt = $conn->prepare("SELECT mat_khau, email, ho_ten FROM nguoi_dung WHERE so_dien_thoai = ?");
    $stmt->bind_param("s", $so_dien_thoai);

    // Thực thi câu lệnh SQL
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($mat_khau_ma_hoa, $email_bam, $ho_ten);
        $stmt->fetch();

        // Kiểm tra mật khẩu
        if (password_verify($mat_khau, $mat_khau_ma_hoa)) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['so_dien_thoai'] = $so_dien_thoai;
            $_SESSION['ho_ten'] = $ho_ten;
            $_SESSION['email'] = $email_bam; // Sửa $email thành $email_bam

            echo "<script>
                    alert('Đăng nhập thành công.');
                    window.location.href = 'Trangchu.php'; // Đổi thành trang chính của bạn
                </script>";
        } else {
            echo "<script>
                    alert('Sai mật khẩu. Vui lòng thử lại.');
                    window.location.href = 'Dangnhap_Index.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Không tìm thấy tài khoản. Vui lòng kiểm tra lại số điện thoại.');
                window.location.href = 'Dangnhap_Index.php';
            </script>";
    }

    // Đóng statement và connection
    $stmt->close();
    $conn->close();
}
?>
