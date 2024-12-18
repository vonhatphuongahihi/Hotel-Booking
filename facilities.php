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
        <title><?php echo $settings_r['site_title'] ?> - DỊCH VỤ</title>
        <style>
            .h-line
            {
                width: 150px;
    margin: 0 auto;
    height: 1.7px;
            }
            .pop:hover
            {
                border-top-color: #2ec1ac  !important;
                transform: scale(1.03);
                transition all 0;
            }
        </style>
   
</head>
<body class="bg-light">
   <?php require('inc/header.php');?>
    <div class="my-5 px-4">
    <h3 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">DỊCH VỤ</h3>
    <div class="h-line bg-dark "></div>
    <p class="text-center mt-3" style="max-width: 800px; margin: auto; text-align: justify;">
    Với <strong>StayHub</strong>, việc tìm kiếm một nơi nghỉ ngơi thoải mái, tiện lợi và phù hợp với nhu cầu của bạn chưa bao giờ dễ dàng đến thế! StayHub cam kết mang đến cho khách hàng những dịch vụ hoàn hảo với hệ thống phòng được trang bị đầy đủ các trang thiết bị hiện đại, tiện dụng.
</p>


    </div>
    
    <div class="container">
        <div class="row">
            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res))
                {
                    echo<<<data
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex align-items-center mb-2">
                            <img src="$path$row[icon]" width="40px">
                            <h5 class="m-0 ms-3">
                                $row[name]
                            </h5> 
                        </div>
                        <p>
                            $row[description]
                        </p>
                         </div>

                    </div>
                    data;  
                }
            ?>        
        </div>
    </div>
   
    
<?php require('inc/footer.php'); ?>
    
    
</body>
</html>