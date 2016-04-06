<?php
class Categorias extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function listar($id = null){
        if (isset($id)){
            $query = $this->db->select('nombre')->from('categoria')->where('idCategoria',$id)->where('borrado',0)->get();
        }else{
            $query = $this->db->select('idCategoria,nombre')->from('categoria')->where('borrado',0)->get();

        }

        return $query->result_array();
    }

    function get_images($id){
        $query = $this->db->get_where('imagen',array('idCategoria'=>$id));

        return $query->result();
    }

    function get_all_prods($id){
        $query = $this->db->select('*')->from('producto')->where(array('idCategoria'=>$id,'borrado'=>0))->get();
        return $query->result();
    }

}