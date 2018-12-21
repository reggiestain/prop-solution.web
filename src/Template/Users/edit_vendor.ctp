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
<?php echo $this->Form->create($vendorInfo,['url' => ['action' => 'update_vendor',$id]]);?>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>General business Information</strong>_____________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-4">    
                        <label>‘Trading as’ name of business:</label>    
                        <?php echo $this->Form->input('trade_name', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                        
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $userID;?>"> 
                    </div>
                    <div class="form-group col-lg-4">    
                        <label>Registered name of business:</label>                          
                        <?php echo $this->Form->input('reg_name', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?> 
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="formGroupExampleInput">Title </label>
                        <?php  
                        $title = ['Prof'=>'Prof','Dr'=>'Dr','Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'];
                        echo $this->Form->select('title',$title,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-4">    
                        <label>Name:</label>    
                        <?php echo $this->Form->input('name', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                           
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Surname:</label>    
                        <?php echo $this->Form->input('surname', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>   
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Contact Person (Cell No):</label>                       
                        <?php echo $this->Form->input('cell', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                                           
                    </div>
                </div> 
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Physical address of business</strong>___________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-4">    
                        <label>Building / complex name:</label>                           
                        <?php echo $this->Form->input('location', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                        
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label>Suburb:</label>                                                
                        <?php echo $this->Form->input('suburb', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                                          
                    </div>                    
                    <div class="form-group col-lg-4">    
                        <label>Province:</label>                           
                    <?php                       
                    echo $this->Form->select('province_id',$province,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                    ?>                                                        
                    </div>
                </div>                    
                <div class="row">    
                    <div class="col-lg-4">    
                        <label>City:</label>                           
                        <?php echo $this->Form->input('city', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                                                
                    </div>
                    <div class="col-lg-4">    
                        <label>Postal Code:</label>                           
                        <?php echo $this->Form->input('area_code', ['label'=>false,'type' =>'text','class'=>'form-control']);?>                                                        
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Postal address of business</strong>_______________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-3">    
                        <label>Post net address:</label>                                          
                        <?php echo $this->Form->input('post_address', ['label'=>false,'type' =>'text','class'=>'form-control']);?>
                    </div>
                    <div class="form-group col-lg-3"> 
                        <label>PO Box / Private Bag:</label>                                 
                        <?php echo $this->Form->input('private_bag', ['label'=>false,'type' =>'text','class'=>'form-control']);?>
                    </div>                    
                    <div class="form-group col-lg-3">    
                        <label>City / Town:</label>                             
                        <?php echo $this->Form->input('post_city', ['label'=>false,'type' =>'text','class'=>'form-control']);?>                    
                    </div>
                    <div class="form-group col-lg-3">    
                        <label>Postal Code:</label>                           
                        <?php echo $this->Form->input('post_code', ['label'=>false,'type' =>'text','class'=>'form-control']);?>
                                                                           
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-lg-4">    
                        <label>Business telephone number:</label>                           
                        <?php echo $this->Form->input('tel_no', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                                            
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label>Alternative number of business:</label>                                     
                        <?php echo $this->Form->input('alt_tel_no', ['label'=>false,'type' =>'text','class'=>'form-control']);?>                    
                    </div>                    
                    <div class="form-group col-lg-4">    
                        <label>Business Fax Number:</label>                                                   
                        <?php echo $this->Form->input('business_fax', ['label'=>false,'type' =>'text','class'=>'form-control']);?>                    
                    </div>
                </div>  
                <div class="row">
                    <div class="form-group col-lg-4">    
                        <label>Accounting Clerk’s fax number:</label>                                                  
                        <?php echo $this->Form->input('clerk_fax', ['label'=>false,'type' =>'text','class'=>'form-control']);?>                    
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label>Business e-mail:</label>                                               
                        <?php echo $this->Form->input('business_email', ['label'=>false,'type' =>'text','class'=>'form-control']);?>                    
                    </div>                    
                    <div class="form-group col-lg-4">    
                        <label>Tax number of business:</label>                           
                        <?php echo $this->Form->input('tax_no', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                                           
                    </div>
                </div>   
                <div class="row">    
                    <div class="form-group col-lg-4">    
                        <label>VAT registration number:</label>                           
                        <?php echo $this->Form->input('vat_no', ['label'=>false,'type' =>'text','class'=>'form-control','required']);?>                                                                         
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Select the geographical areas where your business is willing and cable of providing services:</strong>_______________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row"> 
                    <div class="form-group col-lg-6">
                        <label for="formGroupExampleInput">Operational Areas</label><br>
                        <?php    
                        echo $this->Form->select('vendor_city._ids',$city,['class'=>'form-control','id'=>'city1','multiple'=>'multiple','required']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="formGroupExampleInput">Type of Services</label><br>
                        <?php    
                        echo $this->Form->select('maintenance_id',$maintenance,['id'=>'type1','multiple'=>'multiple','default'=>$option]);    
                        ?>  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Commercial:</strong>__________________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">    
                    <div class="form-group col-lg-12">    
                        <label>Name three commercial references of previous projects / contracts recently completed and provide contactable names’
                            and contact numbers:</label>                                  
                        <?php echo $this->Form->input('references', ['label'=>false,'type' =>'textarea','class'=>'form-control','row'=>'3']);?>                    
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Financial:</strong>______________________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">    
                    <div class="form-group col-lg-12">    
                        <label>Has your business ever been declared insolvent or had a judicial management order granted against it? –if yes, please
                            elaborate:</label>                                                   
                        <?php echo $this->Form->input('insolvent', ['label'=>false,'type' =>'textarea','class'=>'form-control']);?>
                    </div>
                </div>
                <br> 
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Technical:</strong>__________________________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">    
                    <div class="form-group col-lg-12">    
                        <label>Please indicate what your business specialises in:</label>                                                   
                        <?php echo $this->Form->input('speciality', ['label'=>false,'type' =>'textarea','class'=>'form-control']);?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Quality</strong>___________________________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row"> 
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Does your business operate a Quality Management System?</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('QM',$option,['empty'=>'--Choose One--','class'=>'form-control']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Does your business have an Occupational Health and Safety Policy complying with the Occupational Health and Safety
                            Act (Act 85 of 1993) (OHS Act) that clearly states overall health and safety objectives and commitment to improve health
                            and safety performance?</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('HnS',$option,['empty'=>'--Choose One--','class'=>'form-control']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Are you registered with the Compensation Fund in terms of the Compensation for Occupational Injuries and Diseases Act
                            (COID) If yes please provide Registration Number</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('compensation_fund',$option,['empty'=>'--Choose One--','class'=>'form-control']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Has your business experienced any incident that resulted in a fatality or serious injury? If yes, provide details:</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('incident',$option,['empty'=>'--Choose One--','class'=>'form-control','id'=>'incident']);    
                        ?>
                        <br>    
                        <div style="display:none" id="incident-d"> 
                            <label>Incident Details:</label>                                
                            <?php echo $this->Form->input('incident_details', ['label'=>false,'type' =>'textarea','class'=>'form-control']);?>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Has any non-conformances or prohibition notices been issued by the Department of Labour to your business? If yes,
                            provide details:</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('non_conformance',$option,['empty'=>'--Choose One--','class'=>'form-control','id'=>'non-c']);    
                        ?>
                        <br>    
                        <div style="display:none" id="non-d"> 
                            <label>Details</label>                                 
                            <?php echo $this->Form->input('conformance_details', ['label'=>false,'type' =>'textarea','class'=>'form-control']);?>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Do you maintain the integrity and safety of all health and safety related equipment and do you have an effective
                            maintenance schedule? If no, provide reasons:</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('integrity',$option,['empty'=>'--Choose One--','class'=>'form-control','id'=>'integrity']);    
                        ?>
                    </div>    
                    <div class="form-group col-lg-12" style="display:none" id="integrity-d"> 
                        <label>Details</label>                            
                        <?php echo $this->Form->input('integrity_details', ['label'=>false,'type' =>'textarea','class'=>'form-control']);?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Environmental</strong>_______________________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">Does your business have an Environmental Management System in place? Y/N</label><br>
                        <?php    
                        $option = ['Yes'=>'Yes','No'=>'No'];
                        echo $this->Form->select('EM',$option,['empty'=>'--Choose One--','class'=>'form-control']);    
                        ?>  
                    </div>
                </div>    
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Human Resources</strong>________________________________________________________________________________</label>
                    </div>                     
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">How many full-time employees do you currently have?</label>
                        <?php
                        echo $this->Form->input('full_time_emp',['label'=>false,'class'=>'form-control']);    
                        ?>  
                    </div>
                </div>  
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="formGroupExampleInput">How many part-time employees do you currently have?</label>
                        <?php                           
                        echo $this->Form->input('part_time_emp',['label'=>false,'class'=>'form-control']);    
                        ?>  
                    </div>
                </div>    
                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>              
            </div>
           <?php $this->Form->end();?>      

<script>
        
        //$("#curr1").bootstrapSwitch();
        $('#city1').multiselect();
        $('#type1').multiselect();
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