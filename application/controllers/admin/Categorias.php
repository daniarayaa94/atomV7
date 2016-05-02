<?php

class Categorias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');

        if (!sizeof($this->session->userdata('admin')) > 0){

            redirect('admin/login');

        }

    }

    public function index()
    {
        $this->lista();
    }

    public function lista(){
        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        /*********************/
        
        $filters = array( 'ncategoria' => null);
        $data['url_filter']       = base_url()."admin/categorias/lista/";

        $ncategoria = trim($this->input->get('ncategoria'));

        if (isset($ncategoria)) {
            $filters['ncategoria'] = $ncategoria;
        }


        $total_row = sizeof($this->cate->getCategorias($filters));
        $start = trim($this->input->get('per_page'));
        
        /* Paginacion */
        $filters['start'] = isset($start) ? ($start) : 0;
        $filters['limit'] = 10;

        $opciones = array();
        $opciones['per_page'] = $filters['limit'];

        if(!empty($filters['ncategoria'])){
            $opciones['base_url'] = base_url() . 'admin/categorias/lista/?ncategoria='.$filters['ncategoria'];
        }else{
            $opciones['base_url'] = base_url() . "admin/categorias/lista/";
        }

        $opciones['total_rows'] = $total_row;
        $opciones['page_query_string'] = TRUE;
        $opciones['uri_segment'] = isset($start) ? ($start) : 0 ;
        $opciones['last_link'] = '>>';
        $opciones['first_link'] = '<<';

        $this->pagination->initialize($opciones);
        $data["links"] = $this->pagination->create_links();
        
        $data['categorias_list'] = $this->cate->getCategorias($filters);
        
        /*********************/


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
