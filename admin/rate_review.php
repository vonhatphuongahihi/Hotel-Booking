<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();

    if(isset($_GET['seen']))
    {
        $frm_data = filteration($_GET);

        if($frm_data['seen']=='all')
        {
            $q = "UPDATE `rating_review` SET `seen` =?";
            $values = [1];
            if(update($q,$values,'i'))
            {
                alert('success','Đánh dấu tất cả đã đọc');
            }
            else{
                alert('error','Thao tác thất bại');
            }
        }
        else
        {
            $q = "UPDATE `rating_review` SET `seen` =? WHERE `sr_no`=?";
            $values = [1,$frm_data['seen']];
            if(update($q,$values,'ii'))
            {
                alert('success','Đánh dấu là đã đọc');
            }
            else{
                alert('error','Thao tác thất bại');
            }
        }
    }

    if(isset($_GET['del']))
    {
        $frm_data = filteration($_GET);

        if($frm_data['del']=='all')
        {
            $q = "DELETE FROM `rating_review`";
            if(mysqli_query($con,$q))
            {
                alert('success','Đã xóa tất cả dữ liệu!');
            }
            else{
                alert('error','Thao tác thất bại');
            }
        }
        else
        {
            $q = "DELETE FROM `rating_review` WHERE `sr_no`=?";
            $values = [$frm_data['del']];
            if(delete($q,$values,'i'))
            {
                alert('success','Dữ liệu đã được xóa');
            }
            else{
                alert('error','Thao tác thất bại');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ratings & Reviews</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">RATINGS & REVIEWS</h3>
          
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                            <i class="bi bi-check2-all"></i>Đánh dấu tất cả đã đọc
                            </a>
                            <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                                <i class="bi bi-trash"></i>Xóa tất cả
                            </a>    
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="stickcy-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên Phòng</th>
                                        <th scope="col">Tên Người Dùng</th>
                                        <th scope="col">Đánh Giá</th>
                                        <th scope="col" width="30%">Nhận Xét</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Hành Động</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    <?php
                                        $q = "SELECT  rr.*,uc.name AS uname,r.name AS rname FROM `rating_review` rr
                                        INNER JOIN `user_cred` uc ON rr.user_id = uc.id 
                                        INNER JOIN `rooms` r ON rr.room_id = r.id
                                        ORDER BY `sr_no` DESC";
                                        $data = mysqli_query($con,$q);
                                        $i=1;

                                        while($row = mysqli_fetch_assoc($data))
                                        {   
                                            $date= date('d-m-Y', strtotime($row['datentime']));

                                            $seen='';
                                            if($row['seen']!=1)
                                            {
                                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Đánh dấu đã đọc</a> <br>";
                                            }
                                            $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Xóa</a>";
                                            echo<<<query
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[rname]</td>
                                                    <td>$row[uname]</td>
                                                    <td>$row[rating]</td>
                                                    <td>$row[review]</td>
                                                    <td>$date</td>
                                                    <td>$seen</td>
                                                </tr>
                                            query;
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
</body>
</html>
