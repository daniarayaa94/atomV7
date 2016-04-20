<?php

class Categorias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->lista();
    }

    public function lista(){
        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();

        $total_row = sizeof($this->cate->getCategorias());

        /*********************/

        $config = array();
        $config["base_url"] = base_url() . "admin/categorias/lista";
        $config["total_rows"] = $total_row;
        $config["per_page"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 1;
        }
        
        $offset = $page * $config["per_page"];

        $data["offset"] = $offset;
        $data["results"] = $this->cate->fetch_data($config["per_page"],$offset);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        /*********************/


        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['content_for_layout'] = $this->load->view('admin/categorias/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function agregarCategoria()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputDescripcion', 'Descripcion', 'required');

        $this->form_validation->set_message('required', '* Debes completar este campo.');

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        //$this->layout->view('index',$data);
        if ($this->form_validation->run() == FALSE) {

            $data['content_for_layout'] = $this->load->view('admin/categorias/agregarCategorias', $data, TRUE);

            $this->load->view('layouts/admin/headerMaster', $data);
        }else{
            $this->guardar();
        }


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

    public function delete($id = null){

        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        if ($this->input->post()) {

            foreach ($this->input->post('selected') as $catID) {
                $this->cate->deleteCategoria($catID);
            }

        }elseif ($id != null){
            $this->cate->deleteCategoria($id);
        }

        redirect("admin/categorias");


    }

    public function guardarCambiosEdicion($id){

        if ($this->input->post()) {

            $this->load->model('admin/productos/categorias_model','cate',TRUE);

            $nombre = $this->input->post('inputNombre');
            $descripcion = $this->input->post('inputDescripcion');

            $this->cate->updateCategoria($id,$nombre,$descripcion);

            redirect("admin/categorias");

        }




    }

    public function editar($id){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputDescripcion', 'Descripcion', 'required');

        $this->form_validation->set_message('required', '* Debes completar este campo.');

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['categoria'] = $this->cate->getCategoriaById($id);

        $data['idCategorias'] = $id;

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/categorias/edit', $data, TRUE);

            $this->load->view('layouts/admin/headerMaster',$data);
        }else
        {
            $this->guardarCambiosEdicion($id);
        }
    }

}
