<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Productos

        </h1>

    </section>

    <?php if(!$hasCategorias){ ?>

        <div class="box-advertencia">
            <div class="box box-warning" style="margin-bottom: -20px;">
                <div class="box-header with-border">
                    <h1 class="box-title"><i class="fa fa-warning"></i>  <?php echo $tituloAgregarCategoria;?></h1>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
            </div>
        </div>

    <?php } ?>

    <!-- Main content -->
    <section class="content">

        <div class="well">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label" for="input-name">Nombre</label>
                        <input type="text" name="filter_nombre" value="<?php echo $filter_nombre?>" placeholder="Nombre del producto" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                    </div>

                </div>
                <div class="col-sm-12">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-model">Marca</label>
                        <input type="text" name="filter_marca" value="<?php echo $filter_marca?>" placeholder="Marca" id="input-marca" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-price">Stock</label>
                        <input type="number" name="filter_stock" value="<?php echo $filter_stock?>" placeholder="Stock" id="input-stock" class="form-control">
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-quantity">P. Compra</label>
                        <input type="number" name="filter_compra" value="<?php echo $filter_compra?>" placeholder="P. Compra" id="input-compra" class="form-control">
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-quantity">P. Venta</label>
                        <input type="number" name="filter_venta" value="<?php echo $filter_venta?>" placeholder="P. Venta" id="input-venta" class="form-control">
                    </div>
                </div>
                <div class="col-sm-12">

                    <button type="button" id="btn-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">


                <div class="box">


                    <div class="box-header">
                        <h3 class="box-title">Productos</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                            <a <?php if($hasCategorias){ echo 'href="' .base_url(). 'admin/productos/agregarProducto"';}?>  class="btn btn-success"  data-toggle="tooltip" title="" data-original-title="<?php echo $tituloAgregar;?>"  <?php if(!$hasCategorias){ echo 'disabled';}?>  >
                                        <i class="fa fa-plus"></i></a>

                            <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="confirm('Está seguro que desea eliminar los productos seleccionados') ? $('#form-product').submit() : false;" data-original-title="Borrar producto"><i class="fa fa-trash-o"></i></button>
                        </div>

                        <!-- /. tools -->
                    </div>





                    <form action="<?php echo base_url();?>admin/productos/delete" method="post" enctype="multipart/form-data" id="form-product">

                        <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center"> <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Stock</th>
                                <th>P. Compra</th>
                                <th>P. Venta</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (sizeof($productos_list) == 0){ ?>
                                <td class="text-center" colspan="9">Sin registros.</td>
                            <?php }else {
                                foreach ($productos_list as $row){ ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['idProducto'] ?>"></td>
                                <td class="text-center"><img src="<?php echo base_url()."assets/".explode(";",$row['imagenes'])[0] ?>" alt="<?php echo $row['nombre'] ?>" style="width: 50px;height: 50px;" class="img-thumbnail"></td>
                                <td class="text-left"><?php echo $row['nombre'] ?></td>
                                <td class="text-left"><?php echo $row['marca'] ?></td>
                                <td class="text-left"><?php echo $row['stock'] ?></td>
                                <td class="text-left"><?php echo $row['compra'] ?></td>
                                <td class="text-left"><?php echo $row['venta'] ?></td>
                                <td class="text-right">
                                    <a href="<?php echo base_url();?>admin/productos/delete/<?php echo $row['idProducto'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>
                                    <a href="<?php echo base_url();?>admin/productos/editar/<?php echo $row['idProducto'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>

                            <?php }

                            }?>


                            </tbody>
                        </table>
                        </div>

                        <div class="col-sm-12">
                            <div id="pagination" class="pull-right"> <?php echo $links; ?> </div>
                        </div>

                    </div><!-- /.box-body -->

                    </form>
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->

<script>
    $('#btn-filter').on('click', function () {

        var url = "<?= $url_filter; ?>";

        var filter_name = $('input[name=\'filter_nombre\']').val();

        if (filter_name) {
            url += ((url.indexOf("?") < 0) ? '?' : '&') + 'filter_nombre=' + encodeURIComponent(filter_name);
        }

        var filter_model = $('input[name=\'filter_marca\']').val();

        if (filter_model) {

            url += ((url.indexOf("?") < 0) ? '?' : '&') + 'filter_marca=' + encodeURIComponent(filter_model);
        }

        var filter_price = $('input[name=\'filter_stock\']').val();

        if (filter_price) {
            url += ((url.indexOf("?") < 0) ? '?' : '&') +  'filter_stock=' + encodeURIComponent(filter_price);
        }

        var filter_quantity = $('input[name=\'filter_compra\']').val();

        if (filter_quantity) {
            url += ((url.indexOf("?") < 0) ? '?' : '&') + 'filter_compra=' + encodeURIComponent(filter_quantity);
        }

        var filter_status = $('input[name=\'filter_venta\']').val();

        if (filter_status) {
            url += ((url.indexOf("?") < 0) ? '?' : '&') + 'filter_venta=' + encodeURIComponent(filter_status);
        }

        location = url;
    });
</script>

