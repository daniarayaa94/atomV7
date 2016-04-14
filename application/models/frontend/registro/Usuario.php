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

    function login($user, $pass){
        $query = $this->db->get_where('usuario', array('username'=>$user,"password = md5($pass)") );
        $result['status'] = ( $query->num_rows() == 1);
        $result['data']   = $query->row();

        return $result;
    }
}
