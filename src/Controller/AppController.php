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

use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Log\Log;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $UsersTable;
    public $ProfilesTable;
    public $RolesTable;
    public $AttachmentsTable;
    public $ProvincesTable;
    public $CompaniesTable;
    public $TitlesTable;
    public $UserPhotosTable;
    public $AuditLogsTable;
    public $ProvinceTable;
    public $PaymentsTable;
    public $PropertyTable;
    public $LedgerTable;
    public $BanksTable;
    public $VendorsTable;
    public $MaintenanceTable;
    public $TenantsTable;
    public $ManagersTable;
    public $CompliantsTable;
    public $CompCommentsTable;
    public $CityTable;
    public $VendorCityTable;
    public $VendorMaintenanceTable;
    public $Datetime;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize() {
        
        $this->UsersTable = TableRegistry::get('users');
        $this->ProfilesTable = TableRegistry::get('profiles');
        $this->DRequestsTable = TableRegistry::get('requests');
        $this->PropertyTable = TableRegistry::get('property');
        $this->ProvinceTable = TableRegistry::get('province');
        $this->LedgerTable = TableRegistry::get('ledger');
        $this->BanksTable = TableRegistry::get('banks');
        $this->VendorsTable = TableRegistry::get('vendors');
        $this->MaintenanceTable = TableRegistry::get('maintenance');
        $this->TenantsTable = TableRegistry::get('tenants');
        $this->ManagersTable = TableRegistry::get('managers');
        $this->CompliantsTable = TableRegistry::get('complaints');
        $this->CompCommentsTable = TableRegistry::get('complaint_comments');
        $this->CityTable = TableRegistry::get('city');
        $this->VendorCityTable = TableRegistry::get('vendor_city');
        $this->VendorMaintenanceTable = TableRegistry::get('vendor_maintenance');
        $this->PropTypeTable = TableRegistry::get('prop_type');

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
        $this->loadComponent('Cookie');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Basic',
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'dashboard'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
    }

}
