<?php
    require('inc/essentials.php');
    require('inc/db_config.php');    
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Features & Facilities</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4 fw-bold">KHÔNG GIAN PHÒNG VÀ DỊCH VỤ</h4>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                    
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Không gian phòng</h5>
                            <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                                <i class="bi bi-plus-square me-2"></i> Thêm
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên không gian</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thread>   
                                <tbody id="features-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div> 

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                    
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Dịch vụ</h5>
                            <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                            <i class="bi bi-plus-square me-2"></i> Thêm
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                    <th scope="col">STT</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Tên dịch vụ</th>
                                    <th scope="col" width="40%">Mô tả</th>
                                    <th scope="col">Hành động</th>
                                    </tr>
                                </thread>   
                                <tbody id="facilities-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </div>

    <!-- Feature modal -->

    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm Không gian phòng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên không gian</label>
                            <input type="text" name="feature_name" class="form-control shadow-none" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger me-2 shadow-none" data-bs-dismiss="modal">HỦY</button>
                        <button type="submit" class="btn btn-success text-white shadow-none">THÊM</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Facility modal -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm Dịch vụ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên dịch vụ</label>
                            <input type="text" name="facility_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="file" name="facility_icon" accept=".svg" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger me-2 shadow-none" data-bs-dismiss="modal">HỦY</button>
                        <button type="submit" class="btn btn-success text-white shadow-none">THÊM</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php require('inc/scripts.php'); ?>
<script src="scripts/features_facilities.js"></script>
    
</body>
</html>