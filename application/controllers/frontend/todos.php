<?php

class Todos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');

        //master params
        $data['titulo']           = $this->enviroment->get_setting('shop_name');
        $data['categorias']       = $this->categorias->listar();
        $data['url']              = base_url()."frontend/clasificacion/index/categoria/";
    }
}