<?php
include 'includes/database.php';
    $sql = "SELECT * FROM `customers`";
    $query  = mysqli_query($connect, $sql);
    $num_rows  = mysqli_num_rows($query); // đếm số bản ghi
    $list_user = array(); // tạo mảng chứa dữ liệu trả về
    if ($num_rows > 0) {
while ($row = mysqli_fetch_array($query)) {
       $list_customer[] = [
        'id'    => $row['id'],
        'name'  => $row['name'],
        'email' => $row['email'],
        'address' => $row['address'],
        'phone' => $row['phone'],
        'madd' => $row['madd'],
        'noidung' => $row['noidung'],
        'price' => $row['price'],
        'soluong' => $row['soluong_KS'],
        'socau' => $row['socau_KS'], 
        'trangthai' => $row['trangthai'],
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
    <a class="btn btn-sm btn-primary" href="add-customers.php"> Thêm khách hàng</a>
    <table class="table table-bordered" style="margin-top: 60px;border:1px solid #eee">
        <thead>

            <tr>
                <th>Mã KH</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Mã định danh</th>
                <th>Mô tả</th>
                <th>Giá tiền</th>
                <th>Số lượng khảo sát</th>
                <th>Số lượng câu hỏi</th>
                <th>Trạng thái</th>
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
                <td><?= $item['address']; ?></td>
                <td><?= $item['phone']; ?></td>
                <td><?= $item['madd']; ?></td>
                <td><?= $item['noidung']; ?></td>
                <td><?= $item['price']; ?></td>
                <td><?= $item['soluong']; ?></td>
                <td><?= $item['socau']; ?></td>
                <td><?php echo ($item['trangthai']==0) ? 'Kích hoạt' : 'Không kích hoạt'; ?></td>
                <td style="text-align:center">
                   
                        
                    <a href="edit-customers.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm"> Edit </a>
                     <a onclick="return confirm('Bạn có chắc xóa không ?')" href="delete-customer.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm"> Xóa KH </a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>

</body>
</html>