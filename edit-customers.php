<?php include 'includes/database.php';

if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query_role = mysqli_query($connect, "SELECT * FROM customers WHERE id = '$id'");
        $role_data = array();
    }
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
<h2> Chỉnh sửa Khách hàng </h2>
<form method="post">
    <div class="col-md-12" style="margin-top:30px;">
        <div class="col-lg-12" style="max-width:1000px;border:1px solid #eee;">
             <div class="form-group">
                <label for="name">Mã KH:</label>
                <?php echo $_GET['id']; ?>
            </div>
            <?php
            while ( $row = mysqli_fetch_array($query_role) ) {
                $_SESSION['name_kh']= $row['name'];
                ?>
            <div class="form-group">
                <label for="name">Tên:</label>
                <?php echo $row['name']; ?>
            </div>
             <div class="form-group">
                <label for="name">Địa chỉ:</label>
                <input type="text" value="<?php echo $row['address']; ?>" class="form-control" name="diachi">
            </div>
             <div class="form-group">
                <label for="name">SĐT:</label>
                <input type="text" value="<?php echo $row['phone']; ?>" class="form-control" name="sdt">
            </div>
             <div class="form-group">
                <label for="name">Mã định danh:</label>
                <input type="text" value="<?php echo $row['madd']; ?>" class="form-control" name="dinhdanh">
            </div>
             <div class="form-group">
                <label for="name">Email:</label>
                <input type="text" value="<?php echo $row['email']; ?>" class="form-control" name="email">
            </div>
              <div class="form-group">
                <label for="name">Mật khẩu:</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Mật khẩu">
        </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" name="mota" cols="30" rows="10"><?= $row['noidung']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="name">Giá tiền;</label>
                <input type="text" value="<?php echo $row['price']; ?>" class="form-control" name="giatien">
            </div>
            <div class="form-group">
                <label for="name">Số lượng khảo sát:</label>
                <input type="text" value="<?php echo $row['soluong_KS']; ?>" class="form-control" name="soluong">
            </div>
            <div class="form-group">
                <label for="name">Số lượng câu hỏi:</label>
                <input type="text" value="<?php echo $row['socau_KS']; ?>" class="form-control" name="socau">
            </div>
             <div class="form-group">
                         <label for="exampleInputEmail1">Trạng thái</label>
                         <select name="tinhtrang" class="custom-select">
                          <option value="0" <?php echo ($row['trangthai']==0)?'selected':''; ?>>Kích hoạt</option>
                          <option value="1" <?php echo ($row['trangthai']==1)?'selected':''; ?>>Không kích hoạt</option>
                      </select>
                  </div>
        </div>
        <?php } ?>
    </div>
    <div class="col-md-12">
        <input type="submit" name="submit" class="btn btn-info" value="Cập nhật">
        <a class="btn btn-default" href="customers.php"> Hủy </a>
    </div>
</form>
</body>
</html>
<?php

if (isset($_POST['submit'])) {
   

if (isset($_POST['diachi']) && isset($_POST['email']) && isset($_POST['sdt'])) {
       
        $address = $_POST['diachi'];
        $phone = $_POST['sdt'];
        $madd = $_POST['dinhdanh'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $noidung = $_POST['mota'];
        $price = $_POST['giatien'];
        $soluong = $_POST['soluong'];
        $socau =$_POST['socau'];
        $trangthai = $_POST['tinhtrang'];
        $id = $_GET['id'];
        
        $sql = "UPDATE `customers` SET `address`='{$address}',`phone`='{$phone}',`madd`='{$madd}',`email`='{$email}',`password`='{$password}',`noidung`='{$noidung}',`price`='{$price}',`soluong_KS`='{$soluong}',`socau_KS`='{$socau}',`trangthai`='{$trangthai}' WHERE id = '$id'";

         // print_r($sql);die();
        $insert = mysqli_query($connect, $sql); // Lưu Thông tin đăng ký vào bảng users                  
        if ($insert) 
        {
            if (isset($_POST['email']) && isset($_POST['password'])) {
        $name =  $_SESSION['name_kh'];
    
        $password   = trim($_POST['password']);
        $password   = md5($password); // Mã hóa md5 mật khẩu
        $update_at = date('Y-m-d H:i:s');
        $auth_id = $_SESSION['auth_user']['id']; 

        $sql ="UPDATE `users` SET  `email`='{$email}',`password`='{$password}',`trangthai`='{$trangthai}' WHERE name = '$name'";
        $insert = mysqli_query($connect, $sql); 

              header('Location: customers.php');
            echo "Update thành công";
   
             // return redirect về login
           
        }
    }
        else // nếu thất bại
        {
             echo '<script>alert("Update thất bại")</script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
            exit;
        }
    }
}

?>