<?php
    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');
    if (isset($_GET['email_confirmation'])) {
        $data = filteration($_GET);
        // Ghi log email và token để kiểm tra
        error_log("Email: " . $data['email'] . " Token: " . $data['token']);
        
        $query = select("SELECT * FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1", [$data['email'], $data['token']], "ss");
        if (mysqli_num_rows($query) == 1) {
            $fetch = mysqli_fetch_assoc($query);
            if ($fetch['is_verified'] == 1) {
                echo "<script>alert('Email đã được xác minh trước đó!');</script>";
            } else {
                $update = update("UPDATE `user_cred` SET `is_verified` = 1 WHERE `id`=?", [$fetch['id']], 'i'); // sử dụng $fetch['id']
                if ($update) {
                    echo "<script>alert('Xác minh email thành công!');</script>";
                } else {
                    echo "<script>alert('Xác minh email thất bại!');</script>";
                }
            }
            redirect('index.php');
        } else {
            echo "<script>alert('Email hoặc mã xác nhận không hợp lệ!');</script>"; // thông báo chính xác hơn
        }
    }
?>
