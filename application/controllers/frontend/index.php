<?php

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('frontend');
    }
    
	public function index()
	{
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');

        $data['titulo'] = $this->enviroment->get_setting('shop_name');

        $data['categorias'] = $this->categorias->listar();
        $data['url']        = base_url()."frontend/clasificacion/index/";

        $data['content_for_layout'] = $this->load->view('frontend/index', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
	}
    
}