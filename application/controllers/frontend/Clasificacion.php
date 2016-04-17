<?php

class Clasificacion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
        $data['titulo']           = $this->enviroment->get_setting('shop_name');
        $data['categorias']       = $this->categorias->listar();
        $data['url']              = base_url()."frontend/clasificacion/index/categoria/";
        $data['img_empty_cart']   = base_url().'assets/empty-shop.png';
        $data['cart_qty']         = $this->cart->total_items();
        $data['url_registro']     = base_url().'frontend/registro/index/';
        $data['mostrar_carro']    = base_url().'frontend/cart/mostrar/';

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

        //recibir parametros desde url con nombre
        $uri_params = $this->uri->uri_to_assoc(4);
        $categoria = $uri_params['categoria'];


        //child view
        $category_info            = $this->categorias->listar($categoria);
        $data['cat_seleccionada'] = $category_info[0]['nombre'];
        $data['imagenes']         = $this->categorias->get_images($categoria);
        $data['title_bground']    = "background: url(".base_url()."frontend/images/crossword.png) repeat scroll 0 0 #30BB39";
        $data['no_results']       = base_url().'/public/frontend/images/no_productos.png';
        $data['link_detalles']    = base_url().'frontend/detalles/index/';
        $data['category_select']  = $categoria;

        $data['url_filter']       = base_url()."frontend/clasificacion/index/categoria/".$categoria ;

        $tags = array( $data['cat_seleccionada']);

        $filters = array( 'categoria' => $categoria,
                          'shortname'  => null,
                          'name_prod'  => null
                        );
        foreach ($uri_params as $key => $param){
            if ($key == 'categoria'){
                $filters['categoria'] = $param;
            }elseif ($key == 'shortname'){
                $filters['shortname'] = $param;
                $tags[] = $param;
            }elseif ($key == 'name_prod'){
                $filters['name_prod'] = strtolower(urldecode($param));
                $tags[] = urldecode($param);
                $data['url_filter'].='/name_prod/'.$param;
            }
        }

        //agrego filtro de categoria
        $data['search_action'] = base_url().'frontend/clasificacion/index/categoria/'.$filters['categoria'];

        //filtro de shortname
        if(!empty($filters['shortname'])){
            $data['search_action'] .= '/shortname/'.$filters['shortname'];
        }

        //filtro de nombre de producto
        if(!empty($filters['name_prod'])){
            $data['search_action'] .= '/name_prod/'.$filters['name_prod'];
        }

        $data['tags'] = $tags;

        /* Paginacion */
        $filters['start'] = isset($uri_params['page'] )? ($uri_params['page'] - 1) : 0;
        $filters['limit'] = $this->enviroment->get_setting('item_por_pagina');

        $opciones = array();
        $opciones['per_page'] = $filters['limit'];
        $opciones['base_url'] = base_url()."frontend/clasificacion/index/categoria/".$categoria;
        $opciones['total_rows'] = $this->producto->count_productos($filters);
        $opciones['uri_segment'] = isset($uri_params['page']) ? (array_search('page',$this->uri->segments) + 1) : $this->uri->total_segments() ;

        $this->pagination->initialize($opciones);
        $data['paginacion'] = $this->pagination->create_links();


        $data['productos']        = $this->producto->get_all_prods($filters);
        $data['subcategories']    = $this->categorias->get_sub_categories($categoria, $filters);


        $data['content_for_layout'] = $this->load->view('frontend/clasificacion', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }
}
