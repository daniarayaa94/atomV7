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

                            <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="confirm('Está seguro que desea eliminar los productos seleccionados') ? $('#form-product').submit() : false;" data-original-title="Borrar producto"><i class="fa fa-trash-o"></i></button>
                            <!-- <button type="button" class="btn btn-danger btn-sm"  data-toggle="tooltip" title="" data-original-title="Eliminar">
                                <i class="fa fa-trash-o"></i></button> -->

                        </div>
                        <!-- /. tools -->
                    </div>

                    <form action="<?php echo base_url();?>admin/categorias/delete" method="post" enctype="multipart/form-data" id="form-product">
                        <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center"> <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (sizeof($categorias_list) == 0){ ?>
                                <td class="text-center" colspan="4">Sin registros.</td>
                            <?php }else {
                                
                                foreach ($categorias_list as $row){ ?>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['idCategoria'] ?>"></td>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url();?>admin/categorias/delete/<?php echo $row['idCategoria'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>
                                            <!--<a href="<?php echo base_url();?>admin/productos/editar/<?php echo $row['idCategoria'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Editar"><i class="fa fa-pencil"></i></a>-->
                                        </td>
                                    </tr>

                                <?php }
                            }?>


                            </tbody>
                        </table>
                        </div>
                    </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->