<div class="container">
    <?php echo json_encode($productos_en_carrito); foreach ($productos_en_carrito as $item){ ?>
        <div class="row">
            <div class="col-sm-2">
                <img src="<?= $item['img']; ?>" class="img-responsive">
            </div>
            <div class="col-sm-4">
                <h3><?= $item['name']; ?></h3>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="">Codigo:</a>
                    </div>
                    <div class="col-sm-6">
                        <p>Marca</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <input type="text" value="<?= $item['qty']; ?>" />
            </div>
            <div class="col-sm-2">
                <i class="fa fa-trash"></i>
            </div>
        </div>
    <?php } ?>
</div>