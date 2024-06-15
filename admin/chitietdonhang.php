<?php 
//lấy ma_don_hang xuống;
$id_ma_don_hang = $_GET['get_ma_don'];
//gọi file kết nối
require_once '../connect.php';

//lấy thông tin dựa vào mã;
$select_chitiet = "SELECT dh.ma_don_hang, 
                        dh.ten_nguoi_mua , 
                        dh.email_nguoi_mua, 
                        dh.so_dien_thoai_nguoi_mua,  
                        km.ten_khuyen_mai, 
                        pttt.ten_phuong_thuc , 
                        dh.dia_chi_nguoi_mua ,
                        dh.tong_tien
                  FROM don_hang dh
                  LEFT JOIN khuyen_mai km ON dh.ma_khuyen_mai = km.ma_khuyen_mai
                  LEFT JOIN phuong_thuc_thanh_toan pttt ON dh.ma_phuong_thuc_thanh_toan = pttt.ma_phuong_thuc
                  WHERE dh.ma_don_hang = '$id_ma_don_hang'";

$result = mysqli_query($conn, $select_chitiet);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chi tiết đơn hàng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <style>
    .table th, .table td {
      text-align: center;
      vertical-align: middle;
    }
    .container {
      margin-top: 50px;
    }
    h2 {
      margin-bottom: 30px;
    }
    .btn-action {
      display: flex;
      justify-content: center;
      gap: 10px;
    }
    .btn i {
      margin-right: 5px;
    }
  </style>

</head>
<body>

<div class="container">
  <h2 style=" text-align:center;" >Chi tiết đơn hàng</h2>           
  <table class="table table-striped"   >
    <thead>
      <tr style=" text-align:center; align-items:center; justify-content: center;">
        <th>Khách hàng</th>
         <th>Email khách hàng</th>
        <th>SĐT khách hàng</th>
        <th> Chiết Khấu </th>
        <th> Tổng tiền</th>
        <th> Phương thức thanh toán</th>
        <th> Địa chỉ nhận hàng  </th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
      <tr style=" text-align:center; align-items:center; justify-content: center;">
        <td><?php echo $row['ten_nguoi_mua'];  ?></td>
        <td><?php echo $row['email_nguoi_mua'];  ?></td>
        <td><?php echo $row['so_dien_thoai_nguoi_mua'];  ?></td>
        <td><?php echo $row['ten_khuyen_mai'];  ?> </td>
        <td><?php echo $row['tong_tien'];  ?></td>
        <td><?php echo $row['ten_phuong_thuc'];  ?></td>
        <td><?php echo $row['dia_chi_nguoi_mua'];  ?></td>
        <td style="display:flex;">
        <a href="sua.php?getid=<?php echo $row['ma_don_hang']; ?>" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i></a>
        <a href="order.php" class="btn btn-primary" style="margin-left:10px;"><i class="fa-solid fa-right-from-bracket"></i></a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
