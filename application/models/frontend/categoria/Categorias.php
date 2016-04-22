<?php
class Categorias extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /**
     * Informacion de las categorias registradas o de una en particular
     *
     * @param null $id Si no es nulo, devuelve la informacion de esa categoria en particular
     * de lo contrario, lista todas las categorias y sus id
     *
     * @return mixed
     */
    function listar($id = null){
        if (isset($id)){
            $query = $this->db->select('nombre')->from('categoria')->where('idCategoria',$id)->where('borrado',0)->get();
        }else{
            $query = $this->db->select('idCategoria,nombre')->from('categoria')->where('borrado',0)->get();

        }

        return $query->result_array();
    }

    /**
     * Retorna las imagenes asociadas a una categoria
     *
     * @param $id Identificador de la categpria buscada
     * @return mixed
     */
    function get_images($id){
        $query = $this->db->get_where('imagen',array('idCategoria'=>$id));

        return $query->result();
    }


    function get_sub_categories($filter = array()){
        $sql = "SELECT DISTINCT
                LOWER(shortname) AS 'subcategoria',
                (SELECT COUNT(idProducto) FROM producto WHERE
                  LOWER(shortname) = p.shortname and borrado = 0 ";

        if (!empty($filter['categoria'])){
            $sql.= " and idCategoria = ".$filter['categoria'].") AS 'total'
                FROM
                producto AS p where borrado = 0 and idCategoria = ".$filter['categoria'];
        }else{
            $sql.= " ) AS 'total' FROM producto AS p where borrado = 0" ;
        }

        if (!empty($filter['shortname'])){
            $sql .= " and lower(p.shortname) = '".$filter['shortname']."'" ;
        }

        if (!empty($filter['name_prod'])){
            $sql .= " and lower(nombre) like '".$filter['name_prod']."%'" ;
        }

        $sql.=" order by shortname";

        $query = $this->db->query($sql);
        
        return $query->result();
    }

}
