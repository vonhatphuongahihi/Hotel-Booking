<?php
//front end purpose data
define('SITE_URL', 'http://127.0.0.1:8012/Hotel-Booking/');
define('ABOUT_IMG_PATH', SITE_URL.'images/about/');
//back end upload process needs this data

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/HOTEL-BOOKING/images/');
define('ABOUT_FOLDER', 'about/');
function adminLogin(){
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>window.location.href='index.php'</script>";
        exit;
    }
   
}
function redirect($url) {
    echo "<script>window.location.href='$url'</script>";
    exit;
}
function alert($msg) {
    echo <<<alert
        <div class="custom-alert-1">
            <strong>$msg</strong>
            <button type="button" class="btn-close-1" onclick="this.parentElement.style.display='none';" aria-label="Close"></button>
        </div>
    alert;
}
function uploadImage($image, $folder)
{
    $valid_mine = ['image/webp', 'image/jpg', 'image/jpeg', 'image/png'];
    $img_mine = $image['type'];
    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img';
    }
    else if (($image['size']/(1024*1024))>2) {
        return 'inv_size';
    }
    else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(1000, 9999).".$ext";
        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        }
        else {
            return 'upd_failed';
        }
        
    }
}

function deleteImage($image, $folder)
{
    if (unlink(UPLOAD_IMAGE_PATH.$folder.$image)) {
        return true;
    }
    else {
        return false;
    }
}
?>