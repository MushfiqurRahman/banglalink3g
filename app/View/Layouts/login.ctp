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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

     <div class="container">  

        <form class="form-signin form-horizontal">
        <div class="top-bar">
          <h3><i class="icon-leaf"></i> Avocado<b>Panel</b></h3>
        </div>
        <div class="well no-padding">

          <div class="control-group">
            <label class="control-label" for="inputName"><i class="icon-user"></i></label>
            <div class="controls">
              <input type="text" id="inputName" placeholder="Username">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputUsername"><i class="icon-key"></i></label>
            <div class="controls">
              <input type="password" id="inputUsername" placeholder="Password">
            </div>
          </div>

        <div class="padding">
          <button class="btn btn-primary" type="submit">Sign in</button>
          <button class="btn" type="submit">Forgot Password</button>
          </div>
        </div>
      </form>

    </div> 

</body>
</html>
