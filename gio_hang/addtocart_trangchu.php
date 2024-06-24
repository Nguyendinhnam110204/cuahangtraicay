<?php
session_start();
ob_start();

// Kiểm tra xem có dữ liệu gửi từ form và xác định sản phẩm được chọn
if (isset($_POST['btnaddtocart_dua'])) {
    $tensp = $_POST['tensp_dua'];
    $id = $_POST['id_dua'];
    $img = $_POST['img_dua'];
    $gia = $_POST['gia_dua'];
} elseif (isset($_POST['btnaddtocart_Tao'])) {
    $tensp = $_POST['tensp_Tao'];
    $id = $_POST['id_Tao'];
    $img = $_POST['img_Tao'];
    $gia = $_POST['gia_Tao'];
} elseif (isset($_POST['btnaddtocart_luu'])) {
    $tensp = $_POST['tensp_luu'];
    $id = $_POST['id_luu'];
    $img = $_POST['img_luu'];
    $gia = $_POST['gia_luu'];
} elseif (isset($_POST['btnaddtocart_Cam'])) {
    $tensp = $_POST['tensp_Cam'];
    $id = $_POST['id_Cam'];
    $img = $_POST['img_Cam'];
    $gia = $_POST['gia_Cam'];
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

   //hiện thông báo thành công
   header("Location: ../thongbaoketqua/them_san_pham_thanh_cong.html");
    exit;
} else {
    // Xử lý khi không có dữ liệu hợp lệ
    header('location: ../trangchu.php');
    exit;
}
?>
