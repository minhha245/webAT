<?php
include 'includes/database.php'; 
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title> Danh sách thành viên - Hệ Thống Quản Trị </title>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
</script>   

</head>
<body>
<div class="panel" style="box-shadow: none;">
<h2 style="text-align: center;"> Thêm người tham gia khảo sát </h2>
  <form class="form_add_user" method="post" action="">
      <div class="form-group">
       <input type="text" id="login" class="form-control" name="name" placeholder="tendangnhap">
       </div>
       <div class="form-group">
        <input type="email" id="login" class="form-control" name="email" placeholder="Email">
        </div>
        
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="sdt" placeholder="Số điện thoại">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="mota" placeholder="Thông tin khác">
        </div>

        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-sm btn-warning" value="Thêm người tham gia">
        </div>

    </form>
</div>
	<style>
        .form_add_user {
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #eee;
            border-radius: 3px;
            padding: 20px;
            margin-top: 50px;
        }
   </style>
</body>
</html>
<?php

if (isset($_POST['submit'])) {
   
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['sdt']) && isset($_POST['mota'])) {
        $name = trim($_POST['name']);
        $phone = $_POST['sdt'];
        $email = trim($_POST['email']);
        $noidung = $_POST['mota'];
        $id_khachhang = $_SESSION['auth_user']['id'];
      
        $sql = "INSERT INTO `khaosat`(`tendangnhap`, `email`, `sdt`, `thongtinkhac`, `id_khachhang`) VALUE ('{$name}','{$email}','{$phone}','{$noidung}','{$id_khachhang}')";
        // print_r($sql);die();
        $insert = mysqli_query($connect, $sql);                
        if ($insert) 
        {
            $email = $_POST['email'];
            $result = true;
           
            $to = $email;
            $subiject = "Tên đăng nhập";
            $message = "Nhập tên đăng nhập để khảo sát: " . $name ."vào link sau: http://localhost/pqdb/login_ks.php";
            $header = "From: minhha.com";
           
            if (mail($to, $subiject, $message, $header) == true) {
              
                    
                echo '<script> alert("Tên đăng nhập khảo sát đã có trong mail") </script>';
                
                header('Location: ' . 'khaosat.php'); 

                
            } else  echo '<script type="text/javascript"> alert("Lỗi gửi mail") </script>';
            // header('Location: customers.php');
            echo '<script>alert("Thêm thành công")</script>';

             // return redirect về login
           
        }
        else // nếu thất bại
        {
             echo '<script>alert("Thêm thất bại")</script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
            exit;
        }
    }
}

?>