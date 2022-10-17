<?php
include 'includes/database.php';
if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM khaosat WHERE id='".$id."' ";
        $query  = mysqli_query($connect, $sql);
        if ($query) {
          
             header('Location: users.php');
               echo '<script>alert("Xóa thành công")</script>';
            exit;
        }
        else {
            echo '<script>alert("Xóa không thành công")</script>';
            exit;
        }
    }

?>