<?php 
require 'connect.php';

if (isset($_POST['province_id'])) {
    $province_id = $_POST['province_id'];

    $sql = "SELECT * FROM district WHERE province_id = $province_id";
    $result = mysqli_query($conn, $sql);

    $data = [];
    $data[0] = [
        'id' => null,
        'name' => 'Chọn một quận/huyện'
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'id' => $row['district_id'],
            'name' => $row['name']
        ];
    }

    echo json_encode($data);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>
