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
                    <div class="text-muted bootstrap-admin-box-title"><h4><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Vendors <a class="btn btn-sm btn-success pull-right" id="add-prop"><i class="fa fa-pencil"></i> New</a></h4></div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Vendor</th>
                                <th>Contact Person</th>
                                <th>Cell (Contact Person)</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Fax</th>
                                <th>VAT registration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vendors as $vendor) :?>    
                            <tr>
                                <td><?php echo $vendor->trade_name;?></td>
                                <td><?php echo $vendor->contact_name;?></td>
                                <td><a href="#"><?php echo $vendor->cell;?></a></td>
                                <td><a href="#"><?php echo $vendor->tel_no;?></a></td>
                                <td><a href="#"><?php echo $vendor->business_email;?></a></td>
                                <td><?php echo $vendor->business_fax;?></td>
                                <td><?php echo $vendor->vat_no;?></td>
                                <td>
                                    <a href="#" id="vendor-v" data="<?php echo $vendor->id;?>" class="btn btn-xs btn-primary">View</a>    
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel">Vendor Application</h4>
            </div>
            <!--<form id="add-unit" action="<?php //echo \Cake\Routing\Router::Url('/users/signup');?>">-->
            <?php echo $this->Form->create($vendor,['url' => ['action' => 'add_vendor']]);?>
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
                        <input type="text" class="form-control" name="trade_name"> 
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $userID;?>"> 
                    </div>
                    <div class="form-group col-lg-4">    
                        <label>Registered name of business:</label>    
                        <input type="text" class="form-control" name="reg_name">                           
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
                        <input type="text" class="form-control" name="name">                           
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Surname:</label>    
                        <input type="text" class="form-control" name="surname">   
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Contact Person (Cell No):</label>                       
                        <input type="text" class="form-control" name="cell" required>                                                                            
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
                        <input type="text" class="form-control" name="location" required>                                                        
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label>Suburb:</label>                       
                        <input type="text" class="form-control" name="suburb" required>                                                                            
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
                        <input type="text" class="form-control" name="city" required>                                                                                
                    </div>
                    <div class="col-lg-4">    
                        <label>Postal Code:</label>                           
                        <input type="text" class="form-control" name="area_code">                                                        
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
                        <input type="text" class="form-control" name="post_address">                                                        
                    </div>
                    <div class="form-group col-lg-3"> 
                        <label>PO Box / Private Bag:</label>                       
                        <input type="text" class="form-control" name="private_bag">                                                                            
                    </div>                    
                    <div class="form-group col-lg-3">    
                        <label>City / Town:</label>                           
                        <input type="text" class="form-control" name="post_city">                                                       
                    </div>
                    <div class="form-group col-lg-3">    
                        <label>Postal Code:</label>                           
                        <input type="text" class="form-control" name="post_code">                                                       
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-lg-4">    
                        <label>Business telephone number:</label>                           
                        <input type="text" class="form-control" name="tel_no" required>                                                        
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label>Alternative number of business:</label>                       
                        <input type="text" class="form-control" name="alt_tel_no" required>                                                                            
                    </div>                    
                    <div class="form-group col-lg-4">    
                        <label>Business Fax Number:</label>                           
                        <input type="text" class="form-control" name="business_fax" required>                                                       
                    </div>
                </div>  
                <div class="row">
                    <div class="form-group col-lg-4">    
                        <label>Accounting Clerk’s fax number:</label>                           
                        <input type="text" class="form-control" name="clerk_fax" required>                                                        
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label>Business e-mail:</label>                       
                        <input type="text" class="form-control" name="business_email" required>                                                                            
                    </div>                    
                    <div class="form-group col-lg-4">    
                        <label>Tax number of business:</label>                           
                        <input type="text" class="form-control" name="tax_no" required>                                                       
                    </div>
                </div>   
                <div class="row">    
                    <div class="form-group col-lg-4">    
                        <label>VAT registration number:</label>                           
                        <input type="text" class="form-control" name="vat_no" required>                                                       
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
                    <div class="form-group col-lg-4">
                        <label for="formGroupExampleInput">Operational Areas</label><br>
                        <?php    
                        echo $this->Form->select('city_id',$city,['class'=>'form-control','id'=>'city','multiple'=>'multiple','required']);    
                        ?>  
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="formGroupExampleInput">Type of Services</label><br>
                        <?php    
                        echo $this->Form->select('maintenance_id',$maintenance,['class'=>'form-control','id'=>'type','multiple'=>'multiple','required']);    
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
                        <textarea class="form-control" name="references" row="3"></textarea>                                                       
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
                        <textarea class="form-control" name="insolvent"></textarea>                                                       
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
                        <textarea class="form-control" name="speciality"></textarea>                                                       
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
                            <textarea name="incident_details" class="form-control"></textarea>
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
                            <textarea name="conformance_details" class="form-control"></textarea>
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
                        <textarea name="integrity_details" class="form-control"></textarea>
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
            </form>        
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
                <h4 class="modal-title" id="myModalLabel">Edit Vendor Information</h4>
            </div>
            <div class="vendorInfo">

            </div>            
            </form>        
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
        $('#city').multiselect();
        $('#type').multiselect();
        $('#date01').datepicker();
        $('#date02').datepicker();

        $("#vendor-v").click(function () {
            var id = $(this).attr('data');
            //tinyMCE.editors = [];
            $('#editModal').modal('show');
            $.ajax({
                url: "<?php echo \Cake\Routing\Router::Url('/users/edit_vendor/');?>" + id,
                type: "POST",
                asyn: true,
                beforeSend: function () {
                 $(".vendorInfo").html('<p>loading.......</p>');   
                },
                success: function (data, textStatus, jqXHR)
                {
                    $(".vendorInfo").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {

                }
            });
        });

        $("#incident").change(function () {
            var value = $(this).val();
            if (value == 'Yes') {
                $("#incident-d").show();
            } else {
                $("#incident-d").hide();
            }
        });

        $("#add-prop").click(function () {
            $("#propModal").modal();
        });

        $("#non-c").change(function () {
            var value = $(this).val();
            if (value == 'Yes') {
                $("#non-d").show();
            } else {
                $("#non-d").hide();
            }
        });

        $("#integrity").change(function () {
            var value = $(this).val();
            if (value == 'Yes') {
                $("#integrity-d").show();
            } else {
                $("#integrity-d").hide();
            }
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

