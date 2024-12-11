<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

// Định nghĩa lại hàm execPostRequest mà không cần "public"
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    // execute post
    $result = curl_exec($ch);
    // close connection
    curl_close($ch);
    return $result;
}

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['payUrl'])) {
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderInfo = "Thanh toán qua MoMo";
    $amount = $_SESSION['room']['payment'];
    $orderId = 'ORD_' . $_SESSION['uId'] . rand(1000, 9999);
    $redirectUrl = "http://localhost:8012/Hotel-Booking/pay_response.php";
    $ipnUrl = "http://localhost:8012/Hotel-Booking/pay_response.php";
    $extraData = "";

    if (!empty($_POST)) {
        $requestId = time() . "";
        $requestType = "payWithATM";

        // before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
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

        // Lưu thông tin thanh toán vào cơ sở dữ liệu trước khi gọi MoMo API
        $frm_data = filteration($_POST);
        $CUST_ID = $_SESSION['uId'];
        $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`, `trans_amt`) VALUES (?,?,?,?,?,?)";
        insert($query1, [$CUST_ID, $_SESSION['room']['id'], $frm_data['checkin'], $frm_data['checkout'], $orderId, $amount], 'issssd');

        $booking_id = mysqli_insert_id($con);

        $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
        insert($query2, [$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $amount, $frm_data['name'], $frm_data['phonenum'], $frm_data['address']], 'issssss');

        // Thực hiện yêu cầu đến MoMo API và lấy URL thanh toán
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        $log_file = "momo_debug.log";
        file_put_contents($log_file, print_r($jsonResult, true), FILE_APPEND);

        // Kiểm tra nếu có URL thanh toán từ MoMo
        if (isset($jsonResult['payUrl'])) {
            // Chuyển hướng người dùng tới trang thanh toán MoMo
            header('Location: ' . $jsonResult['payUrl']);
            exit();
        } else {
            echo "Lỗi khi tạo thanh toán với MoMo: " . $jsonResult['message'];
        }
    }
}
?>
