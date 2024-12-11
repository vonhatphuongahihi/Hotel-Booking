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
    <title><?php echo $settings_r['site_title'] ?> - CONFIRM BOOKING</title> 
</head>
<body class="bg-light">

    <?php require('inc/header.php');?>

    <?php

        /*
            Check room id from url is present or not
            Shut down mode is active or not
            User is logged in or not
        */

        if(!isset($_GET['id']) || $settings_r['shutdown']==true)
        {
            redirect('rooms.php');
        }
        else if(!(isset($_SESSION['login']) && $_SESSION['login'] == true))
        {
            redirect('rooms.php');
        }

        // filter and get room and user data

        $data = filteration($_GET);

        $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status` = ? AND `removed` = ?", [$data['id'],1,0],'iii');

        if(mysqli_num_rows($room_res) == 0)
        {
            redirect('rooms.php');
        }

        $room_data = mysqli_fetch_assoc($room_res);

        $_SESSION['room'] = [
            "id" => $room_data['id'],
            "name" => $room_data['name'],
            "price" => $room_data['price'],
            "payment" => null,
            "available" => false,
        ];

        $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
        $user_data = mysqli_fetch_assoc($user_res);
    ?>

    
    
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h3 class="fw-bold" style="font-size: 24px;">XÁC NHẬN ĐẶT PHÒNG</h3>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">Phòng</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">Xác nhận đặt phòng</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <?php

                    $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                    $thumb_q = mysqli_query($con, "SELECT * FROM room_images 
                        WHERE room_id = '$room_data[id]' 
                        AND thumb = '1'");

                    if(mysqli_num_rows($thumb_q) > 0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                    }

                    echo<<<data
                        <div class="card p-3 shadow-sm rounded">
                            <img src="$room_thumb" class="img-fluid rounded mb-3">
                            <h5 class="fw-bold" style="font-size: 17px;">$room_data[name]</h5>
                            <h6>$room_data[price] VND mỗi đêm</h6>
                        </div>
                    data;

                ?>   
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body mt-4">
                        <form action="momo.php" method="POST" id="booking_form">                            
                            <h6 class="mb-4 fw-bold" style="font-size: 16px">CHI TIẾT ĐẶT PHÒNG</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tên khách hàng</label>
                                    <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">SDT</label>
                                    <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['address'] ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ngày nhận phòng</label>
                                    <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ngày trả phòng</label>
                                    <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                                </div>
                                <div class="col-12">
                                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>

                                    <h6 class="mb-3 text-danger" style="font-size: 14px;" id="pay_info">Vui lòng nhập ngày nhận phòng và trả phòng</h6>
                                    
                                    <button name="payUrl" class="btn mt-4 w-100 text-white custom-bg shadow-none mb-1" disabled>Thanh toán</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    <script>
        let booking_form = document.getElementById('booking_form');
        let info_loader = document.getElementById('info_loader');
        let pay_info = document.getElementById('pay_info');

        function check_availability()
        {
            let checkin_val = booking_form.elements['checkin'].value;
            let checkout_val = booking_form.elements['checkout'].value;

            booking_form.elements['payUrl'].setAttribute('disabled', true);

            if(checkin_val!='' && checkout_val!='')
            {
                pay_info.classList.add('d-none');
                pay_info.classList.replace('text-dark','text-danger');
                info_loader.classList.remove('d-none');

                let data = new FormData();

                data.append('check_availability', '');
                data.append('check_in', checkin_val);
                data.append('check_out', checkout_val);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confirm_booking.php", true);

                xhr.onload = function() 
                {
                    let data = JSON.parse(this.responseText);
                    if(data.status == 'check_in_out_equal')
                    {
                        pay_info.innerText = "Bạn không thể nhận và trả phòng vào cùng một ngày!";
                    }
                    else if(data.status == 'check_out_ealier')
                    {
                        pay_info.innerText = "Ngày trả phòng phải sau ngày nhận phòng!";
                    }
                    else if(data.status == 'check_in_ealier')
                    {
                        pay_info.innerText = "Ngày nhận phòng phải sau ngày hiện tại!";
                    }
                    else if(data.status == 'unavailable')
                    {
                        pay_info.innerText = "Phòng không khả dụng trong khoảng thời gian này!";
                    }
                    else
                    {
                        pay_info.innerHTML = "Số ngày: "+data.days+"<br><br>Tổng số tiền: "+data.payment+" VND";
                        pay_info.classList.replace('text-danger','text-dark');
                        pay_info.style.fontSize = "16px"; 
                        pay_info.style.fontWeight = "700"; 
                        pay_info.style.marginBottom = "4px"; 
                        pay_info.style.marginTop = "6px"; 
                        booking_form.elements['payUrl'].removeAttribute('disabled');
                    }

                    pay_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');
                };

                xhr.send(data);
            }
        }

    </script>
    
</body>
</html>