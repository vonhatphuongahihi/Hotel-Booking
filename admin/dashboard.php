<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php 
        require('inc/header.php');

        $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

        $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
            COUNT(CASE WHEN booking_status = 'booked' AND arrival=0 THEN 1 END) AS `new_bookings`,
            COUNT(CASE WHEN booking_status = 'cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
            FROM `booking_order`"));

        $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` 
            FROM `user_queries` WHERE `seen`=0"));

        $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
            FROM `rating_review` WHERE `seen`=0"));

        $current_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT
            COUNT(id) AS `total`,
            COUNT(CASE WHEN `status` = 1 THEN 1 END) AS `active`,
            COUNT(CASE WHEN `status` = 0 THEN 1 END) AS `inactive`,
            COUNT(CASE WHEN `is_verified` = 0 THEN 1 END) AS `unverified`
            FROM `user_cred`"));

    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="fw-bold">BẢNG ĐIỀU KHIỂN</h4>
                    <?php
                        if($is_shutdown['shutdown']){
                            echo<<<data
                                <h6 class="badge bg-danger py-2 px-3 rounded">Chế độ tắt máy đang hoạt động!</h6>
                            data;
                        }
                    ?>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <a href="new_bookings.php" class="text-decoration-none">
                            <div class="card text-center text-success p-3">
                                <h6>Đặt Phòng Mới</h6>
                                <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings']?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="refund_bookings.php" class="text-decoration-none">
                            <div class="card text-center text-warning p-3">
                                <h6>Đặt Phòng Hoàn Tiền</h6>
                                <h1 class="mt-2 mb-0"><?php echo $current_bookings['refund_bookings']?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>Câu Hỏi Của Người Dùng</h6>
                                <h1 class="mt-2 mb-0"><?php echo $unread_queries['count'] ?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="rate_review.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>Đánh Giá & Nhận Xét</h6>
                                <h1 class="mt-2 mb-0"><?php echo $unread_reviews['count'] ?></h1>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold">Thống kê Đặt Phòng</h5>
                    <select class="form-select shadow-none bg-light w-auto" onchange="booking_analytics(this.value)">
                        <option value="1">30 ngày qua</option>
                        <option value="2">90 ngày qua</option>
                        <option value="3">1 năm qua</option>
                        <option value="4">Tất cả thời gian</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Tổng Đặt Phòng</h6>
                            <h1 class="mt-2 mb-0" id="total_bookings">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-success p-3">
                            <h6>Đặt Phòng Đang Hoạt Động</h6>
                            <h1 class="mt-2 mb-0" id="active_bookings">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-danger p-3">
                            <h6>Đặt Phòng Đã Hủy</h6>
                            <h1 class="mt-2 mb-0" id="cancelled_bookings">0</h1>
                        </div>
                    </div>

                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold">Thống kê Người Dùng, Câu Hỏi, Đánh Giá</h5>
                    <select class="form-select shadow-none bg-light w-auto" onchange="user_analytics(this.value)">
                        <option value="1">30 ngày qua</option>
                        <option value="2">90 ngày qua</option>
                        <option value="3">1 năm qua</option>
                        <option value="4">Tất cả thời gian</option>
                    </select>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-success p-3">
                            <h6>Đăng Ký Mới</h6>
                            <h1 class="mt-2 mb-0" id="total_new_reg">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Tổng Số Câu Hỏi</h6>
                            <h1 class="mt-2 mb-0" id="total_queries">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Tổng Số Đánh Giá</h6>
                            <h1 class="mt-2 mb-0" id="total_reviews">0</h1>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold">Người Dùng</h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-info p-3">
                            <h6>Tổng</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['total']?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-success p-3">
                            <h6>Đang Hoạt Động</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['active']?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-warning p-3">
                            <h6>Ngừng Hoạt Động</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['inactive']?></h1>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-danger p-3">
                            <h6>Chưa Xác Minh</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['unverified']?></h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/dashboard.js"></script>
</body>
</html>