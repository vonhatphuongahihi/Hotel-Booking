<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - PROFILE</title> 
</head>
<body class="bg-light">
    <?php require('inc/header.php');
    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true))
        {
            redirect('index.php');
        }
        $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');
        if(mysqli_num_rows($u_exist)==0)
        {
            redirect('index.php');
        }
        $u_fetch = mysqli_fetch_assoc($u_exist);
        ?>
    
    
    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">PROFILE</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">TRANG CHỦ</a>
                    <span class="text-secondary"> > </span>
                
                    <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
                </div>
            </div>

            <div class="col-12 mb-5 px-4">
              <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <form id="info-form">
                    <h5 class="mb-3 fw-bold">
                        Thông tin cơ bản
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Số điện thoại</label>
                             <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-4 mb-3">
                             <label class="form-label">Ngày sinh</label>
                            <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-4 mb-3">
                             <label class="form-label">Mã bưu điện</label>
                             <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-8 mb-4">
                             <label class="form-label">Địa chỉ</label>
                             <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $u_fetch['address'] ?></textarea>
                        </div>              
                    </div>
                    <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
                </form>
              </div>
            </div>

            <div class="col-md-4 mb-5 px-4">
              <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <form id="profile-form">
                    <h5 class="mb-3 fw-bold">
                        Ảnh đại diện
                    </h5>
                    <img src="<?php  echo USERS_IMG_PATH.$u_fetch['profile']?>" class="rounded-circle img-fluid">

                    <label class="form-label">Ảnh mới</label>
                    <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="mb-4 form-control shadow-none" required>

                    <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
                </form>
              </div>
            </div>

            <div class="col-md-8 mb-5 px-4">
              <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                <form id="pass-form">
                    <h5 class="mb-3 fw-bold">
                        Đổi mật khẩu
                    </h5>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                            <label class="form-label">Mật khẩu mới</label>
                            <input name="new_pass" type="password" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Xác nhận mật khẩu</label>
                             <input name="confirm_pass" type="password" class="form-control shadow-none" required>
                        </div>
                    </div>
                    <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
                </form>
              </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    
   <script>
    // JavaScript giữ nguyên
   </script>

    
</body>
</html>
