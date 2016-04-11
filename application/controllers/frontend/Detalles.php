<?php

class Detalles extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($producto)
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
        $data['titulo']           = $this->enviroment->get_setting('shop_name');
        $data['categorias']       = $this->categorias->listar();
        $data['url']              = base_url()."/frontend/clasificacion/index/";

        //child view
        $prod_information         = $this->producto->get_by_id($producto);
        $data['producto']         = $prod_information[0];
        $data['imagenes']         = explode(';',$prod_information[0]->imagenes);
        $data['assets']           = base_url().'assets/';

        $data['content_for_layout'] = $this->load->view('frontend/detalles', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

}
