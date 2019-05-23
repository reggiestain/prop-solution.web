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
<?php echo $this->Form->create($tenantInfo,['url' => ['action' => 'update_tenant',$id]]);?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="formGroupExampleInput">Select Property </label>
                        <?php    
                        echo $this->Form->select('property_id',$property,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-6">    
                        <label>Unit Name / Number</label> 
                        <?php echo $this->Form->input('unit', ['label'=>false,'class' => 'form-control']);?>                        
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Tenant Details</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">    
                        <label>Company Name</label>    
                        <?php echo $this->Form->input('company_name', ['label'=>false,'class' => 'form-control']);?>                          
                    </div>
                    <div class="form-group col-lg-6">    
                        <label>ID / Passport Number</label>    
                        <?php echo $this->Form->input('ID_number', ['label'=>false,'class' => 'form-control']);?>                         
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4"> 
                        <label>First Name</label>   
                        <?php echo $this->Form->input('firstname', ['label'=>false,'class' => 'form-control','required']);?>                                                                            
                    </div>
                    <div class="col-lg-4">    
                        <label>Surname</label>  
                        <?php echo $this->Form->input('surname', ['label'=>false,'class' => 'form-control','required']);?>                                                                               
                    </div>
                    <div class="col-lg-4">    
                        <label>Date Of Birth</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <?php echo $this->Form->input('birthdate', ['label'=>false,'class' => 'form-control datepicker','id'=>'date16','required']);?>                                                            
                        </div>                                                       
                    </div>
                </div> 
                <br>                
                <div class="row">
                    <div class="col-lg-4"> 
                        <label>Contact Number 1</label>
                        <?php echo $this->Form->input('phone1', ['label'=>false,'class' => 'form-control','required']);?>                                                                            
                    </div>
                    <div class="col-lg-4">    
                        <label>Contact Number 2</label>                           
                        <?php echo $this->Form->input('phone2', ['label'=>false,'class' => 'form-control','required']);?>                                                                                
                    </div>
                    <div class="col-lg-4">    
                        <label>Email</label>                           
                        <?php echo $this->Form->input('email', ['label'=>false,'class' => 'form-control','required']);?>                                                       
                    </div>
                </div>                 
                <br>
                <div class="row">
                    <div class="col-lg-6"> 
                        <label>Address Type</label>                       
                        <?php    
                        $type = ['Learning Institution'=>'Learning Institution','Work'=>'Work'];
                        echo $this->Form->select('address_type',$type,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>                                                                           
                    </div>
                    <div class="col-lg-6">    
                        <label>Learning Institution / Work Address</label>                           
                        <?php echo $this->Form->input('address', ['type'=>'textarea','label'=>false,'class' => 'form-control']);?>                                                                               
                    </div>
                </div>   
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Lease Details</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3"> 
                        <label>Agreement Type</label>                       
                        <?php    
                        $lease = ['Month-to-Month'=>'Month-to-Month','6 Months'=>'6 Months','12 Months'=>'12 Months'];
                        echo $this->Form->select('lease_type',$lease,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>                                                                            
                    </div>
                    <div class="col-lg-3">    
                        <label>Lease Start</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <?php echo $this->Form->input('lease_start', ['label'=>false,'class' => 'form-control datepicker','id'=>'date15']);?>                                                            
                        </div>                                                       
                    </div>
                    <div class="col-lg-3">    
                        <label>Lease End</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <?php echo $this->Form->input('lease_end', ['label'=>false,'class' => 'form-control datepicker','id'=>'date14']);?>                                                                                        
                        </div>                                                       
                    </div>
                    <div class="col-lg-3"> 
                        <label>Deposit</label>                       
                        <div class="input-group">                        
                            <span class="input-group-addon">R</span>   
                            <?php echo $this->Form->input('deposit', ['label'=>false,'class' => 'form-control']);?>
                            <span class="input-group-addon">.00</span>
                        </div>                                                                           
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Payment Terms</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <div class="row alert alert-warning">
                    <div class="form-group col-lg-2">   
                        <label>Recurring Rent</label>                       
                        <div class="input-group">
                        <?php echo $this->Form->input('recurring_rent', ['label'=>false,'type'=>'checkbox','id'=>'curr1']);?>  
                        </div>    
                    </div>
                    <div class="form-group col-lg-6">
                    <p>
                    Recurring Rent will remind you when rent is due based on the payment terms you set below. Unpaid rent will accrue into a balance due.
                    </p>
                    </div>    
                </div>
                <div class="row">
                    <p style="text-align: center">
                        *Important: “Start Date” is the rent due date. (Example: If rent is due on the 1st, enter 1/1/2016)<br>
                        ** Leave “End Date” blank to continue payments indefinitely
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-3"> 
                        <label>Frequency</label>                       
                        <?php    
                        $frequency = ['Once'=>'Once','Daily'=>'Daily'];
                        echo $this->Form->select('re_frequency',$frequency,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>                                                                            
                    </div>
                    <div class="col-lg-3">    
                        <label>Start Date</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span> 
                            <?php echo $this->Form->input('re_start', ['label'=>false,'class' =>'form-control datepicker','id'=>'date12']);?>                                                            
                        </div>                                                       
                    </div>
                    <div class="col-lg-3">    
                        <label>End Date</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span> 
                            <?php echo $this->Form->input('re_end', ['label'=>false,'class' =>'form-control datepicker','id'=>'date11']);?>                                                          
                        </div>                                                       
                    </div>
                    <div class="col-lg-3"> 
                        <label>Rent Amount</label>                       
                        <div class="input-group">                        
                            <span class="input-group-addon">R</span> 
                            <?php echo $this->Form->input('re_amount', ['label'=>false,'class' =>'form-control']);?>
                        </div>                                                                           
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Payment Settings</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6"> 
                        <label>Default Ledger</label>                       
                        <?php    
                        echo $this->Form->select('ledger_id',$ledger,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>                                                                            
                    </div>
                    <div class="col-lg-6"> 
                        <label>Default Payment Type</label>                       
                        <?php    
                        $payment = ['Cash'=>'Cash','EFT'=>'EFT','Credit Card'];
                        echo $this->Form->select('payment',$payment,['default'=>'','class'=>'form-control','required']);    
                        ?>                                                                            
                    </div>
                </div> 
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Restrictions</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">                        
                        <label class="checkbox-inline"><input type="checkbox" name="pets" value="<?php echo $tentantInfo->pets;?>" <?php if(!empty($tentantInfo->pets)){echo 'checked';};?>><b>No Pets</b></label>
                        <label class="checkbox-inline"><input type="checkbox" name="smoking" value="<?php echo $tentantInfo->smoking;?>" <?php if(!empty($tentantInfo->smoking)){echo 'checked';};?>><b>No Smoking</b></label>                                                                          
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12"> 
                    <?php echo $this->Form->input('restrictions', ['label'=>false,'type' =>'textarea','id'=>'mytextarea3']);?>                                              
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Occupancy Details</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">    
                        <label>Move-in Date</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span> 
                            <?php echo $this->Form->input('move_in_date', ['label'=>false,'class' =>'form-control datepicker','id'=>'date10']);?>                                                            
                        </div>                                                       
                    </div>
                </div> 
                <br>
                <div class="row">                    
                    <div class="col-lg-12"> 
                        <label>Move-in Conditions / Memo</label>
                        <?php echo $this->Form->input('conditions', ['label'=>false,'type' =>'textarea','id'=>'mytextarea4']);?>                    
                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>              
            </div>
<?php echo $this->Form->end();?>

<script>
        CKEDITOR.replace('mytextarea3');
        CKEDITOR.replace('mytextarea4');
        //$("#curr1").bootstrapSwitch();
        $('#date10').datepicker();
        $('#date11').datepicker();
        $('#date12').datepicker();
        $('#date13').datepicker();
        $('#date14').datepicker();
        $('#date15').datepicker();
        $('#date16').datepicker();
        $("#add-prop").click(function () {
            $("#propModal").modal({});
        });
</script>    