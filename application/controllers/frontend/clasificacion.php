<?php

class Clasificacion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($categoria)
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');

        //master params
        $data['titulo']           = $this->enviroment->get_setting('shop_name');
        $data['categorias']       = $this->categorias->listar();
        $data['url']              = base_url()."/frontend/clasificacion/index/";

        //child view
        $category_info            = $this->categorias->listar($categoria);
        $data['cat_seleccionada'] = $category_info[0]['nombre'];
        $data['imagenes']         = $this->categorias->get_images($categoria);
        $data['productos']        = $this->categorias->get_all_prods($categoria);
        $data['title_bground']    = "background: url(".base_url()."frontend/images/crossword.png) repeat scroll 0 0 #30BB39";
        $data['no_results']       = base_url().'/public/frontend/images/no_productos.png';

        $data['link_detalles']    = base_url().'frontend/detalles/index/';

        $data['content_for_layout'] = $this->load->view('frontend/clasificacion', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

}