<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><?php echo $cat_seleccionada; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <!--Filtros-->
    <div class="col-sm-2">
        <ul class="list-group" style="padding-left: 5px;">
            <li class="list-group-item list-group-item-success">
                <b>Filtros &nbsp<i id="no-filter" class="fa fa-times" style="color: #b91320"
                                   data-toggle="tooltip" title="Quitar filtros"></i></b></li>
            <div style="height: auto;line-height: 300%;" class="list-group-item">
                <?php foreach ($tags as $tag) { ?>
                    <label class="label label-success"><?= $tag ?></label>
                <?php } ?>
            </div>
            <li class="list-group-item list-group-item-success"><b>Sub categorías</b></li>
            <?php if (count($subcategories) > 0) { ?>
                <?php foreach ($subcategories as $key => $item) { ?>
                    <a href="<?= $url_filter . '/shortname/' . $item->subcategoria; ?>"
                       class="list-group-item"><?php echo ucfirst($item->subcategoria . ' (' . $item->total . ')') ?></a>
                <?php } ?>
            <?php } else { ?>
                <li class="list-group-item">Sin resultados</li>
            <?php } ?>

        </ul>
    </div>

    <!--Productos-->
    <div class="col-sm-10">
        <?php if (count($productos) > 0) { ?>
            <?php foreach ($productos as $prod) {
                $src = explode(';', $prod->imagenes); ?>
                <div class="col-sm-3">
                    <div class="single-product">
                        <div class="product-f-image">
                            <img src="<?php echo base_url() . 'assets/' . end($src); ?>" alt=""
                                 style="width:100%; height:230px;">
                            <div class="product-hover">
                                <a class="add-to-cart-link" name="<?php echo $prod->nombre ?>"
                                   id="<?php echo $prod->idProducto ?>"><i class="fa fa-shopping-cart"></i> Agregar</a>
                                <a href="<?php echo $link_detalles . $prod->idProducto; ?>" class="view-details-link"><i
                                        class="fa fa-link"></i> Detalles</a>
                            </div>
                        </div>
                        <h2><a href="<?php echo $link_detalles . $prod->idProducto; ?>"><?php echo $prod->nombre ?></a>
                        </h2>
                        <p>
                            <a href="<?php echo $link_detalles . $prod->idProducto; ?>"><?php echo 'Código:' . $prod->codigo ?></a>
                        </p>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div style="text-align: center">
                <img src="<?= $no_results; ?>" style="width: 200px;height: 200px;"/>
            </div>
            <div style="text-align: center">
                <h2>Estamos agregando productos a esta categoría.</h2>
            </div>
        <?php } ?>
        <hr/>
    </div>
</div>

<script type="application/javascript">
    $('#no-filter').on('click', function () {
        location = "<?= $url . $category_select ?>";
    });
</script>
