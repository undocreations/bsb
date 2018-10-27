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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "customers_add")) {
  $insertSQL = sprintf("INSERT INTO tbl_customers (`date`, brand_name, branch, activity, name, lastname, AFM, DOY, address, TK, phone, mobilephone, fax, email, url) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['brand_name'], "text"),
                       GetSQLValueString(isset($_POST['branch']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['activity'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['afm'], "int"),
                       GetSQLValueString($_POST['doy'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['TK'], "int"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['mobilephone'], "int"),
                       GetSQLValueString($_POST['fax'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['url'], "text"));

  mysql_select_db($database_bsb, $bsb);
  $Result1 = mysql_query($insertSQL, $bsb) or die(mysql_error());
/*
  $insertGoTo = "customers_add.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
 */ 
}

?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}


?>
<?php require_once('../lang/el.php'); ?>
                <!DOCTYPE html>
                <html>

                <head>
                    <meta charset="UTF-8">
                    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                    <title>
                        <?php echo $MenuAddCustomers ?>
                    </title>
                    <!-- Favicon-->
                    <link rel="icon" href="../favicon.ico" type="image/x-icon">

                    <!-- Google Fonts -->
                    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
                    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

                    <!-- Bootstrap Core Css -->
                    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

                    <!-- Waves Effect Css -->
                    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

                    <!-- Animation Css -->
                    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />
                        <!-- Sweetalert Css -->
				    <link href="../plugins/sweetalert/sweetalert2.min.css" rel="stylesheet" />

                    <!-- Custom Css -->
                    <link href="../css/style.css" rel="stylesheet">

                    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
                    <link href="../css/themes/all-themes.css" rel="stylesheet" />
                </head>

                <body class="theme-red">
                    <!-- Page Loader -->
                    <div class="page-loader-wrapper">
                        <div class="loader">
                            <div class="preloader">
                                <div class="spinner-layer pl-red">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                    <!-- #END# Page Loader -->
                    <!-- Overlay For Sidebars -->
                    <div class="overlay"></div>
                    <!-- #END# Overlay For Sidebars -->
                    <!-- Top Bar -->
                    <nav class="navbar">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                                <a href="javascript:void(0);" class="bars"></a>
                                <a class="navbar-brand" href="../index.php">
                                    <?php echo $TitleH1?>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <!-- Call Search -->
                                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons"><?php echo $SearchIcon ?></i></a></li>
                                    <!-- #END# Call Search -->

                                    <!-- NOTIFICATIONS -->

                                    <!-- END -->

                                    <!-- Tasks -->

                                    <!-- #END# Tasks -->
                                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- #Top Bar -->
                    <section>
                        <!-- Left Sidebar -->
                        <aside id="leftsidebar" class="sidebar">

                            <!-- User Info -->
                            <?php require_once('../mods/user-info.php'); ?>
                                <!-- #User Info -->

                                <!-- Menu -->
                                <?php require_once('../mods/menu.php'); ?>
                                    <!-- #Menu -->

                                    <!-- Footer -->
                                    <?php require_once('../mods/footer.php'); ?>
                                        <!-- #Footer -->
                        </aside>
                        <!-- #END# Left Sidebar -->

                        <!-- Right Sidebar -->
                        <?php require_once('../mods/right-sidebar.php'); ?>
                            <!-- #END# Right Sidebar -->
                    </section>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="block-header">
                                <!-- Body Copy -->
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2><?php echo $MenuAddCustomers ?></h2>
                                                <ul class="header-dropdown m-r-0">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">help_outline</i>
                                                    </a>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Body Copy -->
             <!-- Multi Column -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                        <form ACTION="customers_add.php" id="customers_add" method="POST" name="customers_add">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input name="brand_name" id="brand_name" type="text" class="form-control" placeholder="<?php echo $PlaceholderBrandName ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="name" id="name" type="text" class="form-control" placeholder="<?php echo $ProfileName ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="lastname" id="lastname" type="text" class="form-control" placeholder="<?php echo $ProfileLastName ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="address" id="address" type="text" class="form-control" placeholder="<?php echo $PlaceholderAddress ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="afm" id="afm" type="text" class="form-control" placeholder="<?php echo $PlaceholderAFM ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="doy" id="doy" type="text" class="form-control" placeholder="<?php echo $PlaceholderDOY ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="TK" id="TK" type="text" class="form-control" placeholder="<?php echo $PlaceholderTK ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="phone" id="phone" type="text" class="form-control" placeholder="<?php echo $PlaceholderPhone ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="mobilephone" id="mobilephone" type="text" class="form-control" placeholder="<?php echo $PlaceholderMobile ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="fax" id="fax" type="text" class="form-control" placeholder="<?php echo $PlaceholderFax ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-line">
                                        <input name="email" id="email" type="text" class="form-control" placeholder="<?php echo $PlaceholderEmail ?>">
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="url" id="url" type="text" class="form-control" placeholder="<?php echo $PlaceholderUrl ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="activity" id="activity" type="text" class="form-control" placeholder="<?php echo $PlaceholderActivity ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    
                                        <div class="form-line">
                                        <input type="checkbox" id="branch" name="branch" class="filled-in">
                                        <label for="branch"><?php echo $PlaceholderBranch ?></label>
                                        </div>
                              </div>
                          </div>
                       <div class="row">
                      <div class="col-xs-6 js-sweetalert">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" data-type="success" id="submit" onSubmit="JSconfirm()" ><?php echo $MenuAddCustomers ?></button>
                        </div>
                    </div>
                       <input type="hidden" name="MM_insert" value="customers_add">
                        <input type="hidden" name="date" id="date" value="<?php echo date("Y-m-d")?>">
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Column -->
        </div>


                    <!-- Jquery Core Js -->
                    <script src="../plugins/jquery/jquery.min.js"></script>

                    <!-- Bootstrap Core Js -->
                    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

                    <!-- Select Plugin Js -->
                    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

                    <!-- Slimscroll Plugin Js -->
                    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

                    <!-- Waves Effect Plugin Js -->
                    <script src="../plugins/node-waves/waves.js"></script>
                    
                    <!-- Bootstrap Notify Plugin Js -->
                    <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script>
                    
                    <!-- Custom Js -->
                    <script src="../js/admin.js"></script>

                    <!-- Demo Js -->
                    <script src="../js/demo.js"></script>
                    <!-- SweetAlert Plugin Js -->
				    <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
				    <script src="../js/pages/ui/dialogs.js"></script>
    			</body>
                </html>
