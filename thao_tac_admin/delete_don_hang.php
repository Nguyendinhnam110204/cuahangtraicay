<?php 
$ma_don_hang = $_GET['get_ma_don'];

require_once '../connect.php';

$xoa_sql = "DELETE FROM don_hang WHERE ma_don_hang = '$ma_don_hang'";

$result = mysqli_query($conn,$xoa_sql);

header("Location:../order.php");


//dong ket noi
mysqli_close($conn);

?>