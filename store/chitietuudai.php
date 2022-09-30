<?php
session_start();
//session_destroy();
?>
<?php include 'connect.php';?>
<?php
 if ($_SESSION["isLoggedIn"]!=2){
         header('Location: all_error.html');    
 }
 else
 {
     $mauudai = $_GET["mauudai"];
     if( $_SESSION["bat1"]=="")
     {
     $_SESSION["bat1"] = $_GET["mauudai"];
     }
     $magoitap = array();
     $tengoitap = array();
     $gia = array();
     $thoihan = array();
    
      $query = "Select * from thongtinkhuyenmai where mauudai = '$mauudai'";
     $rs = executeSelectQuery($conn,$query);
      while( $obj = sqlsrv_fetch_object($rs)) {
                 $magoitap[] = $obj->magoitap;
                $tengoitap[] = $obj->tengoitap;
                $gia[] = $obj->gia;
                $thoihan[] = $obj->thoihansudung;
                $tinhtrang[] = $obj->tinhtrang;
               
                }
     
     
     closeRS($rs);
     closeDB($conn);
    
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["Back"]))   
        {
             unset($_SESSION["bat1"]);
            header('Location: QuanLyUuDai.php');   
        }

     
        if(isset($_POST["add"]))   
        {
            $mauudai =  $_SESSION["bat1"];
             $tgt = $_POST["tengoitap"];
             $query = "exec chitietuudaithem '".$mauudai."','$tgt'";
             echo $query;
             $rs = executeSelectQuery($conn,$query);
              $result = sqlsrv_fetch_array($rs);
               if($result['check']==1)
                        {
                             $checkErr="Đã thêm thành công";
                        }
                         else if($result['check']==0)
                        {
                            $checkErr="Nhập thông tin sai lệch";
                        }
                          closeRS($rs);
                        closeDB($conn);
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
             th{
             padding: 15px;
             text-align: center;
             background-color: #f1f1c1;
             border: 1px solid black;
             border-collapse: collapse;
        }
            .scroll
        {
                 
                overflow: auto;
                height: 350px;
                width: 40%;
                margin: 0 auto;
                
        }
            
           .idlol
            {
             border: 1px solid black;
             border-collapse: collapse;
             padding: 15px;
             text-align: center;
            }
            
            .tablelol
            {
             border: 1px solid black;
             border-collapse: collapse;
            }
            
             input[type=submit] {
                 width: 10em;  height: 2em;
                }
        </style>
    </head>
    <body style='text-align:center'>
         <span class="error"><?php echo $checkErr;?></span><br>
        <h2>Thông tin Chi tiết: </h2>
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <div style="width: 30%; margin: 0 auto">
        <table align="left" style="width: 50%" >
                  <tr>
                 <td style="color: #0000ff">Mã ưu đãi:</td>
                <td><?php echo $mauudai; ?></td>
                 </tr>
             <tr>
                 <td style="color: #0000ff">Thêm gói tập:</td>
                <td><input type='text' name="tengoitap" ></td>

                 </tr>
                
             </table>
           
            </div><br>
            <p></p><br><br>
            <h3>Chi tiết ưu đãi:</h3>

            <div class="scroll">
            <table align="center" style="width: 100%" class="tablelol" >
             <tr>
                 <th>Mã gói tập</th>
                 <th>Tên gói tập</th> 
                 <th>Giá (VNĐ)</th>
                 <th>Thời hạn sử dụng (Ngày)</th>
                 <th>Tình trạng</th>
            </tr>
                 <?php
                for($i=0;$i<count($magoitap);$i++)
                {
                    echo "<tr>";
                    echo "<td class='idlol'>".$magoitap[$i]."</td>";
                    echo "<td class='idlol'>".$tengoitap[$i]."</td>";
                    echo "<td class='idlol'>".$gia[$i]."</td>";
                    echo "<td class='idlol'>".$thoihan[$i]."</td>";
                    echo "<td class='idlol'>".$tinhtrang[$i]."</td>";
                    echo "</tr>";
                }            

            ?>
            </table>
            </div>


           
            <input type="submit" value="Thêm Gói Tập" name="add" ><br><br>
            <input type="submit" value="Quay lại" name="Back">
        </form>
    </body>
</html>
