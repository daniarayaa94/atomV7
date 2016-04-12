<?php

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
	public function index()
	{
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');

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

        //child view
        $data['mostrar_todos'] = base_url().'frontend/todos/';

        $data['content_for_layout'] = $this->load->view('frontend/index', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
	}
    
}
