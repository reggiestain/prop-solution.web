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
<!-- content -->
<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header bootstrap-admin-content-title">
                                <?php echo $this->element('menus/manage-menu');?>
            </div>
        </div>
    </div>
    <?php 
    echo $this->Flash->render();
    echo $this->Flash->render('auth');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title"> <h4><span class="fa fa-users" aria-hidden="true"></span> Tenants <a class="btn btn-sm btn-success pull-right" id="add-prop"><i class="fa fa-pencil"></i> New</a></h4></div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Property</th>
                                <th>Unit</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Rent Amount</th>                                
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tenants as $tenant) :?>    
                            <tr>
                                <td><?php echo $tenant->firstname;?></td>
                                <td><?php echo $tenant->surname;?></td>
                                <td><?php echo $tenant->property->prop_name;?></td>
                                <td><?php echo $tenant->unit;?></td>
                                <td><?php echo $tenant->phone1;?></td>
                                <td><?php echo $tenant->email;?></td>
                                <td><?php echo 'R'.number_format($tenant->re_amount, 2, '.', '');?></td>
                                <td><?php echo $tenant->created;?></td>
                                <td>
                                    
                                    <a href="#" class="btn btn-xs btn-primary btn-responsive" var="<?php echo $tenant->id;?>">View</a><br>                                    
                                    <a href="<?php echo \Cake\Routing\Router::Url('/users/contract/'.$tenant->id);?>" target="_blank" class="btn btn-xs btn-default btn-responsive" style="margin-top: 2px"><i class="fa fa-download"></i> Contract</a><br>
                                    <a href="#" class="btn btn-xs btn-danger btn-responsive" style="margin-top: 2px">Delete</a>
             
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="propModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Tenant</h4>
            </div>
            <!--<form id="add-unit" action="<?php //echo \Cake\Routing\Router::Url('/users/signup');?>">-->
            <?php echo $this->Form->create($profile,['url' => ['action' => 'add_tenant']]);?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="formGroupExampleInput">Select Property </label>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $UserId;?>"> 
                        <?php    
                        echo $this->Form->select('property_id',$property,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-6">    
                        <label>Unit Name / Number</label>    
                        <input type="text" class="form-control" name="unit">                           
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
                        <input type="text" class="form-control" name="company_name">                           
                    </div>
                    <div class="form-group col-lg-6">    
                        <label>ID / Passport Number</label>    
                        <input type="text" class="form-control" name="ID_number" required>                           
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4"> 
                        <label>First Name</label>                       
                        <input type="text" class="form-control" name="firstname" required>                                                                            
                    </div>
                    <div class="col-lg-4">    
                        <label>Surname</label>                           
                        <input type="text" class="form-control" name="surname" required>                                                                                
                    </div>
                    <div class="col-lg-4">    
                        <label>Date Of Birth</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>    
                            <input id="date02" class="form-control datepicker" name="birthdate" type="text">                                                            
                        </div>                                                       
                    </div>
                </div> 
                <br>                
                <div class="row">
                    <div class="col-lg-4"> 
                        <label>Contact Number 1</label>                       
                        <input type="text" class="form-control" name="phone1" required>                                                                            
                    </div>
                    <div class="col-lg-4">    
                        <label>Contact Number 2</label>                           
                        <input type="text" class="form-control" name="phone2">                                                                                
                    </div>
                    <div class="col-lg-4">    
                        <label>Email</label>                           
                        <input type="email" class="form-control" name="email" required>                                                        
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
                        <textarea type="text" class="form-control" rows="4" name="adress"></textarea>                                                                               
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
                            <input id="date03" class="form-control datepicker" name="lease_start" type="text">                                                            
                        </div>                                                       
                    </div>
                    <div class="col-lg-3">    
                        <label>Lease End</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>    
                            <input id="date04" class="form-control datepicker" name="lease_end" type="text">                                                            
                        </div>                                                       
                    </div>
                    <div class="col-lg-3"> 
                        <label>Deposit</label>                       
                        <div class="input-group">                        
                            <span class="input-group-addon">R</span>    
                            <input type="text" class="form-control" name="deposit"> 
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
                            <input id="curr" type="checkbox" name="recurring_rent" value="Yes" checked>   
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
                        $lease = ['Once'=>'Once','Daily'=>'Daily'];
                        echo $this->Form->select('re_frequency',$lease,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>                                                                            
                    </div>
                    <div class="col-lg-3">    
                        <label>Start Date</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>    
                            <input id="date05" class="form-control datepicker" name="re_start" type="text">                                                            
                        </div>                                                       
                    </div>
                    <div class="col-lg-3">    
                        <label>End Date</label>                           
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>    
                            <input id="date06" class="form-control datepicker" name="re_end" type="text">                                                            
                        </div>                                                       
                    </div>
                    <div class="col-lg-3"> 
                        <label>Rent Amount</label>                       
                        <div class="input-group">                        
                            <span class="input-group-addon">R</span>    
                            <input type="text" class="form-control" name="re_amount"> 
                            <span class="input-group-addon">.00</span>
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
                        $lease = ['Cash'=>'Cash','EFT'=>'EFT','Credit Card'];
                        echo $this->Form->select('frequency',$lease,['empty'=>'--Chose One--','class'=>'form-control','required']);    
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
                        <label class="checkbox-inline"><input type="checkbox" name="pets" value="Yes"><b>No Pets</b></label>
                        <label class="checkbox-inline"><input type="checkbox" name="smoking" value="Yes"><b>No Smoking</b></label>                                                                          
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12"> 
                        <textarea name="restrictions"  id="mytextarea"><b>Enter restriction..</b></textarea>                       

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
                            <input id="date07" class="form-control datepicker" name="move_in_date" type="text">                                                            
                        </div>                                                       
                    </div>
                </div> 
                <br>
                <div class="row">                    
                    <div class="col-lg-12"> 
                        <label>Move-in Conditions / Memo</label>
                        <textarea name="conditions"  id="mytextarea2"><b>Enter condition..</b></textarea>                       

                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>              
            </div>
           <?php echo $this->Form->end();?>        
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Tenant Information</h4>
            </div>
            <div class="tenantInfo">

            </div>            
            </form>        
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('mytextarea');
        CKEDITOR.replace('mytextarea2');
        
        $('#example').DataTable();
        $('#date02').datepicker();
        $('#date03').datepicker();
        $('#date04').datepicker();
        $('#date05').datepicker();
        $('#date06').datepicker();
        $('#date07').datepicker();
        $("#add-prop").click(function () {
            $("#propModal").modal({});
        });

        $("#add-uni").on("submit", function (event) {
            event.preventDefault();
            var name = $("input[name=address]").val();
            $("#input-44").fileinput("upload");

        });

        $(".btn-primary").click(function () {
            var id = $(this).attr('var');
            //tinyMCE.editors=[];
            $('#editModal').modal('show');
            $.ajax({
                url: "<?php echo \Cake\Routing\Router::Url('/users/edit_tenant/');?>" + id,
                type: "POST",
                asyn: true,
                beforeSend: function () {
                 $(".tenantInfo").html('<p>loading.......</p>');   
                },
                success: function (data, textStatus, jqXHR)
                {                    
                    $(".tenantInfo").html(data);                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {

                }
            });
        });

        $(".btn-primary").on("click", function () {
            $(".file-div").toggle();
            $("#input-44").fileinput({
                uploadUrl: '<?php echo \Cake\Routing\Router::Url('/users/edit_tenan');?>',
                showUpload: false,
                uploadAsync: true,
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                maxFilePreviewSize: 10240,
                uploadExtraData: {
                    address: $("input[name=address]").val(),
                    city: $("input[name=city]").val(),
                    province: $("input[name=province]").val(),
                    code: $("input[name=area_code]").val(),
                }
            }).on('filebatchpreupload', function (event, data, id, index) {
                $('#kv-success-1').html('<h4>Upload Status</h4><ul></ul>').hide();
            }).on('fileuploaded', function (event, data, id, index) {
                var fname = data.files[index].name,
                        out = '<li>' + 'Uploaded file # ' + (index + 1) + ' - ' +
                        fname + ' successfully.' + '</li>';
                $('#kv-success-1 ul').append(out);
                $('#kv-success-1').fadeIn('slow');
            });

        });


        $("#reset-form").submit(function (event) {
            event.preventDefault();
            $('#RModal').modal('toggle');
            var formData = $("#reset-form").serialize();
            var url = $("#reset-form").attr("action");
            $.ajax({
                url: "<?php echo \Cake\Routing\Router::Url('/users/reset_pass');?>",
                type: "POST",
                asyn: true,
                data: formData,
                success: function (data, textStatus, jqXHR)
                {
                    $(".e-message").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {

                }
            });
        });
    });
</script>    

