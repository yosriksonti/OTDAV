 <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                        <a href="stats.php"><i class="menu-icon fa fa-database"></i>Statistics</a>
                    </li>
                    
                    
                     
                   
                    <?php 
                            
                            
if ($qls->user_info['group_id'] == '3') 
                            
                        echo '
                    <li class="menu-title">Depots</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        
                        <ul > 
                            <li><a href="find_dp.php">Liste des Depots</a></li>
                            <li><a href="adddp.php">Ajouter un depot</a></li>
                            <li><a href="redepot.php">Mettre à jour un depot</a></li>
                            ';
                            else
                            
if ($qls->user_info['group_id'] == '4')
                        echo '
                    
                    <li class="menu-title">Quittances</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        
                        <ul > 
                        	<li><a href="find_qt.php">Liste des Quittances</a></li>
                    		<li><a href="depots.php"> Quittance</a></li>
                            <li><a href="requittance.php">Mettre à jour une quittance</a></li>
                            '   ; 
                            else
                           if ($qls->user_info['group_id'] == '5') 
                            echo '
                    <li class="menu-title">Certificats</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        
                        <ul > 
                            <li><a href="find_certif.php">Liste des Certificats</a></li>
                        	<li><a href="validate.php">Certificat</a></li>
                            <li><a href="search.php">Research</a></li>
                            <li><a href="list_alert.php">Alerts</a></li>
                            <li><a href="revalidate.php">Renouvellement</a></li>
                            ';
                            else
                            if ($qls->user_info['group_id'] == '1')
                            echo ' 
                        <li class="menu-title">Depots</li><!-- /.menu-title -->
                    	<li class="menu-item-has-children dropdown">
              
                        <ul > 
                        <li><a href="find_dp.php">Liste des Depots</a></li>
                        <li><a href="adddp.php">Ajouter un depot</a></li>
                        <li><a href="redepot.php">Mettre à jour un depot</a></li>

                        <li class="menu-title">Quittances</li><!-- /.menu-title -->
                        <li><a href="find_qt.php">Liste des Quittances</a></li>
                        <li><a href="depots.php">Quittance</a></li>
                        <li><a href="requittance.php">Mettre à jour une quittance</a></li>

                        <li class="menu-title">Certificats</li><!-- /.menu-title -->
                        <li><a href="find_certif.php">Liste des Certificats</a></li>
                        <li><a href="validate.php">Certificat</a></li>
                        <li><a href="search.php">Research</a></li>
                        <li><a href="list_alert.php">Alerts</a></li>
                        <li><a href="revalidate.php">Renouvellement</a></li>
                        ';
                            ?>
                            <?php if ($qls->user_info['group_id'] == 6) { 
                        echo '
                     <li class="menu-title">Administrateurs</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        
                        <ul >
                            <li><a href="admins.php">Liste Administrateurs</a></li>
                           
                            <li><a href="admincp.php">Panel Administratif</a></li>';} ?>
                        </ul>
                    </li>
                     
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
