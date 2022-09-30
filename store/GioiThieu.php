<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body style='text-align:center'>
<h2>Phần mềm: </h2>
<h3>Quản lý phòng tập Gym </h3>
Tác giả: Nguyễn Trọng Thắng<br />
MSSV: 1545760<br />
Lớp: 60PM1<br />
Trường: Đại học Xây Dựng<br />
<br />
<br />
Mọi ý kiến đóng góp xin gửi về địa chỉ: <br />
.........
<br /> 

        <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="submit" value="Quay lại" name="Back">
        </form>
    </body>
</html>
