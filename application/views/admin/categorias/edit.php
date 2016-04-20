<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Categorias

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">

                    <!--header-->
                    <div class="box-header">
                        <h3 class="box-title">Datos de la categoria</h3>
                        <!-- tools box -->
                        <!-- /. tools -->
                    </div>
                    <!--fin header-->
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'formCategorias');
                    echo form_open(base_url().'admin/categorias/editar/'.$idCategorias,$attributes);
                    ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inputNombre" id="inputNombre" value="<?php echo set_value('inputNombre',$categoria->nombre); ?>" placeholder="Nombre de la categoria">
                                    <?php echo form_error('inputNombre', '<div class="error">', '</div>'); ?>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputDescripcion" class="col-sm-2 control-label">Descripcion</label>

                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="inputDescripcion" name="inputDescripcion" placeholder="Descripcion" ><?php echo set_value('inputDescripcion',$categoria->descripcion); ?></textarea>
                                    <?php echo form_error('inputDescripcion', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Guardar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>

                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->