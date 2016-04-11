<?php

class Mailbox_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getMails(){

        $query = $this->db->query('SELECT * FROM inbox');

        return $query->result_array();

    }

    function insertMails($asunto,$remitente,$mensaje,$fecha,$uId)
    {

        $query = $this->db->get_where('inbox', array('uId' => $uId));

        if ($query->num_rows() == 0) {

            $this->asunto = $asunto;
            $this->remitente = $remitente;
            $this->mensaje = $mensaje;
            $this->fecha = $fecha;
            $this->uId = $uId;

            $this->db->insert('inbox', $this);
        }

    }
}