<div class="container">
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
    <div class="col-sm-2 cart-title">Imagen</div>
    <div class="col-sm-5 cart-title">Detalles</div>
    <div class="col-sm-3 cart-title">Cantidad</div>
    <div class="col-sm-2 cart-title">Eliminar</div>

    <?php foreach ($productos_en_carrito as $item) { ?>
        <div class="row" style="margin-top: 5px;">
            <div class="col-sm-2">
                <img src="<?= $item['img']; ?>" class="img-responsive">
            </div>
            <div class="col-sm-5">
                <h5><?= $item['name']; ?></h5>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="">Codigo:</a>
                    </div>
                    <div class="col-sm-6">
                        <p>Marca</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <input type="text" value="<?= $item['qty']; ?>" class="form-control"/>
            </div>
            <div class="col-sm-2">
                <i class="fa fa-trash"></i>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <a href="<?php echo $confirmacion; ?>" class="btn btn-success pull-right" ><i class="fa fa-envelope"></i> Solicitar Cotización</a>
    </div>
</div>