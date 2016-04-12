<?php

class Detalles extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
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
        $prod_information         = $this->producto->get_by_id($id);
        $data['producto']         = $prod_information[0];
        $data['imagenes']         = explode(';',$prod_information[0]->imagenes);
        $data['assets']           = base_url().'assets/';

        $data['content_for_layout'] = $this->load->view('frontend/detalles', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

}
