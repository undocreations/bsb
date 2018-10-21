<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bsb = "localhost";
$database_bsb = "bsb";
$username_bsb = "root";
$password_bsb = "";
$bsb = mysql_pconnect($hostname_bsb, $username_bsb, $password_bsb) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
?>