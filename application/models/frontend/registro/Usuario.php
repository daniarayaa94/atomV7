<?php
class Usuario extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function insert($info)
    {
        $finder = $this->db->get_where('usuario',array('username'=>$info['username']))->result();

        if (count($finder) == 0){ 
            $this->db->insert( 'usuario', $info );
            $result['status'] = true;
            $result['err_msg'] = '';
        }else{
            $result['status']  = false;
            $result['err_msg'] = 'ese nombre de usuario ya existe';
        }
        return (object)$result;

    }
}
