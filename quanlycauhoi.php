<?php
include 'includes/database.php';
include 'includes/nav.php';
if (isset($_POST['send'])) {
    $uname  = trim($_SESSION['nameclient']);
    $q1     = trim($_POST['q1']);
    $q2  = trim($_POST['q2']);
    $q3   = trim($_POST['q3']);
    $q4     = trim($_POST['q4']);
    $q5    = trim($_POST['q5']);
    $q6      = trim($_POST['q6']);
    $sql = "INSERT INTO bangks (username,q1,q2,q3,q4,q5,q6) VALUE ('{$uname}','{$q1}','{$q2}','{$q3}','{$q4}','{$q5}','{$q6}')";
    $insert = mysqli_query($connect, $sql);
    if ($insert) {
        header('Location: ' . 'complete.php');
        exit;
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title> </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
    </script>

</head>

<body style="background: rgb(255, 255, 255)">
    <div class="panel" style="box-shadow: none;">
        <h2 style="font-family:time new roman;font-size:38px;font-weight: 1000;text-align: center;margin-top: 70px"> Điền vào biểu mẫu </h2>
        <form class="form_add_user" method="post" action="?page=dang-ky">

            <div class="form-group">
                <h4>Câu 1: Mối quan hệ giữa bạn và tổ chức là gì? (vui lòng chọn những câu phù hợp):</h4>
                <input type="radio" id="box1" name="q1" value="Đang là thân chủ trực tiếp">
                <label for="box1">Đang là thân chủ trực tiếp</label><br>
                <input type="radio" id="box2" name="q1" value="Đã từng là thân chủ trực tiếp">
                <label for="box2">Đã từng là thân chủ trực tiếp</label><br>
                <input type="radio" id="box3" name="q1" value="Thành viên tổ chức">
                <label for="box3">Thành viên tổ chức</label><br>
                <input type="radio" id="box4" name="q1" value="Nhân viên tổ chức">
                <label for="box4">Nhân viên tổ chức</label><br>
            </div>
            <br>
            <div class="form-group">
                <h4>Câu 2: Làm thế nào bạn biết được dịch vụ/hoạt động của chúng tôi?</h4>
                <input type="radio" id="box5" name="q2" value="Liên hệ trực tiếp với nhân viên tổ chức">
                <label for="box5"> Liên hệ trực tiếp với nhân viên tổ chức</label><br>
                <input type="radio" id="box6" name="q2" value="Được giới thiệu từ tổ chức khác">
                <label for="box6"> Được giới thiệu từ tổ chức khác</label><br>
                <input type="radio" id="box7" name="q2" value="Được giới thiệu từ bạn bè hay người thân trong gia đình">
                <label for="box7"> Được giới thiệu từ bạn bè hay người thân trong gia đình</label><br>
                <input type="radio" id="box8" name="q2" value=" Tìm kiếm trên Internet">
                <label for="box8"> Tìm kiếm trên Internet</label><br>
            </div>
            <br>
            <div class="form-group">
                <h4>Câu 3: Nói chung, bạn hài lòng với chất lượng dịch vụ/hoạt động mình đang nhận được (đã nhận được) như thế nào?</h4>
                <input type="radio" id="box9" name="q3" value="Rất không hài lòng">
                <label for="box9"> Rất không hài lòng</label><br>
                <input type="radio" id="box10" name="q3" value="Không hài lòng">
                <label for="box10"> Không hài lòng</label><br>
                <input type="radio" id="box11" name="q3" value="Bình thường">
                <label for="box11"> Bình thường</label><br>
                <input type="radio" id="box12" name="q3" value="Hài lòng">
                <label for="box12"> Hài lòng</label><br>
            </div>
            <br>
            <div class="form-group">
                <h4>Câu 4: Dịch vụ chúng tôi cung cấp quan trọng như thế nào đối với bạn?</h4>
                <input type="radio" id="box13" name="q4" value="Không phù hợp">
                <label for="box13"> Không phù hợp</label><br>
                <input type="radio" id="box14" name="q4" value="Không quan trọng">
                <label for="box14"> Không quan trọng</label><br>
                <input type="radio" id="box15" name="q4" value="Có quan trọng">
                <label for="box15"> Có quan trọng</label><br>
                <input type="radio" id="box16" name="q4" value="Rất quan trọng">
                <label for="box16"> Rất quan trọng</label><br>
            </div>
            <br>
            <div class="form-group">
                <h4>Câu 5: Bạn có trả phí cho dịch vụ nào không?</h4>
                <input type="radio" id="box17" name="q5" value="Có">
                <label for="box17"> Có</label><br>
                <input type="radio" id="box18" name="q5" value="Không">
                <label for="box18"> Không</label><br>
            </div>
            <div class="form-group">
                <h4>Câu 6: Bạn có gặp bất kỳ vấn đề gì với dịch vụ cung cấp và/hay cách thức cung cấp dịch vụ hay không?</h4>
                <input type="radio" id="box19" name="q6" value="Có">
                <label for="box19"> Có</label><br>
                <input type="radio" id="box20" name="q6" value="Không">
                <label for="box20"> Không</label><br>
            </div>
            <input type="hidden" name="status" value=0>
            <input type="submit" class="btn btn-sm btn-warning" style=" background: orangered; width: 90px; margin-top:25px" value="Gửi" name="send">
    </div>
    </form>
    </div>
    <style>

    </style>
</body>

</html>