<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de usuarios

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="well">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-name">Nombre</label>
                        <input type="text" name="filter_nombre" value="<?php echo $filter_nombre?>" placeholder="Nombre de usuario" id="input-name" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-model">Username</label>
                        <input type="text" name="filter_username" value="<?php echo $filter_username?>" placeholder="Username" id="input-username" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-model">Correo</label>
                        <input type="text" name="filter_correo" value="<?php echo $filter_correo?>" placeholder="Correo" id="input-correo" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="input-model">Tipo Usuario</label>
                        <select name="inputTipo" id="inputTipo" class="form-control">

                            <option value="0" <?php echo ((0 == $filter_tipo) ? 'selected' : '' );?> >Todos</option>

                            <?php foreach ($tipos_list as $row){ ?>
                                <option value="<?php echo $row['idTipo']; ?>" <?php echo (($row['idTipo'] == $filter_tipo) ? 'selected' : '' );?>><?php echo $row['nombre']; ?></option>
                            <?php }?>

                        </select>
                    </div>

                </div>
                <!--<div class="col-sm-12">

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
                </div>-->
                <div class="col-sm-12">

                    <button type="button" id="btn-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">


                <div class="box">


                    <div class="box-header">
                        <h3 class="box-title">Usuarios</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                            <a href="<?php echo base_url().'admin/usuario/agregarUsuario"';?>"  class="btn btn-success"  data-toggle="tooltip" title="" data-original-title="Agregar usuario" >
                                <i class="fa fa-plus"></i></a>
                            <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="confirm('Está seguro que desea eliminar los usuarios seleccionados') ? $('#form-product').submit() : false;" data-original-title="Borrar usuario"><i class="fa fa-trash-o"></i></button>
                        </div>

                        <!-- /. tools -->
                    </div>

                    <form action="<?php echo base_url();?>admin/usuario/delete" method="post" enctype="multipart/form-data" id="form-product">

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center"> <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
                                        <th>Nombre</th>
                                        <th>Username</th>
                                        <th>Correo</th>
                                        <th>Tipo Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if (sizeof($usuarios_list) == 0){ ?>
                                        <td class="text-center" colspan="9">Sin registros.</td>
                                    <?php }else {
                                        foreach ($usuarios_list as $row){ ?>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['idUsuario'] ?>"></td>
                                                <td class="text-left"><?php echo $row['nombre'] ?></td>
                                                <td class="text-left"><?php echo $row['username'] ?></td>
                                                <td class="text-left"><?php echo $row['correoContacto'] ?></td>
                                                <td class="text-left"><?php echo $row['nombreTipo'] ?></td>
                                                <td class="text-right">
                                                    <a href="<?php echo base_url();?>admin/usuario/delete/<?php echo $row['idUsuario'] ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>
                                                    <a href="<?php echo base_url();?>admin/usuario/editar/<?php echo $row['idUsuario'] ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
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

        var filter_username = $('input[name=\'filter_username\']').val();

        if (filter_username) {

            url += ((url.indexOf("?") < 0) ? '?' : '&') + 'filter_username=' + encodeURIComponent(filter_username);
        }

        var filter_correo = $('input[name=\'filter_correo\']').val();

        if (filter_correo) {
            url += ((url.indexOf("?") < 0) ? '?' : '&') +  'filter_correo=' + encodeURIComponent(filter_correo);
        }

        var filter_tipo = $('#inputTipo').val();

        if (filter_tipo > 0) {
            url += ((url.indexOf("?") < 0) ? '?' : '&') +  'filter_tipo=' + encodeURIComponent(filter_tipo);
        }

        location = url;
    });
</script>

