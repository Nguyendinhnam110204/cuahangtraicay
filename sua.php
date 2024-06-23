<?php
   require_once 'connect.php';
   require_once 'Updatesp.php';
   $ma_san_pham = $_POST['txtma_san_pham'];
   $ten_san_pham = $_POST['txtten_san_pham'];
   $gia = $_POST['txtgia'];
   $mo_ta = $_POST['txtmo_ta'];
   $url_hinh_anh = $_POST['txturl_hinh_anh'];
   $ton_kho = $_POST['txtton_kho'];
   $ma_doi_tac = $_POST['sma_doi_tac'];

   // $currentTimestamp = DateTime('Y-m-d H:i:s');

   $sql="UPDATE san_pham SET ten_san_pham='$ten_san_pham',gia='$gia', mo_ta='$mo_ta',url_hinh_anh='$url_hinh_anh',ton_kho='$ton_kho',ma_doi_tac='$ma_doi_tac' WHERE ma_san_pham='$ma_san_pham'";
   mysqli_query($conn,$sql);
   echo "<script>alert('Cập nhật thành công!'); location.href ='quanlysanpham.php'</script>";
   
?>