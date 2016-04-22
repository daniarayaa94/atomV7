<?php

class Detalle extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert($cotizacion, $data){
        $info = array('idCotizacion'=>$cotizacion,
            'idProducto' => $data['id'],
            'cantidad'=>$data['qty'],
            'subtotal' => $data['subtotal']);

        $this->db->insert('detalle_cotizacion', $info);
        return $this->db->insert_id();
    }
}