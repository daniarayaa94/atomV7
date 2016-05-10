<?php

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function mostrar()
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
        $data['url'] = base_url() . "frontend/todos/index/";
        $data['img_empty_cart'] = base_url() . 'assets/empty-shop.png';
        $data['cart_qty'] = $this->cart->total_items();
        $data['url_registro'] = base_url() . 'frontend/registro/index/';
        $data['mostrar_carro'] = base_url() . 'frontend/cart/mostrar/';
        $data['logout']   = base_url().'frontend/Registro/logout';
        $data['url_filter']   = '';

        //cargar items en carro de compras
        $data['carrito'] = array();

        foreach ($this->cart->contents() as $rowid => $producto) {
            $info = $this->producto->get_by_id($producto['id']);
            $aux = explode(";", $info->imagenes);
            $img = base_url().'assets/'.end($aux);
            $data['carrito'][] = array('imagen'    => $img,
                                        'nombre'   => $info->nombre,
                                        'cantidad' => $producto['qty'],
                                        'rowid'    => $producto['rowid'],
                                        'codigo'   => $info->codigo,
                                        'marca'    => $info->marca,
                                        'id'       => $producto['id']);

        }

        //mostrar usuario y sesion iniciada
        if (!empty($this->session->userdata('usuario'))) {
            $data['usuario'] = $this->session->userdata('usuario');
            $data['assets'] = base_url() . 'assets/';
        }

        $data['link_mostrar_detalles'] = base_url().'frontend/detalles/index/';

        //child View
        $data['confirmacion'] = base_url() . 'frontend/Cart/enviar_cotizacion';


        $data['content_for_layout'] = $this->load->view('frontend/carrito', $data, TRUE);
        $this->load->view('layouts/frontend/master', $data);
    }

    function enviar_cotizacion()
    {

        if ($this->session->userdata('usuario')) {

            $this->load->model('frontend/cotizacion/Detalle');
            $this->load->model('frontend/cotizacion/Cotizacion');
            $this->load->model('frontend/producto/Producto');

            $user_info = $this->session->userdata('usuario');
            $cotizacion = $this->Cotizacion->iniciar($user_info->idUsuario);

            $total = 0;

            foreach ($this->cart->contents() as $key => $item) {
                $info = $this->Producto->get_precio_venta($item['id']);

                if ($info['promocion']) {
                    $item['subtotal'] = $info['promocion']->valor * $item['qty'];
                } else {
                    $item['subtotal'] = $info['normal']->valor * $item['qty'];
                }

                $total += $item['subtotal'];
                $this->Detalle->insert($cotizacion, $item);
            }

            //actualizar total de cotizacion
            $this->Cotizacion->terminar($cotizacion, $total);

            $this->cart->destroy();

            //enviar correo
            $to = 'projectatomoffice@gmail.com';
            $subject = "Solicitud de Cotizacion";
            $txt = "Por favor responder con los precios de productos solicitados";
            $headers = "From: " . $user_info->correoContacto . "\r\n";

            mail($to, $subject, $txt, $headers);

            redirect(base_url() . 'frontend/Success');

        } else {
            redirect(base_url() . 'frontend/registro');
        }
    }

    function agregar()
    {
        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $this->load->model('frontend/producto/Producto');

            $id = $this->input->post('id');

            //si el producto a agregar ya se encuentra en el carro, aumentamos su cantidad
            foreach ($this->cart->contents() as $producto) {
                if ($id == $producto['id']) {
                    $producto['qty']++;
                    $update_data = array('rowid' => $producto['rowid'], 'qty' => ($producto['qty']));
                }
            }

            //si el porducto no está incluido en el carro, lo agregamos.
            if (!isset($update_data)) {
                $prod = $this->Producto->get_by_id($id);
                $img = explode(";", $prod->imagenes);
                $aux = end($img);

                $insert_data = array('id' => $this->input->post('id'),
                    //'name' => $this->input->post('name'),
                    'name' => $prod->nombre,
                    'price' => 0,
                    'qty' => 1,
                    //'img' => $this->input->post('imagen'));
                    'img' =>  base_url()."frontend/assets/".$aux);
                $this->cart->insert($insert_data);
            } else {
                $this->cart->update($update_data);
            }

            echo json_encode($this->cart->contents());
        } else {
            redirect(base_url() . 'frontend');
        }
    }

    function actualizar()
    {
        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $data = array('rowid' => $this->input->post('rowid'),
                'qty' => $this->input->post('qty')
            );
            $this->cart->update($data);
        } else {
            redirect(base_url() . 'frontend');
        }
    }

    function eliminar()
    {
        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $data = array('rowid' => $this->input->post('rowid'),
                'qty' => 0
            );


            $this->cart->update($data);
        } else {
            redirect(base_url() . 'frontend');
        }
    }
}
