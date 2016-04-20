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
                                <th>Descripcion</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (sizeof($productos_list) == 0){ ?>
                                <td class="text-center" colspan="7">Sin registros.</td>
                            <?php }else {
                                foreach ($productos_list as $row){ ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['idProducto'] ?>"></td>
                                <td class="text-center"><img src="<?php echo base_url()."assets/".explode(";",$row['imagenes'])[0] ?>" alt="<?php echo $row['nombre'] ?>" style="width: 50px;height: 50px;" class="img-thumbnail"></td>
                                <td class="text-left"><?php echo $row['nombre'] ?></td>
                                <td class="text-left"><?php echo $row['marca'] ?></td>
                                <td class="text-left"><?php echo $row['descripcion'] ?></td>
                                <td class="text-left"><?php echo $row['stock'] ?></td>
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

                    </div><!-- /.box-body -->


                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->


</div><!-- /.content-wrapper -->