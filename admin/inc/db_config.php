<?php
    $hname = "localhost";
    $uname = "root";
    $pass = "";
    $db = "hotel_website";
    $con = mysqli_connect($hname, $uname, $pass, $db);

    if (!$con) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    function filteration($data) {
       foreach ($data as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
       }
       return $data;
    }

    function selectAll($table){
        $con = $GLOBALS['con'];
        $res = mysqli_query($con, "SELECT * FROM $table");
        return $res;
    }

    function select($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt))
            {
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }
            else {
                die("Truy vấn không thể thực thi - Select");
            }
            mysqli_stmt_close($stmt);
            
        }
        else{
            die("Không thể chuẩn bị truy vấn - Select");
        }
    }

    function update($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt))
            {
                $result = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }
            else {
                die("Truy vấn không thể thực thi - Update");
            }
            mysqli_stmt_close($stmt);
            
        }
        else{
            die("Không thể chuẩn bị truy vấn - Update");
        }
    }

    function insert($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt))
            {
                $result = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }
            else {
                die("Truy vấn không thể thực thi - Insert");
            }
            mysqli_stmt_close($stmt);
            
        }
        else{
            die("Không thể chuẩn bị truy vấn - Insert");
        }
    }

    function delete($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt))
            {
                $result = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }
            else {
                die("Truy vấn không thể thực thi - Delete");
            }
            mysqli_stmt_close($stmt);
            
        }
        else{
            die("Không thể chuẩn bị truy vấn - Delete");
        }
    }
?>