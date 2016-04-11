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


    function get_all_prods($id, $filter = array() ){
        $this->db->select('*')->from('producto')->where(array('idCategoria'=>$id,'borrado'=>0));

        if (!empty($filter['shortname'])){
           // $this->db->where('shortname',$filter['shortname']);
            $this->db->where('lower(shortname)',$filter['shortname']);
        }

        if (!empty($filter['name_prod'])){
            $this->db->where("lower(nombre) like '".$filter['name_prod']."%'");
        }

        $query = $this->db->get();
        return $query->result();
    }


    function get_sub_categories($id, $filter = array()){
        $sql = "SELECT DISTINCT
                LOWER(shortname) AS 'subcategoria',
                (SELECT COUNT(idProducto) FROM producto WHERE
                  LOWER(shortname) = p.shortname and borrado = 0 and idCategoria = $id) AS 'total'
                FROM
                producto AS p where borrado = 0 and idCategoria = $id";

        if (!empty($filter['shortname'])){
            $sql .= " and lower(p.shortname) = '".$filter['shortname']."'" ;
        }

        if (!empty($filter['name_prod'])){
            $sql .= " and lower(nombre) like '".$filter['name_prod']."%'" ;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

}
