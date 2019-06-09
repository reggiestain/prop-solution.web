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
<?php echo $this->Form->create($propInfo, ['url' => ['action' => 'update_prop']]); ?>
<div class="modal-body"> 
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Property Type </label>
            <?php
            echo $this->Form->select('prop_type_id', $propTypes, ['empty' => '--Chose One--', 'class' => 'form-control', 'required']);
            ?>  
        </div>
    </div> <br>
    <div class="row">
        <div class="form-group col-lg-12">
            <label><strong>Physical Address</strong>_____________________________________________________________________________________</label>
        </div>                     
    </div>
    <div class="row">
        <div class="form-group col-lg-5">
            <label for="formGroupExampleInput">Street Number </label>
            <?php echo $this->Form->input('street_number', ['label' => false, 'class' => 'form-control', 'required']); ?>
        </div>
        <div class="form-group col-lg-7">
            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
            <label for="formGroupExampleInput">Street Address </label>
            <?php echo $this->Form->input('street_address', ['label' => false, 'class' => 'form-control', 'required']); ?>
        </div>
    </div> 
    <div class="row">
        <div class="form-group col-lg-5">
            <label for="formGroupExampleInput2">City</label>
            <?php echo $this->Form->input('city', ['label' => false, 'class' => 'form-control', 'required']); ?>
        </div>
        <div class="form-group col-lg-5">
            <label for="formGroupExampleInput">Province </label>
            <?php
            echo $this->Form->select('province_id', $province, ['empty' => '--Chose One--', 'class' => 'form-control', 'required']);
            ?>  
        </div>
        <div class="form-group col-lg-2">
            <label for="formGroupExampleInput2">Area Code</label>
            <?php echo $this->Form->input('area_code', ['label' => false, 'class' => 'form-control']); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="form-group col-lg-12">
            <label><strong>Financials</strong> (Optional)_____________________________________________________________________________________</label>
        </div>                     
    </div>
    <div class="row">
        <div class="col-lg-4">    
            <label>Purchase Price</label>    
            <div class="input-group">                        
                <span class="input-group-addon">R</span>    
                <?php echo $this->Form->input('purchase_price', ['label' => false, 'class' => 'form-control']); ?>
                <span class="input-group-addon">.00</span>
            </div> 
        </div>
        <div class="col-lg-4">    
            <label>Purchase Date</label>   
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>     
                <?php echo $this->Form->input('purchase_date', ['label' => false, 'class' => 'form-control', 'id' => 'date2']); ?>
            </div>
        </div>
        <div class="col-lg-4">    
            <label>Current Value</label>    
            <div class="input-group">
                <span class="input-group-addon">R</span>
                <?php echo $this->Form->input('current_value', ['label' => false, 'class' => 'form-control', 'min' => '0']); ?>
                <span class="input-group-addon">.00</span>
            </div> 
        </div>
    </div> 
    <br>
    <div class="row">
        <div class="form-group col-lg-12">
            <label><strong>Loans (Optional)</strong> __________________________________________________________________________</label>
        </div>                     
    </div>
    <div class="row">
        <div class="col-lg-3">    
            <label>Lender Name</label>    
            <div class="input-group">                           
                <?php echo $this->Form->input('lender_name', ['label' => false, 'class' => 'form-control']); ?>
            </div> 
        </div>
        <div class="col-lg-3">    
            <label>Current Balance</label>   
            <div class="input-group">
                <span class="input-group-addon">R</span>
                <?php echo $this->Form->input('current_balance', ['label' => false, 'class' => 'form-control', 'min' => '0']); ?>
                <span class="input-group-addon">.00</span>
            </div>
        </div>
        <div class="col-lg-3">    
            <label>Monthly Payment</label>    
            <div class="input-group">
                <span class="input-group-addon">R</span>
                <?php echo $this->Form->input('monthly_payment', ['label' => false, 'class' => 'form-control', 'min' => '0']); ?>
                <span class="input-group-addon">.00</span>
            </div> 
        </div>
        <div class="col-lg-3">    
            <label>Interest Rate</label>    
            <div class="input-group">                            
                <?php echo $this->Form->input('interest_rate', ['label' => false, 'class' => 'form-control', 'min' => '0']); ?>     
            </div> 
        </div>
    </div> 
    <br>
    <div class="row">
        <div class="form-group col-lg-6">
            <label><strong>Owner / Manager</strong> ________________________</label>
        </div>  
    </div>
    <div class="row">
        <div class="col-lg-6">    
            <div class="input-group">
                <?php
                echo $this->Form->select('manager_id', $profile, ['empty' => '--Choose One--', 'class' => 'form-control', 'required']);
                ?>   
            </div>
        </div>   
    </div> 
    <br>
    <div class="row">
        <div class="form-group col-lg-12">
            <label><strong>Property Management Fee</strong> ___________________________________________________________________</label>
        </div>  
    </div>
    <div class="row">
        <div class="col-lg-4">    
            <label>Flat Fee and   /   or</label>    
            <div class="input-group">
                <span class="input-group-addon">R</span>
                <?php echo $this->Form->input('flat_fee', ['label' => false, 'class' => 'form-control', 'min' => '0']); ?>
                <span class="input-group-addon">.00</span>
            </div> 
        </div>
        <div class="col-lg-4">    
            <label>Schedule Rent</label>    
            <div class="input-group">
                <span class="input-group-addon">R</span>
                <?php echo $this->Form->input('schedule_rent', ['label' => false, 'class' => 'form-control', 'min' => '0']); ?>
                <span class="input-group-addon">.00</span>
            </div> 
        </div>
        <div class="col-lg-4">    
            <label> Start Date</label>    
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>                            
                <?php echo $this->Form->input('start_date', ['label' => false, 'class' => 'form-control datepicker', 'id' => 'date1']); ?>
            </div>
        </div> 
    </div>

    <br>                
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>              
</div>
</form>        
<script>
    $('#date1').datepicker();
    $('#date2').datepicker();
</script>        