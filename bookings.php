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
    <title><?php echo $settings_r['site_title'] ?> - BOOKINGS</title> 
</head>
<body class="bg-light">
    <?php require('inc/header.php');
    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true))
        {
            redirect('index.php');
        }?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">ĐẶT PHÒNG</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">TRANG CHỦ</a>
                    <span class="text-secondary"> > </span>
                
                    <a href="#" class="text-secondary text-decoration-none">ĐẶT PHÒNG</a>
                </div>
            </div>
            <?php
            
    $query = "SELECT bo.*, bd.* FROM booking_order bo
    INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
    WHERE ((bo.booking_status = 'booked')
    OR (bo.booking_status = 'cancelled')
    OR (bo.booking_status = 'payment failed'))
    AND (bo.user_id=?)
    ORDER BY bo.booking_id DESC";
    $result=select($query,[$_SESSION['uId']],'i');
    while($data= mysqli_fetch_assoc($result))
    {
        $date = isset($data['datetime']) ? date("d-m-Y", strtotime($data['datetime'])) : 'N/A';
        $checkin = isset($data['check_in']) ? date("d-m-Y", strtotime($data['check_in'])) : 'N/A';
        $checkout = isset($data['check_out']) ? date("d-m-Y", strtotime($data['check_out'])) : 'N/A';
        $status_bg="";
        $btn= "";
        if($data['booking_status']=='booked')
        {
            $status_bg="bg-success";
            if($data['arrival']==1)
            {
                $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]'  class='btn btn-dark btn-sm shadow-none'> Tải PDF </a>";
                    if($data['rate_review']==0)
                    {
                        $btn.="<button type='button' onclick='review_room($data[booking_id],$data[room_id])'  data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none ms-2'>Đánh giá</button>";
                    }     
            }
            else
            {
                $btn="
                <button onclick='cancle_booking($data[booking_id])' type='button' class='mt-2 btn btn-danger btn-sm shadow-none'>
                        Hủy
                    </button> 
                ";
            }
        }
        else if ($data['booking_status']=='cancelled')
        {
            $status_bg="bg-danger";
            if($data['refund']==0)
            {
                $btn="<span class='badge bg-primary'>Đang xử lý hoàn tiền!</span>";
            }
            else
            {
                $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]'  class='mt-2 btn btn-dark btn-sm shadow-none'> Tải PDF </a>";
            }
        }
        else
        {
            $status_bg="bg-warning";
            $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]'  class='mt-2 btn btn-dark btn-sm shadow-none'> Tải PDF </a>";
        }
        echo<<<bookings
        <div class='col-md-4 px-4 mb-4'>
        <div class='bg-white p-3 rounded shadow-sm'>
        <h5 class='fw-bold'>$data[room_name]</h5>
        <p>$data[price] VND mỗi đêm</p>
        <p>
        <b>Nhận phòng: </b>$checkin <br>
        <b>Trả phòng: </b> $checkout 
        </p>
        <p>
        <b>Số tiền: </b>$data[price] VND <br>
        <b>Mã đơn hàng: </b> $data[order_id] <br>
        <b>Ngày: </b> $date
        </p>
        <p>
        <span class='badge $status_bg'>$data[booking_status]</span>
        </p>
        $btn
        </div>
        </div>
        bookings;
    }
            ?>
        </div>
    </div>

    <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="review-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-chat-square-heart fs-3 me-2"></i>
                        Đánh giá và nhận xét
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Đánh giá</label>
                        <select class="form-select shadow-none" name="rating">
                            <option value="5">Xuất sắc</option>
                            <option value="4">Tốt</option>
                            <option value="3">Bình thường</option>
                            <option value="2">Kém</option>
                            <option value="1">Tệ</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nhận xét</label>
                        <textarea name="review" rows="3" required class="form-control shadow-none"></textarea>
                    </div>
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="room_id">
                    <div class="text-end">
                        <button type="submit" class="btn custom-bg text-white shadow-none">GỬI</button>
                    </div>    
                </div>
            </form>
        </div>
    </div>
</div>
    <?php
    if(isset($_GET['cancel_status']))
    {
        alert('success','Hủy phòng thành công!');
    }
    else if(isset($_GET['review_status']))
    {
        alert('success','Cảm ơn bạn đã đánh giá!');
    }
    ?>
    <?php require('inc/footer.php'); ?>
    
   <script>
     function cancle_booking(id)
     {
        if(confirm('Bạn có muốn hủy phòng?'))
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/cancle_booking.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText==1)
                {
                    window.location.href="bookings.php?cancle_status=true";
                }
                else
                {
                    alert('error','Hủy không thành công!');
                }
            }

            xhr.send('cancle_booking&id='+id);
        }
     }
     let review_form = document.getElementById('review-form');
     function review_room(bid,rid)
     {
        review_form.elements['booking_id'].value = bid;
        review_form.elements['room_id'].value = rid;
     }
     review_form.addEventListener('submit',function(e)
     {
        e.preventDefault();
        let data= new FormData();
        data.append('review_form','');
        data.append('rating',review_form.elements['rating'].value);
        data.append('review',review_form.elements['review'].value);
        data.append('booking_id',review_form.elements['booking_id'].value);
        data.append('room_id',review_form.elements['room_id'].value);
       
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/review_room.php", true);
        xhr.onload = function()
        {
            if(this.responseText==1)
            {
                window.location.href = 'bookings.php?review_status=true';
            }  
            else
            {
                let modal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
                modal.hide();
                alert('error', "Đánh giá không thành công!");
            }
        }
        xhr.send(data);
     });
   </script>
</body>
</html>
