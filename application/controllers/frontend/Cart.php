<?php
class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    function mostrar(){
        $this->load->model('frontend/enviroment');
        $this->load->model('frontend/categoria/categorias');
        $this->load->model('frontend/producto/producto');

        //master params
        $data['titulo']           = $this->enviroment->get_setting('shop_name');
        $data['categorias']       = $this->categorias->listar();
        $data['url']              = base_url()."frontend/todos/index/";
        $data['img_empty_cart']   = base_url().'assets/empty-shop.png';
        $data['cart_qty']         = $this->cart->total_items();
        $data['url_registro']     = base_url().'frontend/registro/index/';

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
            $data['usuario']  = $this->session->userdata('usuario');
            $data['assets']   = base_url().'assets/';
        }

        $data['productos_en_carrito'] = $this->cart->contents();


        //child View

        $data['content_for_layout'] = $this->load->view('frontend/carrito', $data, TRUE);
        $this->load->view('layouts/frontend/master',$data);
    }

    function agregar(){
        $id = $this->input->post('id');

        //si el producto a agregar ya se encuentra en el carro, aumentamos su cantidad
        foreach ($this->cart->contents() as $producto ){
            if ($id == $producto['id']){
                $producto['qty']++;
                $update_data = array('rowid'=> $producto['rowid'], 'qty'  => ($producto['qty'] ) );
            }
        }

        //si el porducto no está incluido en el carro, lo agregamos.
        if (! isset($update_data)){
            $insert_data = array( 'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'price' => 0,
                'qty' => 1 ,
                'img' =>$this->input->post('imagen'));
            $this->cart->insert($insert_data);
        }else{
            $this->cart->update($update_data);
        }
        //$this->cart->destroy();
        echo json_encode($this->cart->contents());
    }

    function actualizar(){
        $data = array('rowid'=> $this->input->post('rowid'),
                      'qty'  => $this->input->post('qty')
                );
        $this->cart->update($data);
    }

    function eliminar(){
        $data = array('rowid'=> $this->input->post('rowid'),
                      'qty'  => 0
                     );
        $this->cart->update($data);
    }
}
