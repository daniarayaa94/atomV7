<div class="slider-area">
    <div class="zigzag-bottom"></div>
    <div id="slide-list" class="carousel carousel-fade slide" data-ride="carousel">

        <div class="slide-bulletz">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="carousel-indicators slide-indicators">
                            <li data-target="#slide-list" data-slide-to="0" class="active"></li>
                            <li data-target="#slide-list" data-slide-to="1"></li>
                            <li data-target="#slide-list" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="single-slide">
                    <div class="slide-bg slide-one"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>Tu tienes problemas, nosotros soluciones.</h2>
                                            <p>¿Necesita una alfombra, alguna herramientas, instalar algo?</p>
                                            <p>Contáctenos y cotice con nosotros, productos de calidad a buen precio y
                                                entrega veloz garantizada, la solución a sus problemas de insumos.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide">
                    <div class="slide-bg slide-two"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>Su negocio lo necesita, atom lo tiene.</h2>
                                            <p>Cientos de productos que pueden estar mañana en su negocio. Vemos las
                                                necesidades de nuestros clientes y en base
                                                a ellas vamos ampliando nuestro catálogo: Aseo, papeleria, afombras,
                                                herramientas; lo que usted necesite, Atom lo tiene.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide">
                    <div class="slide-bg slide-three"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>De personas, para personas</h2>
                                            <p>Como clientes también nos cansamos de tener que esperar y esperar lo que
                                                necesitamos 'ahora'.</p>
                                            <p>Nuestro comprmiso es la entrega rápida de productos de calidad y a
                                                precios convemientes para todo bolsillo, basta de pagar demas, Atom
                                                piensa en todos.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-refresh"></i>
                    <p>Siempre Disponibles</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping Santiago</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-lock"></i>
                    <p>Seriedad y Confianza</p>
                </div>
            </div>
            <a href="<?= $mostrar_todos; ?>" style="color: white">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-gift"></i>
                        <p>Miles de Productos</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Los más buscados</h2>
                    <div class="product-carousel">
                        <?php foreach ($mas_vistos as $popular) {
                            $img = explode(';', $popular->imagenes); ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="<?= $assets . end($img); ?>" style="width: 215px; height: 200px;">
                                    <div class="product-hover">
                                        <!--<a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Agregar</a>-->
                                        <a href="<?= $mostrar_detalle . $popular->idProducto; ?>"
                                           class="view-details-link"><i class="fa fa-link"></i>
                                            Detalles</a>
                                    </div>
                                </div>

                                <h2>
                                    <a href="<?= $mostrar_detalle . $popular->idProducto; ?>"><?php echo $popular->nombre; ?></a>
                                </h2>
                                <p style="color: #00a157">
                                    <a href="<?= $mostrar_detalle . $popular->idProducto; ?>"><?php echo 'Código: ' . $popular->codigo; ?></a>
                                    <span class="pull-right" style="color: #0c0c0c"><i
                                            class="fa fa-eye"></i><?= $popular->vecesVisto; ?></span>
                                </p>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<!--<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <h2 class="section-title">Marcas</h2>
                    <div class="brand-list">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__1.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__2.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__3.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__4.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__1.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__2.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__3.jpg" alt="">
                        <img src="<?php //echo base_url() ?>public/frontend/images/services_logo__4.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Más Vendidos</h2>
                    <a href="" class="wid-view-more">ver todos</a>
                    <?php foreach ($mas_vendidos as $vendido) {
                        $img = explode(';', $vendido->imagenes); ?>
                        <div class="single-wid-product">
                            <a><img src="<?= $assets . end($img); ?>" alt="<?= end($img); ?>" class="product-thumb"></a>
                            <h2><a href="<?= $mostrar_detalle . $vendido->idProducto ?>"><?= $vendido->nombre; ?></a>
                            </h2>

                            <div class="product-wid-price">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Más Nuevos</h2>
                    <a href="#" class="wid-view-more">Ver todos</a>
                    <?php foreach ($mas_nuevos as $newest) {
                        $img = explode(';', $newest->imagenes); ?>
                        <div class="single-wid-product">
                            <a><img src="<?= $assets . end($img); ?>" class="product-thumb"></a>
                            <h2><a href="<?= $mostrar_detalle . $newest->idProducto; ?>"> <?= $newest->nombre; ?></a>
                            </h2>

                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Más cotizados</h2>
                    <a href="#" class="wid-view-more">Ver todos</a>
                    <?php foreach ($mas_cotizados as $cotizado) {
                        $img = explode(';', $cotizado->imagenes); ?>
                        <div class="single-wid-product">
                            <a><img src="<?= $assets . end($img); ?>" alt="<?= end($img); ?>" class="product-thumb"></a>
                            <h2>
                                <a href="<?php echo $mostrar_detalle . $cotizado->idProducto; ?>"><?= $cotizado->nombre; ?></a>
                            </h2>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End product widget area -->
