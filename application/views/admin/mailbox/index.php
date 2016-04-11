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

            <div>
                <a href="compose.html" class="btn btn-primary btn-block margin-bottom" style="width: 150px">Compose</a>
                <a href="mailbox/refresh" class="btn btn-primary btn-block margin-bottom" style="width: 150px">refrescar</a>
            </div><!-- /.col -->
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">

                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>

                                <?php foreach ($email as $row){ ?>
                                    <tr>
                                        <td><?php echo $row['remitente'] ?></td>
                                        <td><?php echo $row['asunto'] ?></td>
                                        <td><?php echo $row['fecha'] ?></td>
                                    </tr>

                                <?php }?>


                                <!-- <?php //echo $email; ?>-->

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