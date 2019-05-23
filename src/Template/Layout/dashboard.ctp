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

//$cakeDescription = 'CakePHP: the rapid development php framework';

$cakeDescription = '';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Docs -->
        <!--<link href="http://getbootstrap.com/docs-assets/css/docs.css" rel="stylesheet" media="screen">-->
        <!-- Bootstrap -->
        <?php echo $this->Html->css('bootstrap.min.css');?>
        <?php //echo $this->Html->css('ckeditor.css') ;?>
        <?php echo $this->Html->css('jquery.dataTables.css') ;?>
        <?php echo $this->Html->css('multi-select.css') ;?>
        <?php echo $this->Html->css('bootstrap-theme.min.css');?>
        <?php echo $this->Html->css('font-awesome.min.css');?>
        <?php echo $this->Html->css('cake-style.css') ;?>    
        <?php echo $this->Html->css('bootstrap-switch.css');?> 
                
        <!-- Bootstrap Admin Theme -->
        <?php echo $this->Html->css('bootstrap-admin-theme.css') ;?>
        <?php echo $this->Html->css('bootstrap-admin-theme-change-size.css');?>       
        <?php echo $this->Html->css('datepicker.min.css');?>
        <?php echo $this->Html->css('file.css');?>
        <?php echo $this->Html->css('uniform.default.min.css');?>
        

        <!-- Custom styles -->
        <style type="text/css">
            @font-face {
                font-family: Ubuntu;
                src: url('fonts/Ubuntu-Regular.ttf');
            }
            .bs-docs-masthead{
                background-color: #6f5499;
                background-image: linear-gradient(to bottom, #563d7c 0px, #6f5499 100%);
                background-repeat: repeat-x;
            }
            .bs-docs-masthead{
                padding: 0;
            }
            .bs-docs-masthead h1{
                color: #fff;
                font-size: 40px;
                margin: 0;
                padding: 34px 0;
                text-align: center;
            }
            .bs-docs-masthead a:hover{
                text-decoration: none;
            }
            .meritoo-logo a{
                background-color: #fff;
                border: 1px solid rgba(66, 139, 202, 0.4);
                display: block;
                font-family: Ubuntu;
                padding: 22px 0;
                text-align: center;
            }
            .meritoo-logo a,
            .meritoo-logo a:hover,
            .meritoo-logo a:focus{
                text-decoration: none;
            }
            .meritoo-logo a img{
                display: block;
                margin: 0 auto;
            }
            .meritoo-logo a span{
                color: #4e4b4b;
                font-size: 18px;
            }
            .row-urls{
                margin-top: 4px;
            }
            .row-urls .col-md-6{
                text-align: center;
            }
            .row-urls .col-md-6 a{
                font-size: 14px;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
        <?php echo $this->Html->script('jquery');?>
        <?php //echo $this->Html->script('http://code.jquery.com/jquery-2.0.3.min');?>
        <?php echo $this->Html->script('bootstrap.min');?>   
       
        <?php echo $this->Html->script('bootstrap-switch');?>
        <?php echo $this->Html->script('multi-select');?>
        <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    </head>
    <body class="bootstrap-admin-with-small-navbar">
       <?php echo $this->element('admin-header');?>
        <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">        
       <?php echo $this->element('admin-sidebar');?>  
       <?php echo $this->fetch('content');?>
        </div>
        </div>
        <?php echo $this->element('footer');?>
        <!-- Include JS files --> 
        <?php echo $this->Html->script('twitter-bootstrap-hover-dropdown.min');?>
        <?php echo $this->Html->script('bootstrap-admin-theme-change-size');?>       
        <?php echo $this->Html->script('bootstrap-datepicker.min');?>
        <?php echo $this->Html->script('file');?>
        <?php echo $this->Html->script('jquery.uniform');?>
        
    </body>
</html>
