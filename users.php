<?php
include 'includes/database.php';
$sql   =   "SELECT
GROUP_CONCAT(roles.name) as name,
GROUP_CONCAT(roles.id) as role_id,users.id AS user_id, email,users.NAME AS user_name 
FROM users
LEFT JOIN user_has_roles ON users.id = user_has_roles.user_id
LEFT JOIN roles ON roles.id = user_has_roles.role_id 
GROUP BY users.id";
$query  = mysqli_query($connect, $sql);
    $num_rows  = mysqli_num_rows($query); // đếm số bản ghi
    $list_user = array(); // tạo mảng chứa dữ liệu trả về
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($query)) {
           $list_user[] = [
            'id'    => $row['user_id'],
            'name'  => $row['user_name'],
            'email' => $row['email'],
            'role_id' => $row['role_id'],
            'role_name' => ($row['name']) ? $row['name'] : 'Chưa có vai trò'
        ];
    }
}
include 'includes/nav.php';
?>
<?php

$auth_id = $_SESSION['auth_user']['id']; 
$sql = "SELECT
GROUP_CONCAT(permissions.name) as permission_name,
user_has_roles.user_id,
roles.name as role_name,
roles.id as role_id
FROM user_has_roles 
LEFT JOIN roles ON roles.id = user_has_roles.role_id
LEFT JOIN role_has_permissions ON role_has_permissions.role_id = roles.id
LEFT JOIN permissions ON role_has_permissions.permission_id = permissions.id
WHERE user_has_roles.user_id = '$auth_id'
GROUP BY roles.id";
$query  = mysqli_query($connect, $sql);
$num_rows  = mysqli_num_rows($query);

$data = array();
if ($num_rows > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $data[] = [
            'role_name' => $row['role_name'],
            'permissions' => explode(',',$row['permission_name']),
        ];
    }
}
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
        <h2> Quản lý thành viên </h2>
<?php if (in_array('Thêm User', $_SESSION['auth_user']['permission_name'])) {
// print_r($_SESSION['auth_user']['permission_name']);
 ?>
        
            <a class="btn btn-sm btn-primary" href="add-user.php"> Thêm thành viên</a>
       <?php } ?>
        <table class="table table-bordered" style="margin-top: 60px;border:1px solid #eee; width: 800px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th style="width:50px">Chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_user as $item) { 
                    $_SESSION['user']['name'] = $item['name'];
                    ?>

                    <tr class="item__user" data-name="<?= $item['name']; ?>">
                        <td><?= $item['id']; ?></td>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['email']; ?></td>
                        <td><?= $item['role_name']; ?></td>
                        <td style="text-align:center">
                            <form action="user-role.php" method="post">
                                <input type="hidden" name="role_group" value="<?= $item['role_id']; ?>">
                                <input type="hidden" name="user_name" value="<?= $item['name'].'+'.$item['id'];; ?>">
                                    
                                    <button class="btn btn-sm btn-info">Chọn vai trò </button>
                                
                            </form>
                        
                                <a onclick="return confirm('Bạn có chắc xóa không ?')" href="delete-user.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm"> Xóa user </a>
                           
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

</body>
</html>
