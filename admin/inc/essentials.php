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
        <div class="custom-alert">
            <strong>$msg</strong>
            <button type="button" class="btn-close" onclick="this.parentElement.style.display='none';"></button>
        </div>
    alert;
}
?>
<style>
    .custom-alert {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    position: fixed;
    top: 25px;
    left: 25px;
    width: auto;
    min-width: 280px; 
    padding-right: 50px;
}

.btn-close {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%); 
    background: none;
    border: none;
    font-size: 16px;
    color: #721c24; 
    cursor: pointer;
}

.btn-close:hover {
    color: #000; 
}


</style>
