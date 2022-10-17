<?php
include 'includes/database.php';
if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM permissions WHERE id='".$id."' ";
        $query  = mysqli_query($connect, $sql);
        if ($query) {
            $sql1 = "DELETE FROM role_has_permissions WHERE permission_id='".$id."' ";
        $query1  = mysqli_query($connect, $sql1);
             header('Location: permissions.php');
               echo '<script>alert("Xóa thành công")</script>';
            exit;
        }
        else {
            echo '<script>alert("Xóa không thành công")</script>';
            exit;
        }
    }

?>