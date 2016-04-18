<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Read Mail
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">

                <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Mail</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3><?php echo $mail->asunto;?></h3>
                            <h5>De: <?php echo $mail->remitente;?> <span class="mailbox-read-time pull-right"><?php echo $mail->fecha;?></span></h5>
                        </div><!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">
                            <div class="btn-group">
                                <a href="<?php echo base_url();?>admin/mailbox/envelope/<?php echo $mail->idMail;?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Responder"><i class="fa fa-reply"></i></a>
                            </div><!-- /.btn-group -->
                        </div><!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <?php echo html_entity_decode($mail->mensaje);?>
                        </div><!-- /.mailbox-read-message -->
                    </div><!-- /.box-body -->
                </div><!-- /. box -->
            </div><!-- /.col -->

            </div>

        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->