<?php

class Mailbox_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getMails(){

        $query = $this->db->get_where('inbox', array('buzon' => 'recibidos'));

        return $query->result_array();

    }

    function getMailsEnviados(){
        $query = $this->db->get_where('inbox', array('buzon' => 'enviados'));

        return $query->result_array();
    }

    function getMailById($id){

        $query = $this->db->get_where('inbox', array('idMail' => $id));

        return $query->row();

    }

    function insertMails($asunto,$remitente,$mensaje,$fecha,$uId,$correoRemitente,$buzon)
    {

        $query = $this->db->get_where('inbox', array('uId' => $uId));

        if ($query->num_rows() == 0) {

            $this->asunto = $asunto;
            $this->remitente = $remitente;
            $this->mensaje = $mensaje;
            $this->fecha = $fecha;
            $this->uId = $uId;
            $this->remitenteCorreo = $correoRemitente;
            $this->buzon = $buzon;

            $this->db->insert('inbox', $this);
        }

    }
}