 <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Adhérants</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        
                        <ul >                            
                            <li><a href="<?php echo"users.php";?>">Liste d'adhérants</a></li>
                            <li><a href="<?php echo"addus.php";?>">Ajoutez un adhérant</a></li>
                            
                        </ul>
                    </li>
                     
                    <!-- <li class="menu-title">Breuvés</li>
                    <li class="menu-item-has-children dropdown">
                        
                        <ul >                            
                            <li><a href="<?php echo"breuves.php";?>">Liste des breuvés</a></li>
                            <li><a href="<?php echo"addbr.php";?>">Ajoutez une breuvé</a></li>
                            
                        </ul>
                    </li> -->
                    
                   
                     <li class="menu-title">Administrateurs</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        
                        <ul >
                            <li><a href="admins.php">Liste d'administrateurs</a></li>
                            <?php if ($qls->user_info['group_id'] == 1) { echo '
                            <li><a href="admincp.php">Panel Administratif</a></li>';} ?>
                        </ul>
                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    
                    <div class="user-area dropdown float-right">
                        <a class="nav-link" href="<?php echo'logout.php'; ?>"><i class="fa fa-power -off"></i>Logout</a>
                    </div>


                </div>
            </div>
        </header>