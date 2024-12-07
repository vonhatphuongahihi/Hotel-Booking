<?php
  // Mảng dữ liệu Links
  $links = [
    [
      'title' => 'Giới thiệu',
      'links' => [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Giới thiệu về StayHub', 'link' => '/about-us'],
      ],
    ],
    [
      'title' => 'Thông tin',
      'links' => [
        ['name' => 'Liên hệ', 'link' => '/contact-us'],
      ],
    ],
  ];
?>
<div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title']?></h3>
                <p>
                    <?php echo $settings_r['site_about']?>
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Trang chủ</a> <br>
                <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Phòng</a> <br>
                <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Dịch vụ</a> <br>
                <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Liên hệ</a> <br>
                <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">Giới thiệu</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Theo dõi</h5>
                <?php
                if($contact_r['tw']!='')
                {
                    echo<<<data
                          <a href="$contact_r[tw]" class="d-inline-block text-dark text-decoration-none mb-2">
                           <i class="bi bi-twitter-x me-1"></i> X (Twitter)
                          </a><br>
                    data;
                }
                ?>
                <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
                    <img src="./images/facebook.png" alt="logo" /> 
                </a>
                <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
                <img src="./images/instagram.png" alt="logo" /> 
                </a><br>
                
            </div>
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
                    alert('error', 'Password and Confirm Password do not match!');
                    break;
                case 'email_already':
                    alert('error', 'Email is already registered!');
                    break;
                case 'phone_already':
                    alert('error', 'Phone number is already registered!');
                    break;
                case 'inv_img':
                    alert('error', 'Only JPG, WEBP & PNG images are allowed!');
                    break;
                case 'upd_failed':
                    alert('error', 'Image upload failed!');
                    break;
                case 'mail_failed':
                    alert('error', 'Cannot send confirmation email! Server down!');
                    break;
                case 'ins_failed':
                    alert('error', 'Registration failed! Server down!');
                    break;
                default:
                    alert('success', 'Registration successful! Please check your email for confirmation link.');
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
                    alert('error', 'Invalid Email or Mobile Number!');
                    break;
                case 'not_verified':
                    alert('error', 'Email is not verified!');
                    break;
                case 'inactive':
                    alert('error', 'Account Suspended! Please contact Admin.');
                    break;
                case 'pass_wrong':
                    alert('error', 'Incorrect Password!');
                    break;
                default:
                    alert('success', 'Login successful!');
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
                    alert('error', 'Invalid Email!');
                    break;
                case 'not_verified':
                    alert('error', 'Email is not verified! Please contact Admin');
                    break;
                case 'inactive':
                    alert('error', 'Account Suspended! Please contact Admin.');
                    break;
                case 'mail_failed':
                    alert('error', 'Cannot send email. Server down!');
                    break;
                case 'upd_failed':
                    alert('error', 'Account recovery failed. Server down!');
                    break;
                default:
                    alert('success', 'Reset link sent to email!');
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7Mr0x7BUQOOnceIcNHDx5P4x5N8Fwp5cjQ1" crossorigin="anonymous"></script>