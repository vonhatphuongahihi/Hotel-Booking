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

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />
        <?php require('inc/links.php'); ?>
        <title><?php echo $settings_r['site_title'] ?> - GIỚI THIỆU</title>
        <style>
            .h-line
            {
                width: 150px;
    margin: 0 auto;
    height: 1.7px;
            }
            .box
            {
                border-top-color : #2ec1ac !important;
            }
        </style>
    
</head>
<body class="bg-light">
   <?php require('inc/header.php');?>
    <div class="my-5 px-4">
    <h3 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">GIỚI THIỆU</h3>
    <div class="h-line bg-dark "></div>
    <p class="text-center mt-3" style="max-width: 1200px; margin: auto; text-align: justify;">
    StayHub là website đặt phòng khách sạn hiện đại, mang đến trải nghiệm tiện lợi và đáng tin cậy cho mọi khách du lịch. Chúng tôi cung cấp danh sách đa dạng các phòng với tiện nghi cao cấp, giá cả minh bạch và nhiều ưu đãi hấp dẫn. Với giao diện thân thiện, bạn có thể dễ dàng tìm kiếm, đặt phòng chỉ trong vài bước. StayHub cam kết đồng hành cùng bạn trong mọi hành trình, mang đến không gian nghỉ dưỡng thoải mái và dịch vụ chất lượng, giúp chuyến đi của bạn trở nên trọn vẹn. 
    </p>
    <p class="text-center mt-2"><strong>Chào mừng bạn đến với StayHub!</strong></p>
    </div>
  
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-md-1 order-2" style="text-align: justify;">
                <h3 class="mb-3" style="fw-bold font-size: 16px; ">StayHub - Điểm đến của mọi nhà</h3>
                <p>
                <strong>StayHub</strong> - Khách sạn sang trọng với không gian hiện đại, tiện nghi cao cấp và dịch vụ hoàn hảo, mang đến trải nghiệm tuyệt vời cho mỗi khách hàng. Tọa lạc tại vị trí đắc địa, đây là lựa chọn lý tưởng cho những ai muốn tận hưởng không gian nghỉ dưỡng đẳng cấp tại Thành phố Hồ Chí Minh. Với các phòng nghỉ rộng rãi, nhà hàng chất lượng và các tiện ích vượt trội, StayHub sẽ là điểm dừng chân lý tưởng cho mọi chuyến đi.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-md-2 order-1">
            <img src="images/hotel.jpg" class="w-100"> 
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
             <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" width="70px">
                    <h4 class="mt-3 fw-bold" style="font-size: 20px;">HƠN 100 PHÒNG</h4>
                </div>

             </div>
             <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customers.svg" width="70px">
                    <h4 class="mt-3 fw-bold" style="font-size: 20px;">HƠN 200 KHÁCH HÀNG</h4>
                </div>

             </div>
             <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" width="70px">
                    <h4 class="mt-3 fw-bold" style="font-size: 20px;">HƠN 150 ĐÁNH GIÁ</h4>
                </div>

             </div>
             <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" width="70px">
                    <h4 class="mt-3 fw-bold" style="font-size: 20px;">HƠN 100 NHÂN VIÊN</h4>
                </div>

             </div>
        </div>
          
    </div>
    <h3 class="my-5 fw-bold h-font text-center">
        BAN QUẢN LÝ
    </h3>
    <div class="container px-4">
    <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">
      <?php
      $about_r= selectALL('team_details');
      $path=ABOUT_IMG_PATH;
      while($row = mysqli_fetch_assoc($about_r))
      {
        echo<<<data
          <div class="swiper-slide bg-white text-center overflow rounded ">
           <img src="$path$row[picture]" class="w-100">
           <h5 class="mt-2">$row[name] </h5>
          </div>
        data;
      }
      ?>

      
    </div>
    <div class="swiper-pagination"></div>
  </div>
    </div>
<?php require('inc/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
    });
  </script>
    
    
</body>
</html>
