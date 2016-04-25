<?php

class Cotizacion extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_all($data){
        $this->db->select('cotizacion.fechaSolicitud,cotizacion.fechaRespuesta,estado.nombre as estado,cotizacion.idCotizacion')
                 ->join('estado', 'cotizacion.idEstado = estado.idEstado');

        $this->db->where(array('idUsuario'=> $data['usuario'], 'total >' => 0));

        if (!empty($data['fecha_solicitud'])){
            $this->db->where('cotizacion.fechaSolicitud', $data['fecha_solicitud']);
        }

        if (!empty($data['fecha_respuesta'])){
            $this->db->where('cotizacion.fechaRespuesta', $data['fecha_respuesta']);
        }

        if (!empty($data['estado'])){
            $this->db->where('cotizacion.idEstado', $data['estado']);
        }

        if (isset($filter['start'])){
            $this->db->limit( $filter['limit'],$filter['start']);
        }

        $query = $this->db->get('cotizacion');

        return $query->result();
    }


    function count($data){
        $this->db->select('count(cotizacion.idCotizacion) as total')->from('cotizacion');

        $this->db->where(array('idUsuario'=> $data['usuario'], 'total >' => 0));

        if (!empty($data['fecha_solicitud'])){
            $this->db->where('cotizacion.fechaSolicitud', $data['fecha_solicitud']);
        }

        if (!empty($data['fecha_respuesta'])){
            $this->db->where('cotizacion.fechaRespuesta', $data['fecha_respuesta']);
        }

        if (!empty($data['estado'])){
            $this->db->where('cotizacion.idEstado', $data['estado']);
        }
        $aux = $this->db->get()->row()->total;
        return $aux;
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

    function confirmar_venta($cotizacion, $usuario){
        $this->db->query('call sp_confirmar_venta(?,?)', array('cotizacion'=>$cotizacion, "usuario"=>$usuario));

        if (mysqli_more_results($this->db->conn_id)){
            mysqli_next_result($this->db->conn_id);
        }
    }
}