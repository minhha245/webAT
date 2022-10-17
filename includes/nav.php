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
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <ul class="nav navbar-nav">
            <li>
                <a href="index.php">Trang chủ</a>
            </li>
            <?php 
             foreach ($data as $item) { 
            if ($item['role_name'] == "Admin") {
                ?>

            <li >
                <a href="users.php">Quản lý User</a>
            </li>
            <li>
                <a href="roles.php">Quản lý vai trò</a>
            </li>
            <li>
                <a href="permissions.php">Quản lý quyền</a>
            </li>
              <?php
            } elseif ($item['role_name'] =="Nhân viên") {
                ?>
            <li>
                <a href="customers.php">Quản lý khách hàng</a>
            </li>
             <?php
            } elseif ($item['role_name'] =="Khách hàng") {
                ?>
            <li>
                <a href="khaosat.php">Quản lý khảo sát</a>
            </li>
            <li>
                <a href="quanlycauhoi.php">Quản lý Câu hỏi khảo sát</a>
            </li>
              <?php
            }
        }
            ?>
            <li>
                <a href="logout.php">Đăng Xuất</a>
            </li>
        </ul>
    </div>
</nav>
</body>