<?php
class Producto extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /**
     * Lista de todos los productos visibles en frontend
     *
     * @param array $filter datos usados para filtrar resultados
     * @return mixed
     */
    function get_all_prods($filter = array() ){
        $this->db->select('*')->from('producto')->where(array('borrado'=>0));

        if (!empty($filter['categoria'])){
            $this->db->where('idCategoria',$filter['categoria']);
        }

        if (!empty($filter['shortname'])){
            $this->db->where('lower(shortname)',$filter['shortname']);
        }

        if (!empty($filter['name_prod'])){
            $this->db->where("lower(nombre) like '".$filter['name_prod']."%'");
        }

        if (isset($filter['start'])){
            $this->db->limit( $filter['limit'],$filter['start']);
        }

        $query = $this->db->get();

        return $query->result();
    }
    

    /**
     * Devuelve los detalles de un producto determinado
     *
     * @param $id Identificador del producto buecado
     * @return mixed
     */
    function get_by_id($id){
        $query = $this->db->select('*')->from('producto')->where(array('idProducto'=>$id))->get();

        return $query->result();
    }


    /**
     * Devuelve el numero total de productos 'no borrados'
     *
     * @param array $data Datos para filtrar los resultados
     * @return int
     */
    function count_productos($data = array()){

        $this->db->select('count(idProducto) as total')->from('producto');

        if (!empty($data['categoria'])){
            $this->db->where('idCategoria',$data['categoria']);
        }

        if (!empty($data['shortname'])){
            $this->db->where('lower(shortname)',$data['shortname']);
        }

        if (!empty($data['name_prod'])){
            $this->db->where("lower(nombre) like '".$data['name_prod']."%'");
        }

        $result = $this->db->get()->row();

        return $result->total;
    }

}
