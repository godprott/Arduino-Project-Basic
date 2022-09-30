<?php
session_start();
//session_destroy();
?>
<?php include 'connect.php';?>
<?php
     $matkhaucuErr = $mbvErr = $matkhauErr = $nlmatkhauErr =$checkErr="";
 if ($_SESSION["isLoggedIn"]!=2 and $_SESSION["isLoggedIn"]!=1){
         header('Location: all_error.html');    
 }
 else
 {    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["confirm"]))
        {
             if (empty($_POST["matkhaucu"])) {
             $matkhaucuErr = "*Mật khẩu hiện tại is required";
                } else {
                  $matkhaucu = test_input($_POST["matkhaucu"]);
                }

            if (empty($_POST["mbv"])) {
             $mbvErr = "*Mã bảo vệ is required";
                } else {
                  $mbv = test_input($_POST["mbv"]);
                }
               
            if (empty($_POST["matkhau"])) {
             $matkhauErr = "*Mật khẩu mới is required";
                } else {
                  $matkhau = test_input($_POST["matkhau"]);
                }

            if (empty($_POST["nlmatkhau"])) {
             $nlmatkhauErr = "*Nhập lại mật khẩu mới is required";
                } else {
                  $nlmatkhau = test_input($_POST["nlmatkhau"]);
                }

        if(!empty($_POST["matkhaucu"]) and !empty($_POST["nlmatkhau"]) and !empty($_POST["matkhau"]) and !empty($_POST["mbv"]))
    {
        if(strcmp($matkhau,$nlmatkhau)==0)
        {
             $id = $_SESSION["id"];
            $query = "exec dbo.doimatkhau '$id','$matkhaucu','$mbv','$matkhau'"; 
            
               
            $rs = executeSelectQuery($conn,$query); 
            $result = sqlsrv_fetch_array($rs);
           // echo $result['check']; // lấy giá trị kết quả từ check trong proc của sql
           if($result['check']==1)
           {
               $checkErr="Đã thay đổi thành công";
           }
           else if($result['check']==0)
           {
               $checkErr="Nhập thông tin sai lệch";
           }
             closeRS($rs);
             closeDB($conn);
        }
        else
        {
            $nlmatkhauErr = "*Nhập lại mật khẩu mới phải chính xác";
        }
    }
        }

        if(isset($_POST["Back"]))
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
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body style='text-align:center'>
        <span class="error"><?php echo $checkErr;?></span><br>
        <h2>Đổi mật khẩu: </h2>
         <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <table align="center">
             <tr>
              <td>Mật khẩu hiện tại:</td> 
              <td><input type="text" name="matkhaucu"></td>
                <td><span class="error"><?php echo $matkhaucuErr;?></span></td>
                </tr>
                <tr>
              <td>Mã bảo vệ:</td>     
              <td><input type="number" name="mbv"></td>
                      <td><span class="error"><?php echo $mbvErr;?></span></td>
                 </tr>
             <tr>
              <td>Mật khẩu mới:</td>     
              <td><input type="password" name="matkhau"></td>
                     <td><span class="error"><?php echo $matkhauErr;?></span></td>
                 </tr>
                 <tr>
              <td>Nhập lại mật khẩu mới:</td>     
              <td><input type="password" name="nlmatkhau"></td>
                     <td><span class="error"><?php echo $nlmatkhauErr;?></span></td>
                 </tr>
                </table><br>

            <input type="submit" style="margin-right:20px" value="Xác nhận" name="confirm">
              <input type="submit" value="Quay lại" name="Back">
            </table>
             </form>
    </body>
</html>
