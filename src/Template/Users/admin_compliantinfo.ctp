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
<style>
    .detailBox {
        width:320px;
        border:1px solid #bbb;
        margin:50px;
    }
    .titleBox {
        background-color:#fdfdfd;
        padding:10px;
    }
    .titleBox label{
        color:#444;
        margin:0;
        display:inline-block;
    }

    .commentBox {
        padding:10px;
        border-top:1px dotted #bbb;
    }
    .commentBox .form-group:first-child, .actionBox .form-group:first-child {
        width:80%;
    }
    .commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
        width:18%;
    }
    .actionBox .form-group * {
        width:100%;
    }
    .taskDescription {
        margin-top:10px 0;
    }
    .commentList {
        padding:0;
        list-style:none;
        max-height:200px;
        overflow:auto;
    }
    .commentList li {
        margin:0;
        margin-top:10px;
    }
    .commentList li > div {
        display:table-cell;
    }
    .commenterImage {
        width:30px;
        margin-right:5px;
        height:100%;
        float:left;
    }
    .commenterImage img {
        width:100%;
        border-radius:50%;
    }
    .commentText p {
        margin:0;
    }
    .sub-text {
        color:#aaa;
        font-family:verdana;
        font-size:11px;
    }
    .actionBox {
        border-top:1px dotted #bbb;
        padding:10px;
    }    
</style>

<div class="row">
    <div class="col-lg-12">
    <div class="panel panel-default">
    <div class="panel-heading">
        <strong><?php echo $CompInfo->complaint_type;?></strong> <span class="text-muted"><?php echo $CompInfo->created;?></span> <span class="pull-right"><strong>Vendor: </strong><?php echo $CompInfo->vendor->reg_name;?></span>
    <?php 
     if($CompInfo->status === 'Pending'){
       echo "<span class='btn btn-warning btn-xs' style='margin-left:20px'>".$CompInfo->status."</span>";
     }
     if($CompInfo->status === 'Inprogress'){
       echo "<span class='btn btn-primary btn-xs' style='margin-left:20px'>".$CompInfo->status."</span>";
     }
     if($CompInfo->status === 'Completed'){
       echo "<span class='btn btn-success btn-xs' style='margin-left:20px'>".$CompInfo->status."</span>";
     }
    ?>
            </div>
            <div class="panel-body">
<?php echo $CompInfo->complaint;?>
            </div><!-- /panel-body -->
        </div><!-- /panel panel-default -->
    </div><!-- /col-sm-5 -->
</div><!-- /row -->
<div class="col-lg-12">
    <div class="titleBox">
        <label>Complaint Replies</label>
       <!-- <button type="button" class="close" aria-hidden="true">&times;</button>-->
    </div>
    <!--<div class="commentBox">
        <p class="taskDescription"></p>
    </div>-->
    <div class="actionBox">
        <ul class="commentList">
            <?php foreach ($CompInfo->complaint_comments as $value):?>               
            <li>
                <div class="commenterImage">                
                <?php 
                if($value->tenant_id == NULL){
                   echo $this->Html->image('admin.png');
                }else{
                   echo $this->Html->image('tenant.jpg');  
                }
                ?>
                </div>
                <div class="commentText">
                    <p class=""><?php echo $value->comment;?>  <?php if($value->status == 'Inprogress'){echo '<span style="margin-left:50px"class="btn btn-primary btn-xs">';}else{echo '<span style="margin-left:50px"class="btn btn-success btn-xs">';}?><?php echo $value->status;?></span></p><span class="date sub-text"><?php echo $value->created;?></span>

                </div>
            </li> 
            <?php endforeach;?>
        </ul>
        <!--<form class="form-inline" role="form">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Your comments" />
            </div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>-->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <!--<button type="submit" class="btn btn-success">Submit</button>-->
</div>  