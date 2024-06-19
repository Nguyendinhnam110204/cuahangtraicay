<?php
//lấy mã giỏ hàng xuống
$magiohang = $_GET['get_ma_gio_hang'];

//ket noi
require_once 'connect.php';

 //cau lenh sql
 $delete_sql = "DELETE FROM gio_hang WHERE ma_gio_hang= '$magiohang'";
// lenh thuc thi truy van

$result = mysqli_query($conn,$delete_sql);

//dongs ket noi
mysqli_close($conn);

 //tro ve trang giohang
 header("Location: giohang.php");

?>