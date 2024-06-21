<?php
   require_once 'db.php';
  //  $hienthi_sql= "SELECT * FROM san_pham order by ma_san_pham,ten_san_pham,gia,mo_ta,url_hinh_anh,ton_kho,ngay_tao,ngay_cap_nhat,ma_doi_tac";
  //  $result = mysqli_query($conn,$hienthi_sql);

   $hienthi_sql = "SELECT san_pham.ma_san_pham,san_pham.ten_san_pham, san_pham.gia, san_pham.mo_ta,san_pham.url_hinh_anh,san_pham.ton_kho,san_pham.ngay_tao,san_pham.ngay_cap_nhat, doi_tac.ten_doi_tac FROM san_pham 
   JOIN doi_tac ON san_pham.ma_doi_tac = doi_tac.ma_doi_tac ";
   $result = mysqli_query($conn,$hienthi_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./Style/Admin.css?v = <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3" >
  <table class="table" style="width: 1200px;">
    <thead class="table-dark">
      <tr>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Mô tả</th>
        <th>Hình ảnh</th>
        <th>Tồn kho</th>
        <th>Ngày tạo</th>
        <th>Ngày cập nhật</th>
        <th>Đối tác</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
    <?php
       while($r = mysqli_fetch_assoc($result)){
        ?>
    <tr>
        <td><?php echo $r['ma_san_pham']; ?></td>
        <td><?php echo $r['ten_san_pham']; ?></td>
        <td><?php echo $r['gia']; ?></td>
        <td><?php echo $r['mo_ta']; ?></td>
        <td><img style="width: 50px;" src="Img/<?php echo $r['url_hinh_anh'] ?>" ></td>
        <td><?php echo $r['ton_kho']; ?></td>
        <td><?php echo $r['ngay_tao']; ?></td>
        <td><?php echo $r['ngay_cap_nhat']; ?></td>
        <td><?php echo $r['ten_doi_tac']; ?></td>
        <td><a href="Updatesp.php?ma_san_pham=<?php echo $r['ma_san_pham'];?>" class="btn btn-info">Sửa</a>
        <a onclick="return confirm('Bạn có muốn xóa không?');" href="xoa.php?ma_san_pham=<?php echo $r['ma_san_pham'];?>" class="btn btn-danger">Xóa</a></td>
      </tr>
      <?php
}
    ?>
    <tr>
        <td colspan="9"><button class="btn"><a href="themsp.php"> Thêm</a></button></td>
    </tr>
    </tbody>
  </table>
</div>
</body>
</html>



