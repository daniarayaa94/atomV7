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
<div class="container">
    <div class="filter-style">
        <div class="row ">
            <form action="<?= $filter_url; ?>" method="POST">
                <div id="fil-hidden">
                    <div class="col-sm-4">
                        <label>Fecha Respuesta</label>
                        <input class="form-control" type="date" name="fil-fResp"/>
                    </div>
                    <div class="col-md-4">
                        <label>Estado de cotización</label>
                        <select name="fil-Estado" class="form-control">
                            <option value="">Seleccione</option>
                            <?php foreach ($estados as $estado) { ?>
                                <option value="<?= $estado->idEstado; ?>"><?= $estado->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <label>Fecha Solicitud</label>
                <div class="input-group col-sm-4">
                    <input id="search" type="date" class="form-control" name="fil-fsolicitud">
              <span class="input-group-btn">
                <button id="btn-filter" name="btn-filer" class="btn btn-success" ><i class="fa fa-search"></i> Buscar
                </button>
              </span>
                </div>
            </form>
            <span id="advanced-filter" class="caret" style="color: #00CC00; cursor: pointer"></span>&nbsp Búsqueda
            específica
        </div>
    </div>
    <table class="table table-hover"> 
        <thead>
        <tr>
            <th>Fecha Solicitud</th>
            <th>Fecha Respuesta</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mis_cotizaciones as $cotizacion) { ?>
            <tr>
                <td><?= $cotizacion->fechaSolicitud; ?></td>
                <td>
                    <?= ($cotizacion->fechaRespuesta) ? $cotizacion->fechaRespuesta: "<label class='label label-warning'>Respuesta pendiente</label>"; ?>
                </td>
                <td><?= $cotizacion->estado; ?></td>
                <td><a class="btn btn-primary" id="confirmar[]" name="<?= $cotizacion->idCotizacion; ?>"><i
                            class="fa fa-check-circle"></i></a>
                    <a class="btn btn-primary" id="<?= $cotizacion->idCotizacion; ?>"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="col-sm-12" style="padding-right: 150px;">
        <div id="pagination" class="pull-right"> <?php echo $paginacion; ?> </div>
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
            "<?= base_url().'frontend/cotizaciones/confirmar' ?>",
            { id: id }
        ).done(function() {
            $(event.target).removeClass('btn-primary');
            $(event.target).addClass('btn-success');
             //$(this).css({background:'green'});
        });

    });
</script>