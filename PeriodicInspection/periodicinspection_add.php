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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "periodicinspection_add")) {
  $insertSQL = sprintf("INSERT INTO tbl_periodic_inspection (customers_id, fext_type, serialnumber, manufacturers_fext_brandname, notes, useless, date_useless, date_add_check, date_next_check) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['customers_id'], "int"),
                       GetSQLValueString($_POST['fext_type'], "text"),
                       GetSQLValueString($_POST['serialnumber'], "text"),
                       GetSQLValueString($_POST['manufacturers_fext_brandname'], "text"),
                       GetSQLValueString($_POST['notes'], "text"),
                       GetSQLValueString(isset($_POST['useless']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['date_useless'], "date"),
                       GetSQLValueString($_POST['date_add_check'], "date"),
                       GetSQLValueString($_POST['date_next_check'], "date"));

  mysql_select_db($database_bsb, $bsb);
  $Result1 = mysql_query($insertSQL, $bsb) or die(mysql_error());

  $insertGoTo = "periodicinspection_add.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_bsb, $bsb);
$query_RS_Customers = "SELECT customers_id, brand_name, name, lastname FROM tbl_customers ORDER BY brand_name ASC";
$RS_Customers = mysql_query($query_RS_Customers, $bsb) or die(mysql_error());
$row_RS_Customers = mysql_fetch_assoc($RS_Customers);
$totalRows_RS_Customers = mysql_num_rows($RS_Customers);

mysql_select_db($database_bsb, $bsb);
$query_RS_ManufacturesFext = "SELECT * FROM tbl_manufacturers_fext ORDER BY manufacturers_fext_brandname ASC";
$RS_ManufacturesFext = mysql_query($query_RS_ManufacturesFext, $bsb) or die(mysql_error());
$row_RS_ManufacturesFext = mysql_fetch_assoc($RS_ManufacturesFext);
$totalRows_RS_ManufacturesFext = mysql_num_rows($RS_ManufacturesFext);

mysql_select_db($database_bsb, $bsb);
$query_RS_FextType = "SELECT * FROM tbl_fext_type ORDER BY fext_type ASC";
$RS_FextType = mysql_query($query_RS_FextType, $bsb) or die(mysql_error());
$row_RS_FextType = mysql_fetch_assoc($RS_FextType);
$totalRows_RS_FextType = mysql_num_rows($RS_FextType);

mysql_select_db($database_bsb, $bsb);
$query_RS_FireExtinguisher = "SELECT serialnumber FROM tbl_fire_extinguisher";
$RS_FireExtinguisher = mysql_query($query_RS_FireExtinguisher, $bsb) or die(mysql_error());
$row_RS_FireExtinguisher = mysql_fetch_assoc($RS_FireExtinguisher);
$totalRows_RS_FireExtinguisher = mysql_num_rows($RS_FireExtinguisher);

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
<?php require_once('../documentation/help.php'); ?>
                <!DOCTYPE html>
                <html>

                <head>
                    <meta charset="UTF-8">
                    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                    <title>
                        <?php echo $PeriodIcinspectionTitle ?>
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
				    <!-- Bootstrap Select Css -->
				    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />     
				    <!-- Bootstrap Material Datetime Picker Css -->
				    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
                    <!-- Wait Me Css -->
                    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />               
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
                                                <h2><?php echo $PeriodIcinspectionTitle ?></h2>
                                                <ul class="header-dropdown m-r-0">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons" data-toggle="modal" data-target="#defaultModal">help_outline</i>
                                                    </a>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                               <!-- Default Size Modal -->
                                <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="defaultModalLabel"><?php echo $PeriodicInspection_hlp_Title ?></h4>
                                            </div>
                                            <div class="modal-body">
                                            <?php echo $PeriodicInspection_hlp?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><?php echo $Close ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Default Size Modal -->

                                <!-- #END# Body Copy -->
             <!-- Multi Column -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                        <form ACTION="<?php echo $editFormAction; ?>" id="periodicinspection_add" method="POST" name="periodicinspection_add">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                     <p>
                                        <b><?php echo $MenuAddCustomers?></b>
                                    </p>
                                        <select class="form-control show-tick" id="customers_id" name="customers_id" data-live-search="true">
                                          <?php
												do {  
											?>
                                          <option value="<?php echo $row_RS_Customers['customers_id']?>"<?php if (!(strcmp($row_RS_Customers['customers_id'], $row_RS_Customers['customers_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RS_Customers['brand_name']?></option>
                                          <?php
											} while ($row_RS_Customers = mysql_fetch_assoc($RS_Customers));
											  $rows = mysql_num_rows($RS_Customers);
											  if($rows > 0) {
												  mysql_data_seek($RS_Customers, 0);
												  $row_RS_Customers = mysql_fetch_assoc($RS_Customers);
											  }
										   ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <p>
                                        <b><?php echo $FireExtSerialNumber?></b>
                                    </p>
                                    <select class="form-control show-tick" id="serialnumber" name="serialnumber" data-live-search="true">
                                          <?php
												do {  
											?>
                                          <option value="<?php echo $row_RS_FireExtinguisher['serialnumber']?>"<?php if (!(strcmp($row_RS_FireExtinguisher['serialnumber'], $row_RS_FireExtinguisher['serialnumber']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RS_FireExtinguisher['serialnumber']?></option>
                                          <?php
											} while ($row_RS_FireExtinguisher = mysql_fetch_assoc($RS_FireExtinguisher));
											  $rows = mysql_num_rows($RS_FireExtinguisher);
											  if($rows > 0) {
												  mysql_data_seek($RS_FireExtinguisher, 0);
												  $row_RS_FireExtinguisher = mysql_fetch_assoc($RS_FireExtinguisher);
											  }
										   ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <p>
                                        <b><?php echo $FextTypePlaceholder ?></b>
                                    </p>
                                       <select class="form-control show-tick" data-live-search="true" id="fext_type" name="fext_type">
                                          <?php
												do {  
											?>
                                          <option value="<?php echo $row_RS_FextType['fext_type']?>"<?php if (!(strcmp($row_RS_FextType['fext_type'], $row_RS_FextType['fext_type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RS_FextType['fext_type']?></option>
                                          <?php
											} while ($row_RS_FextType = mysql_fetch_assoc($RS_FextType));
											  $rows = mysql_num_rows($RS_FextType);
											  if($rows > 0) {
												  mysql_data_seek($RS_FextType, 0);
												  $row_RS_FextType = mysql_fetch_assoc($RS_ManufacturesFext);
											  }
										   ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <p>
                                        <b><?php echo $ManufacturersFextPlaceholder ?></b>
                                    </p>
                                       <select class="form-control show-tick" data-live-search="true" id="manufacturers_fext_brandname" name="manufacturers_fext_brandname">
                                          <?php
												do {  
											?>
                                          <option value="<?php echo $row_RS_ManufacturesFext['manufacturers_fext_brandname']?>"<?php if (!(strcmp($row_RS_ManufacturesFext['manufacturers_fext_brandname'], $row_RS_ManufacturesFext['manufacturers_fext_brandname']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RS_ManufacturesFext['manufacturers_fext_brandname']?></option>
                                          <?php
											} while ($row_RS_ManufacturesFext = mysql_fetch_assoc($RS_ManufacturesFext));
											  $rows = mysql_num_rows($RS_ManufacturesFext);
											  if($rows > 0) {
												  mysql_data_seek($RS_ManufacturesFext, 0);
												  $row_RS_ManufacturesFext = mysql_fetch_assoc($RS_ManufacturesFext);
											  }
										   ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <p>
                                        <b><?php echo $PeriodIcinspectionDateAsUseless ?></b>
                                    </p>
                                        <input type="text" class="datepicker form-control" id="date_useless" name="date_useless" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <p>
                                        <b><?php echo $PeriodIcinspectionDateAddCheck ?></b>
                                    </p>
                                        <input type="text" class="datepicker form-control" id="date_add_check" name="date_add_check" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                     <p>
                                        <b><?php echo $PeriodIcinspectionDateNextCheck ?></b>
                                    </p>
                                    <input type="text" class="datepicker form-control" id="date_next_check" name="date_next_check" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input type="checkbox" id="useless" name="useless" class="filled-in">
                                        <label for="useless"><?php echo $PeriodIcinspectionUseless ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                     <p>
                                        <b><?php echo $Notes ?></b>
                                    </p>
                                    <textarea rows="4" class="form-control no-resize" id="notes" name="notes" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                       <div class="row">
                      <div class="col-xs-6 js-sweetalert">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" data-type="success" id="submit" onSubmit="JSconfirm()" ><?php echo $PeriodIcinspectionAdd ?></button>
                        </div>
                    </div>
                       <input type="hidden" name="MM_insert" value="periodicinspection_add">
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
                    <!-- Form Validation Js -->
                    <script src="../js/pages/forms/form-validation.js"></script>
                	<!-- Autosize Plugin Js -->
				    <script src="../plugins/autosize/autosize.js"></script>
                    <!-- Moment Plugin Js -->
                    <script src="../plugins/momentjs/moment.js"></script>
				    <!-- Bootstrap Material Datetime Picker Plugin Js -->
                    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
                    <script src="../js/pages/ui/modals.js"></script>
                    
                    <!-- Custom Js -->
                    <script src="../js/admin.js"></script>
                    <script src="../js/pages/forms/basic-form-elements.js"></script>

                    <!-- Demo Js -->
                    <script src="../js/demo.js"></script>
                    <!-- SweetAlert Plugin Js -->
				    <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
				    <script src="../js/pages/ui/dialogs.js"></script>
    			</body>
                </html>
                <?php
                mysql_free_result($RS_Customers);
                mysql_free_result($RS_ManufacturesFext);
                mysql_free_result($RS_FextType);
                mysql_free_result($RS_FireExtinguisher);
                ?>
