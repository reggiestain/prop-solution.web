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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
?>
<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('../img/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" method="post" action="<?php echo \Cake\Routing\Router::Url('/users/login');?>">					
                    <span class="login100-form-title p-b-59">
						Sign in
					</span>
                     <?php  
                     echo $this->Flash->render();
                     echo $this->Flash->render('auth');
                     ?>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email addess...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="text" name="password" placeholder="*************">
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
								Sign in
							</button>
						</div>

						<a href="#" id="reg" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            <b>Sign Up</b>
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">                    
                    <h3 class="modal-title w-100" id="myModalLabel">PROP SOLUTION</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="register" action="<?php echo \Cake\Routing\Router::Url('/users/signup');?>">
                <div class="modal-body">
                    <p>
                        Start your free trial now! No credit card required. 
                        Enter your email address and create a password below. You will receive and email confirmation.    
                    </p>                    
                        <div class="form-group">
                            <label for="formGroupExampleInput">Enter your email address (This will be your username)</label>
                            <input type="email" class="form-control" id="formGroupExampleInput" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Create Password</label>
                            <input type="password" class="form-control" id="formGroupExampleInput2" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Confirm Password</label>
                            <input type="password" class="form-control" id="formGroupExampleInput2" name="confirm_pass" required>
                        </div>
                    
                    <br>
                    <p>By clicking this Submit, you agree to the <a>Terms and Conditions</a> and <a>Privacy Policy.</a></p>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>    
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">
                    <div class="reg-alert">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#remember').click(function () {
            if ($(this).prop("checked") == true) {
                $(this).val('true');
            }
            else if ($(this).prop("checked") == false) {
                $(this).val('false');
            }
        });

        $("#reg").click(function () {
            $("#myModal").modal();
        });

        $(document).on('submit', '#register', function (event) {
            event.preventDefault();
            $('#myModal').modal('toggle');
            var formData = $("#register").serialize();
            var url = $("#register").attr("action");
            $.ajax({
                url: url,
                type: "POST",
                //asyn: true,
                data: formData,
                success: function (data, textStatus, jqXHR)
                {
                    $(".reg-alert").html(data);
                    $("#myModal1").modal();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {

                }
            });
        });
    });
</script>    

