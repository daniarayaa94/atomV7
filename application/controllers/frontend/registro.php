<?php

class Registro extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        redirect(base_url().'frontend/');

        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
        $data['titulo'] = $this->enviroment->get_setting('shop_name');

        $data['categorias']     = $this->categorias->listar();
        $data['url']            = base_url() . "frontend/clasificacion/index/categoria/";
        $data['search_action']  = base_url() . 'frontend/todos/index/';
        $data['img_empty_cart'] = base_url() . 'assets/empty-shop.png';
        $data['cart_qty']       = $this->cart->total_items();

        $data['url_filter']     = base_url() . 'frontend/todos/index/';
        $data['url_registro']   = base_url() . 'frontend/registro/index/';
        $data['mostrar_carro']  = base_url().'frontend/cart/mostrar/';

        //cargar items en carro de compras
        $data['carrito'] = array();

        foreach ($this->cart->contents() as $rowid => $producto) {
            $data['carrito'][] = array('imagen' => $producto['img'],
                'nombre' => $producto['name'],
                'cantidad' => $producto['qty'],
                'rowid' => $producto['rowid']);
        }


        //child view

        $data['registro_persona'] = base_url() . 'frontend/registro/registrar/';
        $data['entrar'] = base_url() . 'frontend/registro/login/';

        $data['tipo'] = "persona";

        $data['content_for_layout'] = $this->load->view('frontend/registro', $data, TRUE);
        $this->load->view('layouts/frontend/master', $data);
    }

    public function registrar()
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
        $data['titulo'] = $this->enviroment->get_setting('shop_name');

        $data['categorias'] = $this->categorias->listar();
        $data['url'] = base_url() . "frontend/clasificacion/index/categoria/";
        $data['search_action'] = base_url() . 'frontend/todos/index/';
        $data['img_empty_cart'] = base_url() . 'assets/empty-shop.png';
        $data['cart_qty'] = $this->cart->total_items();

        $data['url_filter'] = base_url() . 'frontend/todos/index/';
        $data['url_registro'] = base_url() . 'frontend/registro/index/';

        //cargar items en carro de compras
        $data['carrito'] = array();

        foreach ($this->cart->contents() as $rowid => $producto) {
            $data['carrito'][] = array('imagen' => $producto['img'],
                'nombre' => $producto['name'],
                'cantidad' => $producto['qty'],
                'rowid' => $producto['rowid']);
        }

        //child view

        $data['registro_persona'] = base_url() . 'frontend/registro/registrar/';
        $data['entrar'] = base_url() . 'frontend/registro/login/';

        $this->load->model('frontend/registro/usuario');
        $post = $this->input->post();

        $data['tipo'] = "persona";

        if ($this->validaRut($post['txt_rut'])) {
            if (isset($post['r_sexo']) && !empty($post['r_sexo'])) {
                //insertar cuenta persona
                $info = array("nombre" => $post['txt_nombre'],
                    "apellidos" => $post['txt_apellidos'],
                    "rut" => $post['txt_rut'],
                    "genero" => $post['r_sexo'],
                    "correoContacto" => $post['txt_email'],
                    "direccion" => $post['txt_direccion'],
                    "username" => $post['txt_user'],
                    "password" => md5($post['txt_pass']),
                    "idTipo" => 1,
                    "telefono" => $post['txt_cel']);
            } else {
                //insertar cuenta como empresa
                $info = array("nombre" => $post['txt_nombre'],
                    "empresa" => $post['txt_nombreemp'],
                    "rut" => $post['txt_rut'],
                    "correoContacto" => $post['txt_email'],
                    "direccion" => $post['txt_dir_emp'],
                    "username" => $post['txt_usuario'],
                    "password" => md5($post['txt_clave']),
                    "telefono" => $post['txt_tel'],
                    "idTipo" => 1);

                $data['tipo'] = "empresa";
            }

            $result = $this->usuario->insert($info);

            if ($result->status) {
                $data['success'] = "Se a registrado exitosamente su cuenta " . $post['txt_nombre'];
                $data['recordados'] = array();
            } else {
                $data['error'] = $post['txt_user'] . " ya está registrado como nombre de usuario, por favor use uno diferente.";
                $data['recordados'] = $post;
            }
        } else {
            $data['recordados'] = $post;
            $data['error'] = "El rut ingresado no es válido, recuerde escribirlo sin puntos y con el guión al final";
        }

        $data['content_for_layout'] = $this->load->view('frontend/registro', $data, TRUE);
        $this->load->view('layouts/frontend/master', $data);
    }

    public function login()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('frontend/registro/usuario');

            $usuario = $this->input->post('txt_user');
            $pass = $this->input->post('txt_pass');

            $user_info = $this->usuario->login($usuario, $pass);

            if ($user_info['status']) {
                $this->session->set_userdata('usuario', $user_info['data']);
                redirect(base_url() . 'frontend/');
            } else {
                echo "ERROR";
            }
        }
    }

    function logout()
    {
        //cerrar sesion de usuario
        $this->session->unset_userdata('usuario');
        //quitar productos del carro
        $this->cart->destroy();
        //redireccionar a pagina de inicio de la tienda.
        redirect(base_url().'frontend/');
    }

    private function validaRut($rut)
    {
        if (strlen($rut) > 5) {
            $suma = 0;
            if (strpos($rut, "-") == false) {
                $RUT[0] = substr($rut, 0, -1);
                $RUT[1] = substr($rut, -1);
            } else {
                $RUT = explode("-", trim($rut));
            }
            $elRut = str_replace(".", "", trim($RUT[0]));
            $factor = 2;
            for ($i = strlen($elRut) - 1; $i >= 0; $i--):
                $factor = $factor > 7 ? 2 : $factor;
                $suma += $elRut{$i} * $factor++;
            endfor;
            $resto = $suma % 11;
            $dv = 11 - $resto;
            if ($dv == 11) {
                $dv = 0;
            } else if ($dv == 10) {
                $dv = "k";
            } else {
                $dv = $dv;
            }
            if ($dv == trim(strtolower($RUT[1]))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}