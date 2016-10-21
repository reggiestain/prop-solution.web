<?php
;
//use Cake\Routing\Router;
?>
<style>
    .btn-default{
        margin-bottom: 5px;
    }   
</style>

    <ul class="nav nav-pills">
        
    <a href="<?php echo \Cake\Routing\Router::Url('/users/complaints');?>" class="btn btn-default btn-md">
    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Complaints
    </a>
        
    <a href="<?php echo \Cake\Routing\Router::Url('/users/properties');?>" class="btn btn-default btn-md">
    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Properties
    </a>
    
    <a href="<?php echo \Cake\Routing\Router::Url('/users/tenants');?>" class="btn btn-default btn-md">
    <span class="fa fa-users" aria-hidden="true"></span> Tenants
    </a> 
        
    <a href="<?php echo \Cake\Routing\Router::Url('/users/managers');?>" class="btn btn-default btn-md">
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Owner / Manager
    </a>  
        
    <a href="<?php echo \Cake\Routing\Router::Url('/users/vendors');?>" class="btn btn-default btn-md">
    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Vendors
    </a>    
        
    <a href="<?php echo \Cake\Routing\Router::Url('/users/ledger');?>" class="btn btn-default btn-md">
    <span class="fa fa-money" aria-hidden="true"></span> General Ledger
    </a>     
    </ul>

