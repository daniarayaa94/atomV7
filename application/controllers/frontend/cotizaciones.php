<?php

class Cotizaciones extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index(){
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');
        $this->load->model('frontend/cotizacion/Cotizacion');
        $this->load->model('frontend/cotizacion/Estado');

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

            $user             = $this->session->userdata('usuario');
            $data['usuario']  = $user;
            $data['assets']   = base_url().'assets/';
            $data['total_notif'] = $this->Notificacion->count_not_read($data['usuario']->idUsuario);

            //recibir parametros desde url con nombre
            $uri_params = $this->uri->uri_to_assoc(4);

            //child view
            $filters = array('usuario'=>$user->idUsuario);
            $post    = $this->input->post();
            
            if (!empty($post['fil-fResp'])){
                $filters['fecha_respuesta'] = $post['fil-fResp'];
            }

            if (!empty($uri_params['estado'])) {
                $filters['estado'] = $uri_params['estado'];
                $data['sel_estado'] = $uri_params['estado'];
            }else{
                $data['sel_estado'] = 'todos';
            }


            if (!empty($post['fil-fsolicitud'])){
                $filters['fecha_solicitud'] = $post['fil-fsolicitud'];
            }

            $data['mis_cotizaciones'] = $this->Cotizacion->get_all($filters);
            $data['estados']          = $this->Estado->get_all();

            /* Paginacion */
            $filters['start'] = isset($uri_params['page'] )? ($uri_params['page']) : 0;
            $filters['limit'] = $this->enviroment->get_setting('filas_tabla_por_pagina');

            $opciones = array();
            $opciones['per_page'] = $filters['limit'];
            $opciones['base_url'] = base_url()."frontend/cotizaciones/index/page/";
            $opciones['total_rows'] = $this->Cotizacion->count($filters);
            $opciones['uri_segment'] = isset($uri_params['page']) ? (array_search('page',$this->uri->segments) + 1) : $this->uri->total_segments() ;

            $this->pagination->initialize($opciones);
            $data['paginacion'] = $this->pagination->create_links();


            $data['logout']   = base_url().'frontend/Registro/logout';
        }else{
            redirect(base_url().'frontend/registro');
        }

        //child view
        $data['image_folder']  = base_url().'public/frontend/images/';
        $data['filter_url']    = base_url().'frontend/cotizaciones';
        $data['url_detalles']  = base_url().'frontend/cotizaciones/mostrar_detalles';

        $data['link_estado']   = base_url().'frontend/cotizaciones/index/estado/';
        $data['link_no_estado']= base_url().'frontend/cotizaciones/';

        $data['content_for_layout'] = $this->load->view('frontend/mis_cotizaciones', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

    //usado por ajax
    public function confirmar()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->load->model('frontend/cotizacion/Cotizacion');

            $cotizacion = $this->input->post('id');
            $usuario = $this->session->userdata('usuario');

            $this->Cotizacion->confirmar_venta($cotizacion, $usuario->idUsuario);

        }else{
            $this->index();
        }
    }

    //usado por ajax
    public function mostrar_detalles()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->model('frontend/categoria/categorias');
            $this->load->model('frontend/producto/producto');
            $this->load->model('frontend/cotizacion/Cotizacion');
            $this->load->model('frontend/cotizacion/Detalle');

            $id_cotizacion = $this->input->post('id');            
            
            $cotizacion = $this->Cotizacion->get_by_id($id_cotizacion);
            $detalles   = $this->Detalle->get_by_cotizacion($id_cotizacion);

            $tabla      =  "<h1>Detalles de Cotización</h1>";

            $tabla      .= "<table class='table table-hover table-details' ><thead> %s </thead><tbody> %s </tbody></table>";
            $rows = '';

            if (!empty($cotizacion->fechaRespuesta)) {
                $thead = "<tr><th>Imagen</th><th>Nombre</th><th>Marca</th><th>Cant.</th><th>$ Uni.</th><th>Subtotal</th></tr>";
                foreach ($detalles as $detalle) {
                    $imgs = explode(';', $detalle->imagenes);
                    $img  = end($imgs);
                    $rows .= "<tr><td><img src='".base_url()."assets/$img' class='img-responsive miniatura'></td><td>$detalle->nombre</td><td>$detalle->marca</td><td>$detalle->cantidad</td><td>$detalle->precioUnidad</td><td>$detalle->subtotal</td></tr>";
                }
            }else{
                $thead = "<tr><th>Imagen</th><th>Nombre</th><th>Marca</th><th>Cant.</th></tr>";
                foreach ($detalles as $detalle) {
                    $imgs = explode(';', $detalle->imagenes);
                    $img  = end($imgs);
                    $rows .= "<tr><td><img src='".base_url()."assets/$img' class='recent-thumb'></td><td>$detalle->nombre</td><td>$detalle->marca</td><td>$detalle->cantidad</td></tr>";
                }
            }
            
            $tabla .= "<div class='row pull-right' style='margin-right:5px;'>
                        <h3>Total:$ $cotizacion->total</h3>
                        </div>";
            echo sprintf($tabla, $thead, $rows);  
        }else{
            redirect(base_url().'frontend/');
        }
    }
}