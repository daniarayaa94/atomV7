<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agregar Usuario
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Datos del usuario</h3>
                    </div>

                    <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'formUsuario','enctype' => 'multipart/form-data');
                    echo form_open(base_url().'admin/usuario/agregarUsuario',$attributes);
                    ?>

                        <div class="box-body">
                        <div class="form-group">
                            <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputNombre" value="<?php echo set_value('inputNombre',''); ?>" id="inputNombre" placeholder="Nombre">
                                <?php echo form_error('inputNombre', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputApellidos" class="col-sm-2 control-label">Apellidos</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputApellidos" value="<?php echo set_value('inputApellidos',''); ?>" id="inputApellidos" placeholder="Apellidos">
                                <?php echo form_error('inputApellidos', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputRut" class="col-sm-2 control-label">Rut</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputRut" value="<?php echo set_value('inputRut',''); ?>" id="inputRut" placeholder="Rut">
                                <?php echo form_error('inputRut', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmpresa" class="col-sm-2 control-label">Empresa</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputEmpresa" value="<?php echo set_value('inputEmpresa',''); ?>" id="inputEmpresa" placeholder="Empresa">
                                <?php echo form_error('inputEmpresa', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputUsername" value="<?php echo set_value('inputUsername',''); ?>"  autocomplete="off" id="inputUsername" placeholder="Username">
                                <?php echo form_error('inputUsername', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Contraseña</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputPassword" value="<?php echo set_value('inputPassword',''); ?>" id="inputPassword" autocomplete="off" placeholder="Contraseña">
                                <?php echo form_error('inputPassword', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Correo Contacto</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Correo Contacto" value="<?php echo set_value('inputEmail',''); ?>">
                                <?php echo form_error('inputEmail', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="inputGenero" class="col-sm-2 control-label">Genero</label>

                            <div class="col-sm-10">
                                <div>
                                    <input checked type="radio" name="inputGenero" value="M"/> Masculino &nbsp
                                    <input type="radio" name="inputGenero" value="F"/> Femenino
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDireccion" class="col-sm-2 control-label">Direccion</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputDireccion" value="<?php echo set_value('inputDireccion',''); ?>" id="inputDireccion" placeholder="Direccion">
                                <?php echo form_error('inputDireccion', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="inputTelefono" class="col-sm-2 control-label">Telefono</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputTelefono" value="<?php echo set_value('inputTelefono',''); ?>" id="inputTelefono" placeholder="Telefono">
                                <?php echo form_error('inputTelefono', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                       <!-- <div class="form-group">

                            <label class="col-sm-2 control-label">Imagenes</label>

                            <div class="col-sm-10">
                                <input  name="upload[]" hidden multiple="multiple" id="upload" value="<?php echo set_value('upload');?>" class="file" type="file" accept="image/*">
                            </div>
                        </div>-->

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


