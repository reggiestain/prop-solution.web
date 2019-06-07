<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = 'CakePHP: the rapid development php framework';

$cakeDescription = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
               
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/bootstrap/css/bootstrap.min.css') ;?>
        <?php echo $this->Html->css('cake-style.css') ;?>  
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/fonts/font-awesome.min.css') ;?>
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/fonts/icon-font.min.css') ;?>
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/fonts/material-design-iconic-font.min.css') ;?>
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/animate/animate.css') ;?>
<!--===============================================================================================-->	
        <?php echo $this->Html->css('vendor/css-hamburgers/hamburgers.min.css') ;?>
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/animsition/css/animsition.min.css') ;?>
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/select2/select2.min.css') ;?>
<!--===============================================================================================-->	
        <?php echo $this->Html->css('vendor/daterangepicker/daterangepicker.css') ;?>
<!--===============================================================================================-->
        <?php echo $this->Html->css('util.css') ;?>
        <?php echo $this->Html->css('main.css') ;?>
<!--===============================================================================================-->
<?php echo $this->Html->script('vendor/jquery/jquery-3.2.1.min.js');?>  
</head>
<body style="background-color: #999999;">
	<?php echo $this->fetch('content');?>	
<!--===============================================================================================-->
        
<!--===============================================================================================-->
        <?php echo $this->Html->script('vendor/animsition/js/animsition.min.js');?>
<!--===============================================================================================-->
        <?php echo $this->Html->script('vendor/bootstrap/js/popper.js');?>
        <?php echo $this->Html->script('vendor/bootstrap/js/bootstrap.min.js');?>
<!--===============================================================================================-->	
        <?php echo $this->Html->script('vendor/select2/select2.min.js');?>
<!--===============================================================================================-->
        <?php echo $this->Html->script('vendor/daterangepicker/moment.min.js');?>
        <?php echo $this->Html->script('vendor/daterangepicker/daterangepicker.js');?>
<!--===============================================================================================-->	
        <?php echo $this->Html->script('vendor/countdowntime/countdowntime.js');?>
<!--===============================================================================================-->
        <?php echo $this->Html->script('main.js');?>
        

</body>
</html>
