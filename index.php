<?php require_once('Connections/bsb.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
	  $theValue = ($theValue != "") ? "'" . date("Y-m-d",strtotime($theValue)) . "'" : "NULL";
      break;
	case "time":
	  $theValue = ($theValue != "") ? "'" . date("H:i:s",strtotime($theValue)) . "'" : "NULL";
      break;
    case "datetime":
	  $theValue = ($theValue != "") ? "'" . date("Y-m-d H:i:s",strtotime($theValue)) . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "main/main.php";
  $MM_redirectLoginFailed = "login/login-failed.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_bsb, $bsb);
  
  $LoginRS__query=sprintf("SELECT email, pass FROM tbl_register WHERE email=%s AND pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $bsb) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php require_once('lang/el.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php echo $TitleH2 ?>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><?php echo $TitleH1?></a>
        </div>
        <div class="card">
            <div class="body">
                <form ACTION="<?php echo $loginFormAction; ?>" id="sign_in" method="POST" name="sign_in">
                    <div class="msg"><?php echo $UsernameAndPassword ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons"><?php echo $Person ?></i>
                        </span>
                        <div class="form-line">
                            <input name="email" type="text" autofocus required class="form-control" id="email" placeholder="<?php echo $Username ?>">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons"><?php echo $Lock ?></i>
                        </span>
                        <div class="form-line">
                            <input name="pass" type="password" required class="form-control" id="pass" placeholder="<?php echo $Ps ?>">
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit" id="submit"><?php echo $SignIn ?></button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                           <!--  <a href="pages/examples/sign-up.html">Register Now!</a> -->
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="pages/examples/forgot-password.html"><?php echo $ForgotPassword ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>