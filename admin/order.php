
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản Lí đơn hàng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../Style/Admin.css">
</head>
<body>
    <!-- -----------Thanh bên------------- -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="./img/logo.png" alt="">
            <span class="text">FruitAdmin</span>
        </a>
        <ul class="side_menu top">
            <li class="active">
                <a href="order.php">
                    <i class='bx bxs-store-alt'></i>
                    <span class="text">Giỏ hàng</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-lemon' ></i>
                    <span class="text">Sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-discount' ></i>
                    <span class="text">Chương trình khuyến mãi</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-report' ></i>
                    <span class="text">Thống kê và báo cáo</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-archive-in'></i>
                    <span class="text">Nhà cung cấp</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-news' ></i>
                    <span class="text">Tin tức</span>
                </a>
            </li>
        </ul>
        <ul class="side_menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out' ></i>
                    <span class="text">Đăng xuất</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- -----------Thanh bên------------- -->





    <!-- -----------Content----------- -->
    <section id="content">
        <!-- ----------Thanh điều hướng----------- -->
        <nav>   
            <i class='bx bx-menu' ></i>
            <a href="#" class="nav-link">Thể loại</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Tìm kiếm...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="https://www.enewsletterhome.com/_eNewsletter/2020/2007_J_avatar.jpg?" alt="">
            </a>
        </nav>
        <!-- ----------Thanh điều hướng----------- -->

        <!-- ----------Nội dung trang đơn hàng----------- -->
         <div class="container">
  <h2 style=" text-align:center;" >Liệt Kê Đơn Hàng</h2>           
  <table class="table table-striped"  >
    <thead>
      <tr style="text-align:center;">
        <th>STT</th>
        <th>Mã đơn hàng</th>
         <th>Ngày đặt</th>
         <th>Ngày Cập nhật</th>
         <th> Trạng Thái </th>
        <th>Quản lý </th>
        <th>Thao tác </th>
      </tr>
    </thead>
    <tbody>
       <!-- lay ds tu csdl in ra   -->
        <?php 
        // gọi file connect
        require_once '../connect.php';
        //lệnh truy vấn
        $select_lietke ="SELECT ma_don_hang , ngay_tao , ngay_cap_nhat , trang_thai FROM don_hang ";
        //câu lệnh thực thi
        $comand = mysqli_query($conn,$select_lietke);
        $i = 0;
        // Mảng lưu trữ thông tin trạng thái của từng đơn hàng
        $trang_thai_don_hang = array();

        while($rows = mysqli_fetch_assoc($comand)){
          $ma_don_hang = $rows['ma_don_hang'];
          $trang_thai = $rows['trang_thai'];

          // Lưu trạng thái vào mảng
         $trang_thai_don_hang[$ma_don_hang] = $trang_thai;
        ?> 
         <tr style=" text-align:center;">
      <td><?php echo ++$i ; ?></td>
        <td><?php echo $ma_don_hang; ?></td>
        <td><?php echo $rows['ngay_tao']; ?></td>
        <td><?php echo $rows['ngay_cap_nhat']; ?></td>
        <td id="status-<?php echo $ma_don_hang; ?>"><?php echo $trang_thai; ?></td>
        <td>
          <a href="xoa.php?get_ma_don=<?php echo $ma_don_hang; ?>" class="btn btn-danger" onclick=" return confirm('bạn có muốn xóa không ?')"><i class="fas fa-trash-alt"></i></a>
        <a href="chitietdonhang.php?get_ma_don=<?php echo $ma_don_hang; ?>" class="btn btn-success">Chi tiết đơn hàng</a>
        </td>
        <td>
          <div class="btn-group" id="action-group-<?php echo $ma_don_hang; ?>" >
            <button type="button" class="btn btn-warning" >Thao tác</button>
            <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="#" onclick="update_trang_thai('<?php echo $ma_don_hang; ?>', 'hoan_tat')">Xác nhận đơn hàng</a>
            <a class="dropdown-item" href="#" onclick="update_trang_thai('<?php echo $ma_don_hang; ?>', 'huy_bo')">Hủy đơn hàng</a>
            </div>
          </div>
        </td>
      </tr>
              <?php 
                }
              ?>
    </tbody>
  </table>
</div>
<script>
    // Mảng lưu trữ trạng thái của từng đơn hàng
    var trangThaiDonHang = <?php echo json_encode($trang_thai_don_hang); ?>;

    function update_trang_thai(ma_don_hang, newStatus) {
        document.getElementById('status-' + ma_don_hang).innerText = newStatus;

        // Kiểm tra nếu trạng thái là 'huy_bo' thì ẩn nút 'Thao tác'
        if (newStatus === 'huy_bo') {
            var actionGroup = document.getElementById('action-group-' + ma_don_hang);
            if (actionGroup) {
                actionGroup.style.display = 'none';
            }
        }
    }

    // Thực hiện ẩn nút 'Thao tác' khi tải trang
    window.onload = function() {
        Object.keys(trangThaiDonHang).forEach(function(ma_don_hang) {
            if (trangThaiDonHang[ma_don_hang] === 'huy_bo') {
                var actionGroup = document.getElementById('action-group-' + ma_don_hang);
                if (actionGroup) {
                    actionGroup.style.display = 'none';
                }
            }
        });
    };
</script>
    </section>
    <!-- -----------Content----------- -->
    <script src="../JS/Admin.js"></script>
</body>
</html>
