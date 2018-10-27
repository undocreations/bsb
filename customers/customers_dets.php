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
                                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">
                                <?php echo $SearchIcon ?></i></a></li>
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
                                                <h2>
                                    <?php echo $Details ?>
                                </h2>
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
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                            <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab" id="headingOne_1">
                                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                               <?php echo $CustomersCard ?>
                                            </a>
                                        </h4>
                                                    </div>
                                                    <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                                        <div class="panel-body">
                                                            <!-- Multi Column -->
                                                            <div class="row clearfix">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="card">
                                                                        <div class="body">
                                                                            <form ACTION="" id="customers_edit" method="POST" name="customers_edit">
                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="brand_name" type="text" class="form-control" id="brand_name" placeholder="<?php echo $PlaceholderBrandName ?>" value="<?php echo $row_RS_CustomersEdit['brand_name']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="name" type="text" class="form-control" id="name" placeholder="<?php echo $ProfileName ?>" value="<?php echo $row_RS_CustomersEdit['name']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="<?php echo $ProfileLastName ?>" value="<?php echo $row_RS_CustomersEdit['lastname']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="address" type="text" class="form-control" id="address" placeholder="<?php echo $PlaceholderAddress ?>" value="<?php echo $row_RS_CustomersEdit['address']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="afm" type="text" class="form-control" id="afm" placeholder="<?php echo $PlaceholderAFM ?>" value="<?php echo $row_RS_CustomersEdit['AFM']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="doy" type="text" class="form-control" id="doy" placeholder="<?php echo $PlaceholderDOY ?>" value="<?php echo $row_RS_CustomersEdit['DOY']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="TK" id="TK" type="text" class="form-control" placeholder="<?php echo $PlaceholderTK ?>" value="<?php echo $row_RS_CustomersEdit['TK']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="phone" id="phone" type="text" class="form-control" placeholder="<?php echo $PlaceholderPhone ?>" value="<?php echo $row_RS_CustomersEdit['phone']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="mobilephone" id="mobilephone" type="text" class="form-control" placeholder="<?php echo $PlaceholderMobile ?>" value="<?php echo $row_RS_CustomersEdit['mobilephone']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="fax" id="fax" type="text" class="form-control" placeholder="<?php echo $PlaceholderFax ?>" value="<?php echo $row_RS_CustomersEdit['fax']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row clearfix">
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="email" id="email" type="text" class="form-control" placeholder="<?php echo $PlaceholderEmail ?>" value="<?php echo $row_RS_CustomersEdit['email']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="url" id="url" type="text" class="form-control" placeholder="<?php echo $PlaceholderUrl ?>" value="<?php echo $row_RS_CustomersEdit['url']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input name="activity" id="activity" type="text" class="form-control" placeholder="<?php echo $PlaceholderActivity ?>" value="<?php echo $row_RS_CustomersEdit['activity']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-line">
                                                                                            <input <?php if (!(strcmp($row_RS_CustomersEdit[ 'branch'],1))) {echo "checked=\" checked\ ";} ?> type="checkbox" id="branch" name="branch" class="filled-in" disabled>
                                                                                            <label for="branch">
                                                                                                <?php echo $PlaceholderBranch ?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-xs-6 js-sweetalert">
																				      <a href="customers_upd.php?customers_id=<?php echo $row_RS_CustomersEdit['customers_id']; ?>">
																				      <button type="button" class="btn btn-primary m-t-15 waves-effect"><?php echo $CustomersUpdateCard?></button>
																			        </a>                                                                                    </div>
                                                                                </div>
                                                                                <input name="customers_id" type="hidden" id="customers_id" value="<?php echo $row_RS_CustomersEdit['customers_id']; ?>">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- #END# Multi Column -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading" role="tab" id="headingTwo_1">
                                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false" aria-controls="collapseTwo_1">
                                            Collapsible Group Item #2
                                        </a>
                                    </h4>
                                                </div>
                                                <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading" role="tab" id="headingThree_1">
                                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false" aria-controls="collapseThree_1">
                                            Collapsible Group Item #3
                                        </a>
                                    </h4>
                                                </div>
                                                <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                </body>

                </html>
                <?php
				mysql_free_result($RS_CustomersEdit);
				?>
