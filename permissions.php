<?php include 'includes/database.php';
$sql    = "SELECT * FROM permissions";
$query  = mysqli_query($connect, $sql);
$num_rows  = mysqli_num_rows($query);
$permissions = array();
if ($num_rows > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $permissions[] = [
            'id'    => $row['id'],
            'name'  => $row['name'],
            'description' => $row['description']
        ];
    }
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
<h2> Quản lý quyền </h2>
<div class="col-md-6">
    <h3> Thêm mới </h3>
    <div class="panel">
        <form method="post">
            <div class="form-group">
                <label for="name"> Tên: </label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="description"> Mô tả: </label>
                <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="add-permission" value="1">
                <input type="submit" class="btn btn-sm btn-warning" value="Thêm mới" name="submit">
            </div>
        </form>
    </div>
</div>
<div class="col-md-6">
    <table class="table table-bordered" style="margin-top: 60px;border:1px solid #eee">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($permissions as $item) { ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['description']; ?></td>
                  <td style="text-align:center">
                   
                        
                    <a href="edit-permission.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm"> Edit </a>
                     <a onclick="return confirm('Bạn có chắc xóa không ?')" href="delete-permissions.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm"> Xóa quyền </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>
<?php 
if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $create_at = date("Y-m-d H:i:s");
$sql_insert = "INSERT INTO permissions(name, description, create_at) VALUES ('{$name}','{$description}','{$create_at}')";
        $query_insert  = mysqli_query($connect, $sql_insert);
         // print_r($sql_insert);die;
        if ($query_insert) // nếu lưu thành công
        {
        header('Location: permissions.php'); 
        exit;
        }
        else // nếu thất bại
        {
     
        echo "Thất bại";
        exit;
        }
    }


 ?> 