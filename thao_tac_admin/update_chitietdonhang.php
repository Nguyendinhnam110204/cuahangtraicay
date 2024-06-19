<?php
require_once '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_don_hang = $_POST['ma_don_hang'];
    $ten_nguoi_mua = $_POST['ten_nguoi_mua'];
    $email_nguoi_mua = $_POST['email_nguoi_mua'];
    $so_dien_thoai_nguoi_mua = $_POST['so_dien_thoai_nguoi_mua'];
    $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
    $tong_tien = $_POST['tong_tien'];
    $ten_phuong_thuc = $_POST['phuong_thuc'];
    $dia_chi_nguoi_mua = $_POST['dia_chi_nguoi_mua'];

    //Lấy mã khóa ngoại tương ứng dựa trên tên
    $km_query = "SELECT ma_khuyen_mai FROM khuyen_mai WHERE ten_khuyen_mai = '$ten_khuyen_mai'";
    $km_result = mysqli_query($conn, $km_query);
    $km_row = mysqli_fetch_assoc($km_result);
    $ma_khuyen_mai = $km_row['ma_khuyen_mai'];

    $pttt_query = "SELECT ma_phuong_thuc FROM phuong_thuc_thanh_toan WHERE ten_phuong_thuc = '$ten_phuong_thuc'";
    $pttt_result = mysqli_query($conn, $pttt_query);
    // Kiểm tra xem có kết quả có trả về và số lượng hàng lớn hơn 0 hay không
if ($pttt_result && mysqli_num_rows($pttt_result) > 0) {
    // Lấy dòng dữ liệu đầu tiên từ kết quả truy vấn
    $pttt_row = mysqli_fetch_assoc($pttt_result);
    // Lưu giá trị của cột ma_phuong_thuc vào biến $ma_phuong_thuc
    $ma_phuong_thuc = $pttt_row['ma_phuong_thuc'];
} else {
    // Nếu không có kết quả trả về hoặc số lượng hàng là 0, in ra thông báo lỗi và kết thúc chương trình
    die("Phương thức thanh toán không tồn tại.");
}

    // Update query
    $update_order = "UPDATE don_hang
                     SET ten_nguoi_mua = '$ten_nguoi_mua',
                         email_nguoi_mua = '$email_nguoi_mua',
                         so_dien_thoai_nguoi_mua = '$so_dien_thoai_nguoi_mua',
                         ma_khuyen_mai = '$ma_khuyen_mai',
                         tong_tien = '$tong_tien',
                         ma_phuong_thuc_thanh_toan = '$ma_phuong_thuc',
                         dia_chi_nguoi_mua = '$dia_chi_nguoi_mua'
                     WHERE ma_don_hang = '$ma_don_hang'";

    if (mysqli_query($conn, $update_order)) {
        echo "Đơn hàng đã được cập nhật thành công.";
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}
 //quay lại trang ban đầu
 header("Location: ../admin/chitietdonhang.php?get_ma_don=$ma_don_hang");

?>
