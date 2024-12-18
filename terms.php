<?php
 require_once('admin/inc/db_config.php');
 require_once('admin/inc/essentials.php');

     $contact_q ="SELECT * FROM `contact_details` WHERE `sr_no`=?";
     $settings_q ="SELECT * FROM `settings` WHERE `sr_no`=?";

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
    <title><?php echo $settings_r['site_title'] ?> - ĐIỀU KHOẢN SỬ DỤNG</title>
    <style>
        .h-line {
            width: 150px;
            margin: 0 auto;
            height: 1.7px;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: justify;
            font-size: 16px;
            color: #333;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body class="bg-light">
   <?php require('inc/header.php');?>

<div class="container">
    <h3 class="mt-2 pt-4 mb-4 text-center fw-bold h-font">ĐIỀU KHOẢN SỬ DỤNG</h3>

    <p><strong>BẠN PHẢI ĐỌC NHỮNG ĐIỀU KHOẢN SỬ DỤNG DƯỚI ĐÂY TRƯỚC KHI SỬ DỤNG TRANG WEB NÀY.</strong></p>
    <p>Việc sử dụng trang web này xác nhận việc chấp thuận và tuân thủ các điều khoản và điều kiện dưới đây.</p>

    <p>Bằng cách truy cập và/hoặc sử dụng Trang Web  <a href="http://localhost:8012/Hotel-Booking" target="_blank">http://localhost:8012/Hotel-Booking</a> (“Trang Web”), bạn thừa nhận rằng bạn đã đọc, hiểu và đồng ý chịu sự ràng buộc bởi các Điều Khoản Sử Dụng được quy định dưới đây và các điều khoản và điều kiện khác liên quan đến Trang Web, bao gồm nhưng không giới hạn ở các điều khoản và điều kiện về bảo mật và Các Câu Hỏi Thường Gặp, mà chúng cấu thành các thành phần không thể tách rời của các Điều Khoản Sử Dụng (“Điều Khoản”) này. Bạn phải đủ mười tám (18) tuổi trở lên để được phép sử dụng Trang Web.</p>

    <p>Xin lưu ý rằng chúng tôi có thể thay đổi, sửa đổi, bổ sung và loại bỏ các Điều Khoản này vào bất cứ thời điểm nào mà không cần thông báo trước. Bạn phải đọc các Điều Khoản này một cách định kỳ. Bằng việc tiếp tục sử dụng Trang Web này sau khi đã có những thay đổi như vậy đối với các Điều Khoản, người truy cập, người dùng hoặc Người Dùng Đã Đăng Ký (“bạn” hay “Người Dùng”) đồng ý và chấp thuận với những thay đổi đó. Nếu bạn sử dụng bất kỳ dịch vụ nào khác của chúng tôi, thì việc sử dụng của bạn được dựa trên sự chấp thuận và tuân thủ các điều khoản và điều kiện được áp dụng đối với các dịch vụ đó.</p>

    <div class="section-title">1. PHẠM VI DỊCH VỤ ĐẶT PHÒNG KHÁCH SẠN</div>
    <p class="mt-2">1.1 Thông qua Trang Web, StayHub cung cấp một nền tảng trực tuyến cho phép bạn tìm kiếm và đặt phòng khách sạn, lựa chọn các dịch vụ lưu trú và dịch vụ đi kèm. Người dùng có thể thực hiện việc đặt phòng khách sạn hoặc các dịch vụ lưu trú khác do các nhà cung cấp dịch vụ (“Nhà Cung Cấp”) cung cấp trên trang web của chúng tôi. Bằng cách đặt phòng qua Trang Web, bạn đồng ý với các chính sách đặt phòng và thanh toán của chúng tôi.</p>

    <p>1.2 Chúng tôi cam kết cung cấp thông tin chính xác và đầy đủ về các khách sạn và dịch vụ lưu trú. Tuy nhiên, chúng tôi không chịu trách nhiệm cho bất kỳ sai sót nào (bao gồm các lỗi đánh máy hoặc thông tin không chính xác) trên trang web hoặc đối với các nhà cung cấp dịch vụ mà chúng tôi hợp tác.</p>

    <p>1.3 Trang Web này không đưa ra bất kỳ lời khuyên hay đánh giá nào về chất lượng dịch vụ của các Nhà Cung Cấp được liệt kê trên trang web. Chúng tôi khuyến khích bạn kiểm tra các đánh giá của khách hàng và thông tin chi tiết về các dịch vụ từ các Nhà Cung Cấp trước khi quyết định đặt phòng.</p>

    <div class="section-title">2. CHÍNH SÁCH HỦY BỎ VÀ ĐỔI LỊCH</div>
    <p class="mt-2">2.1 Bằng cách thực hiện việc đặt phòng, bạn đồng ý với các chính sách hủy bỏ và đổi lịch của các Nhà Cung Cấp liên quan, bao gồm cả các yêu cầu về phí hủy phòng và các điều kiện thay đổi lịch trình.</p>

    <p>2.2 Trong trường hợp bạn cần hủy hoặc thay đổi đặt phòng, xin vui lòng tham khảo các chính sách hủy của từng Nhà Cung Cấp và thực hiện theo các hướng dẫn của họ. <?php echo $settings_r['site_title']; ?> không chịu trách nhiệm về bất kỳ khoản phí hủy hoặc thay đổi nào phát sinh từ việc hủy bỏ hoặc thay đổi lịch trình của bạn.</p>

    <div class="footer">
        &copy; 2024 <?php echo $settings_r['site_title']; ?>. Tất cả quyền được bảo lưu.
    </div>
    
</div>
<?php require('inc/footer.php'); ?>


</body>
</html>
