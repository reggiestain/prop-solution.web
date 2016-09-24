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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title;?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <!-- Bootstrap -->
        <?php echo $this->Html->css('index/bootstrap.min.css') ;?>
        <?php echo $this->Html->css('font-awesome.min.css') ;?>
        <?php //echo $this->Html->css('cake-style.css') ;?>   
        <?php echo $this->Html->css('index/animate.css') ;?>  
        <?php echo $this->Html->css('index/prettyPhoto.css') ;?>
        <?php echo $this->Html->css('index/style.css') ;?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php echo $this->Html->script('jquery-2.1.1.min');?>
    </head>
    <body>    
    <?php echo $this->fetch('content');?>
    <?php echo $this->Html->script(array( 
                                   'bootstrap.min',
                                   'jquery.prettyPhoto',
                                   'jquery.isotope.min.',
                                   'wow.min',                                   
                                   'functions'                                   
                                  ));?> 
    </body>
</html>