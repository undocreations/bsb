<?php require_once('../Connections/bsb.php'); ?>
<?php require_once('../mods/logout.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "manufacturersfext_upd")) {
  $updateSQL = sprintf("UPDATE tbl_manufacturers_fext SET manufacturers_fext_brandname=%s WHERE manufacturers_fext_id=%s",
                       GetSQLValueString($_POST['manufacturers_fext_brandname'], "text"),
                       GetSQLValueString($_POST['manufacturers_fext_id'], "int"));

  mysql_select_db($database_bsb, $bsb);
  $Result1 = mysql_query($updateSQL, $bsb) or die(mysql_error());

  $updateGoTo = "manufacturersfext_upd.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RS_ManufacturersFextEdit = "-1";
if (isset($_GET['manufacturers_fext_id'])) {
  $colname_RS_ManufacturersFextEdit = $_GET['manufacturers_fext_id'];
}
mysql_select_db($database_bsb, $bsb);
$query_RS_ManufacturersFextEdit = sprintf("SELECT * FROM tbl_manufacturers_fext WHERE manufacturers_fext_id = %s", GetSQLValueString($colname_RS_ManufacturersFextEdit, "int"));
$RS_ManufacturersFextEdit = mysql_query($query_RS_ManufacturersFextEdit, $bsb) or die(mysql_error());
$row_RS_ManufacturersFextEdit = mysql_fetch_assoc($RS_ManufacturersFextEdit);
$totalRows_RS_ManufacturersFextEdit = mysql_num_rows($RS_ManufacturersFextEdit);

?>

<?php require_once('../mods/noaccess.php'); ?>
<?php require_once('../lang/el.php'); ?>
                <!DOCTYPE html>
                <html>

                <head>
                    <meta charset="UTF-8">
                    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                    <title>
                        <?php echo $ExtinguisherHeadsTitle ?>
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
                                                <h2><?php echo $ManufacturersFextPlaceholder ?></h2>
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
                        <form ACTION="<?php echo $editFormAction; ?>" id="manufacturersfext_upd" method="POST" name="manufacturersfext_upd">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input name="manufacturers_fext_brandname" type="text" class="form-control" id="manufacturers_fext_brandname" placeholder="<?php echo $ManufacturersFextPlaceholder ?>" value="<?php echo $row_RS_ManufacturersFextEdit['manufacturers_fext_brandname']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <div class="row">
                      <div class="col-xs-6 js-sweetalert">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" data-type="success" id="submit" onSubmit="JSconfirm()" ><?php echo $ManufacturersFextTitle ?></button>
                        </div>
                    </div>
                        <input name="manufacturers_fext_id" type="hidden" id="manufacturers_fext_id" value="<?php echo $row_RS_ManufacturersFextEdit['manufacturers_fext_id']; ?>">
                        <input type="hidden" name="MM_update" value="manufacturersfext_upd">
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
mysql_free_result($RS_ManufacturersFextEdit);
?>
