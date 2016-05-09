<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6">
            <?php if ($imagenes) { ?>
                <div class="row" style="line-height: 200px;">
                    <img id="image_container" src="<?php echo $assets . $imagenes[0]; ?>"
                         data-zoom-image="<?php echo $assets . $imagenes[0]; ?>" class="image_detail"/>
                </div>
                <div class="row" style="margin-top: 10px" id="galleria">
                    <?php foreach ($imagenes as $miniatura) { ?>
                        <div class="col-sm-3">
                            <a href="#" data-zoom-image="<?php echo $assets . $miniatura; ?>"
                               data-image="<?php echo $assets . $miniatura; ?>">
                                <img src="<?php echo $assets . $miniatura; ?>" alt="<?php echo $miniatura; ?>"
                                     class="shadow"/>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-6">
            <div class="product-inner">
                <h2 class="product-name"><?php echo $producto->nombre; ?></h2>
                <div class="product-inner-price">
                    <ins><?php echo 'Código: ' . $producto->codigo; ?></ins>
                </div>

                <div role="tabpanel">
                    <ul class="product-tab" role="tablist">
                        <li role="presentation"><a type="submit" class="add-to-cart-link detail-add"
                                                   name="<?php echo $producto->nombre ?>"
                                                   id="<?php echo $producto->idProducto ?>"
                                                   role="tab" data-toggle="tab"
                                                   title="Click para agregar al carro"><i
                                    class="fa fa-shopping-cart"></i> Agregar</a></li>
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descripción del
                                Producto</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <div><p><?php echo $producto->descripcion; ?></p></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <h1>Productos relacionados</h1>
        <?php if ($relacionados) { ?>
            <?php foreach ($relacionados as $prod) {?>
                <?php $img = explode(';', $prod->imagenes); ?>
                <div class="col-sm-3">
                    <div class="single-product">
                        <div class="product-f-image">
                            <img src="<?= $assets . end($img); ?>" style="width: 215px; height: 200px;">
                            <div class="product-hover">
                                <a class="add-to-cart-link" id="<?= $prod->idProducto; ?>" name="<?= $prod->nombre; ?>"
                                ><i class="fa fa-shopping-cart"></i> Agregar</a>
                                <a href="<?= $mostrar_detalle . $prod->idProducto; ?>"
                                   class="view-details-link"><i class="fa fa-link"></i>
                                    Detalles</a>
                            </div>
                        </div>

                        <h2>
                            <a href="<?= $mostrar_detalle . $prod->idProducto; ?>"><?php echo $prod->nombre; ?></a>
                        </h2>
                        <p style="color: #00a157">
                            <a href="<?= $mostrar_detalle . $prod->idProducto; ?>"><?php echo 'Código: ' . $prod->codigo; ?></a>
                        </p>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No tenemos productos relacionados a este.</p>
        <?php } ?>
    </div>
</div>
<br>
<script type="application/javascript">
    $("#image_container").elevateZoom({
        gallery: 'galleria',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        scrollZoom: true
    }); //pass the images to Fancybox
    $("#galleria").bind("click", function (e) {
        var ez = $('#image_container').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });
</script>

