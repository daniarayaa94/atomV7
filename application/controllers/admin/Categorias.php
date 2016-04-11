<?php

class Categorias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
    }

    public function index()
    {

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();

        $data['content_for_layout'] = $this->load->view('admin/categorias/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);


    }



    public function agregarCategoria()
    {

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        //$this->layout->view('index',$data);

        $data['content_for_layout'] = $this->load->view('admin/categorias/agregarCategorias', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);


    }

    public function guardar(){
        if ($this->input->post()) {

            $this->load->model('admin/productos/categorias_model','cate',TRUE);

            $nombre = $this->input->post('inputNombre');
            $descripcion = $this->input->post('inputDescripcion');

            $this->cate->insertCategorias($nombre,$descripcion);

            redirect('admin/categorias');

        }

        redirect('admin/dashboard');
    }


}
