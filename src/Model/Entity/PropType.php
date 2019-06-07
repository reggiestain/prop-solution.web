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

namespace App\Model\Entity;
use Cake\ORM\Entity;

class PropType extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];
    
    protected function _getLedgerName()
    {
        //return $this->_properties['account_name'] .' ('.$this->_properties['account_number'].')';
            
    }
}
