<?php
 require_once('admin/inc/db_config.php');
 require_once('admin/inc/essentials.php');

     $contact_q ="SELECT * FROM `contact_details`  WHERE `sr_no`=?";
     $settings_q ="SELECT * FROM `settings`  WHERE `sr_no`=?";

     $values = [1];
     $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
     $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - TRẠNG THÁI THANH TOÁN</title> 
</head>
<body class="bg-light">

    <?php require('inc/header.php');?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-3 px-4">
                <h2 class="fw-bold">TRẠNG THÁI THANH TOÁN</h2>
                
            </div>
            <?php
            $frm_data = filteration($_GET);
            if (isset($frm_data['resultCode']) && isset($frm_data['orderId'])) {
                $resultCode = $frm_data['resultCode'];
                $orderId = $frm_data['orderId'];

                // Xác định trạng thái thanh toán
                $status = ($resultCode == 0) ? 'booked' : 'pending';

                // Lấy thông tin booking từ database
                $booking_q = "SELECT bo.*, bd.* FROM `booking_order` bo 
                              INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
                              WHERE bo.order_id = ? AND bo.user_id = ? AND bo.booking_status != ?";
                $booking_res = select($booking_q, [$orderId, $_SESSION['uId'], 'pending'], 'sis');

                if (mysqli_num_rows($booking_res) == 0) {
                    redirect('index.php');
                }

                // Cập nhật trạng thái booking
                $query = "UPDATE `booking_order` SET `booking_status` = ? WHERE `order_id` = ?";
                update($query, [$status, $orderId], 'ss');

                // Thông báo người dùng
                if ($status == 'booked') {
                    echo<<<data
                    <div class="col-12 px-4">
                        <p class="fw-bold alert alert-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.</p>
                            <br><br>
                            <a href="bookings.php" class="btn btn-primary">Tới trang đặt hàng</a>
                        </p>
                    </div>
                    data;
                } else {
                    echo<<<data
                    <div class="col-12 px-4">
                        <p class="fw-bold alert alert-success">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Thanh toán thất bại. Vui lòng thử lại hoặc liên hệ hỗ trợ.
                            <br><br>
                            <a href="bookings.php" class="btn btn-primary">Tới trang đặt hàng</a>
                        </p>
                    </div>
                    data;
                }
            } else {
                echo "<div class='alert alert-danger'>Phản hồi không hợp lệ từ MoMo.</div>";
            }
            ?>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    
</body>
</html>