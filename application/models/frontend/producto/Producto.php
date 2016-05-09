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
        $this->db->select('*,CHECK_PROMOCION(idProducto) as promocion')->from('producto')->where(array('borrado'=>0));

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

        return $query->row();
    }


    function get_precio_venta($producto){
        $query = $this->db->get_where('precio', array('idProducto'=>$producto, 'tipo'=> 'venta', 'actual' => 1));
        $precios = $query->result();

        if ($query->num_rows()==2){
            if($precios[0]->esPromocion == 0){
                return array('promocion'=>$precios[1], 'normal' =>$precios[0]);
            }else{
                return array('promocion'=>$precios[0], 'normal' =>$precios[1]);
            }
        }else{
            return array('promocion'=>false, 'normal' =>$query->row());
        }
    }

    public function ver($producto)
    {
       $this->db->query('call visitar_producto(?)', array('id'=>$producto));
        if (mysqli_more_results($this->db->conn_id)){
            mysqli_next_result($this->db->conn_id);
        }
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

        $this->db->where('borrado',0);

        $result = $this->db->get()->row();

        return $result->total;
    }


    public function most_views($cantidad)
    {
        $this->db->order_by('vecesVisto','DESC');
        $this->db->limit($cantidad);
        $query = $this->db->get_where('producto', array('borrado'=>0));

        return $query->result();
    }

    public function newest($cantidad)
    {
        $this->db->order_by('idProducto','DESC');
        $this->db->limit($cantidad);
        $query = $this->db->get_where('producto', array('borrado'=>0));

        return $query->result();
    }

    public function mas_vendidos($cantidad)
    {
        $this->db->order_by('vecesComprado','DESC');
        $this->db->limit($cantidad);
        $query = $this->db->get_where('producto', array('borrado'=>0));

        return $query->result();
    }

    public function mas_cotizados($cantidad)
    {
        $query = $this->db->query('call mas_cotizados(?)', array('limite'=>$cantidad));
        mysqli_next_result($this->db->conn_id);
        return $query->result();

    }

    public function get_relacionados($producto, $limite = 3){
        $query = $this->db->query("CALL sp_get_relacionados(?,?)", array("productoID"=>$producto, "limite"=>$limite));
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }

}
