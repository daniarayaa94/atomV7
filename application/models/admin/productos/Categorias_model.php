<?php

class Categorias_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    public function getCategorias($filter = null) {
        
        if (!empty($filter['ncategoria'])){
            $this->db->where("lower(nombre) like '".$filter['ncategoria']."%'");
        }

        $this->db->order_by('nombre','ASC');

        if (isset($filter['start'])){
            $this->db->limit( $filter['limit'],$filter['start']);
        }



        $this->db->where('borrado', 0);
        $query = $this->db->get("categoria");

        return $query->result_array();

    }


    function getCategoriaById($id){

        $query = $this->db->get_where('categoria', array('idCategoria' => $id));

        return $query->row();

    }
    
    
    function updateCategoria($id,$nombre,$descripcion){
        $this->nombre = $nombre;
        $this->descripcion    = $descripcion;

        $this->db->update('categoria', $this, array('idCategoria' => $id));
    }

    function insertCategorias($nombre, $descripcion)
    {
        $this->nombre   = $nombre;
        $this->descripcion = $descripcion;

        $this->db->insert('categoria', $this);
    }

    function deleteCategoria($id)
    {
        $this->borrado = 1;
        $this->db->update('categoria', $this, array('idCategoria' => $id));
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}