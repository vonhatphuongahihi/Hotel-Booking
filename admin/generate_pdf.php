<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    require('inc/mpdf/vendor/autoload.php');
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    adminLogin();

    if(isset($_GET['gen_pdf'])&&isset($_GET['id']))
    {
        $frm_data = filteration($_GET);
        echo "Booking ID: " . $frm_data['id'];
        ob_flush();

        $query = "SELECT * FROM `booking_order` WHERE booking_id = '$frm_data[id]'";




        $res = mysqli_query($con,$query);

        $total_rows = mysqli_num_rows($res);

        if($total_rows==0)
        {
            header('location: dashboard.php');
            exit;
        }
        $data = mysqli_fetch_assoc($res);
        $date =  date("h:ia | d-m-Y", strtotime($data['datentime']));
        $checkin =  date("d-m-Y", strtotime($data['check_in']));
        $checkout =  date("d-m-Y", strtotime($data['check_out']));

        echo $date;

        $table_data ="
            <h2>HÓA ĐƠN ĐẶT PHÒNG</h2>
            <table border='1'>
                <tr>
                <td>Mã Đơn Hàng: $data[order_id]</td>
                <td>Ngày Đặt: $date</td>
                </tr>
                <tr>
                    <td colspan='2'>Trạng Thái: $data[booking_status]</td>
                </tr>
                <tr>
                <td>Tên: $data[user_name]</td>
                <td>Email: $data[email]</td>
                </tr>
                <tr>
                <td>Số Điện Thoại: $data[phonenum]</td>
                <td>Địa Chỉ: $data[address]</td>
                </tr>
                <tr>
                <td>Tên Phòng: $data[room_name]</td>
                <td>Giá: $data[price] mỗi đêm</td>
                </tr>
                <tr>
                <td>Ngày Nhận Phòng: $checkin</td>
                <td>Ngày Trả Phòng: $checkout</td>
                </tr>
        ";

        if($data['booking_status']=='cancelled')
        {
            $refund = ($data['refund']) ? "Đã Hoàn Tiền" : "Chưa Hoàn Tiền";
            $table_data.="
                <tr>
                <td>Số Tiền Đã Thanh Toán: $data[trans_amt]</td>
                <td>Hoàn Tiền: $refund</td>
                </tr>
            ";
        }

        else
        {
            $table_data.=" 
                <tr>
                <td>Số Phòng: $data[room_no]</td>
                <td>Số Tiền Đã Thanh Toán: $data[trans_amt]</td>
                </tr>";
        }
        $table_data.="</table>";
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($table_data);
        $mpdf->Output();

        echo $table_data;
    }
    else{
        header('location: dashboard.php');
    }
?>
