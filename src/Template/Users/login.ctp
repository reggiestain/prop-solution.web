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
<style>
    hr.soften {
        height: 1px;
        background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,.8), rgba(0,0,0,0));
        background-image:    -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,.8), rgba(0,0,0,0));
        background-image:     -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,.8), rgba(0,0,0,0));
        background-image:      -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,.8), rgba(0,0,0,0));
        border: 0;
    }
</style>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <!--<img alt="Brand" src="...">-->
            </a>
        </div>
    </div>
</nav>
<div class="container">
    <div style="margin-top:20px">
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 hidden-xs hidden-sm">
            <div class="pull-left login-desc-box-l intro">
                <p style="margin-left: 50px">
                    <strong>Property Management Made Easy</strong><br>
                    Property management can be paperwork-intensive. PROP SOLUTION keeps applications, leases, rent checks and receipts accessible. 
                    With a simple online payment system, rent payments can be transferred automatically from your tenant’s bank account. 
                    Designed specifically for the complexities of rental property accounting, from recording transactions to generating reports. 
                    Quickly audit up to an entire year's worth of transactions on one screen to help spot inconsistencies, missing rents, or double payments.
                    PROP SOLUTION proactively alerts you when rents are due, which ones are late and when lease expirations are approaching.
                    Open a direct line of communication with your tenants to streamline repair requests and send tenants reminders and alerts automatically. 
                    <br><br>
                    <button type="button" class="btn btn-primary">Need Help</button>
                    <button type="button" class="btn btn-warning">Find out more</button>
                </p>
                <br />
                <br />
                <hr class="soften" />
            </div>           
        </div>
        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 hidden-xs hidden-sm">
            <div class="pull-left login-desc-box-l intro">
                                <?php echo $this->Html->image('phone.jpg',['style'=>'width:210px;height:330px']);?>
                <br />
                <br />
                <hr class="soften" />      
            </div>  

        </div>
        <div class="col-lg-4">
            
            <!-- <div class="alert alert-info">
                 <a class="close" data-dismiss="alert" href="#">&times;</a>
                 Press enter key or click the Submit button
             </div>-->
            <form method="post" action="<?php echo \Cake\Routing\Router::Url('/users/login');?>" class="bootstrap-admin-login-form">
                <?php  
                echo $this->Flash->render();
                echo $this->Flash->render('auth');
                ?>
                <h4>Sign In</h4>
                <div class="input-group">
                    <input class="form-control" type="text" name="email" placeholder="E-mail" required>
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                </div>
                <br>                
                <div class="input-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-lock"></i></span>
                </div>
                <div class="form-group">
                    <div style="margin-top:5px"> <a href="#">Forgot password?</a> </div>                   
                    <input type="checkbox" name="remember_me">
                    Remember me                    
                </div>
                <button class="btn btn-success" type="submit">Login</button>
                <a href="#" id="reg" class="btn btn-primary pull-right" type="submit">Register</a>
            </form>
            <br />
            <br />
            <hr class="soften" />
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">PROP SOLUTION</h4>
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

