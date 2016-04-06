<?php

class Productos_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getProductos(){

        $query = $this->db->query('SELECT idProducto, nombre, marca, descripcion, stock FROM producto');

        return $query->result_array();
        
    }

    function insertProductos($nombre,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes)
    {
        $this->nombre   = $nombre;
        $this->marca = $marca;
        $this->descripcion    = $descripcion;
        $this->stock   = $stock;

        $this->imagenes = $imagenes;
        $this->shortname = $shortname;
        $this->idCategoria    = $categoria;

        $this->db->insert('producto', $this);

        $id_producto = $this->db->insert_id();
        
        return $id_producto;


    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}