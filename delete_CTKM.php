<?php
    //lay du lieu id can xoa
    $makhuyenmai = $_GET['maCTKhuyenMai'];
    //ket noi
    require_once 'db.php';

    //cau lenh sql
    $delete_sql = "DELETE FROM khuyen_mai WHERE ma_khuyen_mai= $makhuyenmai";

    mysqli_query($conn, $delete_sql);

    //tro ve trang list
    header("Location: Admin.php?page=CTKM");
?>