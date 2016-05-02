<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cotizaciones

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="col-xs-4">

                    <div class="box">

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Solicitadas</h3>


                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">

                                    <?php if (sizeof($cotizaciones_list) == 0){ ?>
                                        <li><a style="cursor: pointer;" >Sin Resultados</a></li>
                                    <?php }else {

                                        foreach ($cotizaciones_list as $row){ ?>
                                            <li id="<?php echo $row['idCotizacion'];?>"><a style="cursor: pointer;"><?php echo "<b>".ucfirst(strtolower($row['nombre']))."</b>"; ?> ha solicitado una cotizacion. </a></li>
                                        <?php }
                                    }?>


                                </ul>

                                <div class="col-sm-12">
                                    <div id="pagination" class="pull-right"> <?php echo $links; ?> </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>


                    </div><!-- /.box -->


                </div><!-- /.col -->

                <div class="col-xs-8">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">Detalles de cotizacion</h3>
                        </div>

                        <div class="box-body no-padding">

                            <div style="height: 300px;text-align: center;vertical-align: middle;line-height: 300px;" id="seleccione">
                                <span>Seleccione una cotizacion en el menu izquierdo.</span>
                            </div>
                            
                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div><!-- /.col -->

            </div>
        </div><!-- /.row -->
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function(){

        $('.nav-stacked > li > a').click(function() {
            $('.nav-stacked > li').removeClass();
            $(this).parent().addClass('active');

            var id = $(this).parent().prop('id') ;

            $.ajax({
                url: '<?php echo $url_ajax?>',
                type: 'post',
                dataType: 'json',
                data: { idCotizacion: $(this).parent().prop('id') },
                success: function (data) {

                    $('#seleccione').html(data.detalle);
                    $('#seleccione').attr('style', '');

                    $("#download").attr("href", "<?php echo $descargar_excel;?>?id=" + id);
                    $("#idCot").attr("value", id);

                    $("#send").attr("action", "<?php echo $email_send;?>");

                    CKEDITOR.replace('editor1');

                    $("#send").submit( function() {
                        var messageLength = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '').trim().length;
                        if( !messageLength ) {
                            alert('Debes ingresar un mensaje antes de enviar el correo.');
                            return false;
                        }else{
                            waitingDialog.show();
                        }
                    });

                }
            });


        });

        $('body').addClass('sidebar-collapse');

    });


</script>

<script>

    var waitingDialog = waitingDialog || (function ($) {
            'use strict';

            // Creating modal dialog's DOM
            var $dialog = $(
                '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
                '<div class="modal-dialog modal-m">' +
                '<div class="modal-content">' +
                '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                '<div class="modal-body">' +
                '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                '</div>' +
                '</div></div></div>');

            return {
                /**
                 * Opens our dialog
                 * @param message Custom message
                 * @param options Custom options:
                 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
                 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
                 */
                show: function (message, options) {
                    // Assigning defaults
                    if (typeof options === 'undefined') {
                        options = {};
                    }
                    if (typeof message === 'undefined') {
                        message = 'Enviando Cotizacion';
                    }
                    var settings = $.extend({
                        dialogSize: 'm',
                        progressType: '',
                        onHide: null // This callback runs after the dialog was hidden
                    }, options);

                    // Configuring dialog
                    $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                    $dialog.find('.progress-bar').attr('class', 'progress-bar');
                    if (settings.progressType) {
                        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                    }
                    $dialog.find('h3').text(message);
                    // Adding callbacks
                    if (typeof settings.onHide === 'function') {
                        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                            settings.onHide.call($dialog);
                        });
                    }
                    // Opening dialog
                    $dialog.modal();
                },
                /**
                 * Closes dialog
                 */
                hide: function () {
                    $dialog.modal('hide');
                }
            };

        })(jQuery);


</script>
