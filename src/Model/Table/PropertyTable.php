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
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

//use Cake\ORM\Rule\IsUnique;

class PropertyTable extends Table {

    public function initialize(array $config) {

        $this->table('property');
        $this->addBehavior('Timestamp');
        // Just add the belongsTo relation with CategoriesTable
        //$this->primaryKey('profile_id');
        $this->belongsTo('Province', [
            'foreignKey' => 'province_id',
            'joinType' => 'INNER'
            
        ]);     
        
        $this->belongsTo('Managers', [
            'foreignKey' => 'manager_id',
            'joinType' => 'INNER'
            
        ]); 
        
        $this->belongsTo('Ledger', [
            'foreignKey' => 'ledger_id',
            'joinType' => 'INNER'
            
        ]);  
        
        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
            
        ]); 
        
        $this->belongsTo('PropType', [
            'foreignKey' => 'prop_type_id',
            'joinType' => 'INNER'
            
        ]); 
         
    }

    public function validationDefault(Validator $validator) {
        $validator->add('email', 'valid-email', ['rule' => 'email'])
                ->notEmpty('address', 'A password is required')
                ->notEmpty('city', 'A password is required')
                ->add('role', 'notEmpty', [
                    'rule' => 'notEmpty',
                    'message' => __('Please select user type')
                ])
                ->add('confirm_password', 'no-misspelling', [
                    'rule' => ['compareWith', 'password'],
                    'message' => 'Passwords are not equal',
        ]);


        return $validator;
    }

    

}
