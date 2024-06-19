<?php

    require_once '../connect.php';

    $maCTKhuyenMai = $_POST['maCTKhuyenMai'];
    $tenChuongTrinh = $_POST['tenChuongTrinh'];
    $giamGia = $_POST['giamGia'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $ngayKetThuc = $_POST['ngayKetThuc'];
    $soLuong = $_POST['soLuong'];

    $sql_check = "SELECT * FROM khuyen_mai WHERE ma_khuyen_mai = '$maCTKhuyenMai'";
    $result = $conn->query($sql_check);

    if ($result->num_rows == 0) {
        $sql = "INSERT INTO khuyen_mai (ma_khuyen_mai, ten_khuyen_mai, giam_gia, ngay_bat_dau, ngay_ket_thuc, so_luong) VALUES ('$maCTKhuyenMai','$tenChuongTrinh' ,'$giamGia' ,'$ngayBatDau' ,'$ngayKetThuc' ,'$soLuong' )";
        mysqli_query($conn, $sql);
        header("location: ../admin/Admin.php?page=CTKM");
    } else {
        echo "<script>
            if (confirm('Trùng mã đã tồn tại. Không thể chèn bản ghi. Quay lại trang trước?')) {
                window.location.href = '../admin/Admin.php?page=CTKM';
            } else {
                window.location.href = '../admin/Admin.php?page=CTKM';
            }
          </script>";
    }
?>