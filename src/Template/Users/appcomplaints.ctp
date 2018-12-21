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
<?php foreach ($compliants as $compliant) {?>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
    <strong><?php echo $compliant->complaint_type;?></strong> <span class="text-muted"><?php echo $compliant->created;?></span>
    <?php if($compliant->status === 'Pending'){
        echo "<span class='btn btn-warning btn-xs' style='margin-left:20px'>".$compliant->status."</span>";
    }
    ?>
</div>
<div class="panel-body">
<?php echo $compliant->complaint;?>
</div><!-- /panel-body -->
<div class="panel-footer">
<a id="st" class="fa fa-check" data="<?php echo $compliant->id;?>" tenant="<?php echo $compliant->tenant_id;?>"> Approve</a>
<a id="st" class="fa fa-reply" data="<?php echo $compliant->id;?>" tenant="<?php echo $compliant->tenant_id;?>"> Reply</a>
<a id="st" class="fa fa-eye" data="<?php echo $compliant->id;?>" tenant="<?php echo $compliant->tenant_id;?>"> View</a>    
</div>
</div><!-- /panel panel-default -->
</div><!-- /col-sm-5 -->
</div><!-- /row -->

<?php }?>
