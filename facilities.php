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
        <title><?php echo $settings_r['site_title'] ?> - FACILITIES</title>
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
   <?php require('inc/header.php'); ?>
    <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CÁC DỊCH VỤ CỦA CHÚNG TÔI</h2> 
    <div class="h-line bg-dark "></div>
    <p class="text-center mt-3 ">
        Chúng tôi cung cấp những dịch vụ tốt nhất để mang lại trải nghiệm tuyệt vời cho bạn. Hãy khám phá các dịch vụ của chúng tôi ngay hôm nay!
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
