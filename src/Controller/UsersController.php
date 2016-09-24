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

require_once(ROOT . DS . 'vendor' . DS . 'excel' . DS . 'PHPExcel.php');
require_once(ROOT . DS . 'vendor' . DS . 'excel' . DS . 'PHPExcel' . DS . 'Writer' . DS . 'Excel2007.php');
require_once(ROOT . DS . 'vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Request;
use Cake\Network\Email\Email;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use tcpdf;
use Cake\Network\Http\Client;
use Cake\View\Helper\RssHelper;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     * 
     */
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
    public $Datetime;

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
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

        $this->Auth->allow(['index', 'login', 'signup', 'logout']);

        if ($this->Auth->user('id')) {
            $this->set('user', $this->UsersTable->get($this->Auth->user('id')));
        }
    }

    public function index() {

        $this->set('title', 'Home');
        $this->layout = 'index';
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->user('status') === 'In-ative') {
                    $this->Flash->error(__('This account has been blocked, please contact Admin for assistance.'));
                    return $this->redirect(['action' => 'login']);
                }
                if ($this->Auth->user('group') === 'admin') {
                    $this->Flash->success(__('Welcome , ' . $this->Auth->user('email')));
                    return $this->redirect(['action' => 'dashboard']);
                } else if ($this->Auth->user('group') === 'super') {
                    return $this->redirect(['action' => 'admin_dashboard']);
                }
            }
            $this->Flash->error(__('Invalid email or password.'));
            $this->set('title', 'Login');
        }
    }
    
    public function signup() {
        if ($this->request->is('post')) {
            $UserEmail = $this->UsersTable->find()->where(['email' => $this->request->data('email')])->first();
            if (!empty($UserEmail->email)) {
                $this->set('exist', 'registered');
            } else {
                $UserData = $this->UsersTable->newEntity();
                $Udata = ['email' => $this->request->data('email'), 'password' => $this->request->data('password'),
                    'confirm_pass' => $this->request->data('confirm_pass'), 'group' => 'admin'];
                $User = $this->UsersTable->patchEntity($UserData, $Udata);
                if ($this->UsersTable->save($User)) {
                    $this->set('true', 'successfull');
                } else {
                    $this->set('false', 'failed');
                }
            }
            $this->set('title', 'Sign Up');
            $this->layout = '';
        }
    }

    public function dashboard() {
        $this->set('title', 'Dashboard');
        $this->layout = 'dashboard';
    }

    public function properties() {
        $props = $this->PropertyTable->find()->where(['property.user_id' => $this->Auth->user('id')])->contain(['Province', 'Ledger', 'Managers']);
        $province = $this->ProvinceTable->find('list');
        $profile = $this->ManagersTable->find('list', ['valueField' => ['full_name']]);
        $ledger = $this->LedgerTable->find('list', ['valueField' => ['ledger_name']]);
        $this->set('props', $props);
        $this->set('province', $province);
        $this->set('profile', $profile);
        $this->set('ledger', $ledger);
        $this->set('userId', $this->Auth->user('id'));
        $this->layout = 'dashboard';
    }

    public function add_prop() {
        $prop = $this->PropertyTable->newEntity();
        if ($this->request->is('post')) {
            $propData = $this->PropertyTable->patchEntity($prop, $this->request->data);
            if ($this->PropertyTable->save($propData)) {
                $this->Flash->success(__('Property details has been saved successfully.'));
                return $this->redirect(['action' => 'properties']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'properties']);
            }
        }

        $this->set('prop', $prop);
        $this->layout = 'dashboard';
    }

    public function managers() {
        $profiles = $this->ManagersTable->find()->where(['managers.user_id' => $this->Auth->user('id')])->contain(['Province']);
        $province = $this->ProvinceTable->find('list');
        $this->set('province', $province);
        $this->set('profiles', $profiles);
        $this->layout = 'dashboard';
    }

    public function add_profile() {
        $prop = $this->ManagersTable->newEntity();
        if ($this->request->is('post')) {
            $propData = $this->ManagersTable->patchEntity($prop, $this->request->data);
            if ($this->ManagersTable->save($propData)) {
                $this->Flash->success(__('Profile details has been saved successfully.'));
                return $this->redirect(['action' => 'managers']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'managers']);
            }
        }

        $this->set('profile', $prop);
        $this->layout = 'dashboard';
    }

    public function ledger() {
        $ledgers = $this->LedgerTable->find()->where(['ledger.user_id' => $this->Auth->user('id')])->contain(['Managers', 'Banks']);
        $profile = $this->ManagersTable->find('list', ['valueField' => ['full_name']]);
        $properties = $this->PropertyTable->find('list', ['valueField' => ['full_name']]);
        $banks = $this->BanksTable->find('list');
        $this->set('profile', $profile);
        $this->set('ledgers', $ledgers);
        $this->set('properties', $properties);
        $this->set('banks', $banks);
        $this->layout = 'dashboard';
    }

    public function add_ledger() {
        $prop = $this->LedgerTable->newEntity();
        if ($this->request->is('post')) {
            $propData = $this->LedgerTable->patchEntity($prop, $this->request->data);
            if ($this->LedgerTable->save($propData)) {
                $this->Flash->success(__('Ledger details has been saved successfully.'));
                return $this->redirect(['action' => 'ledger']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'ledger']);
            }
        }
        $this->set('ledger', $prop);
        $this->layout = 'dashboard';
    }

    public function vendors() {
        $vendor = $this->VendorsTable->find()->where(['vendors.user_id' => $this->Auth->user('id')])->contain(['Province', 'Maintenance']);
        $province = $this->ProvinceTable->find('list');
        $maintenance = $this->MaintenanceTable->find('list');
        $this->set('maintenance', $maintenance);
        $this->set('province', $province);
        $this->set('vendors', $vendor);
        $this->layout = 'dashboard';
    }

    public function add_vendor() {
        $vendor = $this->VendorsTable->newEntity();
        if ($this->request->is('post')) {
            $vendorData = $this->VendorsTable->patchEntity($vendor, $this->request->data);
            if ($this->VendorsTable->save($vendorData)) {
                $this->Flash->success(__('Vendor details has been saved successfully.'));
                return $this->redirect(['action' => 'vendors']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'vendors']);
            }
        }
        $this->set('vendor', $vendor);
        $this->layout = 'dashboard';
    }

    public function tenants() {
        $tenants = $this->TenantsTable->find()->where(['tenants.user_id' => $this->Auth->user('id')])->contain(['Property', 'Ledger']);
        $property = $this->PropertyTable->find('list', ['valueField' => ['prop_name']]);
        $this->set('property', $property);
        $ledger = $this->LedgerTable->find('list',['valueField' => ['ledger_name']]);
        $this->set('ledger', $ledger);
        $this->set('tenants', $tenants);
        $this->layout = 'dashboard';
    }

    public function add_tenant() {
        $tenant = $this->TenantsTable->newEntity();
        if ($this->request->is('post')) {
            $tenantData = $this->TenantsTable->patchEntity($tenant, $this->request->data);
            if ($this->TenantsTable->save($tenantData)) {
                $this->Flash->success(__('Tenant details has been saved successfully.'));
                return $this->redirect(['action' => 'tenants']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'tenants']);
            }
        }
        $this->set('tenant', $tenant);
        $this->layout = 'dashboard';
    }

    public function edit_tenant($id) {
        if ($this->request->is('ajax')) {
            $tenantInfo = $this->TenantsTable->get($id, ['contain' => ['Property', 'Ledger']]);
            $property = $this->PropertyTable->find('list', ['valueField' => ['prop_name']]);
            $this->set('property', $property);
            $ledger = $this->LedgerTable->find('list', ['valueField' => ['ledger_name']]);
            $this->set('ledger', $ledger);
            $this->set('tenantInfo', $tenantInfo);
        }
        $this->layout = '';
    }

    public function update_tenant($id) {
        $tenant = $this->TenantsTable->get($id, ['contain' => ['Property', 'Ledger']]);
        $tenantData = $this->TenantsTable->patchEntity($tenant, $this->request->data);
        if ($this->TenantsTable->save($tenantData)) {
            $this->Flash->success(__('Tenant details has been updated successfully.'));
            return $this->redirect(['action' => 'tenants']);
        } else {
            $this->Flash->error(__('An error occured, please try again.'));
            return $this->redirect(['action' => 'tenants']);
        }

        $this->layout = 'dashboard';
    }

    public function contract($id) {
        $tenant = $this->TenantsTable->get($id,['contain'=>['Property']]);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, 'A4', true, 'UTF-8', false);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        $pdf->SetDefaultMonospacedFont('courier');
        $pdf->SetMargins(6, 8, 6, false);
        $pdf->SetAutoPageBreak(FALSE, 0);

        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage('L');
        $pdf->setImageScale(1.34);
        $html = '
                <p align="center" style="font-size:20px">CONTRACT OF LEASE</p>
                <p align="center" style="font-size:20px">BETWEEN</p>
                <h1 align="center" style="font-size:20px">Murasiet Mentoor ID 680229 5164 084</h1>
                <p align="center" style="font-size:20px">(LESSOR)</p>
                <p align="center" style="font-size:20px">AND</p>
                <p align="center" style="font-size:20px"> '.$tenant->firstname.' '.$tenant->surname.'</p>
                <p align="center" style="font-size:20px">ID / Passport NO: '.$tenant->ID_number.'</p>
                <p align="center" style="font-size:20px">(HEREINAFTER REFERRED TO AS THE LESSEE)</p>
                <p align="center" style="font-size:20px">('.$tenant->address_type.' ADDRESS)</p>
                <p align="center" style="font-size:20px"> '.$tenant->address.'</p>    
                <p align="center" style="font-size:20px">IN RESPECT OF PROPERTY</p>
                <p align="center" style="font-size:20px">Main house (structure) at '.$tenant->property->prop_name.' </p>
                <br>
                <br>
                <hr>
                <p style="font-size:20px"> '.$tenant->conditions.'</p>
                ';               
        $pdf->setCellMargins(5, 5, 5, 5);
        $pdf->writeHTML($html, true, 0, true, 0);
         // add a page
               $pdf->AddPage();
               $html='
                
                ';
        $pdf->setCellMargins(5, 5, 5, 5);
        $pdf->writeHTML($html, true, 0, true, 0);       
        $pdf->lastPage();
        $pdf->Output('contract-form.pdf', 'I');
    }
}
