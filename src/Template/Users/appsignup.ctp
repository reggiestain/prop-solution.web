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

<?php

if($exist === 'appregistered'){
  echo 'alreadyregistered';  
}
if($true === 'successfull'){
   echo '<div class="alert alert-success"><strong>Success!</strong> Your account has been created successfully! Please check your email for activation. '
      . 'If you do not receive an activation email, please check your spam/junk folder or contact us at support@propsolution.co.za .</div>'; 
}
if($false === 'failed'){
   echo '<div class="alert alert-danger"><strong>Error!</strong> An error occured please, try again.</div>';  
}
if($exist === 'registered'){
    echo'<div class="alert alert-warning">This email address has already been registered, please enter a different email address.</div>';
}
?>