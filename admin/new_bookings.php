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
    <title>Admin Panel - New Bookings</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h4 class="fw-bold">ĐẶT PHÒNG MỚI</h4>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width: 1300px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">STT</th>
                                        <th scope="col">Người dùng</th>
                                        <th scope="col">Phòng</th>
                                        <th scope="col">Chi tiết đặt phòng</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>   
                                <tbody id="table-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

   <div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="assign_room_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="fw-bold modal-title">Phân Phòng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số phòng</label>
                            <input type="text" name="room_no" class="form-control shadow-none" required>
                        </div>
                        <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                            Lưu ý: Chỉ phân phòng khi người dùng đã đến!
                        </span>
                        <input type="hidden" name="booking_id">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn shadow-none btn-danger p-1.5 me-2"data-bs-dismiss="modal">HỦY</button>
                        <button type="submit" class="btn btn-success text-white shadow-none">PHÂN PHÒNG</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/new_bookings.js"></script>
    
</body>
</html>