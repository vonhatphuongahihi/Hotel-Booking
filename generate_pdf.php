<?php
    require('admin/inc/essentials.php');
    require('admin/inc/db_config.php');
    require('admin/inc/mpdf/vendor/autoload.php');
    session_start();

    if(isset($_GET['gen_pdf']) && isset($_GET['id']))
    {
        $frm_data = filteration($_GET);

        $query = "SELECT bo.*, bd.* FROM booking_order bo
            INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
            WHERE ((bo.booking_status = 'booked' AND bo.arrival = 1)
            OR (bo.booking_status = 'cancelled' AND bo.refund = 1))
            OR (bo.booking_status = 'payment failed' AND bo.refund = 1))
            AND bo.booking_id = '$frm_data[id]'";

        $res = mysqli_query($con, $query);

        $total_rows = mysqli_num_rows($res);

        if($total_rows == 0)
        {
            header('location: index.php');
            exit;
        }
        $data = mysqli_fetch_assoc($res);
        $date =  date("h:ia | d-m-Y", strtotime($data['datentime']));
        $checkin =  date("d-m-Y", strtotime($data['check_in']));
        $checkout =  date("d-m-Y", strtotime($data['check_out']));

        echo $date;

        $table_data ="
            <h2>BOOKING RECEIPT</h2>
            <table border='1'>
                <tr>
                <td>Order ID: $data[order_id]</td>
                <td>Ngày Đặt: $date</td>
                </tr>
                <tr>
                    <td colspan='2'>Trạng Thái: $data[booking_status]</td>
                </tr>
                <tr>
                <td>Họ Tên: $data[user_name]</td>
                <td>Email: $data[email]</td>
                </tr>
                <tr>
                <td>Số Điện Thoại: $data[phonenum]</td>
                <td>Địa Chỉ: $data[address]</td>
                </tr>
                <tr>
                <td>Tên Phòng: $data[room_name]</td>
                <td>Giá: $data[price] VND mỗi đêm</td>
                </tr>
                <tr>
                <td>Ngày Nhận Phòng: $checkin</td>
                <td>Ngày Trả Phòng: $checkout</td>
                </tr>
        ";

        if($data['booking_status'] == 'cancelled')
        {
            $refund = ($data['refund']) ? "Số Tiền Được Hoàn" : "Chưa Hoàn Tiền";
            $table_data .= "
                <tr>
                <td>Số Tiền Đã Thanh Toán: $data[trans_amt] VND</td>
                <td>Hoàn Tiền: $refund</td>
                </tr>
            ";
        }
        else if($data['booking_status'] == 'payment failed')
        {
            $table_data .= "
                <tr>
                <td>Số Tiền Giao Dịch: $data[trans_amt] VND</td>
                <td>Lý Do Thanh Toán Thất Bại: $data[trans_resp_msg]</td>
                </tr>";
        }

        else
        {
            $table_data .= "
                <tr>
                <td>Số Phòng: $data[room_no]</td>
                <td>Số Tiền Đã Thanh Toán: đ $data[trans_amt]</td>
                </tr>";
        }
        $table_data .= "</table>";
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($table_data);
        $mpdf->Output();

        echo $table_data;
    }
    else{
        header('location: index.php');
    }
?>
