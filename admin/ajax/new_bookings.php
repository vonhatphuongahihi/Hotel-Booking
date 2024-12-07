<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();
    
    if (isset($_POST['get_bookings'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
            AND (bo.booking_status = ? AND bo.arrival = 0) ORDER BY bo.booking_id ASC";

        $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "booked", 0], 'ssssi');

        $i = 1;
        $table_data = "";

        if (mysqli_num_rows($res) == 0) {
            echo "<b>Không tìm thấy dữ liệu!</b>";
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
                            ID: $data[order_id]
                        </span>
                        <br>
                        <b>Người dùng:</b> $data[user_name]
                        <br>
                        <b>SDT:</b> $data[phonenum]
                    </td>
                    <td>
                        <b>Phòng:</b> $data[room_name]
                        <br>
                        <b>Giá:</b> $data[price]
                    </td>
                    <td>
                        <b>Ngày nhận phòng:</b> $checkin
                        <br>
                        <b>Ngày trả phòng:</b> $checkout
                        <br>
                        <b>Thanh toán:</b> $trans_amt
                        <br>
                        <b>Ngày:</b> $date
                    </td>
                    <td>
                        <button type='button' onclick='assign_room($data[booking_id])' class='btn text-white btn-sm fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assign-room'>
                            <i class='bi bi-check2-square'></i>Phân phòng
                        </button>
                        <br>
                        <button type='button' onclick='cancel_booking($data[booking_id])' class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
                            <i class='bi bi-trash'></i> Hủy đặt phòng
                        </button>
                    </td>
                </tr>
            ";    

            $i++;
        }
        echo $table_data;
    }

    if (isset($_POST['assign_room'])) {
        $frm_data = filteration($_POST);

        $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd 
        ON bo.booking_id = bd.booking_id
        SET bo.arrival = ?, bd.room_no = ?
        WHERE bo.booking_id = ?";

        $values = [1, $frm_data['room_no'], $frm_data['booking_id']];
        $res = update($query, $values, 'isi');
        echo ($res == 2) ? 1 : 0;
    }

    if (isset($_POST['cancel_booking'])) {
        $frm_data = filteration($_POST);
        
        $query = "UPDATE `booking_order` SET `booking_status` = ?, `refund` = ? WHERE `booking_id` = ?";
        $values = ['cancelled', 0, $frm_data['booking_id']];
        $res = update($query, $values, 'sii');

        echo $res;
    }

?>
