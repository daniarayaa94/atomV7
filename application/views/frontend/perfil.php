<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Mi perfil</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php if ($success) { ?>
        <div class="alert alert-success"> <?= $success; ?> </div>
    <?php } ?>
    <form action="<?= $editar; ?>" method="POST">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="txtNombre" class="form-control" value="<?php echo $usuario->nombre; ?>"/>
        </div>

        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" name="txtApellidos" class="form-control" value="<?php echo $usuario->apellidos; ?>"/>
        </div>

        <div class="form-group">
            <label>Rut</label>
            <input type="text" name="txtRut" class="form-control" value="<?php echo $usuario->rut; ?>"/>
        </div>

        <div class="form-group">
            <label>Genero</label>
            <div>
                <input type="radio" name="rbGenero" value="M" <?php if ($usuario->genero == 'M') {
                    echo "checked";
                } ?> /> &nbsp Masculino &nbsp
                <input type="radio" name="rbGenero" value="F" <?php if ($usuario->genero == 'F') {
                    echo "checked";
                } ?> />&nbsp Femenino
            </div>
        </div>

        <div class="form-group">
            <label>Correo</label>
            <input type="email" name="txtEmail" class="form-control" value="<?php echo $usuario->correoContacto; ?>"/>
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="txtDireccion" class="form-control" value="<?php echo $usuario->direccion; ?>"/>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="number" name="txtTelefono" class="form-control" value="<?php echo $usuario->telefono; ?>"/>
        </div>

        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="txtUser" class="form-control" value="<?php echo $usuario->username; ?>"/>
        </div>

        <div class="form-group">
            <div>
                <label>Password</label>
            </div>
            <div class="col-sm-4">
                <input type="text" name="txtPassAnt" class="form-control" placeholder="Contraseña Actual"/>
            </div>
            <div class="col-sm-4">
                <input type="text" name="txtPass" class="form-control" placeholder="Contraseña Nueva"/>
            </div>
            <div class="col-sm-4">
                <input type="text" name="txtPassConfirma" class="form-control" placeholder="Confirme Contraseña"/>
            </div>
        </div>
        
        <input type="submit" value="Guardar Cambios"/>
    </form>


</div>
<script type="text/javascript">
    $("[name='img-perfil']").on('change', function () {
        var filename = $(this).val();
        $.post(
            "<?= base_url() . 'frontend/perfil/upload' ?>",
            {filename: filename}
            )
            .done(function (resp) {
                alert(resp);
                $("[name='IPerfil']").attr({src: "<?= base_url() . 'assets/'?>" + resp});
            });
    });
</script>