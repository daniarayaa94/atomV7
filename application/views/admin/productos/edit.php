<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Productos
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
                    <!--<form action="<?php //echo base_url();?>admin/productos/guardar" method="post" class="form-horizontal" enctype="multipart/form-data">-->



                    <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'formProductos','enctype' => 'multipart/form-data');
                    echo form_open(base_url().'admin/productos/editar/'.$idProducto,$attributes);
                    ?>


                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputNombre" value="<?php echo set_value('inputNombre',$producto->nombre); ?>" id="inputNombre" placeholder="Nombre del producto">
                                <?php echo form_error('inputNombre', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputCodigo" class="col-sm-2 control-label">Codigo</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputCodigo" value="<?php echo set_value('inputCodigo',$producto->codigo); ?>" id="inputCodigo" placeholder="Codigo del producto">
                                <?php echo form_error('inputCodigo', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputMarca" class="col-sm-2 control-label">Marca</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputMarca" value="<?php echo set_value('inputMarca',$producto->marca); ?>" id="inputMarca" placeholder="Marca">
                                <?php echo form_error('inputMarca', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescripcion" class="col-sm-2 control-label">Descripcion</label>

                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="inputDescripcion" rows="10" id="inputDescripcion" placeholder="Descripcion"><?php echo set_value('inputDescripcion',$producto->descripcion); ?></textarea>
                                <?php echo form_error('inputDescripcion', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputStock" class="col-sm-2 control-label">Stock</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="inputStock" value="<?php echo set_value('inputStock',$producto->stock); ?>" id="inputStock" placeholder="Stock">
                                <?php echo form_error('inputStock', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputShortName" class="col-sm-2 control-label">ShortName</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputShortName" id="inputShortName" value="<?php echo set_value('inputShortName',$producto->shortname); ?>" placeholder="ShortName">
                                <?php echo form_error('inputShortName', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Categoria</label>

                            <div class="col-sm-10">
                                <select name="inputCategoria" class="form-control" >
                                    <?php foreach ($categorias_list as $row){ ?>
                                        <option value="<?php echo $row['idCategoria'] ?>"  <?php if($row['idCategoria'] == $producto->idCategoria){ echo 'selected';} ?> ><?php echo $row['nombre'] ?></option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="inputPrecio" class="col-sm-2 control-label">Precio Costo</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" name="inputPrecioCompra" id="inputPrecioCompra" value="<?php echo set_value('inputPrecioCompra',$precioCompra->valor); ?>" placeholder="Precio Costo">
                                <?php echo form_error('inputPrecioCompra', '<div class="error">', '</div>'); ?>
                            </div>

                            <div class="col-sm-5">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="inputIva" id="inputIva" value="1" <?php if ($precioVenta->conIva == null) {
                                            echo set_checkbox('inputIva', 1);
                                        }else{
                                            if ($precioVenta->conIva == 1) {
                                                echo 'checked="checked"';
                                            }
                                        } ?>  > Iva incluido
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPrecio" class="col-sm-2 control-label">Precio Venta</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" name="inputPrecioVenta" id="inputPrecioVenta" value="<?php echo set_value('inputPrecioVenta',$precioVenta->valor); ?>" placeholder="Precio Venta">
                                <?php echo form_error('inputPrecioVenta', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>



                        <!-- ##############   CHECKBOX PROMOCION   ################-->
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="inputPromocion" value="1" id="inputPromocion" <?php
                                        if ($precioVenta->esPromocion == null) {
                                            echo set_checkbox('inputPromocion', 1);
                                        }else{
                                            if ($precioVenta->esPromocion == 1) {
                                                echo 'checked="checked"';
                                            }
                                        }?>
                                        > Promocion
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="fechas"
                            <?php
                            if ($precioVenta->esPromocion == null) {
                                if (set_checkbox('inputPromocion', 1) == '') {
                                    echo 'hidden';
                                }
                            }else{
                                if ($precioVenta->esPromocion == 0) {
                                    echo 'hidden';
                                }
                            }?>

                        >
                            <div class="form-group" >
                                <label for="inputDesde" class="col-sm-2 control-label">Desde</label>

                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="inputDesde" value="<?php echo set_value('inputDesde',$precioVenta->fechaDesde); ?>" id="inputDesde">
                                    <?php echo form_error('inputDesde', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputHasta" class="col-sm-2 control-label">Hasta</label>

                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="inputHasta" value="<?php echo set_value('inputHasta',$precioVenta->fechaHasta); ?>" id="inputHasta">
                                    <?php echo form_error('inputHasta', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPrecioPromocion" class="col-sm-2 control-label">Precio Promocion</label>

                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="inputPrecioPromocion" id="inputPrecioPromocion" value="<?php echo set_value('inputPrecioPromocion',$precioPromocion); ?>" placeholder="Precio Promocion">
                                    <?php echo form_error('inputPrecioPromocion', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- ##############  FIN CHECKBOX PROMOCION   ################-->


                        <div class="form-group">

                            <label class="col-sm-2 control-label">Imagenes</label>

                            <div class="col-sm-10">
                                <input  name="upload[]"  multiple="multiple" id="upload" value="<?php echo set_value('upload');?>" class="file" type="file" accept="image/*">
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            
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
<script>

    $(document).ready(function(){

        $("#inputPromocion").change(function() {

            if($("#fechas").is(":visible")) {
                $("#fechas").hide();
            }else{
                $("#fechas").show();
            }
        });

        var imagenesGuardadas = "<?php echo $imagenes?>";
        
        $(".file-input").removeClass("file-input-new");
        
        $(".file-preview-thumbnails").html(imagenesGuardadas);
        
    });

    $( "#inputPrecioCompra" ).keyup(function() {
        $('#inputPrecioVenta').val(Math.floor(($("#inputPrecioCompra").val() * (100 + <?php echo $ganancia; ?>)) / 100));
    });

</script>

