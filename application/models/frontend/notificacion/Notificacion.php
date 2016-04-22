<?php
class Notificacion extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function create($usuario, $data){
        
    }

    function get_not_read($usuario){
        $condiciones = array(
            "leida" => 0,
            "idUsuario" => $usuario
        );

        $result = $this->db->get_where('notificacion',$condiciones)-result();
        return $result;
    }

    function count_not_read($usuario){
        $condiciones = array(
            "leida" => 0,
            "idUsuario" => $usuario
        );

        $query = $this->db->select("count(idNotificacion) as total")->from('notificacion')->where($condiciones)->get();

        return $query->row()->total;
    }
}
