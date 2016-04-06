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
                    <form action="guardar" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                                <label for="inputPrecio" class="col-sm-2 control-label">Precio</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="inputPrecio" id="inputPrecio" placeholder="Precio" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputTipo" class="col-sm-2 control-label">Tipo</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inputTipo" id="inputTipo" placeholder="Ej: Venta o arriendo" required>
                                </div>
                            </div>



                            <!-- ##############   CHECKBOX PROMOCION   ################-->


                            <script>
                                $(document).ready(function(){

                                    $(".checkbox").change(function() {

                                        if($("#fechas").is(":visible")) {
                                            $("#fechas").hide();
                                        }else{
                                            $("#fechas").show();
                                        }
                                    });

                                });
                            </script>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="promocion"> Promocion
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="fechas" hidden>
                                <div class="form-group" >
                                    <label for="inputDesde" class="col-sm-2 control-label">Desde</label>

                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="inputDesde" id="inputDesde">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputHasta" class="col-sm-2 control-label">Hasta</label>

                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="inputHasta" id="inputHasta">
                                    </div>
                                </div>
                            </div>
                            <!-- ##############  FIN CHECKBOX PROMOCION   ################-->

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

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Imagenes</label>

                                <div class="col-sm-10">
                                    <input  name="upload[]"  multiple="multiple" class="file" type="file" accept="image/*">
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Cancelar</button>
                                <button type="submit" class="btn btn-info pull-right">Guardar</button>
                            </div>
                            <!-- /.box-footer -->

                        </div>
                    </form>



                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

