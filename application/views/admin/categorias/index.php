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
                        <td><h3 class="box-title">Categorias</h3></td>

                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <table>
                                <tr>
                                    <td  style="padding-right: 5px;">
                                        <div class="box-tools">
                                            
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="search" id="search" class="form-control pull-right" placeholder="Buscar">

                                                    <div class="input-group-btn">
                                                        <button id="btn-filter" class="btn btn-default"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            

                                        </div>
                                    </td>

                                    <td> <a href="<?php echo base_url();?>admin/categorias/agregarCategoria" class="btn btn-success"  data-toggle="tooltip" title="" data-original-title="Agregar Categoria">
                                            <i class="fa fa-plus"></i></a>

                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="confirm('Está seguro que desea eliminar los productos seleccionados') ? $('#form-product').submit() : false;" data-original-title="Borrar producto"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            </table>





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

                                            <a href="<?php echo base_url();?>admin/categorias/delete/<?php echo $row['idCategoria'] ?>" onclick="return confirm('Está seguro que desea eliminar las categoria seleccionada, si la elimninas tambien se eliminaran los productos relacionador con esta categoria.')" data-toggle="tooltip"  title="" class="btn btn-danger" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>
                                            <a href="<?php echo base_url();?>admin/categorias/editar/<?php echo $row['idCategoria'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
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
        var text = $('#search').val();
        if (text) {
            location = "<?= $url_filter; ?>" + "?ncategoria=" + encodeURI(text);
        }else{
            location = "<?= $url_filter; ?>";
        }
    });
</script>
