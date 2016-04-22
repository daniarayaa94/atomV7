<?php

class Cotizacion extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    
    function iniciar($usuario)
    {
        $info = array('total' => 0,
                        'idUsuario' => $usuario,
                        'idEstado' => 1);

        $this->db->insert('cotizacion', $info);
        return $this->db->insert_id();
    }


    function terminar($cotizacion, $total){
        $this->db->where('idCotizacion', $cotizacion);
        $this->db->update('cotizacion', array('total'=>$total));
    }

    
    function insert($data)
    {
        $this->db->insert('cotizacion', $data);
        return $this->db->insert_id();
    }
}