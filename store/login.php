<?php
session_start();      // để dùng được session tự trang này tạo ra hay lấy từ trang khác thì luôn fai có hàm này
//session_destroy();
?>
<?php include 'connect.php';?>
<?php
    
 if($_SESSION["count"]>=2)
      {
          header('Location: Login_Error.html');
      }

if($_SESSION["isLoggedIn"]==1) 
{
        header('Location: ManHinhGiaoDich.php');              
}

 if($_SESSION["isLoggedIn"]==2) 
{          
        header('Location: foradmin.php');           
}

if($_SESSION["count"]=="")
{
    $_SESSION["count"]=0;
}

 $query = "exec taongaymoi";
 $rs = executeSelectQuery($conn,$query);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["login"]))    // xay ra khi gui request cho chinh minh khi dung button submit nay
    {
     $username = test_input($_POST["taikhoan"]);
     $password = test_input($_POST["matkhau"]);
   
     if($username != "" and $password != "")
     {
          $query = "Select * from dbo.nhanvien where manv='$username' and matkhau='$password' "; 
         
          
          //$data = array($username,$password);
         $rs = executeSelectQuery($conn,$query);
           
          while( $obj = sqlsrv_fetch_object($rs)) {
                $_SESSION["id"] = $obj->manv;
                 $_SESSION["hoten"] = $obj->hoten;
                $_SESSION["pass"] = $obj->matkhau;
                $_SESSION["type"] = $obj->chucvu;
                }

        if(is_null($obj))
        {
            $_SESSION["count"]++;
            $_SESSION["message"] = "Đăng nhập thất bại " .  $_SESSION["count"] . " lần";
        }

          if(strcmp($_SESSION["type"],"nhanvien")==0)
          {
                $query = "exec diemdanh '$username'";
                $rs = executeSelectQuery($conn,$query);

                $_SESSION["isLoggedIn"]=1;
                header('Location: ManHinhGiaoDich.php');
          }
         
          if(strcmp($_SESSION["type"],"admin")==0)
          {
                $query = "exec diemdanh '$username'";
                $rs = executeSelectQuery($conn,$query);

                $_SESSION["isLoggedIn"]=2;
                header('Location: foradmin.php');
          }

          if(strcmp($_SESSION["type"],"chuacap")==0)
          {
              session_destroy();
              header('Location: all_error.html');
          }
          
               
                

      }
      else
      {
          $_SESSION["message"] = "";
          if($username=="") 
          {
              $_SESSION["message"] = $_SESSION["message"] . "Bạn phải nhập tên đăng nhập";
          }
          if($password=="") 
          {
              $_SESSION["message"] = $_SESSION["message"] . "<br/>Bạn phải nhập mật khẩu";
          }

      }

}
else   // xay ra khi gui request cho chinh minh ma khong dung button submit nay
{
   // $_SESSION["message"]="wow, no hien len roi";
}


if(isset($_POST["sign_in"]))
{
     header('Location: TaoTaiKhoan.php');   
}

if(isset($_POST["gioithieu"]))
{
     header('Location: GioiThieu.php');   
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
       
        <?php 
    if($_SESSION["message"]!= "")
    {
        echo "<div style='text-align:center'>";
        echo $_SESSION["message"]."</div>";
        $_SESSION["message"] = NULL;

    }

?>
         <h2>Quản lý phòng tập Gym </h2>
         <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
             <table align="center">
                 <tr>
              <td>Tên đăng nhập:</td> 
              <td><input type="text" name="taikhoan"></td>
                </tr>
                 <tr>
              <td>Mật khẩu:</td>     
              <td><input type="password" name="matkhau"></td>
                 </tr>
                 </table>
             <br>
        <input type="submit" style="margin-right:20px" value="Đăng nhập" name="login">
        <input type="submit" style="margin-bottom:5px" value="Tạo tài khoản" name="sign_in"><br>
          <a href="/QuenMatKhau.php">Quên mật khẩu</a><br><br>
        <input type="submit" value="Giới thiệu" name="gioithieu">
        </form>
      
    </body>
</html>
