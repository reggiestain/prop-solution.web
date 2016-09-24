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
use Cake\I18n\Time;
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

                    <div class="row">
                        
                        
                    </div>             
                </div>                    
    <script>
        $(document).ready(function () {
            $("#donate").click(function () {
                $.ajax({
                    url: "<?php echo \Cake\Routing\Router::Url('/users/acc_check');?>",
                    type: "POST",
                    success: function (data, textStatus, jqXHR)
                    {
                        $(".acc-info").html(data);
                        //window.setTimeout(function(){location.reload()},3000);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //window.setTimeout(function(){location.reload()},3000); 
                    }
                });
                $("#DModal").modal();
            });
            $("#donate-form").submit(function (event) {
                event.preventDefault();
                $('#DModal').modal('toggle');
                var formData = $("#donate-form").serialize();
                var url = $("#donate-form").attr("action");
                if ($("#chose").val().length > 0 && $("#own").val().length > 0) {
                    alert('Please choose an amount OR enter own amount.');
                } else {

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: formData,
                        success: function (data, textStatus, jqXHR)
                        {
                            $(".e-message").html(data);
                            window.setTimeout(function () {
                                location.reload()
                            }, 3000);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            window.setTimeout(function () {
                                location.reload()
                            }, 3000);
                        }
                    });
                }
            });

            $("#receive").click(function () {
                $("#RModal").modal();
            });

            $(document).on("click", ".attachment", function () {
                var id = $(this).attr('id');
                $('input[name="request_id"]').val(id);
                $("#attach-Modal").modal();
            });

            $(document).on("click", ".bank-d", function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "<?php echo \Cake\Routing\Router::Url('/users/bank_details/');?>" + id,
                    type: "POST",
                    asyn: true,
                    //data: formData,
                    success: function (data, textStatus, jqXHR)
                    {
                        $("#bank-details").html(data);
                        $("#bank-Modal").modal();


                    }

                });
            });

            $("#receive-form").submit(function (event) {
                event.preventDefault();
                $('#RModal').modal('toggle');
                var formData = $("#receive-form").serialize();
                var url = $("#receive-form").attr("action");

                $.ajax({
                    url: url,
                    type: "POST",
                    asyn: true,
                    data: formData,
                    success: function (data, textStatus, jqXHR)
                    {
                        $(".e-message").html(data);
                        //window.setTimeout(function () {
                            //location.reload()
                        //}, 3000);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //window.setTimeout(function () {
                            //location.reload()
                        //}, 3000);
                    }
                });
            });
            $("#R-empty").click(function () {
                $("#EMP-Modal").modal();
            });

            $("#view").change(function () {
                var v = $(this).val();
                $(document).on({
                    ajaxStart: function () {
                        $(".lmodal").show();
                    },
                    ajaxStop: function () {
                        $(".lmodal").hide();
                    }
                });
                $.ajax({
                    url: "<?php echo \Cake\Routing\Router::Url('/users/view_request/');?>" + v,
                    type: "POST",
                    //data: formData,
                    success: function (data, textStatus, jqXHR)
                    {
                        $("#r-table").html(data);
                        // window.setTimeout(function(){location.reload()},3000);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //window.setTimeout(function(){location.reload()},3000); 
                    }
                });
            });
            //var y = $('#example').DataTable();
        });
    </script>
