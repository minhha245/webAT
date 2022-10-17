<?php
	session_start();// khởi tạo session
	session_destroy();
	header('Location: ' . 'login.php');
?>

