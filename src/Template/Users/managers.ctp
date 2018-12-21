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
                    <div class="text-muted bootstrap-admin-box-title">Owner / Manager <a class="btn btn-sm btn-success pull-right" id="add-prop"><i class="fa fa-pencil"></i> New</a></div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profiles as $Profile) :?>    
                            <tr>
                                <td><?php echo $Profile->firstname;?></td>
                                <td><?php echo $Profile->surname;?></td>
                                <td><?php echo $Profile->phone1;?></td>
                                <td><?php echo $Profile->email;?></td>
                                <td><?php echo $Profile->type;?></td>
                                <td><?php echo $Profile->created;?></td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-primary view" data="<?php echo $Profile->id;?>">View</a>    
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
                <h4 class="modal-title" id="myModalLabel">Add Owner / Manager</h4>
            </div>
            <!--<form id="add-unit" action="<?php //echo \Cake\Routing\Router::Url('/users/signup');?>">-->
            <?php echo $this->Form->create($profile,['url' => ['action' => 'add_profile']]);?>
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
                        <input type="text" class="form-control" name="firstname" required>                                                                            
                    </div>
                    <div class="col-lg-4">    
                        <label>Surname</label>                           
                        <input type="text" class="form-control" name="surname" required>                                                                                
                    </div>
                    <div class="col-lg-4">    
                        <label>Email</label>                           
                        <input type="email" class="form-control" name="email" required>                                                        
                    </div>
                </div> 
                <br>
                <div class="row">
                    <div class="col-lg-4"> 
                        <label>Address</label>                       
                        <input type="text" class="form-control" name="address" required>                                                                            
                    </div>
                    <div class="col-lg-3">    
                        <label>City</label>                           
                        <input type="text" class="form-control" name="city" required>                                                                                
                    </div>
                    <div class="col-lg-3">    
                        <label>Province</label>                           
                    <?php                       
                    echo $this->Form->select('province_id',$province,['empty'=>'--Chose One--','class'=>'form-control','required']);    
                    ?>                                                        
                    </div>
                    <div class="col-lg-2">    
                        <label>Area Code</label>                           
                        <input type="text" class="form-control" name="area_code">                                                        
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
    <!--View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Manager Information</h4>
            </div>
            <div class="managerInfo">

            </div>            
            </form>        
        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
            $('#date01').datepicker();
            $('#date02').datepicker();

            $("#add-prop").click(function () {
                $("#propModal").modal();
            });

            $(".view").click(function () {
                var id = $(this).attr('data');
                $("#viewModal").modal();
                $.ajax({
                    url: "<?php echo \Cake\Routing\Router::Url('/users/edit_manager/');?>" + id,
                    type: "POST",
                    asyn: true,
                    beforeSend: function () {
                        $(".managerInfo").html('<p>loading.......</p>');
                    },
                    success: function (data, textStatus, jqXHR)
                    {
                        $(".managerInfo").html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {

                    }
                });
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

