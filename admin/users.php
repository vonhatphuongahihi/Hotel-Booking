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
    <title>Admin Panel - Users</title>
    <?php require('inc/links.php'); ?>
    <style>
        th {
            text-align: center; 
            vertical-align: middle; 
        }
    </style>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4">NGƯỜI DÙNG</h4>
  
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                    
                        <div class="text-end mb-4">
                            <input type="text" oninput="search_user(this.value)" class="form-control w-25 ms-auto" id="search" placeholder="Tìm kiếm người dùng">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">STT</th>
                                        <th scope="col" width="20%">Họ và tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Xác minh</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày đăng ký</th>
                                    </tr>
                                </thead>   
                                <tbody id="users-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('inc/scripts.php'); ?>
    <script src="scripts/users.js"></script>
    
</body>
</html>
