
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$shop_name?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/public/admin/dist/css/AdminLTE.css">
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/admin/dist/css/skins/_all-skins.min.css">

    <script src="<?php echo base_url()?>/public/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url()?>/public/admin/bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link href="<?php echo base_url()?>/public/admin/dist/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url()?>/public/admin/dist/js/fileinput.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>/public/admin/dist/js/fileinput_locale_es.js" type="text/javascript"></script>

    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

    <script>
        $('#file-es').fileinput({
            language: 'es',
            allowedFileExtensions : ['jpg', 'png','gif'],
        });

    </script>


</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->

        <a href="dashboard" class="logo">
            <span class="logo-mini"><b><?=$shop_name?></b></span>
            <span class="logo-lg"><b><?=$shop_name?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>

                        <a href="<?php base_url();?>login/cerrar_sesion"><span class="hidden-xs hidden-sm hidden-md">Cerrar sesion </span> <i class="fa fa-sign-out fa-lg"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url()?>/public/admin/dist/img/avatar5.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $this->session->userdata('admin')['nombre'];?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"><?=$shop_name?></li>

                <li <?php if($this->uri->segment(2) == 'dashboard'){echo 'class="treeview active"';}?>>
                    <a href="<?php echo base_url()?>admin/dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li <?php if($this->uri->segment(2) == 'productos' || $this->uri->segment(2) == 'categorias'){echo 'class="treeview active"';}?>>
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Catalogo</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if($this->uri->segment(2) == 'productos'){echo 'class="active"';}?>><a href="<?php echo base_url()?>admin/productos"><i class="fa fa-circle-o"></i> Productos</a></li>
                        <li <?php if($this->uri->segment(2) == 'categorias'){echo 'class="active"';}?>><a href="<?php echo base_url()?>admin/categorias"><i class="fa fa-circle-o"></i> Categorias</a></li>

                    </ul>
                </li>

               <!-- <li <?php if($this->uri->segment(2) == 'mailbox'){echo 'class="treeview active"';}?>>
                    <a href="<?php echo base_url()?>admin/mailbox">
                        <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    </a>
                </li> -->

                <li <?php if($this->uri->segment(2) == 'cotizaciones' || $this->uri->segment(3) == 'historialCotizaciones'){echo 'class="treeview active"';}?>>
                    <a href="#">
                        <i class="fa fa-cart-plus"></i>
                        <span>Cotizaciones</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if($this->uri->segment(2) == 'cotizaciones' && $this->uri->segment(3) == ''){echo 'class="active"';}?>><a href="<?php echo base_url()?>admin/cotizaciones"><i class="fa fa-circle-o"></i>Coti. Solicitadas</a></li>
                        <li <?php if($this->uri->segment(3) == 'historialCotizaciones'){echo 'class="active"';}?>><a href="<?php echo base_url()?>admin/cotizaciones/historialCotizaciones"><i class="fa fa-circle-o"></i>Historial Cotizaciones</a></li>
                    </ul>

                </li>

                <li <?php if($this->uri->segment(2) == 'usuario'){echo 'class="treeview active"';}?>>
                    <a href="<?php echo base_url()?>admin/usuario">
                        <i class="fa fa-users"></i> <span>Usuarios</span>
                    </a>
                </li>


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>


    <?php echo $content_for_layout; ?>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2016-2016 <a href="">Blackrobot</a>.</strong> Todos los derechos Reservados.
    </footer>

    <div class="control-sidebar-bg"></div>
</div>


<!-- jQuery 2.1.4 -->



<!-- FastClick -->
<script src="<?php echo base_url()?>/public/admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>/public/admin/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>/public/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url()?>/public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()?>/public/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url()?>/public/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url()?>/public/admin/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()?>/public/admin/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>/public/admin/dist/js/demo.js"></script>



<!-- DataTables -->
<script src="<?php echo base_url()?>public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>public/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>public/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>


<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>




</body>
</html>