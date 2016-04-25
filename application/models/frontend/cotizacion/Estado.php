<?php

class Estado extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('estado')->result();
    }
}