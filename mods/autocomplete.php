
<?php require_once('../Connections/bsb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
/*
mysql_select_db($database_bsb, $bsb);
$query_Recordset1 = "SELECT brand_name FROM tbl_customers";
$Recordset1 = mysql_query($query_Recordset1, $bsb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_free_result($Recordset1);
*/
?>


<?php
mysql_select_db($database_bsb, $bsb);
//$connect = mysqli_connect("localhost", "root", "", "testing");
$request = mysql_real_escape_string($_POST["query"]);
$query = "SELECT brand_name FROM tbl_customers WHERE brand_name LIKE '%".$request."%'";


//$Recordset1 = mysql_query($query_Recordset1, $bsb) or die(mysql_error());
$result = mysql_query($query) or die(mysql_error());;

$data = array();

if(mysql_num_rows($result) > 0)
{
 while($row = mysql_fetch_assoc($result))
 {
  $data[] = $row["brand_name"];
 }
 echo json_encode($data);
}
?>
