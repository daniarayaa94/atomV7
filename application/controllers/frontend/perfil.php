<?php

class Perfil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        if ($this->session->userdata('usuario') != null) {
            $data = $this->enviroment->getNotificaciones($this->session->userdata('usuario')->idUsuario);
        }

        //master params
        $data['titulo'] = $this->enviroment->get_setting('shop_name');

        $data['categorias'] = $this->categorias->listar();
        $data['url'] = base_url() . "frontend/clasificacion/index/categoria/";
        $data['search_action'] = base_url() . 'frontend/todos/index/';
        $data['img_empty_cart'] = base_url() . 'assets/empty-shop.png';
        $data['cart_qty'] = $this->cart->total_items();

        $data['url_filter'] = base_url() . 'frontend/todos/index/';
        $data['url_registro'] = base_url() . 'frontend/registro/index/';
        $data['mostrar_carro'] = base_url() . 'frontend/cart/mostrar/';

        //cargar items en carro de compras
        $data['carrito'] = array();

        foreach ($this->cart->contents() as $rowid => $producto) {
            $data['carrito'][] = array('imagen' => $producto['img'],
                'nombre' => $producto['name'],
                'cantidad' => $producto['qty'],
                'rowid' => $producto['rowid']);
        }

        //mostrar usuario y sesion iniciada
        if (!empty($this->session->userdata('usuario'))) {
            $this->load->model("frontend/notificacion/Notificacion");

            $data['usuario'] = $this->session->userdata('usuario');
            $data['assets'] = base_url() . 'assets/';
            $data['total_notif'] = $this->Notificacion->count_not_read($data['usuario']->idUsuario);

            $data['logout'] = base_url() . 'frontend/Registro/logout';
        }

        //child view

        if ($this->session->userdata("success")){
            $data['success'] = $this->session->userdata("success");
            $this->session->unset_userdata("success");
        }else{
            $data['success'] = '';
        }

        $data['image_folder'] = base_url() . 'public/frontend/images/';
        $data['editar'] = base_url() . 'frontend/perfil/editar';

        $data['content_for_layout'] = $this->load->view('frontend/perfil', $data, TRUE);
        $this->load->view('layouts/frontend/master', $data);
    }

    public function upload()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $aux = explode('\\', $this->input->post('filename'));
            $img = end($aux);
            if (is_uploaded_file($this->input->post('filename'))) {
                move_uploaded_file($this->input->post('filename'), base_url() . 'assets' . $img);
                echo $img;
            } else {
                echo 'no se puede acceder al archivo ';
            }
        } else {
            redirect(base_url() . 'frontend');
        }
    }

    public function editar()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $post = $this->input->post();
            $user_info = $this->session->userdata("usuario");
            $data = array("nombre" => null,
                "apellidos" => null,
                "username" => null,
                "password" => null,
                "correoContacto" => null,
                "genero" => null,
                "rut" => null,
                "direccion" => null,
                "telefono" => null
            );

            if (!empty($post['txtNombre'])) {
                $data['nombre'] = $post['txtNombre'];
            }

            if (!empty($post['txtApellidos'])) {
                $data['apellidos'] = $post['txtApellidos'];
            }

            if (!empty($post['txtRut'])) {
                $data['rut'] = $post['txtRut'];
            }

            if (!empty($post['rbGenero'])) {
                $data['genero'] = $post['rbGenero'];
            }
            if (!empty($post['txtEmail'])) {
                $data['correoContacto'] = $post['txtEmail'];
            }

            if (!empty($post['txtDireccion'])) {
                $data['direccion'] = $post['txtDireccion'];
            }

            if (!empty($post['txtTelefono'])) {
                $data['telefono'] = $post['txtTelefono'];
            }

            if (!empty($post['txtUser'])) {
                $data['username'] = $post['txtUser'];
            }

            if ($user_info->password == $post['txtPassAnt']) {
                if ($post["txtPass"] == $post["txtPassConfirma"]) {
                    $data['password'] = $post["txtPass"];
                } else {
                    //error password no coinciden
                }
            } else {
                //error password anterior no es correcta
            }

            $this->load->model("frontend/registro/usuario");
            $result = $this->usuario->update($user_info->idUsuario, $data);

            if ($result){
                $new_user = $this->usuario->get_user_by_id($user_info->idUsuario);
                $this->session->set_userdata("usuario", $new_user);
                $this->session->set_userdata('success', 'Sus datos fueron actualizados correctamente!');
            }

            redirect(base_url() . "frontend/perfil");

        } else {
            redirect(base_url() . "frontend");
        }
    }
}