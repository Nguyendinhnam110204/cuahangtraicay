<?php
if(isset($_GET['ma_san_pham'])){
    $ma_san_pham=$_GET['ma_san_pham'];
}

require_once 'db.php';

$xoa_sql = "DELETE FROM san_pham WHERE ma_san_pham = '$ma_san_pham'";
$qr= mysqli_query($conn,$xoa_sql);
header("location: quanlysanpham.php");
?>