<?php

class Cotizaciones_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    public function getCotizaciones($filter = null) {

        $str_query = "select c.fechaSolicitud, c.total, c.comentarios, CONCAT(u.nombre,' ',u.apellidos) nombre, c.idCotizacion
                      from cotizacion c inner join usuario u on c.idUsuario = u.idUsuario ";


        if (!empty($filter['filter_estado'])){
            $str_query .= " where c.idEstado = ".$filter['filter_estado'];
        }

        if (isset($filter['start']) || isset($filter['limit'])) {
            if ($filter['start'] < 0) {
                $filter['start'] = 0;
            }

            $str_query .= " ORDER BY c.idCotizacion DESC LIMIT " . (int)$filter['start'] . "," . (int)$filter['limit'];
        }

        $query = $this->db->query($str_query);

        return $query->result_array();
    }

    public function getEstados() {

        $str_query = "select * from estado ";
        
        $query = $this->db->query($str_query);

        return $query->result_array();
    }
    
    public function getCotizacionById($id) {

        $str_query = "select c.fechaSolicitud, c.total, c.comentarios, CONCAT(u.nombre,' ',u.apellidos) nombre, c.idCotizacion, u.correoContacto, c.fechaRespuesta,
                      (SELECT nombre from estado e where e.idEstado = c.idEstado) estado 
                      from cotizacion c inner join usuario u on c.idUsuario = u.idUsuario where c.idCotizacion =".$id;

        $query = $this->db->query($str_query);

        return $query->row();


    }

    public function getDetalleCotizacionById($id) {

        $str_query = "select * from detalle_cotizacion dc inner join producto p on dc.idProducto = p.idProducto inner join precio pre on dc.idProducto = pre.idProducto where pre.tipo = 'venta' and pre.actual = 1 and dc.idCotizacion =".$id;

        $query = $this->db->query($str_query);

        return $query->result_array();


    }

    public function updateCotizacionById($id) {

        $this->idEstado = 2;
        $this->fechaRespuesta =  date("Y-m-d H:i:s");

        $this->db->update('cotizacion', $this, array('idCotizacion' => $id));

    }

}