<?php include 'includes/database.php';?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Đăng ký</title>
    <link rel="stylesheet" type="text/css" href="view.css">
</head>

<Body>
    <div class="register-page">
        <div class="form">
            <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input type="text" name="username" placeholder="Tên đăng nhập" />
                <input type="password" name="password" placeholder="Mật khẩu" />
                <input type="password" name="rpassword" placeholder="Nhập lại mật khẩu" />
                <input type="text" name="email" placeholder="Email" />
                <!-- <input type="text" name="phone" placeholder="Số điện thoại" />
                <input type="text" name="address" placeholder="Địa chỉ" /> -->
                <button name="registerbtn">Đăng ký</button>
                <p class="message">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST['registerbtn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $email = $_POST['email'];
        // $phone = $_POST['phone'];
        // $address = $_POST['address'];
        $result = true;
        if (strlen($password) < 8)
            $result = false;
        if ($username == null) {
            echo '<script> alert("Không bỏ trống tên") </script>';
            exit();
        }
        if ($password == null) {
            echo '<script> alert("Không bỏ trống mật khẩu") </script>';
            exit();
        }
        if ($rpassword == null) {
            echo '<script> alert("Chưa nhập lại mật khẩu") </script>';
            exit();
        }
        if ($email == null) {
            echo '<script> alert("Không bỏ trống email") </script>';
            exit();
        }
        $count = 0;
        if (preg_match("#[a-z]+#", $password)) $count++;
        if (preg_match("#[A-Z]+#", $password)) $count++;
        if (preg_match("#[0-9]+#", $password)) $count++;
        if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password)) $count++;
        if ($count < 2) $result = false;
        // Kiểm tra sự xuất hiện của định danh trong mật khẩu 
        if (strpos($password, $username) > 0 || strpos($password, $username) === 0)
            $result = false;
        if (!preg_match("/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/", $email)) {
            echo '<script> alert("Định dạng email không hợp lệ") </script>';
            exit();
        }
        if ($result) {
            if (strcmp($password, $rpassword) != 0)
                echo '<script> alert("Mật khẩu không giống nhau") </script>';
            else {
        
                $hashpass = hash('md5', $password);
                 $create_at = date('Y-m-d H:i:s');
                $insert = "INSERT INTO `users`(`name`, `password`, `email`, `created_at`) VALUE ('$username', '$hashpass', '$email', '$created_at')";
                if ($connect->query($insert) === TRUE) {
                    echo '<script type="text/javascript"> alert("Tạo tài khoản thành công") </script>';
                    header("location: login.php");
                    
                }
            }
        } else {
            echo '<script>alert("Thông tin không hợp lệ")</script>';
        }
    }
    ?>

</Body>

</html>