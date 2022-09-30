<?php
session_start();      
?>
<?php
if ($_SESSION["isLoggedIn"]!=2){
         header('Location: all_error.html');    
 }
 else
 {    
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if(isset($_POST["logout"]))    
         {
          session_destroy();
         header('Location: login.php');
         }

          if(isset($_POST["quanly"]))    
         {
         header('Location: ManHinhQuanLy.php');
         }

          if(isset($_POST["giaodich"]))    
         {
         header('Location: ManHinhGiaoDich.php');
         } 
     }
 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body style='text-align:center'>
         <h2>Xin chào Admin !</h2>
        <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="submit" style="margin-right:20px" value="Màn hình quản lý" name="quanly">
            <input type="submit" style="margin-bottom:5px" value="Màn hình giao dịch" name="giaodich"><br>
             <br>
            <input type="submit" value="Đăng xuất" name="logout">
        </form>
    </body>
</html>
