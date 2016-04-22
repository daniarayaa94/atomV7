<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>¿Cómo Comprar?</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="alert alert-success">
        Estamos trabajando muy duro para tener lista la función de cotización y compra.
        Contáctenos directamente al número que aparece al final de esta página. Disculpe las molestias
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-sm-3 buy-conditions">
            <div>
                <i class="fa fa-5x fa-search-plus spin"></i>
                <p>Cotice</p>
            </div>
            <div class="ocultar">
                Navegue por las categorias o use nuestro buscador, vea los detalles y si le gusta lo agrega al carro.
            </div>
        </div>
        <div class="col-sm-3 buy-conditions">
            <div>
                <i class="fa fa-5x fa-envelope-o spin"></i>
                <p>Respondemos</p>
            </div>
            <div class="ocultar">
                Recibiremos su cotización y le mandaremos una respuesta con los precios de cada producto y el total.
            </div>
        </div>
        <div class="col-sm-3 buy-conditions">
            <div>
                <i class="fa fa-5x fa-thumbs-o-up spin"></i>
                <p>Aprueba</p>
            </div>
            <div class="ocultar">
                Si está de acuerdo con los precios, confirma su cotización como compra y nosotros hacemos el resto.
            </div>
        </div>
        <div class="col-sm-3 buy-conditions">
            <div>
                <i class="fa fa-5x fa-smile-o spin"></i>
                <p>Despacho</p>
            </div>
            <div class="ocultar">
                Una vez comcretada la compra, nuestros repartidores irán a su dirección y le entregarán sus productos en
                24hr o menos.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 green_shape">
            1
        </div>
        <div class="col-sm-4">
            <p class="condicion1">
                Muévase por las categorías o use nuestro buscador en la parte superior para encontrar el producto que
                quiera.
            </p>
        </div>
        <div class="col-sm-6">
            <img src="<?= $image_folder . 'buscando.png' ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p class="condicion1">
                Agregue lo que quiera al carro y cuando esté conforme, pinche aceptar y nuestros ejecutivos responderán
                con los precios
            </p>
        </div>
        <div class="col-sm-2 green_shape">
            2
        </div>
        <div class="col-sm-4" style="margin-left: 60px;">
            <p class="condicion1">
                Revise los precios y detalles que le enviaremos. Si está conforme, confirme como compra y ya está.
            </p>
        </div>
        <div class="col-sm-2 green_shape">
            3
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <img src="<?= $image_folder . 'sonriendo.png' ?>">
        </div>
        <div class="col-sm-4">
            <p id="compromiso">
                "Despacho en 24h o menos"
            </p>
            <h2>Formas de Pago</h2>
            <p>
            <ul>
                <li><b>Deposito</b></li>
                <li>Numero de cuenta</li>
                <li>Nombre</li>
                <li>Rut</li>
                <li><b>Cheque</b></li>
                <li>Dico semper id nec, te viderer intellegat inciderint eos, ei inani graeco has. Nam ridens numquam
                    id, ea dicit tollit tantas sed. Viris commune per ne. Te wisi explicari mel, apeirian sensibus vel
                    eu. Ad nisl quando electram est
                </li>
            </ul>
            </p>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(function () {  // $(document).ready shorthand
        $('.buy-conditions').each(function (item) {
            $(item).fadeIn(2000);
        });

    });
</script>