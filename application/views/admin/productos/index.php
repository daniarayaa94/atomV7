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
        <div class="row">
            <div class="col-xs-12">


                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Productos</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                            <a <?php if($hasCategorias){ echo 'href="<?php echo base_url();?>admin/productos/agregarProducto"';}?>  class="btn btn-success"  data-toggle="tooltip" title="" data-original-title="<?php echo $tituloAgregar;?>"  <?php if(!$hasCategorias){ echo 'disabled';}?>  >
                                <i class="fa fa-plus"></i></a>

                        </div>
                        <!-- /. tools -->
                    </div>


                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (sizeof($productos_list) == 0){ ?>
                                <td class="text-center" colspan="4">Sin registros.</td>
                            <?php }else {
                                foreach ($productos_list as $row){ ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="selected[]" value="42"></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['marca'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><?php echo $row['stock'] ?></td>
                            </tr>

                            <?php }

                            }?>


                            </tbody>
                        </table>
                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->