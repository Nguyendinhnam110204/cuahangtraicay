<?php
require_once './Classes/Classes/PHPExcel.php';
require_once './Classes/Classes/PHPExcel/IOFactory.php';

if(isset($_POST['btn_excel'])){
  // code xuất excel
  $objExcel = new PHPExcel();
  $objExcel->setActiveSheetIndex(0);
  $sheet = $objExcel->getActiveSheet()->setTitle('Fruit_store');
  $rowCount = 1;
  
  
// Tạo tiêu đề cho cột trong excel
 
  $sheet->setCellValue('A'.$rowCount,'Mã đơn hàng');
  $sheet->setCellValue('B'.$rowCount,'Ngày Đặt');
  $sheet->setCellValue('C'.$rowCount,'Ngày Cập nhật');
  $sheet->setCellValue('D'.$rowCount,'Trạng thái');
  
  // định dạng cột tiêu đề
  $sheet->getColumnDimension('A')->setAutoSize(true);
  $sheet->getColumnDimension('B')->setAutoSize(true);
  $sheet->getColumnDimension('C')->setAutoSize(true);
  $sheet->getColumnDimension('D')->setAutoSize(true);
  // gán màu nền
  $sheet->getStyle('A1:D1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
  // căn giữa tiêu đề
  $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 
  
  // Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
  require_once '../connect.php';
  $sql_exceldonhang = "SELECT * FROM don_hang";
  $result_excel = mysqli_query($conn, $sql_exceldonhang);
  
  // Kiểm tra xem truy vấn có thành công không
  if (!$result_excel) {
      die('Query failed: ' . mysqli_error($conn));  
  }

  while($row = mysqli_fetch_array($result_excel)){
    $rowCount++;
    $sheet->setCellValue('A'.$rowCount, $row['ma_don_hang']);
    $sheet->setCellValue('B'.$rowCount, $row['ngay_tao']);
    $sheet->setCellValue('C'.$rowCount, $row['ngay_cap_nhat']);
    $sheet->setCellValue('D'.$rowCount, $row['trang_thai']);
  }
  
  // Kẻ bảng 
  $styleAray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
  $sheet->getStyle('A1:'.'D1'.($rowCount))->applyFromArray($styleAray);
  $fileName = 'Bao_cao_don_hang.xlsx';
  $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
  $objWriter->save($fileName);
  
  if (file_exists($fileName)) {
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($fileName));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($fileName);
    unlink($fileName); // Xóa tệp sau khi tải xuống
    exit;
  } else {
    echo 'File not found';
  }
}
?>


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
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./Style/admin_order.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</head>
<body>
  <div class="wrapper">
    <aside id="sidebar">
      <div class="d-flex">
        <button class="toggle-btn" type="button">
          <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
          <a href="#">Fresh Fruit</a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="order.php" class="sidebar-link">
            <i class="lni lni-agenda"></i>
            <span>Đơn hàng</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
             data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
            <i class="lni lni-protection"></i>
            <span>Danh mục</span>
          </a>
          <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="Admin.php?page=sanpham" class="sidebar-link">Sản phẩm</a>
            </li>
            <li class="sidebar-item">
              <a href="Admin.php?page=CTKM" class="sidebar-link">Chương trình khuyến mãi</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Nhà cung cấp</a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="lni lni-layout"></i>
            <span>Thống kê và báo cáo</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="index.php?page=thethuvien" class="sidebar-link">
            <i class="lni lni-popup"></i>
            <span>Tin tức</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="lni lni-cog"></i>
            <span>Cài đặt</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Đăng xuất</span>
        </a>
      </div>
    </aside>
    <div class="main p-3">
      <div>
        <?php
          if (isset($_GET['page']) && $_GET['page'] == 'CTKM') {
            include 'Index_CTKM.php';
          }
        ?>
      </div>
      <div class="container">
        <h2 style="text-align:center;">Liệt Kê Đơn Hàng</h2>
        <!-- xuatexcel -->
<form action="" method="post">
<div style="text-align:right; margin-right:45px;margin-bottom:10px;" >
  <button  type="submit" name="btn_excel" class="btn btn-danger">xuất Excel</button>
</div>
</form>
        <!--  -->
        <table class="table table-striped">
          <thead>
            <tr style="text-align:center;">
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Ngày đặt</th>
              <th>Ngày Cập nhật</th>
              <th>Trạng Thái</th>
              <th>Quản lý</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              require_once './connect.php';
              $select_lietke ="SELECT ma_don_hang , ngay_tao , ngay_cap_nhat , trang_thai FROM don_hang ";
              $comand = mysqli_query($conn,$select_lietke);
              $i = 0;
              $trang_thai_don_hang = array();
              while($rows = mysqli_fetch_assoc($comand)){
                $ma_don_hang = $rows['ma_don_hang'];
                $trang_thai = $rows['trang_thai'];
                $trang_thai_don_hang[$ma_don_hang] = $trang_thai;
            ?> 
            <tr style="text-align:center;">
              <td><?php echo ++$i ; ?></td>
              <td><?php echo $ma_don_hang; ?></td>
              <td><?php echo $rows['ngay_tao']; ?></td>
              <td><?php echo $rows['ngay_cap_nhat']; ?></td>
              <td id="status-<?php echo $ma_don_hang; ?>"><?php echo $trang_thai; ?></td>
              <td>
                <a href="./thao_tac_admin/delete_don_hang.php?get_ma_don=<?php echo $ma_don_hang; ?>" class="btn btn-danger" onclick="return confirm('bạn có muốn xóa không ?')"><i class="fas fa-trash-alt"></i></a>
                <a href="chitietdonhang.php?get_ma_don=<?php echo $ma_don_hang; ?>" class="btn btn-success">Chi tiết đơn hàng</a>
              </td>
              <td>
                <div class="btn-group" id="action-group-<?php echo $ma_don_hang; ?>">
                  <button type="button" class="btn btn-warning">Thao tác</button>
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
    </div>
  </div>
  <script>
    var trangThaiDonHang = <?php echo json_encode($trang_thai_don_hang); ?>;
    function update_trang_thai(ma_don_hang, newStatus) {
      document.getElementById('status-' + ma_don_hang).innerText = newStatus;
      if (newStatus === 'huy_bo') {
        var actionGroup = document.getElementById('action-group-' + ma_don_hang);
        if (actionGroup) {
          actionGroup.style.display = 'none';
        }
      }
    }
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
  <script src="./JS/Admin.js"></script>
</body>
</html>
