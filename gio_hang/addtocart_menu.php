<?php
session_start();
ob_start();

if (isset($_POST['btn_add_to_cart'])) {
    $tensp = $_POST['tensp'];
    $id = $_POST['id'];
    $img = $_POST['img'];
    $gia = $_POST['gia'];
}

// Kiểm tra và thêm sản phẩm vào giỏ hàng
if (isset($tensp) && isset($id) && isset($img) && isset($gia)) {
    $soluong = 1;

    $sp = [
        "id" => $id,
        "img" => $img,
        "tensp" => $tensp,
        "gia" => $gia,
        "soluong" => $soluong
    ];

    if (!isset($_SESSION['giohang'])) {
        $_SESSION['giohang'] = [];
    }

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $found = false;
    foreach ($_SESSION['giohang'] as &$item) {
        if ($item['id'] == $id) {
            $item['soluong']++;
            $found = true;
            break;
        }
    }

    // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào giỏ hàng
    if (!$found) {
        $_SESSION['giohang'][] = $sp;
    }

  //hiện thông báo thanhf công
  header("Location: ../thongbaoketqua/them_san_pham_thanh_cong.html");
    exit;
} else {
    // Xử lý khi không có dữ liệu hợp lệ
    header('location: ../trangchu.php');
    exit;
}

?>