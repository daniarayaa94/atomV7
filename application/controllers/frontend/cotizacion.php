<?php

class Cotizacion extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($cotizacion)
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/Producto');
        $this->load->model('frontend/cotizacion/Cotizacion');
        $this->load->model('frontend/cotizacion/Detalle');

        $data['titulo'] = $this->enviroment->get_setting('shop_name');

        $data['categorias']     = $this->categorias->listar();
        $data['url']            = base_url()."frontend/clasificacion/index/categoria/";
        $data['search_action']  = base_url().'frontend/todos/index/';
        $data['img_empty_cart'] = base_url().'assets/empty-shop.png';
        $data['cart_qty']       = $this->cart->total_items();

        $data['url_filter']    = base_url().'frontend/todos/index/';
        $data['url_registro']  = base_url().'frontend/registro/index/';

        //cargar items en carro de compras
        $data['carrito']       = array();

        foreach ($this->cart->contents() as $rowid => $producto){
            $data['carrito'][] = array( 'imagen'   => $producto['img'],
                'nombre'   => $producto['name'],
                'cantidad' => $producto['qty'],
                'rowid'    => $producto['rowid']);
        }

        $data['mostrar_carro'] = base_url().'frontend/cart/mostrar/';

        //mostrar usuario y sesion iniciada
        if (!empty($this->session->userdata('usuario'))){
            $this->load->model("frontend/notificacion/Notificacion");

            $data['usuario']  = $this->session->userdata('usuario');
            $data['assets']   = base_url().'assets/';
            $data['total_notif'] = $this->Notificacion->count_not_read($data['usuario']->idUsuario);

            $data['logout']   = base_url().'frontend/Registro/logout';
        }

        //child view
        $data['image_folder'] = base_url().'public/frontend/images/';

        $data['mostrar_precios'] = $this->Cotizacion->have_permission_for_show_price($cotizacion);
        $data['detalles']        = $this->Detalle->get_by_cotizacion($cotizacion);


        $data['content_for_layout'] = $this->load->view('frontend/cond_comerciales', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

    
}