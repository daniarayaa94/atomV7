<div class="container">
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
    
    <?php if (count($imagenes) == 1) { ?>
        <!--<img src="<?php// echo base_url() . 'assets/' . $imagenes[0]->nombre ?>" alt="<?php //echo $imagenes[0]->nombre; ?>"
             style="width: 100%;height: 200px;"/>-->
    <?php } else { ?>
        <!--<h1>Aca deberia ir ina imagen</h1>-->
    <?php } ?>
    <div>
        <div class="row">
            <?php if (count($productos) > 0){ ?>

            <?php } else{ ?>
                <div style="text-align: center">
                <img src="<?= $no_results; ?>" style="width: 200px;height: 200px;"/>
                </div>
                <div style="text-align: center">
                    <h2>Estamos agregando productos a esta categoría.</h2>
                </div>
            <?php }?>
        <?php foreach ($productos as $prod) {
            $src = explode(';', $prod->imagenes); ?>
            <div class="col-sm-3">
                <div class="single-product">
                    <div class="product-f-image">
                        <img src="<?php echo base_url() . 'assets/' . end($src); ?>" alt="" style="width:100%; height:230px;">
                        <div class="product-hover">
                            <a class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Agregar</a>
                            <a href="<?php echo $link_detalles.$prod->idProducto; ?>"  class="view-details-link"><i class="fa fa-link"></i> Detalles</a>
                        </div>
                    </div>
                    <h2><a href="<?php echo $link_detalles. $prod->idProducto; ?>"><?php echo $prod->nombre ?></a></h2>
                    <p ><a href="<?php echo $link_detalles. $prod->idProducto; ?>"><?php echo 'Código:'.$prod->codigo ?></a></p>
                </div>
            </div>
        <?php } ?>
            <hr/>
        </div>
    </div>
</div>


