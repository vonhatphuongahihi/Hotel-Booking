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
    <title><?php echo $settings_r['site_title'] ?> - ROOM DETAILS</title>
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

    <?php
        if(!isset($_GET['id']))
        {
            redirect('rooms.php');
        }

        $data = filteration($_GET);

        $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status` = ? AND `removed` = ?", [$data['id'],1,0],'iii');

        if(mysqli_num_rows($room_res) == 0)
        {
            redirect('rooms.php');
        }

        $room_data = mysqli_fetch_assoc($room_res);
    ?>

    
    
    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
            <h3 class="fw-bold h-font"><?php echo $room_data['name'] ?></h3>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">TRANG CHỦ</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">PHÒNG</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php

                            $room_img = ROOMS_IMG_PATH."thumbnail.jpg";
                            $img_q = mysqli_query($con, "SELECT * FROM `room_images` 
                                WHERE `room_id` = '$room_data[id]'");
                            
                            if(mysqli_num_rows($img_q) > 0)
                            {
                                $active_class = 'active';

                                while ($img_res = mysqli_fetch_assoc($img_q))
                                {
                                    echo "
                                    <div class='carousel-item $active_class'>
                                        <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                                    </div>
                                    ";
                                    $active_class = '';
                                }

                            }
                            else{
                                echo "<div class='carousel-item active'>
                                    <img src='$room_img' class='d-block w-100'>
                                </div>";
                            }
                        
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Trước</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sau</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <?php

                            echo <<< price
                                <h4>$room_data[price] VND mỗi đêm</h4>
                            price;

                            echo <<< rating
                                <div class="mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                            rating;

                            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                                INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                                WHERE rfea.room_id = '$room_data[id]'");

                            $features_data = "";
                            while($fea_row = mysqli_fetch_assoc($fea_q))
                            {
                                $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fea_row[name]
                                </span>";
                            }

                            echo <<< features
                                <div class="mb-3">
                                    <h6 class="mb-1">Không gian phòng</h6>
                                    $features_data
                                </div>
                            features;

                            $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                                WHERE rfac.room_id = '$room_data[id]'");
                            
                            $facilities_data = "";
                            while($fac_row = mysqli_fetch_assoc($fac_q))
                            {
                                $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fac_row[name]
                                </span>";
                            }

                            echo <<< facilities
                                <div class="mb-3">
                                    <h6 class="mb-1">Dịch vụ</h6>
                                    $facilities_data
                                </div>
                            facilities;

                            echo<<<guests
                                <div class="mb-3">
                                    <h6 class="mb-1">Khách hàng</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[adult] Người lớn
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[children] Trẻ em
                                    </span>    
                                </div>
                            guests;

                            echo<<<area
                                <div class="mb-3">
                                    <h6 class="mb-1">Diện tích</h6>
                                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                        $room_data[area] m<sup>2</sup>
                                    </span>
                                </div>
                            area;


                            if (!$settings_r['shutdown'])
                            {
                                $login=0;
                                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                    $login = 1;
                                }

                                echo<<<book
                                <button onclick='checkLoginToBook($login,$room_data[id])' class="btn w-100 text-white custom-bg shadow-none mb-1">Đặt phòng</button>
                                book;
                            }
                            
                            
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 px-4">
                <div class="mb-10">
                    <h5 class="mb-2 fw-bold" style="font-size: 17px;">Mô tả</h5>
                    <p style="text-align: justify;">
                        <?php echo $room_data['description'] ?>
                    </p>
                </div>

                <div>
                    <h5 class="mb-4 fw-bold" style="font-size: 17px;">Đánh giá</h5>
                    <?php
                        $review_q=  "SELECT  rr.*,uc.name AS uname,uc.profile, r.name AS rname FROM `rating_review` rr
                        INNER JOIN `user_cred` uc ON rr.user_id = uc.id 
                        INNER JOIN `rooms` r ON rr.room_id = r.id
                        WHERE rr.room_id = '$room_data[id]'
                        ORDER BY `sr_no` DESC LIMIT 15";
                        $review_res = mysqli_query($con,$review_q);
                        $img_path = USERS_IMG_PATH;
                        if (mysqli_num_rows($review_res)==0)
                        {
                            echo 'Chưa có bình luận nào!';
                        }
                        else
                        {
                            while($row = mysqli_fetch_assoc($review_res))
                            {
                                $stars = "<i class='bi bi-star-fill text-warning'></i>";
                               for ($i=1; $i<$row['rating']; $i++)
                               {
                                $stars .= "<i class='bi bi-star-fill text-warning'></i>";
                               }
                                echo<<<reviews
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="30px">
                                            <h6 class="m-0 ms-2 fw-bold">$row[uname]</h6>
                                        </div>
                                        <p>
                                            <p class="mb-1"></p>
                                            $row[review]
                                        </p>
                                        <div>
                                            $stars
                                        </div>
                                    </div>
                                reviews;
                            }
                        }
                        ?>
                </div>
            </div>

        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    
</body>
</html>