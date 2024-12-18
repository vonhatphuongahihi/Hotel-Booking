<?php
  // Mảng dữ liệu Links
  $links = [
    [
        'title' => 'GIỚI THIỆU',
        'links' => [
            ['name' => 'Về StayHub', 'link' => '/Hotel-Booking/about.php'],
        ],
    ],
    [
        'title' => 'HỖ TRỢ',
        'links' => [
            ['name' => 'Điều khoản sử dụng', 'link' => '/Hotel-Booking/terms.php'],
            ['name' => 'Câu hỏi thường gặp', 'link' => '/Hotel-Booking/faq.php'],
        ],
    ],
    [
        'title' => 'LIÊN HỆ',
        'links' => [
            ['name' => 'Facebook', 'link' => $contact_r['fb'], 'image' => './images/facebook.png'],
            ['name' => 'Instagram', 'link' => $contact_r['insta'], 'image' => './images/instagram.png'],
            ['name' => 'Twitter', 'link' => $contact_r['tw'], 'image' => './images/twitter.png'],
        ],
    ],
];
?>
<style>
   .hi {
    width: 19% !important;
}

.social-icon {
    width: 30px; 
    height: auto;
    margin-right: 10px; 
}

@media (max-width: 576px) {
    .footer-column {
        width: 100% !important; 
        text-align: center;
    }

    .hi {
        width: 100% !important; 
    }
}

</style>
<div class="container-fluid bg-white mt-5">
    <div class="row g-2"> 
        <div class="col-lg-5 p-4" style="text-align: justify;">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
            <p>
                <?php echo $settings_r['site_about'] ?>
            </p>
        </div>

        <?php foreach ($links as $column) { ?>
            <div class="hi p-4 footer-column">
                <h5 class="mb-3 fw-bold"><?php echo $column['title']; ?></h5>
                <div class="chao">
                    <?php foreach ($column['links'] as $link) { ?>
                        <a href="<?php echo $link['link']; ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
                            <?php if (isset($link['image'])) { ?>
                                <img src="<?php echo $link['image']; ?>" alt="<?php echo $link['name']; ?>" class="social-icon"> 
                            <?php } else { ?>
                                <span><?php echo $link['name']; ?></span> 
                            <?php } ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

    <h6 class="text-center bg-dark text-white p-3 m-0">
    🏨 Khách sạn 5 sao tại Việt Nam ⭐
    </h6>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function alert(type,msg,position='body')
        {
            let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
            let element = document.createElement('div');
            element.innerHTML = `
                <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                    <strong class="me-3">${msg}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;


            if(position == 'body'){
                document.body.append(element);
                element.classList.add('custom-alert');
            }
            else{
                document.getElementById(position).appendChild(element);
            }

            setTimeout(remAlert, 3000);
        }

        function remAlert() {
        let alertElement = document.getElementsByClassName('alert')[0];
        if (alertElement) { 
            alertElement.remove();
        }
        }

        function setActive()
        {
            let navbar = document.getElementById('nav-bar');
            let a_tags = navbar.getElementsByTagName('a');

            for (i=0;i<a_tags.length;i++)
            {
                let file = a_tags[i].href.split('/').pop(); 
                let file_name = file.split('.')[0]; 

                if(document.location.href.indexOf(file_name)>=0)
                {
                    a_tags[i].classList.add('active');
                }
            }
        }
        
    let register_form = document.getElementById('register-form');
    register_form.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData();
        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phonenum', register_form.elements['phonenum'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('pincode', register_form.elements['pincode'].value);
        data.append('dob', register_form.elements['dob'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);
        xhr.onload = function() {
            switch (this.responseText) {
                case 'pass_missmatch':
                    alert('error', 'Mật khẩu không khớp!');
                    break;
                case 'email_already':
                    alert('error', 'Email đã được đăng ký!');
                    break;
                case 'phone_already':
                    alert('error', 'Số điện thoại đã được đăng ký!');
                    break;
                case 'inv_img':
                    alert('error', 'Hình ảnh không hợp lệ!');
                    break;
                case 'upd_failed':
                    alert('error', 'Đăng ký thất bại! Server down!');
                    break;
                case 'mail_failed':
                    alert('error', 'Không thể gửi email! Server down!');
                    break;
                case 'ins_failed':
                    alert('error', 'Đăng ký thất bại! Server down!');
                    break;
                default:
                    alert('success', 'Đăng ký thành công! Vui lòng kiểm tra email để xác minh tài khoản.');
                    e.target.reset();
            }
        };
        xhr.send(data);
        });

        document.getElementById('login-form').addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(e.target);
        data.append('login', '');

        let modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
        modal.hide();

        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);
        xhr.onload = function() {
            switch (this.responseText) {
                case 'inv_email_mob':
                    alert('error', 'Email hoặc số điện thoại không hợp lệ!');
                    break;
                case 'not_verified':
                    alert('error', 'Email chưa được xác minh! Vui lòng kiểm tra email.');
                    break;
                case 'inactive':
                    alert('error', 'Tài khoản bị đình chỉ! Vui lòng liên hệ Admin.');
                    break;
                case 'pass_wrong':
                    alert('error', 'Sai mật khẩu!');
                    break;
                default:
                    alert('success', 'Đăng nhập thành công!');
                    let fileurl = window.location.href.split('/').pop().split('?').shift();
                    if (fileurl == 'room_details.php') {
                        window.location = window.location.href;
                    }
                    else {
                        window.location.reload();
                    }
                    
            }
        };
        xhr.send(data);
    });
    let forgot_form = document.getElementById('forgot-form');
    document.getElementById('forgot-form').addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData();
        data.append('email', forgot_form.elements['email'].value);
        data.append('forgot_pass', '');

        let modal = bootstrap.Modal.getInstance(document.getElementById('forgotModal'));
        modal.hide();

        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);
        xhr.onprocess = function() {
            alert('success', 'Sending email...');
        };
        xhr.onload = function() {
            switch (this.responseText) {
                case 'inv_email':
                    alert('error', 'Email không hợp lệ!');
                case 'not_verified':
                    alert('error', 'Email chưa được xác minh! Vui lòng kiểm tra email.');
                    break;
                case 'inactive':
                    alert('error', 'Tài khoản bị đình chỉ! Vui lòng liên hệ Admin.');
                    break;
                case 'mail_failed':
                    alert('error', 'Không thể gửi email! Server down!');
                    break;
                case 'upd_failed':
                    alert('error', 'Khôi phục mật khẩu thất bại! Server down!');
                    break;
                default:
                    alert('success', 'Email khôi phục mật khẩu đã được gửi! Vui lòng kiểm tra email.');
                    e.target.reset();
            }
        };
        xhr.send(data);
    });

    function checkLoginToBook(status,room_id){
        if(status){
            window.location.href = 'confirm_booking.php?id='+room_id;
        }
        else{
            alert('error', 'Vui lòng đăng nhập để đặt phòng!');  
        }
    }

    setActive();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>