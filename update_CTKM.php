<?php
        require_once 'connect.php';

        $maCTKhuyenMai = $_POST['maCTKhuyenMai'];
        $tenChuongTrinh = $_POST['tenChuongTrinh'];
        $giamGia = $_POST['giamGia'];
        $ngayBatDau = $_POST['ngayBatDau'];
        $ngayKetThuc = $_POST['ngayKetThuc'];
        $soLuong = $_POST['soLuong'];

        //viet lenh sql de them du lieu
        $update_sql = "UPDATE khuyen_mai SET ten_khuyen_mai = '$tenChuongTrinh', giam_gia = '$giamGia' ,ngay_bat_dau = '$ngayBatDau',ngay_ket_thuc = '$ngayKetThuc',so_luong = '$soLuong' WHERE ma_khuyen_mai='$maCTKhuyenMai'";
        // echo $update_sql; exit;

        //thuc thi cau lenh them
        mysqli_query($conn, $update_sql);

        header("Location: Admin.php?page=CTKM");
?>