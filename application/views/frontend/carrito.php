<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Cotización Actual</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <div class="table-responsive" style="margin: 10px;">
        <table class="table ">
            <thead>
            <tr>
                <th class="cart-title">Imagen</th>
                <th class="cart-title">Detalles</th>
                <th class="cart-title">Cantidad</th>
                <th class="cart-title">Eliminar</th>

            </tr>
            </thead>
            <tbody>

            <?php foreach ($carrito as $item) { ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle"><img src="<?= $item['imagen']; ?>" class="img-responsive" style="width: 70px;height: 70px;"></td>
                    <td class="text-left" style="vertical-align: middle"><?= $item['nombre']; ?> <br> <a href="<?= $link_mostrar_detalles.$item['id']; ?>"><strong>Codigo:</strong> <?= $item['codigo']; ?></a> <br> <p> <strong>Marca:</strong> <?= $item['marca']; ?></p></td>
                    <td class="text-center" style="vertical-align: middle"><input class="form-control" type="text" value="<?= $item['cantidad'] ?>" name="<?= $item['rowid']; ?>"
                                                                                  id="qty-box"/></td>
                    <td class="text-center" style="vertical-align: middle"><div class="col-sm-3" id="del-item[]" title="<?= $item['rowid']; ?>"><i class="fa fa-trash"></i></td>

                </tr>

            <?php }?>

            </tbody>
        </table>
    </div>


        <!--<div class="col-sm-2 cart-title">Imagen</div>
    <div class="col-sm-5 cart-title">Detalles</div>
    <div class="col-sm-3 cart-title">Cantidad</div>
    <div class="col-sm-2 cart-title">Eliminar</div>

    <?php foreach ($carrito as $item) { ?>
        <div class="row" style="margin-top: 5px;">
            <div class="col-sm-2">
                <img src="<?= $item['imagen']; ?>" class="img-responsive" style="width: 70px;height: 70px;">
            </div>
            <div class="col-sm-5">
                <h5><?= $item['nombre']; ?></h5>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?= $link_mostrar_detalles.$item['id']; ?>">Codigo: <?= $item['codigo']; ?></a>
                    </div>
                    <div class="col-sm-6">
                        <p>Marca <br> <?= $item['marca']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <input type="text" value="<?= $item['cantidad']; ?>" class="form-control"/>
            </div>
            <div class="col-sm-2">
                <i class="fa fa-trash"></i>
            </div>
        </div>
    <?php } ?> -->
        <div class="row" style="margin: 10px;">
            <a href="<?php echo $confirmacion; ?>" class="btn btn-success pull-right" ><i class="fa fa-envelope"></i> Solicitar Cotización</a>
        </div>

</div>
