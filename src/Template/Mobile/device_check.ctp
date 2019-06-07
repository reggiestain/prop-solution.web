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
<?php if ($status == false) { ?>
    <div class="wrap-input100 validate-input m-b-10" data-validate = "Usernamedata is required">
        <input class="input100" type="text" name="email" placeholder="Userame">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-user"></i>
        </span>
    </div>
    <div class="wrap-input100 validate-input m-b-10" data-validate = "Passworddata is required">
        <input class="input100" type="password" name="password" placeholder="Username">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock"></i>
        </span>
    </div>
<?php } elseif ($status == true) { ?>
    <div class="scan">
        <div style="font-size:16px;font-weight:bold">Log in with your fingerprint scanner.</div>
        <div class="container-login100-form-btn p-t-10">
            <button type="button" class="login100-form-btn print">
                Login
            </button>
        </div>
    </div>
    <form id="login" class="login100-form validate-form">
        <div id="pin-code" class="text-center w-full p-t-20 p-b-" style="display:none">
            <input name="email" type="email" style="text-align:center" class="form-control" placeholder="Enter Email" required>
            <br>
            <input name="password" style="text-align:center" class="form-control" placeholder="Enter PIN"
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                   type = "number"
                   maxlength = "6"
                   required>
            <div class="container-login100-form-btn p-t-10">
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>
    </form>
    <div class="text-center w-full p-t-20 p-b-45">    
        <a href="#" class="txt1 print" style="font-size:16px;font-weight:bold">
            Log in with your fingerprint.
        </a>
    </div>
    </div>
    <div class="text-center w-full p-t-20 p-b-45 pin-c">
        <a href="#" id="pin" class="txt1" style="font-size:16px;font-weight:bold">
            Or use your App PIN <span class="fa fa-arrow-right"></span>
        </a>
    </div>
    <!--<div class="text-center w-full">
            <a class="txt1" href="#">
                    Create new account
                    <i class="fa fa-long-arrow-right"></i>						
            </a>
    </div>-->    
<?php } ?>
                    

