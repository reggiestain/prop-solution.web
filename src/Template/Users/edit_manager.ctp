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
<?php echo $this->Form->create($managerInfo,['url' => ['action' => 'update_manager']]);?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="formGroupExampleInput">Select Profile Type </label>
                        <?php    
                        $type = ['Owner'=>'Owner','Manager'=>'Manager'];
                        echo $this->Form->select('type',$type,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label><strong>Profile Details</strong>_____________________________________________________________________________________</label>
                    </div>                     
                </div>
                <div class="row">
                    <!-- <div class="form-group col-lg-6">    
                         <label>Company Name</label>    
                         <input type="text" class="form-control" name="company_name">                           
                     </div>
                    -->
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
                        <label>Email</label>                           
                        <?php echo $this->Form->input('email', ['label'=>false,'class' => 'form-control','required']);?>                                                       
                    </div>
                </div> 
                <br>
                <div class="row">
                    <div class="col-lg-4"> 
                        <label>Address</label>                        
                        <?php echo $this->Form->input('address', ['label'=>false,'class' => 'form-control','required']);?>
                    </div>
                    <div class="col-lg-3">    
                        <label>City</label>                           
                        <?php echo $this->Form->input('city', ['label'=>false,'class' => 'form-control','required']);?>
                    </div>
                    <div class="col-lg-3">    
                        <label>Province</label>                           
                    <?php                       
                    echo $this->Form->select('province_id',$province,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                    ?>                                                        
                    </div>
                    <div class="col-lg-2">    
                        <label>Area Code</label>                             
                        <?php echo $this->Form->input('area_code', ['label'=>false,'class' => 'form-control']);?>
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
                        <?php echo $this->Form->input('phone2', ['label'=>false,'class' => 'form-control']);?>
                    </div>
                </div>                 
                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>              
            </div>
            </form>        
        </div>
    </div>
