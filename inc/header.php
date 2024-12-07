<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
.navbar .nav-link {
    color: #ffffff;
    padding: 10px 15px; 
}

.navbar .nav-link:hover {
    background-color: rgba(0, 0, 0, 0.1); 
    border-radius: 5px; 
    width: 100px; 
    height: 40px;
    display: flex; 
    justify-content: center;
    align-items: center;
    padding: 0; 
    color: #000;
}

.navbar .nav-link.active {
    background-color: #111111; 
    color: #ffffff !important;            
    border-radius: 5px; 
    width: 100px; 
    height: 40px; 
    display: flex; 
    justify-content: center;
    align-items: center;
    padding: 0; 
}

    </style>


</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once('admin/inc/db_config.php');
        require_once('admin/inc/essentials.php');

        $contact_q = "SELECT * FROM contact_details WHERE `sr_no`=?";
        $settings_q = "SELECT * FROM settings WHERE `sr_no`=?";
        $values = [1];

        $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
        $settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
        ?>

        <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title']; ?></a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link me-2" href="index.php">Trang Chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="rooms.php">Phòng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="facilities.php">Dịch Vụ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="contact.php">Liên Hệ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="about.php">Giới Thiệu</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <?php
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            $path = USERS_IMG_PATH;
                            echo <<<data
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1 rounded-circle">
                                    $_SESSION[uName]
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="profile.php">Hồ sơ</a></li>
                                    <li><a class="dropdown-item" href="bookings.php">Đặt phòng</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                                </ul>
                            </div>
                            data;
                        } else {
                            echo <<<data
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng Nhập</button>
                            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">Đăng Ký</button>
                            data;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Thành công</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        Email xác minh đã được gửi thành công! Vui lòng kiểm tra email để hoàn tất quá trình xác minh.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="login-form">
                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center fw-bold">
                                <i class="bi bi-person-circle fs-3 me-2"></i>
                                ĐĂNG NHẬP
                                
                            </h5>
                            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Email / Số điện thoại</label>
                                <input type="text" name="email_mob" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="pass" required class="form-control shadow-none">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="submit" class="btn btn-dark shadow-none fw-bold">Đăng nhập</button>
                                <button type="button" class="btn text-secondary text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">Quên mật khẩu?</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="forgot-form">
                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center fw-bold">
                                <i class="bi bi-person-circle fs-3 me-2"></i>
                                QUÊN MẬT KHẨU
                            </h5>
                            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                    Lưu ý: Một liên kết sẽ được gửi đến email của bạn để đặt lại mật khẩu!
                                </span>
                                <br>
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-2 text-end">
                                <button type="button" class="btn shadow-none btn-danger p-1.5 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-dark shadow-none">Gửi liên kết</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <?php
                if (isset($_SESSION['status'])) {
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Thành công!</strong> ' . $_SESSION['status'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                        </div>';
                    unset($_SESSION['status']);
                }
                ?>
                <div class="modal-content">
                    <form action="login-register.php" method="POST" id="register-form">
                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center fw-bold">
                                <i class="bi bi-person-lines-fill fs-3 me-2"></i>ĐĂNG KÝ
                            </h5>
                            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                Lưu ý: Thông tin của bạn phải khớp với giấy tờ tùy thân (hộ chiếu,...) sẽ được yêu cầu khi check-in.
                            </span>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Họ và tên</label>
                                        <input name="name" type="text" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input name="phonenum" type="number" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label">Hình ảnh</label>
                                        <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-12 p-0 mb-3">
                                        <label class="form-label">Địa chỉ</label>
                                        <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Mã vùng</label>
                                        <input name="pincode" type="number" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label">Ngày sinh</label>
                                        <input name="dob" type="date" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Mật khẩu</label>
                                        <input name="pass" type="password" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label">Xác nhận mật khẩu</label>
                                        <input name="cpass" type="password" class="form-control shadow-none" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center my-1">
                                <button type="submit" class="btn btn-dark shadow-none fw-bold">Đăng ký</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const loginForm = document.getElementById('login-form');
                const forgotForm = document.getElementById('forgot-form');
                const registerForm = document.getElementById('register-form');

                // Xử lý sự kiện gửi form đăng nhập
                loginForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    // Xử lý AJAX để xử lý đăng nhập
                });

                // Xử lý sự kiện gửi form quên mật khẩu
                forgotForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    // Xử lý AJAX để xử lý quên mật khẩu
                });

                // Xử lý sự kiện gửi form đăng ký
                registerForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    // Xử lý AJAX để xử lý đăng ký
                });
            });
        </script>
</body>
</html>