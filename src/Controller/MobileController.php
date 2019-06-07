<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Request;
use Cake\Network\Email\Email;
use Cake\Network\Http\Client;
use Cake\View\Helper\RssHelper;
use RestApi\Controller\ApiController;
use RestApi\Utility\JwtToken;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class MobileController extends AppController{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['device_check']);
    }
    /**
     * Login method
     *
     * Returns a token on successful authentication
     *
     * @return void|\Cake\Network\Response
     */
    
    public function login() {
       
        $this->request->allowMethod('post');
        $user = TableRegistry::get('users');
        /**
         * process your data and validate it against database table
         */
        // generate token if valid user
        $payload = $user->find()->where(['email' => 'reggiestain@gmail.com'])->first();

        $this->apiResponse['token'] = JwtToken::generateToken($payload);
        $this->apiResponse['message'] = 'Logged in successfully.';
               
    }
    
    public function device_check($deviceId) {
        $user = $this->UsersTable->find()->where(['deviceID' => $deviceId])->first();    
        
        if($user === NULL){
           $status = false; 
        } else{       
        $status = true;
        }
        $this->set(compact('status'));
        $this->viewBuilder()->layout(false);
    }

}
