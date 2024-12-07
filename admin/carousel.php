<?php
    require('inc/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Carousel</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4 fw-bold">CAROUSEL</h4>

               <!-- Carousel section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Hình ảnh</h5>
                            <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square me-2"></i> Thêm
                            </button>
                        </div>
                        <div class="row" id="carousel-data">
                            
                        </div> 
                    </div>
                </div> 

                <!-- Carousel modal -->
                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="carousel_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Hình ảnh</label>
                                        <input type="file" name="carousel_picture" id="carousel_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="carousel_picture.value=''" class="btn shadow-none btn-danger p-1.5 me-2" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Xác nhận</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/carousel.js"></script>
</body>
</html>