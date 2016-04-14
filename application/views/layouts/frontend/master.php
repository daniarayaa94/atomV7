<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/css/responsive.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <!--Zoom para las imagenes -->
    <script type="application/javascript"
            src="<?php echo base_url(); ?>public/frontend/js/Elevate_zoom/jquery-1.8.3.min.js" ?>"></script>
    <script type="application/javascript"
            src="<?php echo base_url(); ?>public/frontend/js/Elevate_zoom/jquery.elevatezoom.js" ?>"></script>
</head>

<body>
<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="logo">
                    <h1><a href="<?php echo base_url() . 'frontend/'; ?>"
                           style="color: #30BB39; font-weight: bold">a<span style="color: #000000"><b>tom</b></span></a>
                    </h1>
                </div>
            </div>
            <div class="col-sm-5" style="margin-top: 45px;">
                <div class="input-group">
                    <input id="search" type="text" class="form-control" placeholder="¿Podemos ayudarlo..?"/>
                      <span class="input-group-btn">
                        <button id="btn-filter" class="btn btn-success" type="button"><i class="fa fa-search"></i> IR!
                        </button>
                      </span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="shopping-item" id="cart">
                            <a>Ver Carrito <i class="fa fa-shopping-cart"></i> <span
                                    class="product-count"><?= $cart_qty; ?></span></a>
                        </div>
                    </div>
                    <?php if (!empty($usuario)) { ?>
                        <div class="dropdown col-sm-4 profile">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <img
                                    src="<?= $assets . (!empty($usuario->fotoPerfil) ? $usuario->fotoPerfil : 'prof.png'); ?>"
                                    alt=""
                                    style="height: 35px; width: 35px;"
                                    />
                                <?= $usuario->username; ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Editar perfil</a></li>
                                <li><a href="#">Mis cotizaciones</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?= $logout; ?>">Salir</a></li>
                            </ul>
                            <?php if (!empty($total_notif)){ ?>
                                <span class="product-count" style="right: 5px;"><?= $total_notif; ?></span>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-4 shopping-item" style="margin-left: 0;">
                            <a href="<?= $url_registro; ?>" class="login">Login <i class="fa fa-key"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url() . 'frontend/'; ?>"><?php echo strtolower($titulo); ?></a></li>
                    <?php foreach ($categorias as $category) { ?>
                        <li>
                            <a href="<?php echo $url . $category['idCategoria']; ?>"><?php echo ucfirst(strtolower($category['nombre'])); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->

<div class="shopping-cart toggle-cart">
    <div class="cart-title">Carro de cotización</div>
    <div class="row">
        <div class="col-sm-3 header">Imagen</div>
        <div class="col-sm-3 header">Producto</div>
        <div class="col-sm-3 header">Cantidad</div>
        <div class="col-sm-3 header">Eliminar</div>
    </div>
    <?php if (count($carrito) > 0) { ?>
        <form action="" method="POST">
            <div id="shopping-cart-content">
                <?php foreach ($carrito as $key => $item) { ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= $item['imagen'] ?>" alt="cart-image" class="img-circle"/>
                        </div>
                        <div class="col-sm-3"><?= $item['nombre'] ?></div>
                        <div class="col-sm-3">
                            <input type="text" value="<?= $item['cantidad'] ?>" name="<?= $item['rowid']; ?>"
                                   id="qty-box"/>
                        </div>
                        <div class="col-sm-3" id="del-item[]" title="<?= $item['rowid']; ?>"><i class="fa fa-trash"></i>
                        </div>
                    </div>
                <?php } ?>
                <div>
                    <p>*Esta es información de resumen de los productos agregados al carro de cotización.
                        Pinchando Aceptar podrá ver el carro en pantalla completa y editarlo con más comodidad.</p>
                    <input type="submit" value="Aceptar" class=""/>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <div id="div-empty-cart">
            <img src="<?= $img_empty_cart; ?>" alt="carrito_vacio" style="width: 300px;height: 200px">
            <p>Su carro de cotización se encuentra vacío. Ponga el mouse sobre la imagen y luego precione
                Agregar para añadir al carrito. Muchas Gracias.</p>
        </div>
    <?php } ?>
</div>

<div>
    <?php echo $content_for_layout; ?>
</div>

<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="footer-about-us">
                    <h2 style="color: white;">atom</h2>
                    <p>
                        Los clientes son nuestra inspiracion y su satisfaccion nuestra meta.
                        Buscamos entregar los mejores productos de calidad a precios convenientes y en el menor tiempo
                        posible,
                        entendemos que si cotiza productos con nosotros es porque lo necesita urgente, por ende,
                        le aseguramos que en menos de 24hr tendrá los productos en sus manos.
                    </p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Servicio al Cliente</h2>
                    <ul>
                        <li><a href="#">Despacho</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Cómo Comprar</a></li>
                        <li><a href="#">Condicionnes comerciales</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Contáctenos</h2>
                    <ul>
                        <li><h2 style="color: #00a65a">(2) 6785876</h2></li>
                        <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=cotizaciones@atomoffice.cl">cotizaciones@atomoffice.cl</a>
                        </li>
                        <li><a href="#">Av. Vickuña Mackenna #4589.</a></li>
                        <li><a href="#">Lunes a Sábado 8:30-20:00</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy; 2016 atom Office. Todos los derechos reservados. Creado con <i class="fa fa-heart"></i>
                        por <a href="http://wpexpand.com" target="_blank">BlackRobot</a></p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<script type="application/javascript">
    //agregar al carro de cotzaciones

    $(".add-to-cart-link").on('click', function (event) {
        var id = $(this).attr('id');
        var name = $(this).attr('name');
        var src = $(this).parent().parent().children().attr('src');
        $.ajax({
            url: "<?= base_url() . 'frontend/cart/agregar' ?>",
            type: 'POST',
            context: document.body,
            data: {id: id, name: name, imagen: src}
        }).done(function (params) {
            location.reload();
        });
    });
    //Buscar productos
    $('#btn-filter').on('click', function () {
        var text = $('#search').val();
        if (text) {
            location = "<?= $url_filter; ?>" + "/name_prod/" + encodeURI(text);
        }
    });

    <!--Actualizar cantidad de product especifico-->
    $("input[id*='qty-box']").focusout(function () {
        var rowid = $(this).attr('name');
        var qty = $(this).val();
        $.ajax({
            url: "<?= base_url() . 'frontend/cart/actualizar' ?>",
            type: 'POST',
            context: document.body,
            data: {rowid: rowid, qty: qty}
        }).done(function (params) {
            location.reload();
        });
    });

    <!--Eliminar del carro-->
    $("div[id*='del-item']").on('click', function () {
        var rowid = $(this).attr('title');
        $.ajax({
            url: "<?= base_url() . 'frontend/cart/eliminar' ?>",
            type: 'POST',
            context: document.body,
            data: {rowid: rowid}
        }).done(function (params) {
            location.reload();
        });
    });


    <!--Animacion del carrito-->
    var hide = true;
    $('#cart').on('click', function () {
        if (hide) {
            $('.shopping-cart').animate({
                'marginRight': "+=400px"
            }, 1000);
            hide = false;
        } else {
            $('.shopping-cart').animate({
                'marginRight': "-=400px"
            }, 1000);
            hide = true;
        }
    });
</script>

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>
<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- jQuery sticky menu -->
<script src="<?php echo base_url(); ?>public/frontend/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/js/jquery.sticky.js"></script>
<!-- jQuery easing -->
<script src="<?php echo base_url(); ?>public/frontend/js/jquery.easing.1.3.min.js"></script>
<!-- Main Script -->
<script src="<?php echo base_url(); ?>public/frontend/js/main.js"></script>
</body>
</html>



