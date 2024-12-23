<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();
    
    if (isset($_POST['get_bookings'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
        WHERE bo.booking_status = 'cancelled' AND bo.refund = 0 ORDER BY bo.booking_id ASC";

        $res = mysqli_query($con, $query);
        $i = 1;
        $table_data = "";

        if (!$res || mysqli_num_rows($res) == 0) {
            echo "<b>Không tìm thấy dữ liệu!</b>";
            exit;
        }

        while ($data = mysqli_fetch_assoc($res)) {
            $date = isset($data['datetime']) ? date("d-m-Y", strtotime($data['datetime'])) : 'N/A';
            $checkin = isset($data['check_in']) ? date("d-m-Y", strtotime($data['check_in'])) : 'N/A';
            $checkout = isset($data['check_out']) ? date("d-m-Y", strtotime($data['check_out'])) : 'N/A';
            $trans_amt = isset($data['trans_amt']) ? $data['trans_amt'] : 'N/A';

            $trans_amt = number_format($trans_amt, 0, ',', '.');

            $table_data .= "
                <tr>
                    <td>$i</td>
                    <td>
                        <span class='badge bg-primary'>
                            ID: {$data['order_id']}
                        </span>
                        <br>
                        <b>Người dùng:</b> {$data['user_name']}
                        <br>
                        <b>SDT:</b> {$data['phonenum']}
                    </td>
                    <td>
                        <b>Ngày nhận phòng:</b> $checkin
                        <br>
                        <b>Ngày trả phòng:</b> $checkout
                        <br>
                        <b>Ngày đặt phòng:</b> $date
                    </td>
                    <td>
                        <b>$trans_amt</b>
                    </td>
                    <td>
                        <button type='button' onclick='refund_booking({$data['booking_id']})' class='btn btn-success btn-sm fw-bold shadow-none'>
                            <i class='bi bi-cash-stack me-2'></i> Hoàn tiền
                        </button>
                    </td>
                </tr>
            ";    

            $i++;
        }
        echo $table_data;
    }

    if (isset($_POST['refund_booking'])) {
        $frm_data = filteration($_POST);
        
        $query = "UPDATE `booking_order` SET `refund` = ? WHERE `booking_id` = ?";
        $values = [1, $frm_data['booking_id']];
        $res = update($query, $values, 'ii');

        echo $res;
    }

?>