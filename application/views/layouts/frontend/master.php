<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo;?></title>
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/frontend/css/owl.carousel.css">
    <link rel="stylesheet" href="public/frontend/css/style.css">
    <link rel="stylesheet" href="public/frontend/css/responsive.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><b></b><a href="index.html">A<span><b>Tom</b></span></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="cart.html">Cart - <span class="cart-amunt">$800</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
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
            <div class="navbar-collapse collapse nav1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url(); ?>"><?php echo $titulo; ?></a></li>
                    <?php foreach ($categorias as $category ){ ?>
                        <li><a href="<?php echo $cat.$category->idCategoria ; ?>"><?php echo $category->nombre; ?></a>
                            <ul>
                                <li><a href="">item1</a></li>
                                <li><a href="">item1</a></li>
                                <li><a href="">item1</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->

<?php echo $content_for_layout; ?>

<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="footer-about-us">
                    <h2>A<span><b>TOM</b></b></span></h2>
                    <p>
                        Los clintes son nuestra inspiracion y sus satisfaccion nuestra meta.
                        Buscamos entregar productos de calidad a precios convenientes y en el menor tiempo posibles,
                        entendemos que si pide algo es porque lo necesitas y por ella, aseguramos que en 24hr tendrá
                        sus productos en sus manos.
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
                        <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=cotizaciones@atomoffice.cl">cotizaciones@atomoffice.cl</a></li>
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
                    <p>&copy; 2016 atom Office. Todos los derechos reservados. Creado con <i class="fa fa-heart"></i> por <a href="http://wpexpand.com" target="_blank">BlackRobot</a></p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="public/frontend/js/owl.carousel.min.js"></script>
<script src="public/frontend/js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="public/frontend/js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="public/frontend/js/main.js"></script>
</body>
</html>