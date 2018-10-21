<div class="menu">
    <ul class="list">
        <li class="header">
            <?php echo $MainNavigation ?>
        </li>
        <li>
            <a href="../main/main.php">
                <i class="material-icons">home</i>
                <span><?php echo $Home ?></span>
            </a>
        </li>
        <!-- Customers -->
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">face</i>
                <span><?php echo $MenuCustomers ?></span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../Customers/customers_add.php">
                        <?php echo $MenuAddCustomers ?>
                    </a>
                </li>
                <li>
                    <a href="../Customers/customers_edit.php">
                        <?php echo $MenuEditCustomers ?>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Customers -->
        <!-- -------------------------------- -->
        <!-- Fire Ext -->
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">whatshot</i>
                <span><?php echo $MenuFireExt ?></span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../FireExt/fireext_add.php">
                        <?php echo $MenuFireExtAdd ?>
                    </a>
                </li>
                <li>
                    <a href="../FireExt/fireext_edit.php">
                        <?php echo $MenuFireExtEdit ?>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Fire Ext -->
        <!-- -------------------------------- -->
        <!-- Extinguisher Heads -->
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">brightness_high</i>
                <span><?php echo $MenuExtinguisherHeads ?></span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../ExtinguisherHeads/ExtinguisherHeads_add.php">
                        <?php echo $MenuExtinguisherHeadsAdd ?>
                    </a>
                </li>
                <li>
                    <a href="../ExtinguisherHeads/ExtinguisherHeads_edit.php">
                        <?php echo $MenuExtinguisherHeadsEdit ?>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Extinguisher Heads -->
        <!-- -------------------------------- -->
        <!-- Manufacturers Fext -->
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">battery_std</i>
                <span><?php echo $MenuManufacturersFext ?></span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../manufacturersfext/manufacturersfext_add.php">
                        <?php echo $MenuManufacturersFextAdd ?>
                    </a>
                </li>
                <li>
                    <a href="../manufacturersfext/manufacturersfext_edit.php">
                        <?php echo $MenuManufacturersFextEdit ?>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Manufacturers Fext -->
        <!-- -------------------------------- -->
        <!-- Periodic Inspection -->
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">access_time</i>
                <span><?php echo $MenuPeriodicInspection ?></span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../PeriodicInspection/periodicinspection_add.php">
                        <?php echo $MenuPeriodicInspectionAdd ?>
                    </a>
                </li>
                <li>
                    <a href="../PeriodicInspection/periodicinspection_edit.php">
                        <?php echo $MenuPeriodicInspectionEdit ?>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Periodic Inspection -->
        <!-- -------------------------------- -->
        <!-- Fext Type -->
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">merge_type</i>
                <span><?php echo $MenuFextType ?></span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../FextType/fexttype_add.php">
                        <?php echo $MenuFextTypeAdd ?>
                    </a>
                </li>
                <li>
                    <a href="../FextType/fexttype_edit.php">
                        <?php echo $MenuFextTypeEdit ?>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Fext Type -->
    </ul>
</div>
