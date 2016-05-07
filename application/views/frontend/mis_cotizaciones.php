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
<div class="row" style="margin-top: 15px;padding-left: 10px;">
    <div class="col-sm-4">
        <ul class="nav nav-tabs ">
            <li <?= ($sel_estado == 'todos') ? "class='active'" : ''; ?> ><a href="<?= $link_no_estado; ?>">Todas</a>
            </li>
            <?php foreach ($estados as $estado) { ?>
                <li <?= ($sel_estado == $estado->idEstado) ? "class='active'" : ''; ?> ><a
                        href="<?= $link_estado . $estado->idEstado; ?>"><?= $estado->nombre; ?></a></li>
            <?php } ?>
        </ul>
        <div style="max-height: 600px;overflow-y: scroll">
            <table class="table table-hover" style="margin-top: 10px;cursor: pointer">
                <?php if ($mis_cotizaciones) { ?>
                    <?php foreach ($mis_cotizaciones as $cotizacion) { ?>
                        <tr onclick="mostrar(<?= $cotizacion->idCotizacion; ?>)">
                            <td <?php if($cotizacion->idEstado == 3){ echo "class='list-group-item-success'";}?> >
                                <?php echo "<b>" . ucfirst(strtolower($cotizacion->estado)) . "</b><br>Solicitada: " . $cotizacion->fechaSolicitud; ?>
                                <div class="pull-right">
                                    <?php if ($cotizacion->idEstado != 3){ ?>
                                        <a id="confirmar[]" name="<?= $cotizacion->idCotizacion; ?>"
                                           title="Confirmar Compra" class="btn btn-success">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                    <?php }else{ ?>
                                        <a id="confirmado" title="Esta cotización ya está comprada!" class="btn">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                    <?php }?>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td style="text-align: center;background: #e2e8f5">Sin resultados para mostrar.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
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
            $(event.target).removeClass('btn-success');
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
