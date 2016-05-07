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
        $query = $this->db->get_where('usuario', array('username'=>$user,"password = " . $this->encrypt_decrypt("encrypt", $pass)) );
        $result['status'] = ( $query->num_rows() == 1);
        $result['data']   = $query->row();
        

        return $result;
    }

    public function encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'abc123.As';
        $secret_iv = 'abcd123.Asd';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}
