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
                    <div class="text-muted bootstrap-admin-box-title">Properties <a class="btn btn-xs btn-success pull-right" id="add-prop"><i class="fa fa-pencil"></i> New</a></div>
                </div>
                <div class="bootstrap-admin-panel-content table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>schedule Rent</th>
                                <th>Purchase Amount</th>
                                <th>Loan Amount</th>
                                <th>Monthly Payment</th>
                                <th>Owner / Manager</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($props as $Profile) :?>    
                            <tr>
                            <td><?php echo '<a href="#">'.$Profile->address.'</a>';?></td>
                            <td><?php echo 'R '.number_format($Profile->schedule_rent, 2, '.', '');?></td>
                            <td><?php echo 'R '.number_format($Profile->current_value, 2, '.', '');?></td>
                            <td><?php echo 'R '.number_format($Profile->purchase_price, 2, '.', '');?></td>
                            <td><?php echo 'R '.number_format($Profile->monthly_payment, 2, '.', '');?></td>
                            <td><?php echo $Profile->manager->full_name;?></td>
                            <td><?php echo $Profile->created;?></td>
                            <td>
                                <a href="#" class="btn btn-xs btn-primary">View</a>
                                <a href="<?php echo \Cake\Routing\Router::Url('/users/compliants');?>" class="btn btn-xs btn-warning">Compliants</a>
                                <!--<a href="#" class="btn btn-xs btn-danger">Delete</a>-->
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
                <h4 class="modal-title" id="myModalLabel">Add Property</h4>
            </div>
            <!--<form id="add-unit" action="<?php //echo \Cake\Routing\Router::Url('/users/signup');?>">-->
                <?php echo $this->Form->create($prop,['url' => ['action' => 'add_prop']]);?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="form-group col-lg-4">
                        <input type="hidden" name="user_id" value="<?php echo $userId;?>">
                        <label for="formGroupExampleInput">Address </label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="address" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="formGroupExampleInput2">City</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" name="city" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="formGroupExampleInput">Province </label>
                        <?php                       
                        echo $this->Form->select('province_id',$province,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="formGroupExampleInput2">Area Code</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" name="area_code" required>
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
                            <input type="text" class="form-control" name="purchase_price"> 
                            <span class="input-group-addon">.00</span>
                        </div> 
                    </div>
                    <div class="col-lg-4">    
                        <label>Purchase Date</label>   
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>    
                            <input id="date02" class="form-control datepicker" name="purchase_date" type="text">                                                            
                        </div>
                    </div>
                    <div class="col-lg-4">    
                        <label>Current Value</label>    
                        <div class="input-group">
                            <span class="input-group-addon">R</span>
                            <input type="number" min="0" max="1000000000" class="form-control" name="current_value">
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
                            <input type="text" class="form-control" name="lender_name"> 
                        </div> 
                    </div>
                    <div class="col-lg-3">    
                        <label>Current Balance</label>   
                        <div class="input-group">
                            <span class="input-group-addon">R</span>
                            <input type="number" min="0" max="1000000000" class="form-control" name="current_balance">
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="col-lg-3">    
                        <label>Monthly Payment</label>    
                        <div class="input-group">
                            <span class="input-group-addon">R</span>
                            <input type="number" min="1" max="1000000000" class="form-control" name="monthly_payment">
                            <span class="input-group-addon">.00</span>
                        </div> 
                    </div>
                    <div class="col-lg-3">    
                        <label>Interest Rate</label>    
                        <div class="input-group">                            
                            <input type="number" min="0" max="1000000000" class="form-control" name="interest_rate">
                        </div> 
                    </div>
                </div> 
                <br>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label><strong>Owner / Manager</strong> ________________________</label>
                    </div>  
                    <div class="form-group col-lg-6">
                        <label><strong>General Ledger</strong> _________________________</label>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-lg-6">    
                        <div class="input-group">
                                <?php
                                echo $this->Form->select('profile_id',$profile,['empty'=>'--Choose One--','class'=>'form-control','required']);    
                                ?>   
                        </div>
                    </div>   
                    <div class="col-lg-6">    
                        <div class="input-group">
                                <?php
                                echo $this->Form->select('ledger_id',$ledger,['empty'=>'--Choose One--','class'=>'form-control']);    
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
                            <input type="number" min="0" max="1000000000" class="form-control" name="flat_fee">
                            <span class="input-group-addon">.00</span>
                        </div> 
                    </div>
                    <div class="col-lg-4">    
                        <label>Schedule Rent</label>    
                        <div class="input-group">
                            <span class="input-group-addon">R</span>
                            <input type="number" min="0" max="1000000000" class="form-control" name="schedule_rent">
                            <span class="input-group-addon">.00</span>
                        </div> 
                    </div>
                    <div class="col-lg-4">    
                        <label> Start Date</label>    
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input id="date01" class="form-control datepicker" name="start_date" type="text">
                        </div>
                    </div> 
                </div>

                <br>
                <!-- <div class="row">
                     <div class="form-group col-lg-12">
                         <label><strong>Files and Attachment</strong> _____________________________________________________</label>
                     </div>  
                 </div>
                 <br><br>
                 <div class="col-lg-12">
                     
                     <label class="control-label"><a href="#" class="s-file">Select File</a></label>
                     <div class="file-div" style="display:none">
                     <br>
                     <input id="input-44" name="input44[]" type="file" multiple class="file-loading">
                     <div id="errorBlock" class="help-block"></div>
                     </div>
                 </div>
                 <br><br> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>              
            </div>
            </form>        
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#date01').datepicker();
            $('#date02').datepicker();

            $("#add-prop").click(function () {
                $("#propModal").modal();
            });

            $("#add-uni").on("submit", function (event) {
                event.preventDefault();
                var name = $("input[name=address]").val();
                $("#input-44").fileinput("upload");

            });

            $(".s-file").on("click", function () {
                $(".file-div").toggle();
                $("#input-44").fileinput({
                    uploadUrl: '<?php echo \Cake\Routing\Router::Url('/users/add_prop');?>',
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

