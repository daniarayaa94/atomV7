<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bandeja de entrada
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-md-2">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Folders</h3>
                        </div>
                        <div class="box-body no-padding" style="display: block;">
                            <ul class="nav nav-pills nav-stacked">
                                <li  <?php if($this->uri->segment(3) == ''){echo 'class=" active"';}?>><a href="<?php echo base_url();?>admin/mailbox"><i class="fa fa-inbox"></i> Inbox </a></li>
                                <li <?php if($this->uri->segment(3) == 'enviados'){echo 'class=" active"';}?>><a href="<?php echo base_url();?>admin/mailbox/enviados"><i class="fa fa-envelope-o"></i> Sent</a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>
                <div class="col-md-10">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>

                        <div class="box-tools pull-right">

                            <div class="btn-group">
                                <a href="<?php echo base_url();?>admin/mailbox/refresh" class="btn btn-success" id="refresh" data-toggle="tooltip" title="" data-original-title="Actualizar">
                                    <i id="spin" class="fa fa-refresh"></i></a>

                                <script>

                                    $( "#refresh" ).on( "click", function() {
                                        $( "#spin" ).addClass( "fa-spin" );
                                    });

                                </script>
                            </div>

                            <div class="btn-group">
                                <a href="<?php echo base_url();?>admin/mailbox/readMail" class="btn btn-primary"  data-toggle="tooltip" title="" data-original-title="Actualizar">
                                    <i class="fa fa-envelope"></i></a>
                            </div>



                        </div>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Nombre Remitente</th>
                                    <th>Asunto</th>
                                    <th>Fecha</th>

                                </tr>
                                </thead>

                                <tbody>

                                <?php if (sizeof($email) == 0){ ?>
                                    <td class="text-center" colspan="4">Sin registros.</td>
                                <?php }else {
                                    foreach ($email as $row){ ?>
                                        <tr >
                                            <td class="mailbox-name"><a href="mailbox/readMail/<?php echo $row['idMail'] ?>"><?php echo $row['remitente'] ?></a></td>
                                            <td class="mailbox-subject"><?php echo $row['asunto'] ?></td>
                                            <td class="mailbox-date"><?php echo $row['fecha'] ?></td>
                                        </tr>

                                    <?php }
                                }?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">
                            <!--
                            <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>

                            <div class="pull-right">
                                1-50/200
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div>

                            </div>-->
                        </div>
                    </div>
                </div><!-- /. box -->
                </div><!-- /.col -->


            </div>
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


