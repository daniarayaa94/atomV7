<?php
class Categoria extends CI_Model {

    function __construct(){
        parent::__construct();

    }

    function listar_todas()
    {
        $this->db->select('idCategoria,nombre');
        $this->db->from('categoria');
        $this->db->where('borrado',0);

        $query = $this->db->get();

        return $query->result();


    }

}