<?php

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/header_login');
        
    }
    
	public function index()
	{

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['titulo'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['content_for_layout'] = $this->load->view('admin/login/index', $data, TRUE);
        $data['url_logout'] = base_url()."admin/login/cerrar_sesion";
        $this->load->view('layouts/admin/header_login',$data);


	}

    public function iniciar_sesion_post() {
        if ($this->input->post()) {

            $username = $this->input->post('email');
            $password = $this->input->post('password');
  
            $this->load->model('admin/login/login_model','login',TRUE);

            $usuario = $this->login->login($username,$password);

            if ($usuario) {
                $usuario_data = array(
                    'idUsuario' => $usuario->row()->idUsuario,
                    'nombre' => $usuario->row()->nombre,
                    'logueado' => TRUE
                );

                $this->session->set_userdata('admin',$usuario_data);

                redirect('admin/dashboard');
            } else {
                redirect('admin');
            }

        } else {
            $this->index();
        }
    }


    public function cerrar_sesion() {

        $this->session->unset_userdata('admin');
        redirect('admin');
    }
    
    
}
