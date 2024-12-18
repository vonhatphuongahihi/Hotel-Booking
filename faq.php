<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title']; ?> - CÂU HỎI THƯỜNG GẶP</title>

    <style>
        .faq-item { cursor: pointer; }
        .faq-item .answer { display: none; transition: all 0.3s ease; }
        .faq-item.open .answer { display: block; }
        .faq-item .bi-chevron-down {
            transition: transform 0.3s ease;
        }

        .faq-item.open .bi-chevron-down {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container my-5">
        <h3 class="text-center fw-bold mb-4 h-font">CÂU HỎI THƯỜNG GẶP</h3>
        
        <div class="accordion" id="faqAccordion">
            <?php
            $faqData = [
                [
                    "question" => "Làm thế nào để đặt phòng tại khách sạn?",
                    "answer" => "Bạn có thể đặt phòng trực tuyến qua website của chúng tôi bằng cách chọn ngày nhận phòng, ngày trả phòng và loại phòng bạn mong muốn, sau đó điền thông tin thanh toán để hoàn tất đặt phòng."
                ],
                [
                    "question" => "Chính sách hủy phòng như thế nào?",
                    "answer" => "Bạn có thể hủy phòng miễn phí trước 24 giờ so với thời gian nhận phòng. Sau thời gian này, khách sạn sẽ tính phí hủy tương đương 50% tổng giá trị đặt phòng."
                ],
                [
                    "question" => "Khách sạn có những tiện nghi gì?",
                    "answer" => "Chúng tôi cung cấp đầy đủ các tiện nghi như tủ lạnh mini, không gian làm việc, Wi-Fi miễn phí và dịch vụ đưa đón."
                ],
                [
                    "question" => "Tôi có thể thanh toán bằng những phương thức nào?",
                    "answer" => "Chúng tôi chấp nhận thanh toán qua thẻ tín dụng, thẻ ghi nợ, chuyển khoản ngân hàng và thanh toán tiền mặt tại quầy lễ tân."
                ],
                [
                    "question" => "Giờ nhận phòng và trả phòng là khi nào?",
                    "answer" => "Giờ nhận phòng là 9:00 giờ sáng và giờ trả phòng là 8:00 sáng ngày hôm sau. Quý khách có thể yêu cầu nhận phòng sớm hoặc trả phòng muộn tùy vào tình trạng phòng trống."
                ],
                [
                    "question" => "Khách sạn có hỗ trợ đón khách từ sân bay không?",
                    "answer" => "Có, chúng tôi cung cấp dịch vụ đưa đón sân bay với một khoản phí nhỏ. Vui lòng liên hệ với khách sạn để đặt dịch vụ này trước khi đến."
                ],
                [
                    "question" => "Trẻ em có được ở miễn phí không?",
                    "answer" => "Trẻ em dưới 6 tuổi được ở miễn phí nếu sử dụng chung giường với cha mẹ. Đối với trẻ em từ 6-12 tuổi, phụ thu giường phụ sẽ được áp dụng."
                ],
                [
                    "question" => "Khách sạn có chỗ đỗ xe miễn phí không?",
                    "answer" => "Có, chúng tôi cung cấp chỗ đỗ xe miễn phí dành cho khách lưu trú tại khách sạn."
                ],
                [
                    "question" => "Tôi có thể mang theo thú cưng không?",
                    "answer" => "Rất tiếc, chúng tôi không cho phép mang theo thú cưng vào khách sạn để đảm bảo sự thoải mái cho tất cả khách lưu trú."
                ],
                [
                    "question" => "Khách sạn có dịch vụ ăn uống tại phòng không?",
                    "answer" => "Có, chúng tôi cung cấp dịch vụ ăn uống tại phòng 24/7 để phục vụ nhu cầu của quý khách."
                ]
            ];

            foreach ($faqData as $index => $faq) {
                $question = $faq['question'];
                $answer = $faq['answer'];                
                echo "
                <div class='faq-item border p-3 mb-3 rounded shadow-sm'>
                    <div class='d-flex justify-content-between align-items-center' data-bs-toggle='collapse' data-bs-target='#faq$index'>
                        <span class='fw-bold'>$question</span>
                        <i class='bi bi-chevron-down'></i>
                    </div>
                    <div id='faq$index' class='collapse answer mt-2'>
                        <p class='mb-0'>$answer</p>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                const icon = item.querySelector('.bi-chevron-down');
                
                // Toggle 'open' class
                item.classList.toggle('open');

                // Đóng các mục khác (nếu cần)
                document.querySelectorAll('.faq-item').forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('open');
                    }
                });
            });
        });
    </script>
</body>
</html>
