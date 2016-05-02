<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Nuevo Correo
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div>
                    <form action="<?php echo base_url();?>admin/mailbox/enviar" method="POST" enctype="multipart/form-data" >
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Nuevo correo</h3>
                                <div class="box-tools pull-right">

                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success"  data-toggle="tooltip" title="" data-original-title="Enviar">
                                            <i class="fa fa-send-o"></i></button>
                                    </div>
                                </div>
                            </div><!-- /.box-header -->

                            <div class="box-body no-padding">

                            <div class="mailbox-read-info">
                                <div class="form-group">
                                    <input class="form-control" id="inputPara" placeholder="Para:" value="<?php if ($mail){echo $mail->remitente;} ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="inpurAsunto" placeholder="Asunto:">
                                </div>
                            </div><!-- /.mailbox-read-info -->

                            <div class="mailbox-read-message">

                                <div class="form-group">
                                    <textarea id="editor1" name="editor1" rows="20" cols="80"></textarea>
                                </div>

                                    <script>
                                        $(function () {
                                            CKEDITOR.replace('editor1');
                                        });
                                    </script>

                                <div class="form-group">
                                    <input  name="upload[]"  multiple="multiple" class="file" type="file" >
                                </div>

                            </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                        </div><!-- /. box -->
                    </form>
                </div><!-- /.col -->
            </div>

        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->