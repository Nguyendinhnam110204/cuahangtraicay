<?php
require_once 'db.php';
$ma_san_pham=$_GET['ma_san_pham'];
$edit_sql="SELECT * FROM san_pham WHERE ma_san_pham='$ma_san_pham'";
$result = mysqli_query($conn,$edit_sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <div class="container" style="width: 1200px;">
        <h2 style="text-align: center;">FORM THÊM SẢN PHẨM</h2>
        <form class="row g-3" style="margin-top: 30px;" action="sua.php" method="POST">
        <?php 
          if(isset($result) && mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
          ?>
            <div class="col-md-6">
                <label for="ma_san_pham" class="form-label">Mã sản phẩm:</label>
                <input type="text" class="form-control" id="ma_san_pham" name="txtma_san_pham" value="<?php echo $row['ma_san_pham']; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="ten_san_pham" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="ten_san_pham" name="txtten_san_pham" value="<?php echo $row['ten_san_pham']; ?>">
            </div>
            <div class="col-md-6">
                <label for="gia" class="form-label">Giá:</label>
                <input type="text" class="form-control" id="gia" name="txtgia" value="<?php echo $row['gia']; ?>">
            </div>
            <div class="col-md-6">
                <label for="mo_ta" class="form-label">Mô tả:</label>
                <input type="text" class="form-control" id="mo_ta" name="txtmo_ta" value="<?php echo $row['mo_ta']; ?>">
            </div>
            <div class="col-md-6">
                <label for="url_hinh_anh" class="form-label">Thêm ảnh:</label>
                <input type="file" class="form-control" id="url_hinh_anh" name="txturl_hinh_anh" value="<?php echo $row['url_hinh_anh']; ?>">
            </div>
            <div class="col-md-6">
                <label for="ton_kho" class="form-label">Tồn kho:</label>
                <input type="text" class="form-control" id="ton_kho" name="txtton_kho" value="<?php echo $row['ton_kho']; ?>">
            </div>
            <div class="col-md-6">
                <label for="ma_doi_tac" class="form-label">Đối tác:</label>
                <select class="form-control" id="ma_doi_tac" name="sma_doi_tac" value="<?php echo $row['ma_doi_tac']; ?>">
                                <?php
                                    // Lấy danh sách tác giả
                                    $sql = "SELECT ma_doi_tac, ten_doi_tac FROM doi_tac";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row["ma_doi_tac"] . '">' . $row["ten_doi_tac"] . '</option>';
                                    }
                                ?>
                            </select>
            </div>
            <?php
        }
      }
      ?>
            <button  class="btn btn-primary" style="margin-left: 500px;margin-top: 30px;">Sửa sản phẩm</button>
        </form>
        </div>
</body>
</html>