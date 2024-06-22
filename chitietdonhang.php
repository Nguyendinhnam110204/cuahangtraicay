<?php 
//lấy ma_don_hang xuống;
$id_ma_don_hang = $_GET['get_ma_don'];
//gọi file kết nối
require_once './connect.php';

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
//Kiểm tra xem truy vấn có trả về kết quả không trước khi cố gắng truy cập các chỉ mục của mảng $row.
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
} else {
  // Chuyển hướng nếu không có kết quả
  header("Location: order.php?error=not_found");
  exit();
}

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
        <button
          type="button" 
          class="btn btn-success btn-update" 
          data-ten_nguoi_mua="<?php echo $row['ten_nguoi_mua']; ?>" 
          data-email_nguoi_mua="<?php echo $row['email_nguoi_mua']; ?>" 
          data-so_dien_thoai_nguoi_mua="<?php echo $row['so_dien_thoai_nguoi_mua']; ?>" 
          data-ten_khuyen_mai="<?php echo $row['ten_khuyen_mai']; ?>" 
          data-tong_tien="<?php echo $row['tong_tien']; ?>" 
          data-ten_phuong_thuc="<?php echo $row['ten_phuong_thuc']; ?>" 
          data-dia_chi_nguoi_mua="<?php echo $row['dia_chi_nguoi_mua']; ?>" 
          data-toggle="modal" 
          data-target="#myModal-update"
          style="margin-right: 10px">
          <i class="fa-regular fa-pen-to-square"></i>
        </button>
        <a href="order.php" class="btn btn-primary" style="margin-left:10px;"><i class="fa-solid fa-right-from-bracket"></i></a>
        </td>
      </tr>
    </tbody>
  </table>
</div>


<div class="modal" id="myModal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                 <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: 'Times New Roman', Times, serif;">Sửa thông tin đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Sửa -->
                <div class="modal-body">
                    <form action="./thao_tac_admin/update_chitietdonhang.php" method="post">
                    <div class="form-group">
                            <input type="hidden" name="ma_don_hang" value="<?php echo $row['ma_don_hang']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="update_ten_nguoi_mua">Khách Hàng</label>
                            <input type="text" class="form-control" id="update_ten_nguoi_mua" name="ten_nguoi_mua" required>
                        </div>
                        <div class="form-group">
                            <label for="update_email_nguoi_mua">Email khách hàng</label>
                            <input type="text" class="form-control" id="update_email_nguoi_mua" name="email_nguoi_mua" required>
                        </div>
                        <div class="form-group">
                            <label for="update_so_dien_thoai_nguoi_mua">SĐT KH</label>
                            <input type="text" class="form-control" id="update_so_dien_thoai_nguoi_mua" name="so_dien_thoai_nguoi_mua" required>
                        </div>
                        <div class="form-group">
                            <label for="update_ten_khuyen_mai">Chiết Khấu</label>
                            <input type="text" class="form-control" id="update_ten_khuyen_mai" name="ten_khuyen_mai" required>
                        </div>
                        <div class="form-group">
                            <label for="update_tong_tien">Tổng Tiền</label>
                            <input type="text" class="form-control" id="update_tong_tien" name="tong_tien" required>
                        </div>
                        <div class="form-group">
                            <label for="update_phuong_thuc">Phương Thức Thanh Toán</label>
                            <input type="text" class="form-control" id="update_phuong_thuc" name="phuong_thuc" required>
                        </div>

                        <div class="form-group">
                            <label for="update_dia_chi_nguoi_mua">Địa chỉ nhận hàng</label>
                            <input type="text" class="form-control" id="update_dia_chi_nguoi_mua" name="dia_chi_nguoi_mua" required>
                        </div>

                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 275px;">Đóng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Lấy tất cả các nút "Update"
                const updateButtons = document.querySelectorAll('.btn-update');

                updateButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Lấy giá trị từ thuộc tính data-
                        const ten_nguoi_mua = this.getAttribute('data-ten_nguoi_mua');
                        const email_nguoi_mua = this.getAttribute('data-email_nguoi_mua');
                        const so_dien_thoai_nguoi_mua = this.getAttribute('data-so_dien_thoai_nguoi_mua');
                        const ten_khuyen_mai = this.getAttribute('data-ten_khuyen_mai');
                        const tong_tien = this.getAttribute('data-tong_tien');
                        const ten_phuong_thuc= this.getAttribute('data-ten_phuong_thuc');
                        const dia_chi_nguoi_mua= this.getAttribute('data-dia_chi_nguoi_mua');

                        // Điền giá trị vào các trường trong modal
                        document.getElementById('update_ten_nguoi_mua').value = ten_nguoi_mua;
                        document.getElementById('update_email_nguoi_mua').value = email_nguoi_mua;
                        document.getElementById('update_so_dien_thoai_nguoi_mua').value = so_dien_thoai_nguoi_mua;
                        document.getElementById('update_ten_khuyen_mai').value = ten_khuyen_mai;
                        document.getElementById('update_tong_tien').value = tong_tien;
                        document.getElementById('update_phuong_thuc').value = ten_phuong_thuc;
                        document.getElementById('update_dia_chi_nguoi_mua').value = dia_chi_nguoi_mua;
                    });
                });
            });
        </script>
</body>
</html>
