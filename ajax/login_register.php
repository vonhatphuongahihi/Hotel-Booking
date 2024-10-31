<?php
session_start();
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

function send_mail($name, $email, $token) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'vonhatphuongcolen@gmail.com';
        $mail->Password   = 'qoqtkxtpkszjuduz'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('vonhatphuongcolen@gmail.com', 'Hotel-Booking');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Verification Link';
        $mail->Body = "
            <h2>Hi $name, you have registered for Hotel Booking</h2>
            <p>Click the link below to verify your account</p>
            <a href='http://localhost:8012/Hotel-Booking/verify-email.php?email_confirmation&email=$email&token=$token'>Verify Account</a>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Kiểm tra sự trùng khớp giữa mật khẩu và xác nhận mật khẩu
    if ($data['pass'] !== $data['cpass']) {
        echo 'pass_missmatch';
        exit;
    }

    // Kiểm tra xem email hoặc số điện thoại đã tồn tại trong cơ sở dữ liệu hay chưa
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1", [$data['email'], $data['phonenum']], "ss");
    
    if (mysqli_num_rows($u_exist) > 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_exist_fetch['email'] == $data['email']) {
            echo 'email_already';
        } else {
            echo 'phone_already';
        }
        exit;
    }

    // Upload ảnh đại diện của người dùng lên máy chủ
    $img = uploadUserImage($_FILES['profile']);
    if ($img === 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img === 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    // Tạo token ngẫu nhiên cho xác thực email
    $token = bin2hex(random_bytes(16));
    if (!send_mail($data['name'], $data['email'], $token)) {
        echo 'mail_failed';
        exit;
    }
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    // Thực hiện thêm người dùng vào cơ sở dữ liệu
    $query = "INSERT INTO `user_cred` (`name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `token`, `datetime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $values = [$data['name'], $data['email'], $data['phonenum'], $img, $data['address'], $data['pincode'], $data['dob'], $enc_pass, $token];

    if (insert($query, $values, 'sssssssss')) {
        echo 'success';
    } else {
        echo 'ins_failed';
    }
}
?>
