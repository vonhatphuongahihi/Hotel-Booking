<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

// Giá trị mặc định cho bộ lọc
$checkin_default = '';
$checkout_default = '';
$adult_default = 1; // Mặc định 1 người lớn
$children_default = 0; // Mặc định 0 trẻ em

// Lấy thông tin liên hệ và cài đặt
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
$settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title']; ?> - ROOM</title>
    <style>
        .h-line {
            width: 150px;
            margin: 0 auto;
            height: 1.7px;
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">PHÒNG NGHỈ CỦA CHÚNG TÔI</h2>
        <div class="h-line bg-dark"></div>
    </div>
    
    <div class="container-fluid">
        <div class="row">

            <!-- Phần Bộ Lọc -->
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">BỘ LỌC</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <!-- Kiểm tra tình trạng -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <label class="form-label">Ngày nhận phòng</label>
                                <input type="date" class="form-control shadow-none mb-3" value="<?php echo $checkin_default; ?>" id="checkin" onchange="chk_avail_filter()">
                                <label class="form-label">Ngày trả phòng</label>
                                <input type="date" class="form-control shadow-none" value="<?php echo $checkout_default; ?>" id="checkout" onchange="chk_avail_filter()">
                            </div>

                            <!-- Tiện nghi -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px">
                                    <span>TIỆN NGHI</span>
                                    <button id="facilities_btn" onclick="facilities_clear()" class="btn shadow-none btn-sm text-secondary d-none">Đặt lại</button>
                                </h5>
                                <?php 
                                    $facilities_q = selectAll('facilities');
                                    while($row = mysqli_fetch_assoc($facilities_q)) {
                                        echo <<<facilities
                                        <div class="mb-2">
                                            <input type="checkbox" onclick="fetch_rooms()" name="facilities" value="$row[id]" class="form-check-input shadow-none me-1" id="$row[id]">
                                            <label class="form-check-label" for="$row[id]">$row[name]</label>
                                        </div>
                                        facilities;
                                    }
                                ?>
                            </div>

                            <!-- Số lượng khách -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px">
                                    <span>SỐ LƯỢNG KHÁCH</span>
                                    <button id="guests_btn" onclick="guests_clear()" class="btn shadow-none btn-sm text-secondary d-none">Đặt lại</button>
                                </h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Người lớn</label>
                                        <input type="number" min="1" id="adults" value="<?php echo $adult_default; ?>" oninput="guests_filter()" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label class="form-label">Trẻ em</label>
                                        <input type="number" min="0" id="children" value="<?php echo $children_default; ?>" oninput="guests_filter()" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Dữ liệu Phòng -->
            <div class="col-lg-9 col-md-12 px-4" id="rooms-data"></div>

        </div>
    </div>

    <script>
        // Nội dung JavaScript giữ nguyên
    </script>

    <?php require('inc/footer.php'); ?>
</body>
</html>
