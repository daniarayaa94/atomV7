<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Productos

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Productos</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                            <a href="productos/agregarProducto" class="btn btn-success btn-sm"  data-toggle="tooltip" title="" data-original-title="Agregar producto">
                                <i class="fa fa-plus"></i></a>


                            <!-- <button type="button" class="btn btn-danger btn-sm"  data-toggle="tooltip" title="" data-original-title="Eliminar">
                                <i class="fa fa-trash-o"></i></button>-->

                        </div>
                        <!-- /. tools -->
                    </div>


                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>idProducto</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php foreach ($productos_list as $row){ ?>
                            <tr>
                                <td><?php echo $row['idProducto'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['marca'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><?php echo $row['stock'] ?></td>
                            </tr>

                            <?php }?>


                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->