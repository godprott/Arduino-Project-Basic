<?php
session_start();
//session_destroy();
?>
<?php include 'connect.php';?>
<?php
 if ($_SESSION["isLoggedIn"]!=2 and $_SESSION["isLoggedIn"]!=1){
         header('Location: all_error.html');    
 }
 else
 {
    
     $magoitap = array();
     $tengoitap = array();
     $gia = array();
     $thoihan = array();

     $hotenErr = $diachiErr = $gioitinhErr = $cmndErr = $mauudaiErr = $goitapErr = $checkErr ="";

           $mauudaiq = array();
            $tenuudaiq = array();
            $chietkhauq = array();

     $query = "Select * from dbo.uudai where ngayketthuc >= getdate()";
          $rs = executeSelectQuery($conn,$query);
          while( $obj = sqlsrv_fetch_object($rs)) {
            $mauudaiq[] = $obj->mauudai;
            $tenuudaiq[] = $obj->tenuudai;
            $chietkhauq[] = $obj->chietkhau;
          }
              closeRS($rs);
             closeDB($conn);


      $query = "Select * from dbo.goitap where tinhtrang = 'yes'";
          $rs = executeSelectQuery($conn,$query);
          while( $obj = sqlsrv_fetch_object($rs)) {
            $magoitap[] = $obj->magoitap;
            $tengoitap[] = $obj->tengoitap;
            $gia[] = $obj->gia;
            $thoihan[] = $obj->thoihansudung;
          }
              closeRS($rs);
             closeDB($conn);

            $mauudai = array();
            $tenuudai = array();
            $chietkhau = array();
            $magoitap2 = array();

            $query = "Select * from thongtinkhuyenmai";
            $rs = executeSelectQuery($conn,$query);
            while( $obj = sqlsrv_fetch_object($rs)) {
                $magoitap2[] = $obj->magoitap;
                $mauudai[] = $obj->mauudai;
                $tenuudai[] = $obj->tenuudai;
                $chietkhau[] = $obj->chietkhau;
           
               }
            closeRS($rs);
            closeDB($conn);


            $query = "Select * from uudai where mauudai = 'sinhvien'";
            $rs = executeSelectQuery($conn,$query);
            while( $obj = sqlsrv_fetch_object($rs)) {
                $khuyenmaisinhvien = $obj->chietkhau;
           
               }
            closeRS($rs);
            closeDB($conn);

            $query = "Select count(*) as dem from thanhvien";
            $rs = executeSelectQuery($conn,$query);
            while( $obj = sqlsrv_fetch_object($rs)) {
                $mathe = $obj->dem;
               
           }
            $mathe="THE".$mathe;
            closeRS($rs);
            closeDB($conn);

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if($_SESSION["wowdeptrai"]=="")
         {
                $_SESSION["wowdeptrai"]=1;
                   //echo $_SESSION["wowdeptrai"];
         }
         if(isset($_POST["confirm"]))
        {       
            if($_SESSION["wowdeptrai"]==1)
            {

             if (empty($_POST["hoten"])) {
                $hotenErr = "*";
            } else {
                     $hoten = test_input($_POST["hoten"]);
                 }

               if (empty($_POST["diachi"])) {
              $diachiErr = "*";
                 } else {
                 $diachi = test_input($_POST["diachi"]);
                 }
        
                   if (empty($_POST["cmnd"])) {
                 $cmndErr = "*";
                } else {
                    $cmnd = test_input($_POST["cmnd"]);
                }

                if(test_input($_POST["goitap"])=="")
                {
                    $goitapErr = "*";
                }

                 if(test_input($_POST["mauudai"])=="")
                {
                    $mauudaiErr = "*";
                }
                 if(!empty($_POST["hoten"]) and !empty($_POST["diachi"]) and !empty($_POST["cmnd"]) and test_input($_POST["goitap"])!="" and test_input($_POST["mauudai"])!="" )
                 {
                        $gioitinh = $_POST['gioitinh'];
                         $ghichu = $_POST['ghichu'];
                          $goitap = $_POST['goitap'];
                          $qwe = $_SESSION["id"];
                          $sv = $_POST['checkbo'];
                          $uudaie = $_POST['mauudai'];

                         // echo  $goitap;
                         //  echo  $qwe;
                         //   echo  $sv;
                          //   echo  $uudaie;
                             
                        $query = "exec dbo.taothanhvien2 '$hoten','$diachi','$gioitinh','$ghichu','$mathe','$cmnd','$goitap','$qwe','$sv','$uudaie'"; 
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

                if($_SESSION["wowdeptrai"]==2)
                {
                     if (empty($_POST["cmnd"])) {
                     $cmndErr = "*";
                    } else {
                    $cmnd = test_input($_POST["cmnd"]);
                    }   

                     if( !empty($_POST["cmnd"]) and test_input($_POST["goitap"])!="" and test_input($_POST["mauudai"])!="" )
                 {
                          $goitap = $_POST['goitap'];
                          $qwe = $_SESSION["id"];
                          $sv = $_POST['checkbo'];
                          $uudaie = $_POST['mauudai'];

                        //  echo  $goitap;
                         ////  echo  $qwe;
                          //  echo  $sv;
                         ////    echo  $uudaie;
                          //  echo $cmnd;
                            //$cmnd = intval($cmnd); 

                        $query = "exec dbo.taothanhvien1 '$mathe','$cmnd','$goitap','$qwe','$sv','$uudaie'"; 
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
         //$abc="disabled";  // bat tat group box
          if(isset($_POST["Back"]))
        {
            unset($_SESSION["wowdeptrai"]);
            header('Location: ManHinhGiaoDich.php'); 
        }

         if(isset($_POST["weeboo"]))
        {
            $radioVal = $_POST["chon"];

            if($radioVal == "taomoi")
            {
                $_SESSION["wowdeptrai"]=1;
                $tyu="";
             //   echo  $_SESSION["wowdeptrai"];
            }
            else if ($radioVal == "cosan")
            {
               $_SESSION["wowdeptrai"]=2;
               $tyu="readonly";
             //  echo  $_SESSION["wowdeptrai"];
            }
        }
     }


 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <script>
             var strUser; // chua gia tri goi tap duoc chon
            var tinhtientra = 0; // % sv
            var deptrai;    // tongsotien ko tinh %
            var sotientra;
            function myFunction_goitap() {    //giup khi chon goi tap thong tin goi tap do cx hien ra trong textbox
                var e = document.getElementById("idgoitap");
                strUser = e.options[e.selectedIndex].value;  // lay gia tri select
                var res = strUser.substring(2);    // cut string can thiet
                res = parseInt(res) - 1;
                var gia = [];
                var thoihan = [];
                var tengoitap = [];
            <?php 
                 for($i=0;$i<count($magoitap);$i++)
                         {
                             echo " tengoitap.push('$tengoitap[$i]');";
                            echo " gia.push('$gia[$i]');";
                            echo " thoihan.push('$thoihan[$i]');";
                          }         
            ?>
                    
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1; //January is 0!
                    var yyyy = today.getFullYear();

                    if (dd < 10) {
                         dd = '0' + dd;
                    }

                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    today = mm + '/' + dd + '/' + yyyy;

            var enddate = new Date();
            var x = parseInt(thoihan[res]); // chuyen string sang int
            enddate.setDate(enddate.getDate()+ x );
                    var dd1 = enddate.getDate();
                    var mm1 = enddate.getMonth() + 1; //January is 0!
                    var yyyy1 = enddate.getFullYear();

                    if (dd1 < 10)
                    {
                         dd1 = '0' + dd1;
                    }

                    if (mm1 < 10) {
                        mm1 = '0' + mm1;
                    }
                    enddate = mm1 + '/' + dd1 + '/' + yyyy1;

                    document.getElementById("tengoitap").innerHTML = tengoitap[res];
                    document.getElementById("ngaybatdau").innerHTML = today;
                     document.getElementById("gia").innerHTML = gia[res];
                     document.getElementById("tongsotien").innerHTML = gia[res];
                      deptrai = gia[res];
                    document.getElementById("ngayketthuc").innerHTML = enddate;
                    
                      deptrai = parseInt(deptrai);
                     sotientra = parseInt(tinhtientra);
                 sotientra = deptrai - ((deptrai*tinhtientra)/100);
                 document.getElementById("sotienthucsuphaitra").innerHTML = sotientra;


                    

                     var magoitap2 = [];
                     var mauudai = [];
                     var chietkhau = [];
                     var tenuudai = [];

                    <?php 
                        for($i=0;$i<count($mauudai);$i++)
                         {
                             echo " magoitap2.push('$magoitap2[$i]');";
                             echo " mauudai.push('$mauudai[$i]');";
                             echo " tenuudai.push('$tenuudai[$i]');";
                            echo " chietkhau.push('$chietkhau[$i]');";
                          }        
                    ?>



                    select = document.getElementById('iduudai');  // xoa cac uu dai cu 
                    var length = select.options.length;
                    for (i = 1; i < length; i++) {
                        select.remove(select.length-1);
                    }
                        select.options[0].selected = 'selected';       

                     document.getElementById("tenuudai").innerHTML = "";
                    document.getElementById("chietkhau").innerHTML = "";

                    for (var i = 0; i<<?php echo count($mauudai); ?>; i++){
                    if(magoitap2[i]==strUser)
                        {
                        var opt = document.createElement('option');
                      //  var x = i + 2;
                        opt.value = mauudai[i];
                        opt.innerHTML = mauudai[i];
                        select.appendChild(opt);
                        }
                    }
                
            }


            function myFunction_uudai() {    //giup khi chon uu dai theo goi tap da chon
                var e = document.getElementById("iduudai");
                var strUser = e.options[e.selectedIndex].value;  // lay gia tri select
                var res = strUser.substring(2);    // cut string can thiet
                res = parseInt(res)+1;
                var chietkhau = [];
                var tenuudai = [];
                var mauudai = [];
            <?php 
               

                 for($i=0;$i<count($mauudaiq);$i++)
                         {
                             echo " mauudai.push('$mauudaiq[$i]');";
                             echo " tenuudai.push('$tenuudaiq[$i]');";
                            echo " chietkhau.push('$chietkhauq[$i]');";
                          }         
            ?>
                    
                  
                    document.getElementById("tenuudai").innerHTML = tenuudai[res];
                    document.getElementById("chietkhau").innerHTML = chietkhau[res];
                    
                
            }

            function tinhtoan()
            {
                var x = document.getElementById("khachdua").value;
                tinhtientra =  parseInt(tinhtientra);
                x = parseInt(x);
                x = sotientra - x;
                document.getElementById("tralai").innerHTML=x;
            }

            function sinhvien()
            {
                if (document.getElementById("checkthesinhvien").checked) 
                 {  
                    tinhtientra = <?php echo $khuyenmaisinhvien;?>;
                     document.getElementById("sinhvienchietkhau").innerHTML = tinhtientra;
                } else {
                    tinhtientra = 0;
                     document.getElementById("sinhvienchietkhau").innerHTML = tinhtientra;
                }
                 sotientra = deptrai - ((deptrai*tinhtientra)/100);
                 document.getElementById("sotienthucsuphaitra").innerHTML = sotientra;
             }

        </script>

        <style>
            .error {color: #0000FF;}
        </style>
    </head>
    <body style='text-align:center'>
         <span class="error"><?php echo $checkErr;?></span><br>
         <h2>Đăng ký thẻ: </h2>

        <form align="left" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
           
             <div style=" margin: 0 auto; width: 50%; border: 1px solid black">
             <input type="radio" name="chon" value="taomoi" id="taomoi" <?php if ($_SESSION["wowdeptrai"] == 1) {echo ' checked ';} ?>> Tạo thành viên mới<br>
            <input type="radio" name="chon" value="cosan" id="cosan" <?php if ($_SESSION["wowdeptrai"] == 2) {echo ' checked ';} ?>> Thành viên có sẵn<br>
                  <button name="weeboo" style="display: block; margin : 0 auto ">Áp dụng</button>
              </div>
           
              <div style="width: 50%; margin: 0 auto   ">
        <fieldset style="width: 48%; float: left" <?php echo $abc;?>>
            <legend id="banner">Tạo thành viên mới:</legend>
                   <table align="center">
                 <tr>
              <td>Họ và tên:</td> 
              <td><input type="text" name="hoten" id="hoten" value="<?php echo $hoten;?>" <?php echo $tyu;?>></td>
                <td><span class="error"><?php echo $hotenErr;?></span></td>
                </tr>
                  <tr>
              <td>Địa chỉ:</td>     
              <td><input type="text" name="diachi" id="diachi" value="<?php echo $diachi;?>" <?php echo $tyu;?>></td>
                      <td><span class="error"><?php echo $diachiErr;?></span></td>
                 </tr>
                   <tr>
              <td>Giới tính:</td>     
              <td><select name="gioitinh" id="gioitinh" >
                        <option value="nam">Nam</option>
                        <option value="nu">Nữ</option>
                        <option value="khongxacdinh" selected>Không xác định</option>
                  </select></td>
                 </tr>
                  <tr>
              <td>CMND:</td>     
              <td><input type="number" name="cmnd" id="cmnd" value="<?php echo $cmnd;?>"></td>
                     <td><span class="error"><?php echo $cmndErr;?></span></td>
                 </tr>
                <tr>
                <td>Ghi chú:</td>
                    <td><textarea name="ghichu" rows="5" cols="30" id="ghichu" <?php echo $tyu;?>></textarea></td>
                </tr>
                 </table>
        </fieldset>
        
        <fieldset style="width: 44%" >
            <legend>Đăng ký dịch vụ:</legend>
              <table align="center">
                <tr>
              <td>Gói tập:</td>     
              <td><select name="goitap" onchange='myFunction_goitap()' id="idgoitap">
                        <option disabled selected value> -- select an option -- </option>
                         <?php
                         for($i=0;$i<count($magoitap);$i++)
                         {
                             $x = $i + 1;
                            echo " <option value='GT$x'>";
                             echo $magoitap[$i];
                             echo "</option>";
                          }         
                         ?>
                  </select></td>
                    <td><span class="error"><?php echo $goitapErr;?></span></td>
                 </tr>
                  <tr>
                <td>Tên gói tập:</td>
                <td id="tengoitap"></td>
                </tr>
                <tr>
                <td>Ngày bắt đầu:</td>
                <td id="ngaybatdau"></td>
                </tr>
                <tr>
                <td>Ngày kết thúc:</td>
                <td  id="ngayketthuc"></td>
                </tr>
                <tr>
                <td >Giá (VNĐ):</td>
                <td id="gia"></td>
                </tr>
                <tr>
                <td><input type="checkbox" name="checkbo" onclick="sinhvien()" id="checkthesinhvien" value="checked">Thẻ sinh viên</td>
                </tr>
                <tr>
              <td>Mã ưu đãi:</td>     
              <td><select name="mauudai" id="iduudai" onchange='myFunction_uudai()'>
                        <option disabled selected value> -- select an option -- </option>
                  </select></td>
                    <td><span class="error"><?php echo $mauudaiErr;?></span></td>
                 </tr>
                  <tr>
                <td>Tên ưu đãi:</td>
                <td id="tenuudai"></td>
                </tr>
               <tr>
                <td>Chiết khấu (%):</td>
                <td id="chietkhau"></td>
                </tr>
                  
             </table>
        </fieldset>
             
         <table align="left" style="width: 50%" >
            
             <tr>
                <td>Mã thẻ:</td>
                <td><?php echo $mathe; ?></td>
                </tr>
             <tr>
                <td>Mã nhân viên:</td>
                <td><?php echo $_SESSION["id"]; ?></td>
                </tr>
             <tr>
                <td>Tổng số tiền:</td>
                <td id="tongsotien"></td>
                </tr>
             <tr>
                <td>Chiết khấu sinh viên (%):</td>
                <td id="sinhvienchietkhau">0</td>
                </tr>
        </table>

        <table align="right" style="width: 50%" >
             <tr>
                <td>Số tiền phải trả:</td>
                <td id="sotienthucsuphaitra"></td>
                </tr>
             <tr>
              <td>Số tiền khách đưa:</td> 
              <td><input type="number"  onblur="tinhtoan()" name="tiendua" id="khachdua" value="<?php echo $tiendua;?>"></td>
                <td><span class="error"><?php echo $tienduaErr;?></span></td>
                </tr>
           </table>

             
            <table align="right" style="width: 50%">
                <tr>
                <td>Trả lại:</td>
                <td id="tralai"></td>
                </tr>
        </table>
         </div>
            <br><br>
            <div style="width: 100%; float: left; left: 50% ">
        <input type="submit" style="margin-top: 30px; margin-left: 685px;  margin-right:20px" value="Tạo thẻ" name="confirm">
        <input type="submit" value="Quay lại" name="Back">
            </div>
        </form>
    </body>
</html>
