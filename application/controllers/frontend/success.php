<?php

class Success extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        $data = array();

        //master params
        $data['titulo']           = $this->enviroment->get_setting('shop_name');
        $data['categorias']       = $this->categorias->listar();
        $data['url']              = base_url()."frontend/todos/index/";
        $data['img_empty_cart']   = base_url().'assets/empty-shop.png';
        $data['cart_qty']         = $this->cart->total_items();
        $data['url_registro']     = base_url().'frontend/registro/index/';
        $data['mostrar_carro']    = base_url().'frontend/cart/mostrar/';

        $data['content_for_layout'] = $this->load->view('frontend/success', $data, TRUE);
        $this->load->view('layouts/frontend/master', $data);
    }
}