<?php

class Productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
    }

    public function index()
    {

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);
        $this->load->model('admin/productos/productos_model','prod',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['productos_list'] = $this->prod->getProductos();

        $data['content_for_layout'] = $this->load->view('admin/productos/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);


    }



    public function agregarProducto()
    {
        
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();
        
        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['content_for_layout'] = $this->load->view('admin/productos/agregarProductos', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);


    }
    
    public function guardar(){
        if ($this->input->post()) {

            $this->load->model('admin/productos/productos_model','prod',TRUE);
            
            $nombre = $this->input->post('inputNombre');
            $marca = $this->input->post('inputMarca');
            $descripcion = $this->input->post('inputDescripcion');
            $stock = $this->input->post('inputStock');
            $shortname = $this->input->post('inputShortName');
            $categoria = $this->input->post('inputCategoria');

            $this->prod->insertProductos($nombre,$marca,$descripcion,$stock,$shortname,$categoria);
            
            redirect('admin/productos');
            
        }
    }

    

}