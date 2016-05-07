<?php
class Enviroment extends CI_Model {

    function __construct(){
        parent::__construct();

    }

    function get_setting($key)
    {
        $this->db->select('valor');
        $this->db->from('config');
        $this->db->where('key',$key);

        $result = $this->db->get();

        return ( $result->num_rows() > 0 ) ? $result->row()->valor : $key;

    }


    function getNotificaciones($id)
    {
        $str_query = "select * from notificacion where idUsuario=".$id;

        $query = $this->db->query($str_query);
        
        $data['countNotificaciones'] = sizeof($query->result_array());
        
        $data['notificaciones_list'] = $query->result_array();

        return $data;

    }

}
