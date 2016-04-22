<?php

class Contacto extends CI_Controller{

    private $error = array();

    public function __construct()    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index(){
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
        $data['titulo'] = $this->enviroment->get_setting('shop_name');

        $data['categorias']     = $this->categorias->listar();
        $data['url']            = base_url()."frontend/clasificacion/index/categoria/";
        $data['search_action']  = base_url().'frontend/todos/index/';
        $data['img_empty_cart'] = base_url().'assets/empty-shop.png';
        $data['cart_qty']       = $this->cart->total_items();

        $data['url_filter']    = base_url().'frontend/todos/index/';
        $data['url_registro']  = base_url().'frontend/registro/index/';
        $data['mostrar_carro'] = base_url().'frontend/cart/mostrar/';

        //cargar items en carro de compras
        $data['carrito']       = array();

        foreach ($this->cart->contents() as $rowid => $producto){
            $data['carrito'][] = array( 'imagen'   => $producto['img'],
                'nombre'   => $producto['name'],
                'cantidad' => $producto['qty'],
                'rowid'    => $producto['rowid']);
        }

        //mostrar usuario y sesion iniciada
        if (!empty($this->session->userdata('usuario'))){
            $this->load->model("frontend/notificacion/Notificacion");

            $data['usuario']  = $this->session->userdata('usuario');
            $data['assets']   = base_url().'assets/';
            $data['total_notif'] = $this->Notificacion->count_not_read($data['usuario']->idUsuario);

            $data['logout']   = base_url().'frontend/Registro/logout';
        }

        //child view
        if ($this->session->userdata('success')){
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }else{
            $data['success'] = '';
        }

        $data['recordados'] = $this->input->post();

        foreach ($this->error as $keyword_error => $error_message){
            $data[$keyword_error] = $error_message;
        }

        $data['correo'] = base_url().'frontend/contacto/enviar';

        $data['content_for_layout'] = $this->load->view('frontend/contacto', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

    public function enviar()
    {
        if ($this->input->server('REQUEST_METHOD')=='POST' && $this->validateForm() ){
            $this->load->model('frontend/enviroment');
            $post = $this->input->post();

            $to      = $this->enviroment->get_setting('correo_contacto');
            $subject = 'Enviado desde Contactanos.-Atom Office.';
            $mensaje = $post['txtMensaje']. "\r\n\r\n" .'Atte '.$post['txtEmail'];
            $header  = "From:". $post['txtNombre']." <".$post['txtEmail'].">\r\n";

            mail($to, $subject, $mensaje, $header);

            $this->session->set_userdata('success','Muchas gracias por su mensaje.');
            redirect(base_url().'frontend/contacto');
        }else{
            $this->index();
        }


    }

    public function validateForm()
    {
        $post = $this->input->post();

        if (empty($post['txtNombre'])){
            $this->error['error_nombre'] = 'Por favor ingrese su nombre';
        }

        if (empty($post['txtEmail'])){
            $this->error['error_email'] = 'Debe indicar su direccion de correo por favor';
        }else{
            if (!filter_var($post['txtEmail'], FILTER_VALIDATE_EMAIL)){
                $this->error['error_email'] = 'Su direccion de correo no es válida';
            }
        }

        if (empty($post['txtMensaje'])){
            $this->error['error_mensaje'] = 'Debe escribir un mensaje que enviar';
        }

        return !$this->error;
    }

}