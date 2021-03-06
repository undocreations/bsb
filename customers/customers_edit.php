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

mysql_select_db($database_bsb, $bsb);
$query_RS_EditCustomers = "SELECT customers_id, brand_name, name, lastname FROM tbl_customers WHERE inactive = 0 ORDER BY brand_name ASC";
$RS_EditCustomers = mysql_query($query_RS_EditCustomers, $bsb) or die(mysql_error());
$row_RS_EditCustomers = mysql_fetch_assoc($RS_EditCustomers);
$totalRows_RS_EditCustomers = mysql_num_rows($RS_EditCustomers);


?>

<?php require_once('../mods/noaccess.php'); ?>
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
                    <!-- JQuery DataTable Css -->
				    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

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
                                                <h2><?php echo $MenuEditCustomers ?></h2>
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
                        <div class="header">
                            <h2>
                               <?php echo $CustomersTotal ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th><?php echo $PlaceholderBrandName ?></th>
                                            <th><?php echo $ProfileName ?></th>
                                            <th><?php echo $ProfileLastName ?></th>
                                            <th><?php echo $Details ?></th>
                                            <th><?php echo $MenuEditCustomers?></th>
                                            <th><?php echo $Delete ?></th>
                                        </tr>
                                    </thead>
                                    <!--
                                    <tfoot>
                                        <tr>
                                            <th><?php //echo $PlaceholderBrandName ?></th>
                                            <th><?php //echo $ProfileName ?></th>
                                            <th><?php //echo $ProfileLastName ?></th>
                                            <th>Start date</th>
                                            <th>Salary</th>                                            
                                        </tr>
                                    </tfoot>
                                    -->
                                    <tbody>
                                        <?php do { ?>
                                        <tr>
                                            <td><?php echo $row_RS_EditCustomers['brand_name']; ?></td>
                                            <td><?php echo $row_RS_EditCustomers['name']; ?></td>
                                            <td><?php echo $row_RS_EditCustomers['lastname']; ?></td>
                                            <td><a href="customers_dets.php?customers_id=<?php echo $row_RS_EditCustomers['customers_id']; ?>"><img src="../images/icons/application_view_list.png" width="16" height="16" data-toggle="tooltip" data-placement="top" title="<?php echo $CustomersDetails ?>"></a></td>
                                            <td><a href="customers_upd.php?customers_id=<?php echo $row_RS_EditCustomers['customers_id']; ?>"><img src="../images/icons/layout_edit.png" width="16" height="16" data-toggle="tooltip" data-placement="top" title="<?php echo $MenuEditCustomers ?>"></a></td>
                                            <td><a href="customers_del.php?customers_id=<?php echo $row_RS_EditCustomers['customers_id']; ?>"><img src="../images/icons/cancel.png" width="16" height="16" data-toggle="tooltip" data-placement="top" title="<?php echo $Delete ?>"></a></td>
                                          </tr>
                                          <?php } while ($row_RS_EditCustomers = mysql_fetch_assoc($RS_EditCustomers)); ?>
                                    </tbody>
                                </table>
                            </div>
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
                    <!-- Jquery DataTable Plugin Js -->
                    <!-- Tooltips -->
                    <script src="../js/pages/ui/tooltips-popovers.js"></script>
					<script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
                    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
                    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
                    <script src="../js/pages/tables/jquery-datatable.js"></script>
                    <!-- Custom Js -->
                    <script src="../js/admin.js"></script>
                    <!-- Demo Js -->
                    <script src="../js/demo.js"></script>
                    <!-- Bootstrap Notify Plugin Js -->
                    <!-- <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script> -->
                    <!-- SweetAlert Plugin Js -->
				    <!-- <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script> -->
				    <!-- <script src="../js/pages/ui/dialogs.js"></script> -->
    			</body>
                </html>
                 <script>  
				 $(document).ready(function(){  
			      $('#data').DataTable();  
				 });  
				</script>
                <?php
					mysql_free_result($RS_EditCustomers);
				?>
