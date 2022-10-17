<?php
include 'includes/database.php';
if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];
        $name =  $_SESSION['name_kh'];
        $sql = "DELETE FROM customers WHERE id='".$id."' ";
        $query  = mysqli_query($connect, $sql);
        if ($query) {
            $name =  $_SESSION['name_kh'];

            $sql1 = "DELETE FROM users WHERE name='".$name."' ";
          mysqli_query($connect, $sql1);
         mysqli_query($connect,"DELETE FROM user_has_roles,users WHERE users.name ='".$name."' AND user_has_roles.user_id = users.name ");
             header('Location: customers.php');
               echo '<script>alert("Xóa thành công")</script>';
            exit;
        }
        else {
            echo '<script>alert("Xóa không thành công")</script>';
            exit;
        }
    }

?>