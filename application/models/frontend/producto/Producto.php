<?php
class Producto extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_by_id($id){
        $query = $this->db->select('*')->from('producto')->where(array('idProducto'=>$id))->get();

        return $query->result();
    }

}
