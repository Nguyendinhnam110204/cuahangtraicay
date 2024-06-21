<?php
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ));
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    
    // Execute post
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            echo 'HTTP Error Code: ' . $http_code . ' | Response: ' . $result;
        }
    }
    
    // Close connection
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

if (isset($_POST['momo']) && isset($_POST['cartTotalPrice'])) {
    $tong_tien = (int)$_POST['cartTotalPrice'];
} else {
    die('Cart total price không tồn tại.');
}

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

$orderInfo = "Thanh toán qua MoMo";
$amount = $tong_tien;
$orderId = time() . "";
$redirectUrl = "http://localhost:8088/product/cuahangtraicay/pay.php";
$ipnUrl = "http://localhost:8088/product/cuahangtraicay/pay.php";
$extraData = "";

$requestId = time() . "";
$requestType = "captureWallet";

// Create raw hash string for signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "fruit_store",
    'storeId' => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);

// Debugging: Output the entire response
echo '<pre>';
print_r($jsonResult);
echo '</pre>';

// Error Handling: Check if 'payUrl' exists in the response
if (isset($jsonResult['payUrl'])) {
    header('Location: ' . $jsonResult['payUrl']);
} else {
    echo 'Error: payUrl not found in the response.';
    // Log the entire response for further investigation
    file_put_contents('momo_error_log.txt', print_r($jsonResult, true));
}
?>
