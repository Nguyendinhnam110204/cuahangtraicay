<?php
require_once 'connect.php';
// Khởi động phiên làm việc
session_start();

// Create order ID
function creat_ma_don($conn) {
    $query = "SELECT ma_don_hang FROM don_hang ORDER BY ma_don_hang DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $ma_cuoi = $result && mysqli_num_rows($result) > 0 ? mysqli_fetch_assoc($result)['ma_don_hang'] : null;

    if ($ma_cuoi) {
        $lastNumber = intval(substr($ma_cuoi, 3));
        $newNumber = $lastNumber + 1;
        $newOrderCode = 'DH_' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    } else {
        $newOrderCode = 'DH_01';
    }

    return $newOrderCode;
}

// Create cart ID
function creat_ma_gio_hang($conn) {
    $uuid = uniqid();
    return 'GH_' . $uuid;
}

// Kiểm tra các trường bắt buộc
$required_fields = ['ten_nguoi_mua', 'email_nguoi_mua', 'so_dien_thoai_nguoi_mua', 'dia_chi_nguoi_mua', 'tong_tien', 'ma_phuong_thuc_thanh_toan'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        die("Error: Thiếu trường bắt buộc '$field'");
    }
}

// Get order info from form
$ma_nguoi_dung = isset($_POST['ma_nguoi_dung']) ? $_POST['ma_nguoi_dung'] : NULL;
$ten_nguoi_mua = $_POST['ten_nguoi_mua'];
$email_nguoi_mua = $_POST['email_nguoi_mua'];
$so_dien_thoai_nguoi_mua = $_POST['so_dien_thoai_nguoi_mua'];
$dia_chi_nguoi_mua = $_POST['dia_chi_nguoi_mua'];
$tong_tien = $_POST['tong_tien'];
$ma_khuyen_mai = isset($_POST['ma_khuyen_mai']) ? $_POST['ma_khuyen_mai'] : NULL;
$ma_phuong_thuc_thanh_toan = $_POST['ma_phuong_thuc_thanh_toan'];

// Kiểm tra xem ma_nguoi_dung có tồn tại trong bảng nguoi_dung hay không
if ($ma_nguoi_dung !== NULL) {
    $query_user_check = "SELECT ma_nguoi_dung FROM nguoi_dung WHERE ma_nguoi_dung = '$ma_nguoi_dung'";
    $result_user_check = mysqli_query($conn, $query_user_check);
    if (mysqli_num_rows($result_user_check) == 0) {
        $ma_nguoi_dung = NULL;
    }
}

// Kiểm tra xem ma_khuyen_mai có tồn tại trong bảng khuyen_mai hay không
if ($ma_khuyen_mai !== NULL) {
    $query_discount_check = "SELECT ma_khuyen_mai FROM khuyen_mai WHERE ma_khuyen_mai = '$ma_khuyen_mai'";
    $result_discount_check = mysqli_query($conn, $query_discount_check);
    if (mysqli_num_rows($result_discount_check) == 0) {
        $ma_khuyen_mai = NULL;
    }
}

// Generate new order ID


$ma_don_hang = creat_ma_don($conn);
// Insert new order into the database
$query = "INSERT INTO don_hang (ma_don_hang, ma_nguoi_dung, ten_nguoi_mua, email_nguoi_mua, so_dien_thoai_nguoi_mua, dia_chi_nguoi_mua, tong_tien, ma_khuyen_mai, ma_phuong_thuc_thanh_toan)
          VALUES ('$ma_don_hang', " . ($ma_nguoi_dung !== NULL ? "'$ma_nguoi_dung'" : "NULL") . ", '$ten_nguoi_mua', '$email_nguoi_mua', '$so_dien_thoai_nguoi_mua', '$dia_chi_nguoi_mua', '$tong_tien', " . ($ma_khuyen_mai !== NULL ? "'$ma_khuyen_mai'" : "NULL") . ", '$ma_phuong_thuc_thanh_toan')";

$result = mysqli_query($conn, $query);
$ma_gio_hang = creat_ma_gio_hang($conn);
if ($result) {
    // Insert cart items into gio_hang table
    foreach ($_SESSION['giohang'] as $item) {
        $ma_san_pham = $item['id'];
        $so_luong = $item['soluong'];
        $gia = $item['gia'];
        $query_cart = "INSERT INTO gio_hang (ma_gio_hang, ma_nguoi_dung, ma_san_pham, so_luong, gia)
                       VALUES ('$ma_gio_hang', " . ($ma_nguoi_dung !== NULL ? "'$ma_nguoi_dung'" : "NULL") . ", '$ma_san_pham', '$so_luong', '$gia')";
        $result_cart = mysqli_query($conn, $query_cart);

        if (!$result_cart) {
            die("Error: Không thể thêm giỏ hàng '$ma_san_pham'");
        }
    }
    //hiện thông báo thành công
    header("Location: ./thongbaoketqua/thanhkyou.html");
    //gán lại giỏ hàng thành rỗng nếu đặt hàng thành công
    $_SESSION['giohang'] = [];
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
