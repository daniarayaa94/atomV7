<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Contáctenos</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="margin-top: 15px;">
        <?php if ($success) { ?>
            <div class="alert alert-success"> <?= $success; ?> </div>
        <?php } ?>
        <div class="col-sm-6">
            <h2>Nosotros</h2>
            <p>Atom &reg; piensa y se centra siempre en sus clientes. La idea y empresa en sí, nace al observar la
                realidad
                de muchas empresas que requieren insumos básicos y deben esperar diías para recien tener una respuesta
                del proveedor que los abastece.
                Nuestra meta y nuestro compromiso son claros: '24 hrs desde que el producto es solicitado hasta que el
                cliente lo tiene en sus manos',
                casi para no creerlo ¿verdad?.
                Sabemos que si compra algo es porque lo necesita y por eso, nuestro clientes son nuestra inspiracion y
                su satisfacción nuestra meta.
                <br>
                Su opinión también nos interesa; complete este sencillo formulario y pongase en contacto con Atom &reg;
            </p>
            <br>
            <div id="map" style="height: 360px; width: 100%;"></div>
        </div>
        <div class="col-sm-6">
            <form action="<?= $correo; ?>" method="POST">
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre Apellido"
                           class="form-control"
                           value="<?php echo !empty($recordados['txtNombre']) ? $recordados['txtNombre'] : ''; ?>"/>
                    <div class="error"> <?php echo !empty($error_nombre) ? $error_nombre : ''; ?> </div>
                </div>
                <div class="form-group">
                    <label for="txtEmail">Email</label>
                    <input type="text" name="txtEmail" id="txtEmail" placeholder="ejemplo@mail.com" class="form-control"
                           value="<?php echo !empty($recordados['txtEmail']) ? $recordados['txtEmail'] : ''; ?>"/>
                    <div class="error"> <?php echo !empty($error_email) ? $error_email : ''; ?> </div>
                </div>
                <div class="form-group">
                    <label for="txtTelefono">Telefono</label>
                    <input type="text" name="txtTelefono" id="txtTelefono" placeholder="82090910" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtMensaje">Mensaje</label>
                    <textarea id="txtMensaje" name="txtMensaje" placeholder="Escriba aquí el mensaje que desee"
                              style="resize: none; height: 300px; width: 100%;"><?php echo !empty($recordados['txtMensaje']) ? $recordados['txtMensaje'] : ''; ?></textarea>
                    <div class="error"> <?php echo !empty($error_mensaje) ? $error_mensaje : ''; ?> </div>
                </div>
                <div>
                    <input type="submit" value="Enviar" style="width: 100%;">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function initMap() {
        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
            center: {lat: -33.500090, lng: -70.617942},
            zoom: 15
        });
        var marker = new google.maps.Marker({
            position: {lat: -33.500090, lng: -70.617942},
            map: map,
            title: 'Visite Atom Office acá.'
        });
    }
</script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmdvzCMl6-8_tvydhqlepUT_fDK3hR5CM&callback=initMap"></script>