<?php require_once('../Connections/bsb.php'); ?>
    <?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

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
                        <?php echo $MainTitle ?>
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
                       <!-- Search Bar -->
                        <div class="search-bar">
                            <div class="search-icon">
                                <i class="material-icons">search</i>
                            </div>
                            <form>
                            <input type="text" id="custsearch" name="custsearch" placeholder="START TYPING...">
                            </form>
                            <div class="close-search">
                                <i class="material-icons">close</i>
                            </div>
                        </div>
                        <!-- #END# Search Bar -->
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
                                                <h2><?php echo $MainTitleH2 ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Body Copy -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                            Basic Card Title <small>Description text here...</small>
                                                        </h2>
                                            <ul class="header-dropdown m-r-0">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">info_outline</i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">help_outline</i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                                          <input type="text" name="brand_name" id="brand_name" class="form-control input-lg" autocomplete="off"  placeholder="<?php echo $MainAutoCompletePlaceholder?>" />
                                      </div>
                                    </div>
                                </div>

                                <!-- -------------------- -->

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                Basic Card Title <small>Description text here...</small>
                            </h2>
                                            <ul class="header-dropdown m-r-0">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">info_outline</i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">help_outline</i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                                        </div>
                                    </div>
                                </div>
                                <!-- -------------------- -->

                                <!-- -------------------- -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                Basic Card Title <small>Description text here...</small>
                            </h2>
                                            <ul class="header-dropdown m-r-0">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">info_outline</i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <i class="material-icons">help_outline</i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                                        </div>
                                    </div>
                                </div>
                                <!-- -------------------- -->

                            </div>
                        </div>
                    </section>



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
                    <script src="../plugins/typehead/bootstrap3-typeahead.min.js"></script>
                    
                    <!-- AutoComplete Js -->
                    <script src="../js/pages/ui/autocomplete.js"></script>

                    <!-- Custom Js -->
                    <script src="../js/admin.js"></script>

                    <!-- Demo Js -->
                    <script src="../js/demo.js"></script>
 

                </body>

                </html>


