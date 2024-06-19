<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách chương trình khuyến mãi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            font-family: "Ubuntu", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container" style=" text-align:center">
        <h1 style="font-family: 'Times New Roman', Times, serif;"><b>Chương trình khuyến mãi</b></h1>
        
        <div class="form-row mb-3" style="margin: 30px 0 0 45px;">
            <!-- Button to Open the Modal -->
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Thêm chương trình khuyến mãi
                </button> 
            </div>
        </div>
        <br>
        <table class="table" style="margin: -15px 0 0 -10px; width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Mã khuyến mãi</th>
                    <th>Chương trình</th>
                    <th>Giảm giá</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Số lượng</th>
                    <th>Ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //ketnoi
                    require_once 'connect.php';
                    // Câu lệnh SQL
                    $list_sql = "SELECT * FROM khuyen_mai ORDER BY ten_khuyen_mai, giam_gia";
                    

                    //thuc thi cau lenh
                    $result = mysqli_query($conn, $list_sql);

                    //duyet qua result va in ra
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["ma_khuyen_mai"] ?></td>
                            <td><?php echo $row["ten_khuyen_mai"] ?></td>
                            <td><?php echo $row["giam_gia"] ?></td>
                            <td><?php echo $row["ngay_bat_dau"] ?></td>
                            <td><?php echo $row["ngay_ket_thuc"] ?></td>
                            <td><?php echo $row["so_luong"] ?></td>
                            <td><?php echo $row["ngay_tao"] ?></td>
                            <td>
                                <button
                                    type="button" 
                                    class="btn btn-success btn-update" 
                                    data-ma_khuyen_mai="<?php echo $row["ma_khuyen_mai"]; ?>" 
                                    data-ten_khuyen_mai="<?php echo $row["ten_khuyen_mai"]; ?>" 
                                    data-giam_gia="<?php echo $row["giam_gia"]; ?>" 
                                    data-ngay_bat_dau="<?php echo $row["ngay_bat_dau"]; ?>" 
                                    data-ngay_ket_thuc="<?php echo $row["ngay_ket_thuc"]; ?>" 
                                    data-so_luong="<?php echo $row["so_luong"]; ?>" 
                                    data-toggle="modal" 
                                    data-target="#myModal-update"
                                    style="margin-right: 10px">
                                    Update
                                </button>
                                <a onclick="return confirm('Bạn có muốn xóa chương trình khuyến mãi này không')" href="delete_CTKM.php?maCTKhuyenMai=<?php echo $row["ma_khuyen_mai"] ;?>" class="btn btn-danger" style="margin-right: -15px">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: 'Times New Roman', Times, serif;">Thêm Chương trình khuyến mãi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Thêm -->
                <div class="modal-body">
                    <form action="insert_CTKM.php" method="post">
                        <div class="form-group">
                            <label for="maCTKhuyenMai">Mã khuyến mãi</label>
                            <input type="text" class="form-control" id="maCTKhuyenMai" name="maCTKhuyenMai" required>
                        </div>
                        <div class="form-group">
                            <label for="tenChuongTrinh">Chương trình</label>
                            <input type="text" class="form-control" id="tenChuongTrinh" name="tenChuongTrinh" required>
                        </div>
                        <div class="form-group">
                            <label for="giamGia">Giảm giá</label>
                            <input type="text" class="form-control" id="giamGia" name="giamGia" required>
                        </div>
                        <div class="form-group">
                            <label for="ngayBatDau">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="ngayBatDau" name="ngayBatDau" required>
                        </div>
                        <div class="form-group">
                            <label for="ngayKetThuc">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="ngayKetThuc" name="ngayKetThuc" required>
                        </div>
                        <div class="form-group">
                            <label for="soLuong">Số lượng</label>
                            <input type="text" class="form-control" id="soLuong" name="soLuong" required>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 275px;">Đóng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal" id="myModal-update">
        <div class="modal-dialog">
            <div class="modal-content">

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Lấy tất cả các nút "Update"
                const updateButtons = document.querySelectorAll('.btn-update');

                updateButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Lấy giá trị từ thuộc tính data-
                        const maKhuyenMai = this.getAttribute('data-ma_khuyen_mai');
                        const tenKhuyenMai = this.getAttribute('data-ten_khuyen_mai');
                        const giamGia = this.getAttribute('data-giam_gia');
                        const ngayBatDau = this.getAttribute('data-ngay_bat_dau');
                        const ngayKetThuc = this.getAttribute('data-ngay_ket_thuc');
                        const soLuong = this.getAttribute('data-so_luong');

                        // Điền giá trị vào các trường trong modal
                        document.getElementById('update_maCTKhuyenMai').value = maKhuyenMai;
                        document.getElementById('update_tenChuongTrinh').value = tenKhuyenMai;
                        document.getElementById('update_giamGia').value = giamGia;
                        document.getElementById('update_ngayBatDau').value = ngayBatDau;
                        document.getElementById('update_ngayKetThuc').value = ngayKetThuc;
                        document.getElementById('update_soLuong').value = soLuong;
                    });
                });
            });
        </script>

                 <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: 'Times New Roman', Times, serif;">Sửa Chương trình khuyến mãi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Sửa -->
                <div class="modal-body">
                    <form action="update_CTKM.php" method="post">
                        <div class="form-group">
                            <label for="update_maCTKhuyenMai">Mã khuyến mãi</label>
                            <input type="text" class="form-control" id="update_maCTKhuyenMai" name="maCTKhuyenMai" required>
                        </div>
                        <div class="form-group">
                            <label for="update_tenChuongTrinh">Chương trình</label>
                            <input type="text" class="form-control" id="update_tenChuongTrinh" name="tenChuongTrinh" required>
                        </div>
                        <div class="form-group">
                            <label for="update_giamGia">Giảm giá</label>
                            <input type="text" class="form-control" id="update_giamGia" name="giamGia" required>
                        </div>
                        <div class="form-group">
                            <label for="update_ngayBatDau">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="update_ngayBatDau" name="ngayBatDau" required>
                        </div>
                        <div class="form-group">
                            <label for="update_ngayKetThuc">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="update_ngayKetThuc" name="ngayKetThuc" required>
                        </div>
                        <div class="form-group">
                            <label for="update_soLuong">Số lượng</label>
                            <input type="text" class="form-control" id="update_soLuong" name="soLuong" required>
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 275px;">Đóng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


