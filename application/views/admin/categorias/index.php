<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Categorias

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Categorias</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                            <a href="<?php echo base_url();?>admin/categorias/agregarCategoria" class="btn btn-success"  data-toggle="tooltip" title="" data-original-title="Agregar Categoria">
                                <i class="fa fa-plus"></i></a>

                            <!-- <button type="button" class="btn btn-danger btn-sm"  data-toggle="tooltip" title="" data-original-title="Eliminar">
                                <i class="fa fa-trash-o"></i></button> -->

                        </div>
                        <!-- /. tools -->
                    </div>


                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php if (sizeof($categorias_list) == 0){ ?>
                                <td class="text-center" colspan="4">Sin registros.</td>
                            <?php }else {
                                
                                foreach ($categorias_list as $row){ ?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
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