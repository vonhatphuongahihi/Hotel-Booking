<?php
// Đảm bảo session được bắt đầu trước khi hiển thị bất kỳ nội dung nào
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/splash.css"> <!-- Link đến tệp CSS của splash -->
    <title>Splash Screen</title>

    <script>
        window.addEventListener("load", function() {
            setTimeout(() => {
                window.location.href = "index.php"; 
            }, 2500); // Sau 2.5 giây
        });
    </script>
</head>
<body>
    <div id="splash-screen" class="splash-screen">
        <img src="/Hotel-Booking/logo_hotel.png" alt="Logo" class="logo" />
        <h1 class="text-header">
            <span>STAYHUB - ĐIỂM DỪNG CHÂN LÝ TƯỞNG CỦA MỌI CHUYẾN ĐI</span>
        </h1>
    </div>
</body>
</html>
