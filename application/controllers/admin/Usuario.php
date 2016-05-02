<?php

class Usuario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
        $this->load->helper(array('form', 'url'));
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
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);
        $this->load->model('admin/usuarios/usuarios_model','usua',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        /*************************INICIO PAGINACION********************************/

        $filters = array();

        $filter_nombre = trim($this->input->get('filter_nombre'));
        $filter_username = trim($this->input->get('filter_username'));
        $filter_correo = trim($this->input->get('filter_correo'));
        $filter_tipo = trim($this->input->get('filter_tipo'));


        if (isset($filter_nombre)) {
            $filters['filter_nombre'] = $filter_nombre;
        }

        if (isset($filter_username)) {
            $filters['filter_username'] = $filter_username;
        }

        if (isset($filter_correo)) {
            $filters['filter_correo'] = $filter_correo;
        }

        if (isset($filter_tipo)) {
            $filters['filter_tipo'] = $filter_tipo;
        }

        $total_row = sizeof($this->usua->getUsuarios($filters));

        $start = trim($this->input->get('per_page'));

        $filters['start'] = isset($start) ? ($start) : 0;
        $filters['limit'] = 10;

        /* Paginacion */

        $opciones = array();
        $opciones['per_page'] = $filters['limit'];
        $opciones['base_url'] = base_url() . "admin/usuario/lista/";
        $opciones['total_rows'] = $total_row;
        $opciones['page_query_string'] = TRUE;
        $opciones['uri_segment'] = isset($start) ? ($start) : 0 ;
        $opciones['last_link'] = '>>';
        $opciones['first_link'] = '<<';

        $this->pagination->initialize($opciones);

        $data["links"] = $this->pagination->create_links();
        $data['usuarios_list'] = $this->usua->getUsuarios($filters);
        $data['tipos_list'] = $this->usua->getTipos();
        $data['filter_nombre'] = $filter_nombre;
        $data['filter_username'] = $filter_username;
        $data['filter_correo'] = $filter_correo;
        $data['filter_tipo'] = $filter_tipo;
        
        $data['url_filter']       = base_url()."admin/usuario/lista/";

        /***************************FIN PAGINACION******************************/

        $data['content_for_layout'] = $this->load->view('admin/usuario/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function agregarUsuario()
    {
        $this->load->library('form_validation');

        $this->load->model('admin/usuarios/usuarios_model','usua',TRUE);
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);


        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputRut', 'Rut', 'required');
        $this->form_validation->set_rules('inputUsername', 'Username', 'required');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');
        $this->form_validation->set_rules('inputEmail', 'email', 'required');
        $this->form_validation->set_rules('inputDireccion', 'Direccion', 'required');

        $this->form_validation->set_message('required', '* Debes completar este campo.');

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/usuario/agregarUsuario', $data, TRUE);
            $this->load->view('layouts/admin/headerMaster',$data);

        }
        else
        {
            $this->guardar();
        }




    }

    public function delete($id = null){

        $this->load->model('admin/usuarios/usuarios_model','usua',TRUE);

        if ($this->input->post()) {

            foreach ($this->input->post('selected') as $userId) {
                $this->usua->deleteUsuario($userId);
            }

        }elseif ($id != null){
            $this->usua->deleteUsuario($id);
        }

        redirect("admin/usuario");


    }

    public function guardarCambiosEdicion($id){

        if ($this->input->post()) {

            $this->load->model('admin/usuarios/usuarios_model','usua',TRUE);

            $inputNombre = $this->input->post('inputNombre');
            $inputApellidos = $this->input->post('inputApellidos');
            $inputRut = $this->input->post('inputRut');
            $inputEmpresa = $this->input->post('inputEmpresa');
            $inputUsername = $this->input->post('inputUsername');
            $inputPassword = $this->encrypt_decrypt('encrypt',$this->input->post('inputPassword'));
            $inputEmail = $this->input->post('inputEmail');

            $inputGenero = $this->input->post('inputGenero');
            $inputDireccion = $this->input->post('inputDireccion');
            $inputTelefono = $this->input->post('inputTelefono');

            $imagenes = '';

            /*if (sizeof($_FILES['upload']['name']) > 0) {

                $imagenes = implode(";", $_FILES['upload']['name']);

                $total = count($_FILES['upload']['name']);

                for ($i = 0; $i < $total; $i++) {

                    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                    if ($tmpFilePath != "") {
                        $newFilePath = getcwd() . "/assets/" . $_FILES['upload']['name'][$i];

                        move_uploaded_file($tmpFilePath, $newFilePath);
                    }
                }

            }*/

            $this->usua->updateUsuario($id,$inputNombre,$inputApellidos,$inputRut,$inputEmpresa,$inputUsername,$inputPassword,$inputEmail,$inputGenero,$inputDireccion,$inputTelefono,$imagenes);

            redirect("admin/usuario");

        }
        
    }

    public function guardar(){

        if ($this->input->post()) {

            $this->load->model('admin/usuarios/usuarios_model','usua',TRUE);

            $inputNombre = $this->input->post('inputNombre');
            $inputApellidos = $this->input->post('inputApellidos');
            $inputRut = $this->input->post('inputRut');
            $inputEmpresa = $this->input->post('inputEmpresa');
            $inputUsername = $this->input->post('inputUsername');
            $inputPassword = $this->encrypt_decrypt('encrypt',$this->input->post('inputPassword'));
            $inputEmail = $this->input->post('inputEmail');

            $inputGenero = $this->input->post('inputGenero');
            $inputDireccion = $this->input->post('inputDireccion');
            $inputTelefono = $this->input->post('inputTelefono');

            $imagenes = '';

            /*if (sizeof($_FILES['upload']['name']) > 0) {

                $imagenes = implode(";", $_FILES['upload']['name']);

                $total = count($_FILES['upload']['name']);

                for ($i = 0; $i < $total; $i++) {

                    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                    if ($tmpFilePath != "") {
                        $newFilePath = getcwd() . "/assets/" . $_FILES['upload']['name'][$i];

                        move_uploaded_file($tmpFilePath, $newFilePath);
                    }
                }

            }*/

            $this->usua->insertUsuario($inputNombre,$inputApellidos,$inputRut,$inputEmpresa,$inputUsername,$inputPassword,$inputEmail,$inputGenero,$inputDireccion,$inputTelefono,$imagenes);

            redirect("admin/usuario");

        }

    }

    public function editar($id){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputRut', 'Rut', 'required');
        $this->form_validation->set_rules('inputUsername', 'Username', 'required');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');
        $this->form_validation->set_rules('inputEmail', 'email', 'required');
        $this->form_validation->set_rules('inputDireccion', 'Direccion', 'required');

        $this->form_validation->set_message('required', '* Debes completar este campo.');

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/usuarios/usuarios_model','usua',TRUE);

        $usuario = $this->usua->getUsuarioById($id);

        $usuario->password = $this->encrypt_decrypt('decrypt',$usuario->password);

        $data['usuario'] = $usuario;

        $imagen = '';
        
        $data['idUsuario'] = $id;

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/usuario/edit', $data, TRUE);

            $this->load->view('layouts/admin/headerMaster',$data);
        }else
        {
            $this->guardarCambiosEdicion($id);
        }
    }
    
    function encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'abc123.As';
        $secret_iv = 'abcd123.Asd';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }




}
