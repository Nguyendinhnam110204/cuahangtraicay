<?php 
require 'connect.php';

if (isset($_POST['district_id'])) {
    $district_id = $_POST['district_id'];

    $sql = "SELECT * FROM wards WHERE district_id = $district_id";
    $result = mysqli_query($conn, $sql);

    $data = [];
    $data[0] = [
        'id' => null,
        'name' => 'Chọn một xã/phường'
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'id' => $row['wards_id'],
            'name' => $row['name']
        ];
    }

    echo json_encode($data);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>
