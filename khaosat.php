<?php
include 'includes/database.php';
    $sql = "SELECT * FROM `khaosat`";
    $query  = mysqli_query($connect, $sql);
    $num_rows  = mysqli_num_rows($query); // đếm số bản ghi
    $list_user = array(); // tạo mảng chứa dữ liệu trả về
    if ($num_rows > 0) {
while ($row = mysqli_fetch_array($query)) {
       $list_customer[] = [
        'id'    => $row['id'],
        'name'  => $row['tendangnhap'],
        'email' => $row['email'],
        'phone' => $row['sdt'],
        'noidung' => $row['thongtinkhac'],
        'id_khachhang' => $row['id_khachhang'],
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
<div class="panel" style="box-shadow: none;">
    <h2> Quản lý khách hàng </h2>
    <a class="btn btn-sm btn-primary" href="add-khaosat.php">Thêm người tham gia khảo sát</a>
    <table class="table table-bordered" style="margin-top: 60px;border:1px solid #eee">
        <thead>

            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Thông tin khác</th>
              
                <th style="width:50px">Chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_customer as $item) { 
                
                ?>

            <tr class="item__user" data-name="<?= $item['name']; ?>">
                <td><?= $item['id']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['email']; ?></td>
                <td><?= $item['phone']; ?></td>
                <td><?= $item['noidung']; ?></td>
                <td style="text-align:center">
                   
                        
                    <a href="edit-khaosat.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm"> Edit </a>
                     <a onclick="return confirm('Bạn có chắc xóa không ?')" href="delete-khaosat.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm"> Xóa KH </a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>

</body>
</html>