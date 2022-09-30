<?php
    $conn=NULL;
   function connect($conn){
       global $conn;   // giup truy cap dc bien toan cuc conn va luu gia tri cua no ra ngoai duoc
            $serverName = "DESKTOP-SFAJI22\MSSQLSERVER1"; 
$connectionInfo = array( "Database"=>"QLPHONGTAP", "UID"=>"sa", "PWD"=>"Godprott97");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "<div style='text-align:center'>";
     //echo "Connection ok.<br/></div>";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
   }


    function test_input($data) { //bao mat 
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function executeUpdateQuery($conn, $query, $data,$rs)
{
    global $conn;
     connect($conn);
    $rs= sqlsrv_query( $conn, $query, $data);
    if( $rs === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    return $rs;
}

/*
vd:
$sql = "INSERT INTO Table_1 (id, data) VALUES (?, ?)"; // ? o day se dc thay cho gia tri tu array ben duoi
$params = array(1, "some data");

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

*/

function executeSelectQuery($conn, $query)
{
  global $conn;
  connect($conn);
    $rs= sqlsrv_query($conn,$query);
    if( $rs === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    return $rs;
}

/*
vd:
$tableName = 'testTable';
$query = "INSERT INTO [$tableName] (c1_int, c2_varchar) VALUES (1, 'test_data')";
$stmt = sqlsrv_query($conn, $query);
if($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
sqlsrv_free_stmt($stmt);


vd:
$query = "SELECT * FROM $tableName";
$stmt = sqlsrv_query($conn, $query);

if(sqlsrv_fetch($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
}

*/


function closeRS($rs)
{
     sqlsrv_free_stmt($rs);
}

function closeDB($conn)
{
     sqlsrv_close($conn);
}
?>

