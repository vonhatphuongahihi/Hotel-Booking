<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();
    
    if (isset($_POST['get_bookings'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
            AND (bo.booking_status = ? AND bo.refund = ?) ORDER BY bo.booking_id ASC";

        $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "cancelled", 0], 'sssss');
        $i = 1;
        $table_data = "";

        if (!$res || mysqli_num_rows($res) == 0) {
            echo "<b>No Data Found!</b>";
            exit;
        }

        while ($data = mysqli_fetch_assoc($res)) {
            $date = isset($data['datentime']) ? date("d-m-Y", strtotime($data['datentime'])) : 'N/A';
            $checkin = isset($data['check_in']) ? date("d-m-Y", strtotime($data['check_in'])) : 'N/A';
            $checkout = isset($data['check_out']) ? date("d-m-Y", strtotime($data['check_out'])) : 'N/A';
            $trans_amt = isset($data['trans_amt']) ? $data['trans_amt'] : 'N/A';

            $table_data .= "
                <tr>
                    <td>$i</td>
                    <td>
                        <span class='badge bg-primary'>
                            Order ID: {$data['order_id']}
                        </span>
                        <br>
                        <b>Name:</b> {$data['user_name']}
                        <br>
                        <b>Phone No:</b> {$data['phonenum']}
                    </td>
                    <td>
                        <b>Price:</b> {$data['price']}
                    </td>
                    <td>
                        <b>Check-in:</b> $checkin
                        <br>
                        <b>Check-out:</b> $checkout
                        <br>
                        <b>Date:</b> $date
                    </td>
                    <td>
                        <b>$trans_amt</b>
                    </td>
                    <td>
                        <button type='button' onclick='refund_booking({$data['booking_id']})' class='btn btn-outline-danger btn-sm fw-bold shadow-none'>
                            <i class='bi bi-cash-stack'></i> Refund
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
