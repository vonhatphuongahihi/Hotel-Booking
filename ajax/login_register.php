<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Asia/Ho_Chi_Minh');


// Load Composer's autoloader
require '../vendor/autoload.php';

function send_mail($email, $token, $type) {
    if ($type == "email_confirmation")
    {
        $page = 'verify-email.php';
        $subject = "Account Verification Link";
        $content = "confirm your email";
    }
    else{
        $page = 'index.php';
        $subject = "Account Reset Link";
        $content = "reset your account";
    }
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
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h2>Hi $name,</h2>
            <p>Click the link below to $content: </p>
            <a href='http://localhost:8012/Hotel-Booking/$page?$type&email=$email&token=$token'>Verify Account</a>
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
    if (!send_mail($data['email'], $token, "email_confirmation")) {
        echo 'mail_failed';
        exit;
    }
    $enc_pass = password_hash($data['pass'], PASSWORD_DEFAULT);

    // Thực hiện thêm người dùng vào cơ sở dữ liệu
    $query = "INSERT INTO `user_cred` (`name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `token`, `datetime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $values = [$data['name'], $data['email'], $data['phonenum'], $img, $data['address'], $data['pincode'], $data['dob'], $enc_pass, $token];

    if (insert($query, $values, 'sssssssss')) {
        echo 'success';
    } else {
        echo 'ins_failed';
    }
}
if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email_mob'], $data['email_mob']], "ss");
    
    if (mysqli_num_rows($u_exist)==0) {
        echo 'inv_email_mob';
        exit;
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        }
        else if ($u_fetch['status']==0)
        {
            echo 'inactive';
        }
        else{
            if (!password_verify($data['pass'], $u_fetch['password'])) {
                echo 'pass_wrong';
            }
            else{
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uPic'] = $u_fetch['profile'];
                $_SESSION['uPhone'] = $u_fetch['phonenum'];
                echo 1;
            }
        }
    }
}
if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']], "s");
    
    if (mysqli_num_rows($u_exist)==0) {
        echo 'inv_email';
    }
    else 
    {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        }
        else if ($u_fetch['status']==0)
        {
            echo 'inactive';
        }
        else
        {
            $token = bin2hex(random_bytes(16));

            if(!send_mail($data['email'],$token, "account_recovery"))
            {
                echo 'mail_failed';
            }
            else
            {
                $date = date('Y-m-d');
                $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token', `t_expire`='$date' WHERE `id`='$u_fetch[id]'");
                if ($query) {
                    echo 1;
                } else {
                    echo 'upd_failed';
                }
            }
        }
    }
}
if (isset($_POST['recover_user'])) {
    $data = filteration($_POST);
    $enc_pass = password_hash($data['pass'], PASSWORD_DEFAULT);
    $query = "UPDATE `user_cred` SET `password`=?, `token`=?, `t_expire`=? WHERE `email`=? AND `token`=?";  
    $values = [$enc_pass, null, null, $data['email'], $data['token']];  
    if (update($query, $values, 'sssss')) {
        echo 1;
    } else {
        echo 'failed';
    }
}
?>
