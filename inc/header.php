<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
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
                    <a class="nav-link me-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">About</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    $path = USERS_IMG_PATH;
                    echo <<<data
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1">
                            $_SESSION[uName]
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    data;
                } else {
                    echo <<<data
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                    data;
                }
                ?>
            </div>
        </div>
    </div>
</nav>

<!-- Success Modal -->
<div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your verification email has been sent successfully! Please check your email to complete the verification process.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email / Mobile</label>
                        <input type="text" name="email_mob" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" required class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                        <button type="button" class="btn text-secondary text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">Forgot Password?</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        Forgot Password
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                            Note: A link will be sent to your email to reset your password!
                        </span>
                        <br>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-2 text-end">
                        <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-dark shadow-none">SEND LINK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <?php
        if (isset($_SESSION['status'])) {
            // Hiển thị thông báo nếu có
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> ' . $_SESSION['status'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['status']);
        }
        ?>
        <div class="modal-content">
            <form action="login-register.php" method="POST" id="register-form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (Passport, etc.) that will be required during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 pe-0 mb-3">
                                <label class="form-label">Mobile</label>
                                <input name="mobile" type="text" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 pe-0 mb-3">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">ID Type</label>
                                <select name="id_type" class="form-select shadow-none" required>
                                    <option value="" disabled selected>Select your ID type</option>
                                    <option value="Passport">Passport</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Driver's License">Driver's License</option>
                                </select>
                            </div>
                            <div class="col-md-6 pe-0 mb-3">
                                <label class="form-label">ID Number</label>
                                <input name="id_number" type="text" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input name="uPic" type="file" class="form-control shadow-none" accept=".png, .jpg, .jpeg" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
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

        // Handle login form submission
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            // Add your AJAX call here to handle login
        });

        // Handle forgot password form submission
        forgotForm.addEventListener('submit', function (e) {
            e.preventDefault();
            // Add your AJAX call here to handle forgot password
        });

        // Handle register form submission
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();
            // Add your AJAX call here to handle registration
        });
    });
</script>
