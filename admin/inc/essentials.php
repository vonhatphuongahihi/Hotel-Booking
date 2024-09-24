<?php
function adminLogin(){
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>window.location.href='index.php'</script>";
    }
    session_regenerate_id(true);
}
function redirect($url) {
    echo "<script>window.location.href='$url'</script>";
}
function alert($msg) {
    echo <<<alert
        <div class="custom-alert-1">
            <strong>$msg</strong>
            <button type="button" class="btn-close-1" onclick="this.parentElement.style.display='none';" aria-label="Close"></button>
        </div>
    alert;
}
?>