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
    <title><?php echo $settings_r['site_title'] ?> - PHÒNG</title>
    <style>
        .h-line
        {
            width: 150px;
            margin: 0 auto;
            height: 1.7px;
        }
    </style>
   
</head>
<body class="bg-light">

    <?php 
        require('inc/header.php');
        
        $checkin_default="";
        $checkout_default="";
        $adult_default="";
        $children_default="";

        if(isset($_GET['check_availability']))
        {
            $frm_data = filteration($_GET);

            $checkin_default = $frm_data['checkin'];
            $checkout_default = $frm_data['checkout'];
            $adult_default = $frm_data['adult'];
            $children_default = $frm_data['children'];
        }
    ?>
    <div class="my-5 px-4">
    <h3 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">DANH SÁCH CÁC PHÒNG</h3>
    <div class="h-line bg-dark "></div>
    </div>
    
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2 fw-bold" style="font-size: 18px">BỘ LỌC</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <!-- Check availability -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 16px; font-weight: bold;">
                                    <span>THỜI GIAN</span>
                                    <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn shadow-none btn-sm text-secondary d-none">Đặt lại</button>
                                </h5>
                                <label class="form-label">Ngày nhận phòng</label>
                                <input type="date" class="form-control shadow-none mb-3" value="<?php echo $checkin_default ?>" id="checkin" onchange="chk_avail_filter()">
                                <label class="form-label">Ngày trả phòng</label>
                                <input type="date" class="form-control shadow-none" value="<?php echo $checkout_default ?>" id="checkout" onchange="chk_avail_filter()">
                            </div>

                            <!-- Facilities -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 16px; font-weight: bold;">
                                    <span>DỊCH VỤ</span>
                                    <button id="facilities_btn" onclick="facilities_clear()" class="btn shadow-none btn-sm text-secondary d-none">Đặt lại</button>
                                </h5>
                                <?php

                                    $facilities_q = selectAll('facilities');
                                    while($row = mysqli_fetch_assoc($facilities_q))
                                    {
                                        echo<<<facilities
                                            <div class="mb-2">
                                                <input type="checkbox" onclick="fetch_rooms()" name="facilities" value="$row[id]" class="form-check-input shadow-none me-1" id="$row[id]">
                                                <label class="form-check-label" for="$row[id]">$row[name]</label>
                                            </div>
                                        facilities;
                                    }

                                ?>
                            </div>

                            <!-- Guests -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 16px; font-weight: bold;">
                                    <span>KHÁCH HÀNG</span>
                                    <button id="guests_btn" onclick="guests_clear()" class="btn shadow-none btn-sm text-secondary d-none">Đặt lại</button>
                                </h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Người lớn</label>
                                        <input type="number" min="1"  value="<?php echo $adult_default ?>" id="adults" oninput="guests_filter()" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label class="form-label">Trẻ em</label>
                                        <input type="number" min="1"  value="<?php echo $children_default ?>" id="children" oninput="guests_filter()" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4" id="rooms-data"></div>

        </div>
    </div>

    <script>

        let rooms_data = document.getElementById('rooms-data');

        let checkin = document.getElementById('checkin');
        let checkout = document.getElementById('checkout');
        let chk_avail_btn = document.getElementById('chk_avail_btn');

        let adults = document.getElementById('adults');
        let children = document.getElementById('children');
        let guests_btn = document.getElementById('guests_btn');

        let facilities_btn = document.getElementById('facilities_btn');

        // Fetch rooms based on filters
        function fetch_rooms() 
        {
            let chk_avail = JSON.stringify({
                checkin: checkin.value,
                checkout: checkout.value
            });

            let guests = JSON.stringify({
                adults: adults.value,
                children: children.value
            });

            let facility_list = {"facilities": []};

            let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
            if(get_facilities.length > 0)
            {
                get_facilities.forEach((facility) => {
                    facility_list.facilities.push(facility.value);
                });
                facilities_btn.classList.remove('d-none');
            } else {
                facilities_btn.classList.add('d-none');
            }
            facility_list = JSON.stringify(facility_list);
        
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "ajax/rooms.php?fetch_rooms&chk_avail=" + chk_avail + "&guests=" + guests + "&facility_list=" + facility_list, true);
            
            xhr.onprogress = function() {
                rooms_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto" id="info_loader" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`;
            };

            xhr.onload = function() {
                rooms_data.innerHTML = this.responseText;
            };

            xhr.send();
        }

        // Filter functions
        function chk_avail_filter() {
            if (checkin.value !== '' && checkout.value !== '') {
                fetch_rooms();
                chk_avail_btn.classList.remove('d-none');
            }
        }

        function chk_avail_clear() {
            checkin.value = '';
            checkout.value = '';
            chk_avail_btn.classList.add('d-none');
            fetch_rooms();
        }

        function guests_filter() {
            if (adults.value > 0 || children.value > 0) {
                fetch_rooms();
                guests_btn.classList.remove('d-none');
            }
        }

        function guests_clear() {
            adults.value = '';
            children.value = '';
            guests_btn.classList.add('d-none');
            fetch_rooms();
        }

        function facilities_clear() {
            let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
            get_facilities.forEach((facility) => {
                facility.checked = false;
            });
            facilities_btn.classList.add('d-none');
            fetch_rooms();
        }

        window.onload = function(){
            fetch_rooms();
        }

    </script>

    <?php require('inc/footer.php'); ?>
    
</body>
</html>
