<?php

class Usuarios_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getUsuarios($filter = null){

        $str_query = "select CONCAT(u.nombre,' ', u.apellidos) nombre , u.* , 
                      (select nombre from tipo_usuario tp WHERE u.idTipo = tp.idTipo ) nombreTipo  
                      from  usuario u WHERE u.borrado = 0 ";
        
        if (!empty($filter['filter_nombre'])){
            $str_query .=  "AND lower(CONCAT(u.nombre , ' ', u.apellidos)) like '".$filter['filter_nombre']."%'";
        }

        if (!empty($filter['filter_username'])){
            $str_query .=  "AND lower(u.username) like '".$filter['filter_username']."%'";
        }

        if (!empty($filter['filter_correo'])){
            $str_query .=  "AND lower(u.correoContacto) like '".$filter['filter_correo']."%'";
        }

        if (!empty($filter['filter_tipo'])){
            $str_query .=  "AND u.idTipo = ".$filter['filter_tipo'];
        }

        if (isset($filter['start']) || isset($filter['limit'])) {
            if ($filter['start'] < 0) {
                $filter['start'] = 0;
            }

            $str_query .= " ORDER BY u.nombre ASC LIMIT " . (int)$filter['start'] . "," . (int)$filter['limit'];
        }

        $query = $this->db->query($str_query);

        return $query->result_array();

    }

    public function getTipos() {

        $str_query = "select * from tipo_usuario ";

        $query = $this->db->query($str_query);

        return $query->result_array();
    }

    function getUsuarioById($id){

        $query = $this->db->get_where('usuario', array('idUsuario' => $id));

        return $query->row();

    }

    function insertUsuario($inputNombre,$inputApellidos,$inputRut,$inputEmpresa,$inputUsername,$inputPassword,$inputEmail,$inputGenero,$inputDireccion,$inputTelefono,$imagenes)
    {
        $this->nombre   = $inputNombre;
        $this->apellidos   = $inputApellidos;
        $this->rut = $inputRut;
        $this->empresa    = $inputEmpresa;
        $this->username   = $inputUsername;
        $this->password = $inputPassword;
        $this->correoContacto = $inputEmail;
        $this->genero    = $inputGenero;
        $this->idTipo    = 1;
        $this->direccion    = $inputDireccion;
        $this->telefono    = $inputTelefono;
        $this->fotoPerfil    = $imagenes;

        $this->db->insert('usuario', $this);

    }

    function updateUsuario($id,$inputNombre,$inputApellidos,$inputRut,$inputEmpresa,$inputUsername,$inputPassword,$inputEmail,$inputGenero,$inputDireccion,$inputTelefono,$imagenes)
    {
        $this->nombre   = $inputNombre;
        $this->apellidos   = $inputApellidos;
        $this->rut = $inputRut;
        $this->empresa    = $inputEmpresa;
        $this->username   = $inputUsername;
        $this->password = $inputPassword;
        $this->correoContacto = $inputEmail;
        $this->genero    = $inputGenero;
        $this->idTipo    = 1;
        $this->direccion    = $inputDireccion;
        $this->telefono    = $inputTelefono;
        $this->fotoPerfil    = $imagenes;

        $this->db->update('usuario', $this, array('idUsuario' => $id));
        

    }
    
    function deleteUsuario($id)
    {
        $this->borrado = 1;
        $this->db->update('usuario', $this, array('idUsuario' => $id));
    }
}