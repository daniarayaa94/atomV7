<?php

class Categorias_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getCategorias(){

        $query = $this->db->get_where('categoria', array('borrado' => 0));

        return $query->result_array();

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