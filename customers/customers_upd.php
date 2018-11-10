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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "customers_edit")) {
  $updateSQL = sprintf("UPDATE tbl_customers SET brand_name=%s, branch=%s, activity=%s, name=%s, lastname=%s, AFM=%s, DOY=%s, address=%s, TK=%s, phone=%s, mobilephone=%s, fax=%s, email=%s, url=%s WHERE customers_id=%s",
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
                       GetSQLValueString($_POST['url'], "text"),
                       GetSQLValueString($_POST['customers_id'], "int"));

  mysql_select_db($database_bsb, $bsb);
  $Result1 = mysql_query($updateSQL, $bsb) or die(mysql_error());
/*
  $updateGoTo = "customers_upd.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
 */ 
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RS_CustomersEdit = "-1";
if (isset($_GET['customers_id'])) {
  $colname_RS_CustomersEdit = $_GET['customers_id'];
}
mysql_select_db($database_bsb, $bsb);
$query_RS_CustomersEdit = sprintf("SELECT * FROM tbl_customers WHERE customers_id = %s", GetSQLValueString($colname_RS_CustomersEdit, "int"));
$RS_CustomersEdit = mysql_query($query_RS_CustomersEdit, $bsb) or die(mysql_error());
$row_RS_CustomersEdit = mysql_fetch_assoc($RS_CustomersEdit);
$totalRows_RS_CustomersEdit = mysql_num_rows($RS_CustomersEdit);
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
                        <?php echo $MenuEditCustomers ?>
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
                                <a class="navbar-brand" href="../main/main.php">
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
                                                <h2><?php echo $Details ?></h2>
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
                        <form ACTION="<?php echo $editFormAction; ?>" id="customers_edit" method="POST" name="customers_edit">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input name="brand_name" type="text" class="form-control" id="brand_name" placeholder="<?php echo $PlaceholderBrandName ?>" value="<?php echo $row_RS_CustomersEdit['brand_name']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="name" type="text" class="form-control" id="name" placeholder="<?php echo $ProfileName ?>" value="<?php echo $row_RS_CustomersEdit['name']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="lastname" type="text" class="form-control" id="lastname" placeholder="<?php echo $ProfileLastName ?>" value="<?php echo $row_RS_CustomersEdit['lastname']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="address" type="text" class="form-control" id="address" placeholder="<?php echo $PlaceholderAddress ?>" value="<?php echo $row_RS_CustomersEdit['address']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="afm" type="text" class="form-control" id="afm" placeholder="<?php echo $PlaceholderAFM ?>" value="<?php echo $row_RS_CustomersEdit['AFM']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="doy" type="text" class="form-control" id="doy" placeholder="<?php echo $PlaceholderDOY ?>" value="<?php echo $row_RS_CustomersEdit['DOY']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="TK" id="TK" type="text" class="form-control" placeholder="<?php echo $PlaceholderTK ?>" value="<?php echo $row_RS_CustomersEdit['TK']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="phone" id="phone" type="text" class="form-control" placeholder="<?php echo $PlaceholderPhone ?>"  value="<?php echo $row_RS_CustomersEdit['phone']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="mobilephone" id="mobilephone" type="text" class="form-control" placeholder="<?php echo $PlaceholderMobile ?>"  value="<?php echo $row_RS_CustomersEdit['mobilephone']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="fax" id="fax" type="text" class="form-control" placeholder="<?php echo $PlaceholderFax ?>"  value="<?php echo $row_RS_CustomersEdit['fax']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-line">
                                        <input name="email" id="email" type="text" class="form-control" placeholder="<?php echo $PlaceholderEmail ?>"  value="<?php echo $row_RS_CustomersEdit['email']; ?>">
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="url" id="url" type="text" class="form-control" placeholder="<?php echo $PlaceholderUrl ?>"  value="<?php echo $row_RS_CustomersEdit['url']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input name="activity" id="activity" type="text" class="form-control" placeholder="<?php echo $PlaceholderActivity ?>"  value="<?php echo $row_RS_CustomersEdit['activity']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    
                                        <div class="form-line">
                                        <input <?php if (!(strcmp($row_RS_CustomersEdit['branch'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" id="branch" name="branch" class="filled-in">
                                        <label for="branch"><?php echo $PlaceholderBranch ?></label>
                                        </div>
                              </div>
                          </div>
                       <div class="row">
                      <div class="col-xs-6 js-sweetalert">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" data-type="success" id="submit" onSubmit="JSconfirm()" ><?php echo $MenuAddCustomers ?></button>
                        </div>
                    </div>
                       <input type="hidden" name="MM_update" value="customers_edit">
                        <input name="customers_id" type="hidden" id="customers_id" value="<?php echo $row_RS_CustomersEdit['customers_id']; ?>">
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
                    <!-- Jquery Form Validation Js -->
                    <script src="../plugins/jquery-validation/jquery.validate.js"></script>
                    
                    <!-- Bootstrap Notify Plugin Js -->
                    <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script>
                     <!-- Form Validation Js -->
                     <script src="../js/pages/forms/form-validation.js"></script>
                    
                    <!-- Custom Js -->
                    <script src="../js/admin.js"></script>

                    <!-- Demo Js -->
                    <script src="../js/demo.js"></script>
                    <!-- SweetAlert Plugin Js -->
				    <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
				    <script src="../js/pages/ui/dialogs.js"></script>
    			</body>
                </html>
                <?php
mysql_free_result($RS_CustomersEdit);
?>
