<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Mis Cotizaciones</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-sm-4">
        <table class="table" style="max-height: 800px;">
            <tr>
                <td>Todas</td>
                <td><select>
                        <?php foreach ($estados as $estado) { ?>
                        <option value="<?= $estado->idEstado; ?>"><?= $estado->nombre; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <?php if ($mis_cotizaciones) { ?>
                <?php foreach ($mis_cotizaciones as $cotizacion) { ?>
                    <tr onclick="mostrar(<?= $cotizacion->idCotizacion; ?>)">
                        <td><?php echo "<b>" . ucfirst(strtolower($cotizacion->estado)) . "</b><br>Solicitada: " . $cotizacion->fechaSolicitud; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    Sin resultados para mostrar.
                </tr>
            <?php } ?>
        </table>
    </div>


    <div class="col-sm-4 sidebar hidden">
        <ul class="nav nav-tabs ">
            <li <?= ($sel_estado == 'todos') ? "class='active'" : ''; ?> ><a href="<?= $link_no_estado; ?>">Todas</a>
            </li>
            <?php foreach ($estados as $estado) { ?>
                <li <?= ($sel_estado == $estado->idEstado) ? "class='active'" : ''; ?> ><a
                        href="<?= $link_estado . $estado->idEstado; ?>"><?= $estado->nombre; ?></a></li>
            <?php } ?>
        </ul>
        <ul class="single-sidebar">
            <div style="margin-top: 20px;">
                <?php if ($mis_cotizaciones) { ?>
                    <?php foreach ($mis_cotizaciones as $cotizacion) { ?>
                        <div class="thubmnail-recent" style="background-color: #dae0ed"
                             onclick="mostrar(<?= $cotizacion->idCotizacion; ?>)">
                            <?php switch (strtolower($cotizacion->estado)) {
                                case 'solicitada': ?>
                                    <img src="<?= $image_folder . 'arrow.png' ?>" class="recent-thumb" alt="">
                                    <?= '<h2><a>Cotización Solicitada</a></h2>'; ?>
                                    <?php break;
                                case 'respondida': ?>
                                    <img src="<?= $image_folder . 'arrowl.png' ?>" class="recent-thumb" alt="">
                                    <?= '<h2><a>Cotización Respondida</a></h2>'; ?>
                                    <?php break;
                                case 'comprada': ?>
                                    <img src="<?= $image_folder . 'dollar.png' ?>" class="recent-thumb" alt="">
                                    <?= '<h2><a>Compra Realizada</a></h2>'; ?>
                                    <?php break;
                            } ?>
                            <div class="product-sidebar-price">
                                <?php switch (strtolower($cotizacion->estado)) {
                                    case 'solicitada': ?>
                                        <?= '<b>Fecha solicitud: </b>' . $cotizacion->fechaSolicitud; ?>
                                        <?php break;
                                    case 'respondida': ?>
                                        <?= '<b>Fecha Solicitud: </b>' . $cotizacion->fechaSolicitud; ?><br>
                                        <?= '<b>Fecha Respuesta: </b>' . $cotizacion->fechaRespuesta; ?>
                                        <?php break;
                                    case 'comprada': ?>
                                        <?= '<b>Total: </b>' . $cotizacion->total; ?><br>
                                        <?= '<b>Código Compra : </b>' . $cotizacion->confirmationKey; ?>
                                        <?php break;
                                } ?>
                            </div>
                            <a class="btn btn-primary" id="confirmar[]" name="<?= $cotizacion->idCotizacion; ?>"><i
                                    class="fa fa-check-circle"></i></a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="thubmnail-recent">
                        Sin resultados para mostrar.
                    </div>
                <?php } ?>

            </div>

        </ul>
    </div>
    <div class="col-sm-8 child">
        <div class="" id="container">
            <img src="<?= $image_folder . 'iconcotizador.png'; ?>" style="width: 25%;">
            <h1>Pinche una cotización para <br> poder ver sus detalles.</h1>
            <p>Las cotizaciones que hayan sido
                <br> respondidas por el administrador o confirmadas por usted como compras
                <br> tendrán tambien el detalle de los precios y sus totales</p>
        </div>
    </div>
</div>

<script type="application/javascript">
    $('#advanced-filter').on('click', function () {
        var display = $('#fil-hidden').css('display');
        if (display == 'block') {
            $('#fil-hidden').css({'display': 'none'});
        } else {
            $('#fil-hidden').css({'display': 'block'});
        }

    });
    $("a[id*='confirmar']").on('click', function (event) {
        var id = $(this).prop('name');

        $.post(
            "<?= base_url() . 'frontend/cotizaciones/confirmar' ?>",
            {id: id}
        ).done(function () {
            $(event.target).removeClass('btn-primary');
            $(event.target).addClass('btn-success');
        });

    });

    function mostrar(cotizacion) {
        $.post(
            '<?= $url_detalles ?>',
            {id: cotizacion}
            )
            .done(function (resp) {
                $('#container').parent().removeClass('child');
                document.getElementById('container').innerHTML = resp;
            });
    }
</script>
