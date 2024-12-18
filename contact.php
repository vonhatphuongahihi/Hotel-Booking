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
    <title><?php echo $settings_r['site_title'] ?> - LIÊN HỆ</title>
        <style>
            .h-line
            {
                width: 150px;
    margin: 0 auto;
    height: 1.7px;
            }
        </style>
   
</head>
<body class="bg-light">
   <?php require('inc/header.php');?>
    <div class="my-5 px-4">
    <h3 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">LIÊN HỆ</h3>
    <div class="h-line bg-dark "></div>
    <p class="text-center mt-3 " style="max-width: 1300px; margin: auto; text-align: justify;">
    Chúng tôi luôn sẵn sàng hỗ trợ bạn trong mọi vấn đề liên quan đến đặt phòng và dịch vụ khách sạn. Nếu bạn có bất kỳ câu hỏi nào hoặc cần trợ giúp về việc đặt phòng khách sạn, đừng ngần ngại liên hệ với chúng tôi. Đội ngũ chăm sóc khách hàng của StayHub luôn luôn ở đây để mang đến sự hài lòng và giúp bạn có được những trải nghiệm tuyệt vời nhất.    </p>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe'] ?> " loading="lazy"></iframe>
                        <h5 class="fw-bold" style="font-size: 17px;">Địa chỉ</h5>
                        <a href=" <?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt"></i> <?php echo $contact_r['address'] ?>
                        </a>
                        <h5 class="mt-4 fw-bold" style="font-size: 17px;">Điện thoại</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <?php
                    if($contact_r['pn2']!='')
                    {
                        echo<<<data
                            <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                            </a>
                        data;
                    } 
                    ?>
                
                    <h5 class= "mt-4 fw-bold" style="font-size: 17px;">
                        Email
                    </h5>
                    <a href="mailto : <?php echo $contact_r['email'] ?>" class=" d-inline-block text-decoration-none text-dark">
                    <i class="bi bi-envelope-fill"></i>
                    <?php echo $contact_r['email'] ?>
                    </a>
                    <h5 class="mt-4 fw-bold" style="font-size: 17px;">Theo dõi</h5>
                    <?php
                    if($contact_r['tw']!='')
                    {
                        echo<<<data
                            <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
                       
                             <i class="bi bi-twitter-x me-1"></i>
                        
                            </a>

                        data;
                    }
                    ?>
            
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark fs-5">

                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <form method="POST">
                        <h5 class="fw-bold mb-4">Gửi câu hỏi</h5>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight :500">Họ và tên</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight :500">Email</label>
                            <input name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight :500">Tiêu đề</label>
                            <input name="subject" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" style=" font-weight :500">Nội dung</label>
                            <textarea name="message" required class="form-control shadow-none" rows="5" style="resize : none;"></textarea>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="submit" name="send" class="btn text-white custom-bg">GỬI</button>
                        </div>
                    </form>
                </div>
            </div>


            </div>
          
        </div>
    </div>
   

    <?php
        if(isset($_POST['send']))
        {
            $frm_data = filteration($_POST);

            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?)";
            $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

            $res = insert($q, $values, 'ssss');
            if($res==1){
                alert('success','Đã gửi câu hỏi! Chúng tôi sẽ liên hệ với bạn sớm nhất có thể');
            }
            else{
                alert('error','Đã xảy ra lỗi! Vui lòng thử lại sau');
            }
        }
    ?>

<?php require('inc/footer.php'); ?>
    
    
</body>
</html>