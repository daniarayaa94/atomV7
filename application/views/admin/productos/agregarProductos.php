<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agregar Productos

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">

                    <!--header-->
                    <div class="box-header">
                        <h3 class="box-title">Datos del producto</h3>
                        <!-- tools box -->
                        <!-- /. tools -->
                    </div>
                    <!--fin header-->
                    <form action="guardar" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inputNombre" id="inputNombre" placeholder="Nombre del producto" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputMarca" class="col-sm-2 control-label">Marca</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inputMarca" id="inputMarca" placeholder="Marca" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputDescripcion" class="col-sm-2 control-label">Descripcion</label>

                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="inputDescripcion" id="inputDescripcion" placeholder="Descripcion" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputStock" class="col-sm-2 control-label">Stock</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="inputStock" id="inputStock" placeholder="Stock" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputShortName" class="col-sm-2 control-label">ShortName</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inputShortName" id="inputShortName" placeholder="ShortName" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Categoria</label>

                                <div class="col-sm-10">
                                    <select name="inputCategoria" class="form-control" >
                                        <?php foreach ($categorias_list as $row){ ?>
                                            <option value="<?php echo $row['idCategoria'] ?>"><?php echo $row['nombre'] ?></option>
                                        <?php }?>

                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-info pull-right">Guardar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>

                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->