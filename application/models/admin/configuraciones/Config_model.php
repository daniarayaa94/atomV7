<?php

class Config_model extends CI_Model {

    function __construct()
    {

        parent::__construct();
    }

    function get_config($key)
    {
        //Funciones para login **Debe agregarce variable sesion con token al igual que opencart

        $this->db->select('valor');
        $this->db->from('config');
        $this->db->where('key', $key);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
            return $query;
        }else{
            return 'hola';
        }

    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('usuario', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}