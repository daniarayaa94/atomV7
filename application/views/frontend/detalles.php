<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6">
            <?php if ($imagenes) { ?>
                <div class="row">
                    <img id="image_container" src="<?php echo $assets . $imagenes[0]; ?>"
                         data-zoom-image="<?php echo $assets . $imagenes[0]; ?>"/>
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

                <form action="" class="cart">
                    <div class="quantity">
                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity"
                               min="1" step="1">
                    </div>
                    <button class="add_to_cart_button" type="submit">Agregar al Carro</button>
                </form>

                <div role="tabpanel">
                    <ul class="product-tab" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descripción del Producto</a>
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

