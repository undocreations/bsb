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

mysql_select_db($database_bsb, $bsb);
$query_Recordset1 = "SELECT useless FROM tbl_periodic_inspection";
$Recordset1 = mysql_query($query_Recordset1, $bsb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<html>
<head>

<style type="text/css">
.as {
	color: #F00;
}
</style>
</head>

<body>
<p>
  <?php 
if ($row_Recordset1['useless'] == 0) { // Show if recordset empty ?
  echo "it is useless";
   } // Show if recordset empty 
   else if ($row_Recordset1['useless'] == 1){
	echo "<p class='as'>  it is OK! </p> ";
   }
   ?>
</p>
<p class="as">ghjgjh</p>
</body>


</html>
<?php
mysql_free_result($Recordset1);
?>
