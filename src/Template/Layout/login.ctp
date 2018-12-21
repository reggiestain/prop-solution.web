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
        <?php //echo $this->Html->css('cake-style.css') ;?>         
<!--===============================================================================================-->
        <?php echo $this->Html->css('vendor/bootstrap/css/bootstrap.min.css') ;?>
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
</head>
<body style="background-color: #999999;">
	<?php //echo $this->fetch('content');?>
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('../img/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-59">
						Sign in
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email addess...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="text" name="pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									I agree to the
									<a href="#" class="txt2 hov1">
										Terms of User
									</a>
								</span>
							</label>
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Sign Up
							</button>
						</div>

						<a href="#" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign in
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
        <?php echo $this->Html->script('vendor/jquery/jquery-3.2.1.min.js');?>  
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
