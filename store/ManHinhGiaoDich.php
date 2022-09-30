<?php
session_start();
//session_destroy();
?>
<?php
      if ($_SESSION["isLoggedIn"]!=2 and $_SESSION["isLoggedIn"]!=1){
         header('Location: all_error.html');    
 }
 else
 {    
    
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if(isset($_POST["dangky"]))    
         {
         header('Location: DangKyTap.php');
         }

          if(isset($_POST["goitap"]))    
         {
         header('Location: ThongTinGoiTap.php');
         }

          if(isset($_POST["khuyenmai"]))    
         {
         header('Location: ThongTinKhuyenMai.php');
         } 

          if(isset($_POST["thanhvien"]))    
         {
         header('Location: QuanLyThanhVien.php');
         } 

          if(isset($_POST["maytap"]))    
         {
         header('Location: QuanLyMayTap.php');
         } 

          if(isset($_POST["the"]))    
         {
         header('Location: QuanLyThe.php');
         } 

          if(isset($_POST["taikhoan"]))    
         {
         header('Location: ThongTinTaiKhoan.php');
         } 

          if(isset($_POST["matkhau"]))    
         {
         header('Location: DoiMatKhau.php');
         } 

          if(isset($_POST["gioithieu"]))    
         {
         header('Location: GioiThieu2.php');
         } 
     }
 }    
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <style>
            td {
                padding: 15px;
                text-align: left;
               }
            
            .error {color: #0026ff;}
            
            input[type=submit] {
                 width: 20em;  height: 2em;
                }
            
        </style>
    </head>
    <body style='text-align:center'>
        <span style="margin-right:20px">Xin chào <strong><?php echo $_SESSION["hoten"]; ?></strong></span>
        <a href="/Thoat_ManHinhGiaoDich.php">Thoát</a>
         <h2>Màn hình giao dịch </h2>
        <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <table align="center">
                 <tr>
              <td class="error">Giao dịch:</td> 
              <td><input type="submit" value="Đăng ký tập" name="dangky"></td>
               <td><input type="submit" value="Thông tin gói tập" name="goitap"></td>
               <td><input type="submit" value="Thông tin khuyến mãi" name="khuyenmai"></td>
                </tr>
                <tr>
              <td class="error">Quản lý:</td> 
              <td><input type="submit" value="Quản lý thành viên" name="thanhvien"></td>
               <td><input type="submit" value="Quản lý máy tập" name="maytap"></td>
               <td><input type="submit" value="Quản lý thẻ" name="the"></td>
                </tr>
                <tr>
              <td class="error">Tài khoản:</td> 
              <td><input type="submit" value="Thông tin tài khoản" name="taikhoan"></td>
               <td><input type="submit" value="Đổi mật khẩu" name="matkhau"></td>
               <td><input type="submit" value="Giới thiệu" name="gioithieu"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
