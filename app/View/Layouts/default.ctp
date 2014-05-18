<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
        <title>banglalink&#8482; 3G Experience Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?php echo Configure::read('base_url')?>/img/favicon.ico" type="image/x-icon"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,600,300' rel='stylesheet' type='text/css'>         
        
        <style type="text/css">
		body { padding-top: 102px; }
	</style>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
	<?php
		echo $this->Html->meta('favicon');
                echo $this->Html->css(array('chosen','bootstrap', 'bootstrap-responsive',
                    'prism','theme/banglalink',));
                
                echo $this->Html->script( array('charts/excanvas.min',
                    'charts/jquery.flot','jquery.jpanelmenu.min',
                    'jquery.cookie','avocado-custom-predom','jquery.ui.datepicker'));

		echo $this->fetch('css');
	?>
        <script>
	$(function() {
		$( "#startDate" ).datepicker();
		$( "#endDate" ).datepicker();
	});
	</script>
</head>
<body>
	<div id="container">
            <?php echo $this->element('top_fixed_bar');?>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			
                    <!-- Content Container -->
	<div class="container">

		<!-- Main Navigation: Box -->
		<div class="navbar navbar-inverse" id="nav">

			<!-- Main Navigation: Inner -->
			<div class="navbar-inner">

				<!-- Main Navigation: Nav -->
				<ul class="nav">

					<!-- Main Navigation: Dashboard -->
					<li class="active"><a href="<?php echo Configure::read('base_url').'/surveys/dashboard';?>"><i class="icon-align-justify"></i> Dashboard</a></li>
					<!-- / Main Navigation: Dashboard -->
					
					<!-- Main Navigation: Report -->
					<li class="dropdown"><a href="<?php echo Configure::read('base_url').'/surveys/report';?>">	<i class="icon-table"></i> All Report </a></li>
					<!-- / Main Navigation: Report -->
					
					<!-- Main Navigation: Update/Refresh  Report -->
					<li class="dropdown"><a href="#" onClick="window.location.reload(true);"><i class="icon-refresh"></i> Update </a></li>
					<!-- / Main Navigation: Update/Refresh  Report -->

					<!-- Main Navigation: Download Zone -->
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-download">
								</i> Download Zone <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="icon-check"></i> Manual</a></li>
								<li><a href="#"><i class="icon-edit"></i> Mobile App For Report</a></li>
								<li><a href="#"><i class="icon-th-large"></i> BP Mobile App</a></li>
							</ul>
					</li>
					<!-- / Main Navigation: Download Zone -->
					
					<!-- Main Navigation: Admin Access Options -->
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user">
								</i> Admin  <b class="caret"></b>
							</a>
					
						<ul class="dropdown-menu">
								<li><a href="#"><i class="icon-check"></i> Admin Option 1</a></li>
								<li><a href="#"><i class="icon-edit"></i> Admin Option 2</a></li>
								<li><a href="#"><i class="icon-th-large"></i> Admin Option 3</a></li>
						</ul>
							
					</li>
					<!-- / Main Navigation: Admin Access Options -->
					
				</ul>
				<!-- / Main Navigation: Nav -->
			</div>
			<!-- / Main Navigation: Inner -->
		</div>
		<!-- / Main Navigation: Box -->

		<!-- Alert -->
		<div class="alert alert-light">
			<a class="close" data-dismiss="alert">&times;</a>
			<i class="icon-comment"></i> Welcome to, <b>Banglalink 3G</b> feedback application
		</div>
		<!-- / Alert -->
                
                <?php                     
                    echo $this->fetch('content');
                ?>
	</div> 
		</div>
			<!-- Footer -->
	<footer class="footer">

			<!-- Footer Container -->
            <div class="container">

                                      <!-- Footer Container: Content -->
              <p>Development and design by <a href="http://www.ihoverbd.com">iHover</a></p>


                                      <!-- / Footer Container: Content -->

            </div>
            <!-- / Footer Container -->

	</footer>
	<!-- / Footer -->
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
<?php
echo $this->Html->script( array('jquery.hotkeys',//'calendar/fullcalendar.min',
    'jquery-ui-1.10.2.custom.min','jquery.pajinate','jquery.prism.min',
    'jquery.dataTables.min','charts/jquery.flot.time','charts/jquery.flot.pie',
    'charts/jquery.flot.resize','bootstrap/bootstrap.min',
    'bootstrap/bootstrap-wysiwyg','bootstrap/bootstrap-typeahead',
    'jquery.easing.min','jquery.chosen.min','chart'));
?>
</html>
