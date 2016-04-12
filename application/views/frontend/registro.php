<div class="container">
    <br>
    <?php if (isset($success)) { ?>
        <div class="alert alert-success"> <?= $success; ?> </div>
    <?php } ?>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"> <?= $error; ?> </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend>Ingrese sus datos:</legend>
                <p>Bienvenido nuevamente, ingrese los datos de su cuenta y podrá cotizar y hacer los pedidos que su
                    negocio
                    o usted necesite. Si aún o tiene una cuenta, regístrese completanto los datos solicitados en derecha
                    de
                    su pantalla y tendrá acceso a mundo <b>atom &reg;</b>.</p>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="txt_user">Usuario:</label>
                        <input type="text" name="txt_user" id="txt_user" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="txt_user">Contraseña:</label>
                        <input type="text" name="txt_pass" id="txt_pass" class="form-control"/>
                    </div>
                    <input type="submit" value="Ingresar"/>
                </form>
            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset>
                <legend>Registro de Usuario:</legend>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#persona">Persona</a></li>
                    <li><a data-toggle="tab" href="#empresa">Empresa</a></li>
                </ul>

                <div class="tab-content">
                    <div id="persona" class="tab-pane fade in active">
                        <h3>Cuenta Personal</h3>
                        <form method="POST" action="<?= $registro_persona; ?>">
                            <div class="form-group col-sm-12">
                                <label for="txt_nombre">Nombre: </label>
                                <input type="text" name="txt_nombre" id="txt_nombre" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="txt_apellidos">Apellidos: </label>
                                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control"/>
                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="txt_rut">R.U.T: </label>
                                    <input type="text" name="txt_rut" id="txt_rut" class="form-control"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Sexo:</label>&nbsp
                                    <div>
                                        <input type="radio" name="r_sexo" value="M"/>Masculino &nbsp
                                        <input type="radio" name="r_sexo" value="F"/>Femenino
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="form-group col-sm-6">
                                    <label for="txt_email">Email: </label>
                                    <input type="text" name="txt_email" id="txt_email" class="form-control"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="txt_email">Teléfono: </label>
                                    <input type="text" name="txt_cel" id="txt_cel" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="txt_email">Dirección: </label>
                                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="txt_email">Usuario: </label>
                                    <input type="text" name="txt_user" id="txt_user" class="form-control"/>
                                </div>
                                <div class="col-sm-6">
                                    <label for="txt_email">Contraseña: </label>
                                    <input type="text" name="txt_pass" id="txt_pass" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-12"><br>
                                <input type="submit" value="Registrar"/>
                            </div>
                        </form>
                    </div>

                    <div id="empresa" class="tab-pane fade">
                        <h3>Empresa</h3>
                        <form method="POST" action="<?= $registro_persona; ?>">
                            <div class="form-group col-sm-12">
                                <label for="txt_contacto">Nombre contacto: </label>
                                <input type="text" name="txt_nombre" id="txt_nombre" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="txt_empresa">Empresa: </label>
                                <input type="text" name="txt_nombreemp" id="txt_nombreemp" class="form-control"/>
                            </div>
                            <div>
                                <div class="form-group col-sm-6">
                                    <label for="txt_email">R.u.t Empresa: </label>
                                    <input type="text" name="txt_rutemp" id="txt_rutemp" class="form-control"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="txt_email">Telefono: </label>
                                    <input type="text" name="txt_tel" id="txt_tel" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="txt_email">Email: </label>
                                <input type="text" name="txt_email" id="txt_email" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="txt_email">Dirección: </label>
                                <input type="text" name="txt_dir_emp" id="txt_dir_emp" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="txt_email">Usuario: </label>
                                    <input type="text" name="txt_usuario" id="txt_usuario" class="form-control"/>
                                </div>
                                <div class="col-sm-6">
                                    <label for="txt_email">Contraseña: </label>
                                    <input type="text" name="txt_clave" id="txt_clave" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-12"><br>
                                <input type="submit" value="Ingresar"/>
                            </div>
                        </form>

                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>