<?php require_once('../Connections/bsb.php'); ?>
<?php require_once('noaccess.php');?>

<?php

$colname_RS_Profile = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RS_Profile = $_SESSION['MM_Username'];
}
mysql_select_db($database_bsb, $bsb);
$query_RS_Profile = sprintf("SELECT * FROM tbl_register WHERE email = %s", GetSQLValueString($colname_RS_Profile, "text"));
$RS_Profile = mysql_query($query_RS_Profile, $bsb) or die(mysql_error());
$row_RS_Profile = mysql_fetch_assoc($RS_Profile);
$totalRows_RS_Profile = mysql_num_rows($RS_Profile);

?>
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row_RS_Profile['name']; ?> <?php echo $row_RS_Profile['lastname']; ?></div>
                    <div class="email"><?php echo $row_RS_Profile['email']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../login/profile.php?reg_id=<?php echo $row_RS_Profile['reg_id']; ?>"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                              <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $logoutAction ?>"><i class="material-icons">input</i><?php echo $SignOut ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
<?php
mysql_free_result($RS_Profile);
?>