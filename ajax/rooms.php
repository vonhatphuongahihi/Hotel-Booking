<?php

require('../admin/inc/db_config.php'); // Include database configuration
require('../admin/inc/essentials.php'); // Include essential functions
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Set the default timezone

session_start(); // Start the session to track user login status

if (isset($_GET['fetch_rooms'])) { // Check if the 'fetch_rooms' parameter is set

    // Decode 'chk_avail' data from GET request, if available
    $chk_avail = isset($_GET['chk_avail']) ? json_decode($_GET['chk_avail'], true) : null;

    // Validate check-in and check-out dates
    if ($chk_avail && isset($chk_avail['checkin'], $chk_avail['checkout']) && $chk_avail['checkin'] != '' && $chk_avail['checkout'] != '') {
        $today_date = new DateTime(date("Y-m-d"));
        $checkin_date = new DateTime($chk_avail['checkin']);
        $checkout_date = new DateTime($chk_avail['checkout']);

        // Check if the dates are invalid (allow same-day check-in and check-out for single night)
        if ($checkin_date >= $checkout_date || $checkout_date < $checkin_date || $checkin_date < $today_date) {
            echo "<h3 class='text-center text-danger'>Invalid Dates Entered!</h3>";
            exit; // Stop further execution if dates are invalid
        }
    }

    // Decode 'guests' data from GET request, if available
    $guests = isset($_GET['guests']) ? json_decode($_GET['guests'], true) : null;

    // Extract the number of adults and children, with default values as 0
    $adults = isset($guests['adults']) ? max(0, (int)$guests['adults']) : 0;
    $children = isset($guests['children']) ? max(0, (int)$guests['children']) : 0;

    // facilities data decode
    $facility_list = isset($_GET['facility_list']) ? json_decode($_GET['facility_list'], true) : [];

    // Initialize variables for room count and HTML output
    $count_rooms = 0;
    $output = "";

    // Fetch settings to check if the website is shut down
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no` = 1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con, $settings_q));

    // Fetch available rooms based on the criteria (adults, children, status, removed)
    $room_res = select("SELECT * FROM rooms WHERE `adult` >= ? AND `children` >= ? AND `status` = ? AND `removed` = ?", [$adults, $children, 1, 0], 'iiii');

    while ($room_data = mysqli_fetch_assoc($room_res)) { // Iterate through each room

        // Check room availability for the selected date range
        if ($chk_avail && isset($chk_avail['checkin'], $chk_avail['checkout']) && $chk_avail['checkin'] != '' && $chk_avail['checkout'] != '') {
            $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order`
                WHERE booking_status=? AND room_id=? 
                AND check_out > ? AND check_in < ?";

            $values = ['booked', $room_data['id'], $chk_avail['checkin'], $chk_avail['checkout']];

            $tb_fetch = mysqli_fetch_assoc(select($tb_query, $values, 'siss'));
            if (($room_data['quantity'] - $tb_fetch['total_bookings']) == 0) {
                continue; // Skip this room if fully booked
            }
        }

        // Fetch facilities for this room
        $fac_q = mysqli_query($con, "SELECT f.name, f.id FROM facilities f 
            INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id 
            WHERE rfac.room_id = '$room_data[id]'");
        $facilities_data = "";
        $room_facilities = [];
        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $room_facilities[] = $fac_row['id']; // Collect all facility IDs for this room
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$fac_row[name]</span>";
        }

        // Check if the room matches the selected facilities filter
        if (!empty($facility_list['facilities']) && empty(array_intersect($facility_list['facilities'], $room_facilities))) {
            continue; // Skip this room if the selected facilities do not match the room's facilities
        }

        // Room Features
        $fea_q = mysqli_query($con, "SELECT f.name FROM features f 
            INNER JOIN room_features rfea ON f.id = rfea.features_id 
            WHERE rfea.room_id = '$room_data[id]'");
        $features_data = "";
        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$fea_row[name]</span>";
        }

        // Fetch room thumbnail image
        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg"; // Default thumbnail
        $thumb_q = mysqli_query($con, "SELECT * FROM room_images 
            WHERE room_id = '$room_data[id]' 
            AND thumb = '1'");
        if (mysqli_num_rows($thumb_q) > 0) { // Check if a custom thumbnail exists
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }

        // Prepare the 'Book Now' button (disabled if the site is shut down)
        $book_btn = "";
        if (!$settings_r['shutdown']) {
            $login = isset($_SESSION['login']) && $_SESSION['login'] == true ? 1 : 0; // User login status
            $book_btn = "<button onclick='checkLoginToBook($login, $room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
        }

        // Generate HTML for the room card
        $output .= "
            <div class='card mb-4 border-0 shadow'>
                <div class='row g-0 p-3 align-items-center'>
                    <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                        <img src='$room_thumb' class='img-fluid rounded'>
                    </div>
                    <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                        <h5 class='mb-3'>$room_data[name]</h5>
                        <div class='features mb-3'>
                            <h6 class='mb-1'>Features</h6>
                            $features_data
                        </div>
                        <div class='facilities mb-3'>
                            <h6 class='mb-1'>Facilities</h6>
                            $facilities_data
                        </div>
                        <div class='guests'>
                            <h6 class='mb-1'>Guests</h6>
                            <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                $room_data[adult] Adults
                            </span>
                            <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                $room_data[children] Children
                            </span>    
                        </div>
                    </div>
                    <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center'>
                        <h6 class='mb-4'>$room_data[price] VND</h6>
                        $book_btn
                    </div>
                </div>
            </div>";

        $count_rooms++; // Increase room count
    }

    // Check if rooms were found
    if ($count_rooms == 0) {
        echo "<h3 class='text-center text-danger'>No Rooms Found!</h3>";
    } else {
        echo $output; // Output the rooms
    }
}
?>
