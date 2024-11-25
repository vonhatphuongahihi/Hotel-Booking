<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['add_image']))
    {
        $img_r = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);
        if ($img_r == 'inv_img') {
            echo "Hình ảnh không hợp lệ!";
        }
        else if ($img_r == 'inv_size') {
            echo "Kích thước hình ảnh quá lớn!";
        }
        else if ($img_r == 'upd_failed') {
            echo "Tải lên hình ảnh thất bại!";
        }
        else {
            $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [$img_r];
            $res = insert($q, $values,'s');
            echo ($res) ? "Thêm hình ảnh thành công!" : "Thêm hình ảnh thất bại!";
        }
    }

    if (isset($_POST['get_carousel'])) {
        $res = selectAll('carousel');
        while ($row = mysqli_fetch_assoc($res)) {
            $path = CAROUSEL_IMG_PATH;
            echo <<<data
            <div class="col-md-2 mb-3">
                <div class="card bg-dark text-white">
                    <img src="$path$row[image]" class="card-img" >
                    <div class="card-img-overlay text-end">
                        <button type="button" onclick="rem_image($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            </div>
            data;
        }
    }

    if (isset($_POST['rem_image'])) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_image']];
        $pre_q = "SELECT * FROM `carousel` WHERE `sr_no`= ?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['image'], CAROUSEL_FOLDER)) {
            $q = "DELETE FROM `carousel` WHERE `sr_no` = ?";
            $res = delete($q, $values, 'i');
            echo ($res) ? "Xóa hình ảnh thành công!" : "Xóa hình ảnh thất bại!";
        }
        else {
            echo "Xóa hình ảnh thất bại!";
        }
    }

?>
