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
                    <a href="compose.html" class="btn btn-primary btn-block margin-bottom" style="width: 150px">Compose</a>
                </div><!-- /.col -->
                <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Mail</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>Message Subject Is Placed Here</h3>
                            <h5>From: support@almsaeedstudio.com <span class="mailbox-read-time pull-right">15 Feb. 2015 11:03 PM</span></h5>
                        </div><!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></button>
                            </div><!-- /.btn-group -->
                        </div><!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <form>
                                <textarea id="editor1" name="editor1" rows="10" cols="80">
                                                <?php foreach ($mail as $row) {

                                                    echo html_entity_decode($row['mensaje']);

                                                }?>
                                </textarea>


                                <script>
                                    $(function () {
                                        CKEDITOR.replace('editor1');
                                    });
                                </script>
                            </form>


                        </div><!-- /.mailbox-read-message -->
                    </div><!-- /.box-body -->
                </div><!-- /. box -->
            </div><!-- /.col -->

            </div>

        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->