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
        $this->db->where('password', $this->encrypt_decrypt('encrypt',$password));
        $this->db->where('idTipo', 2);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
            return $query;
        }else{
            return false;
        }

    }

    function encrypt_decrypt($action, $string) {
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