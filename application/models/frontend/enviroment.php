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

        return ( $result->num_rows() > 0 ) ? $result->row()->valor : false;

    }

}