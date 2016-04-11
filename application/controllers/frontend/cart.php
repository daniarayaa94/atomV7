<?php
class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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