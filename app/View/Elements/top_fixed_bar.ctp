<!-- Top Fixed Bar -->
<div class="navbar navbar-inverse navbar-fixed-top">

        <!-- Top Fixed Bar: Navbar Inner -->
        <div class="navbar-inner">

                <!-- Top Fixed Bar: Container -->
                <div class="container">

                        <!-- Mobile Menu Button -->
                        <a href="#">
                                <button type="button" class="btn btn-navbar mobile-menu">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </button>
                        </a>
                        <!-- / Mobile Menu Button -->

                        <!-- / Logo / Brand Name -->
                        <a class="brand" href="#"><img src="assets/img/logo_bl.png" alt="banglalink logo" style="margin: 0; padding: 0;"/></b></a>
                        <!-- / Logo / Brand Name -->

                        <!-- User Navigation -->
                        <ul class="nav pull-right">

                                <!-- User Navigation: User -->
                                <li class="dropdown">

                                        <!-- User Navigation: User Link -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-user icon-white"></i> 
                                                <span class="hidden-phone">Welcome, Admin</span>
                                        </a>
                                        <!-- / User Navigation: User Link -->

                                        <!-- User Navigation: User Dropdown -->
                                        <ul class="dropdown-menu">
<!--                                                <li><a href="#"><i class="icon-off"></i> Logout</a></li>-->
                                            <li><?php echo $this->Html->link('Logout', array('controller' =>
                                                'users', 'action' => 'logout'));?>
                                            </li>
                                        </ul>
                                        <!-- / User Navigation: User Dropdown -->

                                </li>
                                <!-- / User Navigation: User -->

                        </ul>
                        <!-- / User Navigation -->

                </div>
                <!-- / Top Fixed Bar: Container -->

        </div>
        <!-- / Top Fixed Bar: Navbar Inner -->

        <!-- Top Fixed Bar: Breadcrumb -->
        <div class="breadcrumb clearfix">

                <!-- Top Fixed Bar: Breadcrumb Container -->
                <div class="container">

                        <!-- Top Fixed Bar: Breadcrumb Location -->
                        <ul class="pull-left">
                                <li>
<!--                                    <a href="#"><i class="icon-home"></i> Home</a> <span class="divider">/</span>-->
                                    
                                    <?php echo $this->Html->link('Home', array('controller' => 'surveys',
                                        'action' => 'dashboard'));?>
                                </li>
                                <li class="active"><a href="#"><i class="icon-align-justify"></i> Dashboard</a></li>                                
                                
                                <li>
                                    <?php echo $this->Html->link('User', array('controller' => 'users', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Promoter', array('controller' => 'promoters', 'action' => 'index'));?>
                                </li>                                
                                
                                <li>
                                    <?php echo $this->Html->link('Team', array('controller' => 'teams', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Package', array('controller' => 'packages', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Mobile Model', array('controller' => 'mobile_brands', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Occupation', array('controller' => 'occupations', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Region', array('controller' => 'regions', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Area', array('controller' => 'areas', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Location', array('controller' => 'locations', 'action' => 'index'));?>
                                </li>
                                
                                <li>
                                    <?php echo $this->Html->link('Import Data', array('controller' => 'regions', 'action' => 'import_data'));?>
                                </li>
                                
                        </ul>
                        <!-- / Top Fixed Bar: Breadcrumb Location -->

                        <!-- Top Fixed Bar: Breadcrumb Right Navigation -->
                        <ul class="pull-right">
                                <!-- / Top Fixed Bar: Breadcrumb Theme -->
                                <li>
<!--                                    <a href="login.html"><i class="icon-off"></i> Logout</a>-->
                                    
                                    <?php 
                                    echo $this->Html->link('Logout', array('controller' =>
                                                'users', 'action' => 'logout'), array(),
                                            'Are you sure you want to logout?');?>
                                </li>
                        </ul>
                        <!-- / Top Fixed Bar: Breadcrumb Right Navigation -->

                </div>
                <!-- / Top Fixed Bar: Breadcrumb Container -->
        </div>
        <!-- / Top Fixed Bar: Breadcrumb -->
</div>
<!-- / Top Fixed Bar -->