<?php
    //lay du lieu id can xoa
    $makhuyenmai = $_GET['maCTKhuyenMai'];
    //ket noi
    require_once 'connect.php';

    //cau lenh sql
    $delete_sql = "DELETE FROM khuyen_mai WHERE ma_khuyen_mai= '$makhuyenmai'";

    mysqli_query($conn, $delete_sql);
    echo "xóa thành công";

    //tro ve trang list
    header("Location: ../admin/Admin.php?page=CTKM");

    //close ket noi 
    mysqli_close($conn);
?>