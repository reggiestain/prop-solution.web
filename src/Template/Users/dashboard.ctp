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
                    <div class="text-muted bootstrap-admin-box-title">Compliants <a class="btn btn-xs btn-success pull-right" id="add-prop"><i class="fa fa-pencil"></i> New</a></div>
                </div>
                <div class="bootstrap-admin-panel-content table-responsive">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Property</th>
                                <th>Compliant</th>
                                <th>Compliant Type</th> 
                                <th>Tenant</th>
                                <!--<th>Priority</th>-->
                                <th>Status</th>                                
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($complaints as $complaint) :?>    
                            <tr>
                                <td><?php echo $complaint->id;?></td>    
                                <td><?php echo '<a href="#">'.$complaint->property->address.'</a>';?></td>
                                <td><?php echo $complaint->complaint;?></td>
                                <td><?php echo $complaint->complaint_type;?></td>
                                <td><?php echo $complaint->tenant->firstname;?></td>
                                <!--<td><?php //echo $complaint->priority;?></td>-->
                                <td>
                                    <?php
                                    if($complaint->status === 'Pending'){
                                    echo '<a class="btn btn-danger btn-xs">'.$complaint->status.'</a>';
                                    }
                                    if($complaint->status === 'Inprogress'){
                                    echo '<a class="btn btn-primary btn-xs">'.$complaint->status.'</a>';
                                    }
                                    if($complaint->status === 'Completed'){
                                    echo '<a class="btn btn-success btn-xs">'.$complaint->status.'</a>';
                                    }
                                    ?>
                                </td>                            
                                <td><?php echo $complaint->created;?></td>
                                <td>
                                    <a href="#" class="btn btn-default btn-xs view" var="<?php echo $complaint->id;?>">View</a>                          
                                    <a href="#" class="btn btn-primary btn-xs reply" comp="<?php echo $complaint->complaint;?>" comptype="<?php echo $complaint->complaint_type;?>" var="<?php echo $complaint->id;?>">Reply</a>
                                    <!--<a href="<?php //echo \Cake\Routing\Router::Url('/users/compliants');?>" class="btn btn-xs btn-warning">Compliants</a>-->
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
<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Complaint Reply</h4>
            </div>
            <!--<form id="add-unit" action="<?php //echo \Cake\Routing\Router::Url('/users/signup');?>">-->
            <?php echo $this->Form->create($compliantReply,['url' => ['action' => 'admincompliant_reply']]);?>
            <div class="modal-body"> 
                <div class="row">
                    <div class="form-group col-lg-12">    
                        <h4 id="com-type"></h4>      
                        <p id="comp"></p>  
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <input type="hidden"  name="type" value="Reply">
                        <input type="hidden" id="com-id" name="complaint_id" value="">
                        <input type="hidden" id="user-id" name="user_id" value="<?php echo $userId;?>">
                        <label>status:</label>                       
                        <?php    
                        $type = ['Inprogress'=>'Inprogress','Completed'=>'Completed'];
                        echo $this->Form->select('status',$type,['empty'=>'--Choose One--','class'=>'form-control','required']);    
                        ?>  
                        <br>
                        <label for="formGroupExampleInput">Vendor:</label>
                        <?php    
                        echo $this->Form->select('vendor_id',$vendor,['empty'=>'--Choose One--','class'=>'form-control']);    
                        ?> 
                        <br>
                        <label for="formGroupExampleInput">Reply:</label>
                        <textarea name="comment" class="form-control"></textarea> 
                        
                    </div>
                </div>
            </div>    
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
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Complaint Info</h4>
            </div>
            <!--<form id="add-unit" action="<?php //echo \Cake\Routing\Router::Url('/users/signup');?>">-->
           <?php //echo $this->Form->create($compliant,['url' => ['action' => 'compliant_reply']]);?>
            <div class="modal-body"> 
                <div id="compliantInfo">
                    
                </div>
                            
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

        $(".reply").click(function () {
            var compId = $(this).attr("var");
            var comptype = $(this).attr("comptype");
            var comp = $(this).attr("comp");
            $("#com-id").val(compId);
            $("#com-type").text(comptype);
            $("#comp").text(comp);
            $("#replyModal").modal();
        });

        $("#add-prop").click(function () {
            var compId = $(this).attr("var");
            $("#viewModal").modal();
            $.ajax({
                url: "<?php echo \Cake\Routing\Router::Url('tenant/phoneID');?>",
                type: "POST",
                asyn: true,
                beforeSend: function () {
                 $("#compliantInfo").html('loading.......');   
                },
                success: function (data){
                 $("#compliantInfo").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown){
                   alert('Please assign a vendor to this complaint.');
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

