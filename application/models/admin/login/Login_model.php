<?php

class Login_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function login($username,$password){
        //Funciones para login **Debe agregarce variable sesion con token al igual que opencart

        $this->db->select('idUsuario, nombre');
        $this->db->from('usuario');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
            return $query;
        }else{
            return false;
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