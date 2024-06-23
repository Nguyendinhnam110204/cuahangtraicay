<?php
require_once 'connect.php';

$ma_san_pham = isset($_POST['ma_san_pham']) ? $_POST['ma_san_pham'] : '';
$ten_san_pham = isset($_POST['ten_san_pham']) ? $_POST['ten_san_pham'] : '';
$gia = isset($_POST['gia']) ? $_POST['gia'] : '';
$mo_ta = isset($_POST['mo_ta']) ? $_POST['mo_ta'] : '';
$url_hinh_anh = isset($_POST['url_hinh_anh']) ? $_POST['url_hinh_anh'] : '';
$ton_kho = isset($_POST['ton_kho']) ? $_POST['ton_kho'] : '';
$ma_doi_tac = isset($_POST['ma_doi_tac']) ? $_POST['ma_doi_tac'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_san_pham = mysqli_real_escape_string($conn, $ma_san_pham);
    $ten_san_pham = mysqli_real_escape_string($conn, $ten_san_pham);
    $gia = mysqli_real_escape_string($conn, $gia);
    $mo_ta = mysqli_real_escape_string($conn, $mo_ta);
    $url_hinh_anh = mysqli_real_escape_string($conn, $url_hinh_anh);
    $ton_kho = mysqli_real_escape_string($conn, $ton_kho);
    $ma_doi_tac = mysqli_real_escape_string($conn, $ma_doi_tac);

    $sql_trungid = "SELECT * FROM san_pham WHERE ma_san_pham='$ma_san_pham'";
    $result = mysqli_query($conn, $sql_trungid);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Trùng mã sản phẩm!'); location.href ='themsp.php';</script>";
    } else {
        // Chèn sản phẩm mới vào cơ sở dữ liệu
        $addsql = "INSERT INTO san_pham (ma_san_pham, ten_san_pham, gia, mo_ta, url_hinh_anh, ton_kho,ma_doi_tac) 
                   VALUES ('$ma_san_pham', '$ten_san_pham', '$gia', '$mo_ta', '$url_hinh_anh', '$ton_kho','$ma_doi_tac')";
        $qr = mysqli_query($conn, $addsql);
        header("Location: quanlysanpham.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
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
        <form class="row g-3" style="margin-top: 30px;" action="" method="POST">
            <div class="col-md-6">
                <label for="ma_san_pham" class="form-label">Mã sản phẩm:</label>
                <input type="text" class="form-control" id="ma_san_pham" name="ma_san_pham" required>
            </div>
            <div class="col-md-6">
                <label for="ten_san_pham" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham" required>
            </div>
            <div class="col-md-6">
                <label for="gia" class="form-label">Giá:</label>
                <input type="text" class="form-control" id="gia" name="gia" required>
            </div>
            <div class="col-md-6">
                <label for="mo_ta" class="form-label">Mô tả:</label>
                <input type="text" class="form-control" id="mo_ta" name="mo_ta" required>
            </div>
            <div class="col-md-6">
                <label for="url_hinh_anh" class="form-label">Thêm ảnh:</label>
                <input type="file" class="form-control" id="url_hinh_anh" name="url_hinh_anh" required>
            </div>
            <div class="col-md-6">
                <label for="ton_kho" class="form-label">Tồn kho:</label>
                <input type="text" class="form-control" id="ton_kho" name="ton_kho" required>
            </div>
            <div class="col-md-6">
                <label for="ma_doi_tac" class="form-label">Đối tác:</label>
                <select class="form-control" id="ma_doi_tac" name="ma_doi_tac">
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
            <button type="submit"  class="btn btn-primary" style="margin-left: 500px;margin-top: 30px;">Thêm sản phẩm</button>
        </form>
        </div>
</body>
</html>
