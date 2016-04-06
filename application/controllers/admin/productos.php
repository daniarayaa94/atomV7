<?php

class Productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
        $this->load->helper(array('form', 'url'));
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
            $imagenes = implode(";",$_FILES['upload']['name']);


            // Count # of uploaded files in array
            $total = count($_FILES['upload']['name']);

            // Loop through each file
            for($i=0; $i<$total; $i++) {
                //Get the temp file path

                $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                //Make sure we have a filepath
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath =  getcwd()."/assets/" . $_FILES['upload']['name'][$i];

                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                    }
                }
            }


            $this->prod->insertProductos($nombre,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes);

            redirect("admin/productos");


        }




    }

    public function upload(){
        
    }

    

}