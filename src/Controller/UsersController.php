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

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['index', 'applogin', 'appsignup', 'login', 'signup', 'logout']);

       
    }

    public function index() {
        $this->set('title', 'Home');
        $this->viewBuilder()->layout('index');
    }

    public function applogin() {
        //if ($this->request->is('ajax')) {            
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->user('status') == 'In-ative') {
                    $message = ['blocked' => 'block'];
                }
                if ($this->Auth->user('group') == 'tenant') {

                    $message = ['tenant' => 'tenant', 'user' => $this->Auth->user('id'), 'tenantid' => $this->Auth->user('tenant_id'), 'prop' => $this->Auth->user('property_id')];
                }
                if ($this->Auth->user('group') === 'admin') {
                    $message = ['admin' => 'admin'];
                } else if ($this->Auth->user('group') === 'super') {
                    $message = ['super' => 'super'];
                }
            } else {
                $message = ['error' => 'error'];
            }
        }
        echo json_encode($message);
        exit();
        $this->viewBuilder()->layout(false);
    }

    //}

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->user('status') === 'In-ative') {
                    $this->Flash->error(__('This account has been blocked, please contact Admin for assistance.'));
                    return $this->redirect(['action' => 'login']);
                }
                if ($this->Auth->user('role') === 'admin') {
                    $this->Flash->success(__('Welcome , ' . $this->Auth->user('email')));
                    return $this->redirect(['action' => 'dashboard']);
                } else if ($this->Auth->user('role') === 'super') {
                    return $this->redirect(['action' => 'admin_dashboard']);
                }
            }
            $this->Flash->error(__('Invalid email or password.'));
            $this->set('title', 'Login');
        }
        $this->set('user',$this->UsersTable->newEntity());
        $this->viewBuilder()->layout('login');
    }

    public function appsignup() {
        if ($this->request->is('post')) {
            $UserEmail = $this->UsersTable->find()->where(['email' => $this->request->data('email')])->first();
            if (!empty($UserEmail->email)) {
                $this->set('exist', 'appregistered');
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
           $this->viewBuilder()->layout(false);
        }
    }

    public function signup() {
        if ($this->request->is('post')) {
            $UserEmail = $this->UsersTable->find()->where(['email' => $this->request->data('email')])->first();
            if (!empty($UserEmail->email)) {
                $this->set('status', 'appregistered');
            } else {
                $UserData = $this->UsersTable->newEntity();
                $User = $this->UsersTable->patchEntity($UserData,$this->request->data);
                if ($this->UsersTable->save($User)) {
                    $this->set('status', 'successfull');
                } else {
                    $this->set('status', $User->errors());
                }
            }
            $this->set('title', 'Sign Up');
            $this->viewBuilder()->layout(false);
        }
    }

    public function dashboard() {
        $complaints = $this->CompliantsTable->find()->where(['complaints.user_id' => $this->Auth->user('id'), 'complaints.property_id' => $this->Auth->user('property_id')])->contain(['Tenants', 'Property']);
        $compliantReply = $this->CompCommentsTable->newEntity();
        $vendor = $this->VendorsTable->find('list', ['valueField' => ['reg_name']]);
        $this->set('complaints', $complaints);
        $this->set('compliantReply', $compliantReply);
        $this->set('userId', $this->Auth->user('id'));
        $this->set('vendor', $vendor);
        $this->set('title', 'Dashboard');
        $this->viewBuilder()->layout('dashboard');
    }

    public function properties() {
        $props = $this->PropertyTable->find()->where(['property.user_id' => $this->Auth->user('id')])->contain(['Province', 'Managers','PropType']);
        $province = $this->ProvinceTable->find('list');
        $propTypes = $this->PropTypeTable->find('list');
        $profile = $this->ManagersTable->find('list', ['valueField' => ['full_name']]);
        $ledger = $this->LedgerTable->find('list', ['valueField' => ['ledger_name']]);
        $this->set('props', $props);
        $this->set('province', $province);
        $this->set('profile', $profile);
        $this->set('ledger', $ledger);
        $this->set('propTypes', $propTypes);
        $this->set('userId', $this->Auth->user('id'));
        $this->set('title','Properties');
        $this->viewBuilder()->layout('dashboard');
    }

    public function edit_property($id) {
        if ($this->request->is('ajax')) {
            $propInfo = $this->PropertyTable->get($id, ['contain' => ['Province','Managers','PropType']]);
            $province = $this->ProvinceTable->find('list');
            $profile = $this->ManagersTable->find('list', ['valueField' => ['full_name']]);
            $propTypes = $this->PropTypeTable->find('list');
            $this->set('province', $province);
            $this->set('profile', $profile);
            $this->set('userId', $this->Auth->user('id'));
            $this->set('propInfo', $propInfo);
            $this->set('propTypes', $propTypes);
            $this->set('id', $id);
            
        }
        $this->viewBuilder()->layout(false);
    }
    
    public function update_prop($id) {
        $manager = $this->PropertyTable->get($id);
        if ($this->request->is(['post', 'put'])) {
            $managerData = $this->PropertyTable->patchEntity($manager, $this->request->data);
            if ($this->PropertyTable->save($managerData)) {
                $this->Flash->success(__('Property details has been updated successfully.'));
                return $this->redirect(['action' => 'properties']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'properties']);
            }
        }
        $this->set('title','Properties');
        $this->viewBuilder()->layout('dashboard');
    }

    public function addcomplaint() {
        $compliantTable = $this->ComplaintsTable->newEntity();
        if ($this->request->is('post')) {
            $compliantData = $this->ComplaintsTable->patchEntity($compliantTable, $this->request->data);
            if ($this->ComplaintsTable->save($compliantData)) {
                $message = ['success' => 'success'];
            } else {
                $message = ['error' => 'error'];
            }
        }
        echo json_encode($message);
        exit();
        $this->viewBuilder()->layout(false);
    }

    public function appcomplaints($id) {
        $compliants = $this->CompliantsTable->find()->where(['tenant_id'=>$id])->contain(['ComplaintComments']);
        $this->set('compliants', $compliants);
        $this->viewBuilder()->layout(false);
    }

    public function appview_complaint($id) {
        $compliant = $this->ComplaintsTable->get($id, ['contain' => ['ComplaintComments']]);
        $this->set('compliant', $compliant);
        $this->viewBuilder()->layout(false);
    }

    public function appcompliant_reply() {
        $compliantTable = $this->CompCommentsTable->newEntity();
        if ($this->request->is('post')) {
            $compliantData = $this->CompCommentsTable->patchEntity($compliantTable, $this->request->data);
            if ($this->CompCommentsTable->save($compliantData)) {
                $message = ['success' => 'success'];
            } else {
                $message = ['error' => 'error'];
            }
        }
        echo json_encode($message);
        exit();
        $this->viewBuilder()->layout(false);
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
        $this->viewBuilder()->layout('dashboard');
    }

    public function admincompliant_reply() {
        $compliantTable = $this->CompCommentsTable->newEntity();
        $compliant = $this->CompliantsTable->get($this->request->data('complaint_id'));
        if ($this->request->is('post')) {
            $compliantData = $this->CompCommentsTable->patchEntity($compliantTable, $this->request->data);
            if ($this->CompCommentsTable->save($compliantData)) {
                if(!empty($this->request->data('vendor_id'))){
                   $compliant->vendor_id = $this->request->data('vendor_id');
                }
                $compliant->status = $this->request->data('status');
                $this->CompliantsTable->save($compliant);
                $this->Flash->success(__('Compliant reply has been saved successfully.'));
                return $this->redirect(['action' => 'dashboard']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'dashboard']);
            }
        }
    }

    public function admin_compliantinfo($id) {
        $CompInfo = $this->CompliantsTable->get($id, ['contain' => ['ComplaintComments','Vendors']]);
        $this->set('CompInfo', $CompInfo);
        $this->viewBuilder()->layout(false);
    }

    public function managers() {
        $profiles = $this->ManagersTable->find()->where(['managers.user_id' => $this->Auth->user('id')])->contain(['Province']);
        $province = $this->ProvinceTable->find('list');
        $this->set('province', $province);
        $this->set('profiles', $profiles);
        $this->set('title','Managers');
        $this->viewBuilder()->layout('dashboard');
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
        $this->viewBuilder()->layout('dashboard');
    }

    public function edit_manager($id) {
        if ($this->request->is('ajax')) {
            $managerInfo = $this->ManagersTable->get($id, ['contain' => ['Province']]);
            $province = $this->ProvinceTable->find('list');

            $this->set('managerInfo', $managerInfo);
            $this->set('province', $province);
        }
        $this->viewBuilder()->layout(false);
    }

    public function update_manager($id) {
        $manager = $this->ManagersTable->get($id);
        if ($this->request->is(['post', 'put'])) {
            $managerData = $this->ManagersTable->patchEntity($manager, $this->request->data);
            if ($this->ManagersTable->save($managerData)) {
                $this->Flash->success(__('Manager details has been updated successfully.'));
                return $this->redirect(['action' => 'managers']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'managers']);
            }
        }
        $this->set('title','Managers');
        $this->viewBuilder()->layout('dashboard');
        
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
        $this->viewBuilder()->layout('dashboard');
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
        $this->viewBuilder()->layout('dashboard');
    }

    public function vendors() {
        $vendor = $this->VendorsTable->find()->where(['vendors.user_id' => $this->Auth->user('id')])->contain(['Province']);
        $province = $this->ProvinceTable->find('list');
        $maintenance = $this->MaintenanceTable->find('list');
        $cities = $this->CityTable->find('list');
        $this->set('maintenance', $maintenance);
        $this->set('province', $province);
        $this->set('vendors', $vendor);
        $this->set('city', $cities);
        $this->set('userID', $this->Auth->user('id'));
        $this->set('title', 'Vendor Information');
        $this->viewBuilder()->layout('dashboard');
    }

    public function add_vendor() {
        $vendor = $this->VendorsTable->newEntity();
        if ($this->request->is('post')) {
            $vendorData = $this->VendorsTable->patchEntity($vendor, $this->request->data);
            if ($this->VendorsTable->save($vendorData)) {
                foreach ($this->request->data('maintenance_id') as $vendorMData) {
                    $vendorMaint = $this->VendorMaintenanceTable->newEntity();
                    $data = ['maintenance_id' => $vendorMData, 'vendor_id' => $vendorData->id];
                    $this->VendorMaintenanceTable->patchEntity($vendorMaint, $data);
                    $this->VendorMaintenanceTable->save($vendorMaint);
                }
                foreach ($this->request->data('city_id') as $vendorCData) {
                    $vendorCity = $this->VendorCityTable->newEntity();
                    $data = ['city_id' => $vendorCData, 'vendor_id' => $vendorData->id];
                    $this->VendorCityTable->patchEntity($vendorCity, $data);
                    $this->VendorCityTable->save($vendorCity);
                }
                $this->Flash->success(__('Vendor details has been saved successfully.'));
                return $this->redirect(['action' => 'vendors']);
            } else {
                $this->Flash->error(__('An error occured, please try again.'));
                return $this->redirect(['action' => 'vendors']);
            }
        }
        $this->set('vendor', $vendor);
        $this->viewBuilder()->layout('dashboard');
    }

    public function edit_vendor($id) {
        if ($this->request->is('ajax')) {
            $vendorInfo = $this->VendorsTable->get($id, ['contain' => ['Province', 'VendorMaintenance', 'VendorCity']]);
            $province = $this->ProvinceTable->find('list');
            $maintenance = $this->MaintenanceTable->find('list');
            $option = $this->VendorMaintenanceTable->find()->where(['vendor_id' => $id]);
            foreach ($option as $option) {
                $options[] = $option->maintenance_id;
            }

            $cities = $this->CityTable->find('list');
            $this->set('maintenance', $maintenance);
            $this->set('province', $province);
            $this->set('city', $cities);
            $this->set('userID', $this->Auth->user('id'));
            $this->set('vendorInfo', $vendorInfo);
            $this->set('option', $options);
            $this->set('id', $id);
        }
        $this->viewBuilder()->layout(false);
    }

    public function update_vendor($id) {
        $vendorInfo = $this->VendorsTable->get($id, ['contain' => ['Province', 'VendorMaintenance', 'VendorCity']]);
        if ($this->request->is(['post', 'put'])) {
            $vendorData = $this->VendorsTable->patchEntity($vendorInfo, $this->request->data);
            if ($this->VendorsTable->save($vendorData)) {
                if ($this->VendorMaintenanceTable->deleteAll(['vendor_id' => $id])) {
                    //$VendorMain = $this->VendorMaintenanceTable->get($id);
                    //$this->VendorMaintenanceTable->delete($VendorMain);
                    foreach ($this->request->data('maintenance_id') as $vendorMData) {
                        $vendorMaint = $this->VendorMaintenanceTable->newEntity();
                        $data = ['maintenance_id' => $vendorMData, 'vendor_id' => $vendorData->id];
                        $this->VendorMaintenanceTable->patchEntity($vendorMaint, $data);
                        $this->VendorMaintenanceTable->save($vendorMaint);
                    }
                } else {
                    foreach ($this->request->data('maintenance_id') as $vendorMData) {
                        $vendorMaint = $this->VendorMaintenanceTable->newEntity();
                        $data = ['maintenance_id' => $vendorMData, 'vendor_id' => $vendorData->id];
                        $this->VendorMaintenanceTable->patchEntity($vendorMaint, $data);
                        $this->VendorMaintenanceTable->save($vendorMaint);
                    }
                }
            }
            $this->Flash->success(__('Vendor details has been updated successfully.'));
            return $this->redirect(['action' => 'vendors']);
        } else {
            $this->Flash->error(__('An error occured, please try again.'));
            return $this->redirect(['action' => 'vendors']);
        }
        $this->viewBuilder()->layout('dashboard');
    }

    public function tenants() {
        $tenants = $this->TenantsTable->find()->where(['tenants.user_id' => $this->Auth->user('id')])->contain(['Property', 'Ledger']);
        $property = $this->PropertyTable->find('list', ['valueField' => ['prop_name']]);
        $this->set('property', $property);
        $ledger = $this->LedgerTable->find('list', ['valueField' => ['ledger_name']]);
        $this->set('ledger', $ledger);
        $this->set('tenants', $tenants);
        $this->set('UserId', $this->Auth->user('id'));
        $this->viewBuilder()->layout('dashboard');
    }

    public function add_tenant() {
        $tenant = $this->TenantsTable->newEntity();
        if ($this->request->is('post')) {
            $tenantData = $this->TenantsTable->patchEntity($tenant, $this->request->data);
            if ($this->TenantsTable->save($tenantData)) {
                $UserData = $this->UsersTable->newEntity();
                $pass = mt_rand(100000, 999999);
                $Udata = ['email' => $this->request->data('email'), 'password' => $pass, 'confirm_pass' => $pass,
                    'tenant_id' => $tenantData->id, 'property_id' => $this->request->data('property_id'), 'group' => 'tenant'];
                $User = $this->UsersTable->patchEntity($UserData, $Udata);
                if ($this->UsersTable->save($User)) {
                    $DefaultEmail = new Email();
                    $DefaultEmail->viewVars(['pass' => $pass, 'email' => $this->request->data('email')]);
                    $DefaultEmail->transport('default');
                    $DefaultEmail->template('tenant-login', 'tenant-login')
                            ->emailFormat('html')
                            ->from(['info@rilconsulting.co.za' => 'rilconsulting.co.za'])
                            ->to($this->request->data('email'))
                            ->subject('Welcome')
                            ->send();

                    $this->Flash->success(__('Tenant details has been saved successfully.'));
                    return $this->redirect(['action' => 'tenants']);
                } else {
                    $this->Flash->error(__('An error occured, please try again.'));
                    return $this->redirect(['action' => 'tenants']);
                }
            }
        }
        $this->set('tenant', $tenant);
        $this->viewBuilder()->layout('dashboard');
    }

    public function edit_tenant($id) {
        if ($this->request->is('ajax')) {
            $tenantInfo = $this->TenantsTable->get($id, ['contain' => ['Property', 'Ledger']]);
            $property = $this->PropertyTable->find('list', ['valueField' => ['prop_name']]);
            $this->set('property', $property);
            $ledger = $this->LedgerTable->find('list', ['valueField' => ['ledger_name']]);
            $this->set('ledger', $ledger);
            $this->set('tenantInfo', $tenantInfo);
            $this->set('id', $id);
        }
        $this->viewBuilder()->layout(false);
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
        $this->viewBuilder()->layout('dashboard');
    }

    public function contract($id) {
        $tenant = $this->TenantsTable->get($id, ['contain' => ['Property']]);
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
                <p align="center" style="font-size:20px"> ' . $tenant->firstname . ' ' . $tenant->surname . '</p>
                <p align="center" style="font-size:20px">ID / Passport NO: ' . $tenant->ID_number . '</p>
                <p align="center" style="font-size:20px">(HEREINAFTER REFERRED TO AS THE LESSEE)</p>
                <p align="center" style="font-size:20px">(' . $tenant->address_type . ' ADDRESS)</p>
                <p align="center" style="font-size:20px"> ' . $tenant->address . '</p>    
                <p align="center" style="font-size:20px">IN RESPECT OF PROPERTY</p>
                <p align="center" style="font-size:20px">Main house (structure) at ' . $tenant->property->prop_name . ' </p>
                <br>
                <br>
                <hr>
                <p style="font-size:20px"> ' . $tenant->conditions . '</p>
                ';
        $pdf->setCellMargins(5, 5, 5, 5);
        $pdf->writeHTML($html, true, 0, true, 0);
        // add a page
        $pdf->AddPage();
        $html = '
                
                ';
        $pdf->setCellMargins(5, 5, 5, 5);
        $pdf->writeHTML($html, true, 0, true, 0);
        $pdf->lastPage();
        $pdf->Output('contract-form.pdf', 'I');
    }

    public function logout() {
        $this->set('title', 'Login');
        return $this->redirect($this->Auth->logout());
    }

}
