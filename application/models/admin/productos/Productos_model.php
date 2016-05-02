<?php

class Productos_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getProductos($filter = null){

        $str_query = "select pro.idProducto, pro.nombre, pro.marca, pro.descripcion, pro.imagenes, pro.stock,
                      (select valor from precio p WHERE pro.idProducto = p.idProducto and p.actual = 1 and p.tipo = 'venta') venta, 
                      (select valor from precio p WHERE pro.idProducto = p.idProducto and p.actual = 1 and p.tipo = 'compra') compra  
                      from producto pro  WHERE pro.borrado = 0 ";

        if (!empty($filter['filter_compra'])){
            $str_query .= " AND (select valor from precio p where pro.idProducto = p.idProducto and p.actual = 1 and p.tipo = 'compra') = ".$filter['filter_compra'];
        }


        if (!empty($filter['filter_venta'])){
            $str_query .= " AND (select valor from precio p where pro.idProducto = p.idProducto and p.actual = 1 and p.tipo = 'venta') = ".$filter['filter_venta'];
        }

        if (!empty($filter['filter_nombre'])){
            $str_query .= " AND lower(pro.nombre) like '".$filter['filter_nombre']."%'";
        }

        if (!empty($filter['filter_marca'])){
            $str_query .= " AND lower(pro.marca) like '".$filter['filter_marca']."%'";
        }

        if (!empty($filter['filter_stock'])){
            $str_query .= " AND pro.stock = ".$filter['filter_stock'];
        }


        if (isset($filter['start']) || isset($filter['limit'])) {
            if ($filter['start'] < 0) {
                $filter['start'] = 0;
            }

            $str_query .= "ORDER BY pro.nombre ASC LIMIT " . (int)$filter['start'] . "," . (int)$filter['limit'];
        }

        $query = $this->db->query($str_query);

        return $query->result_array();
        
    }

    function getProductoById($id){

        $query = $this->db->get_where('producto', array('idProducto' => $id));

        return $query->row();

    }

    function getPrecioVentaByIdProducto($id){

        $query = $this->db->get_where('precio', array('idProducto' => $id ,'tipo' => 'venta', 'actual' => 1));

        return $query->row();

    }

    function getPrecioPromocionByIdProducto($id){

        $query = $this->db->get_where('precio', array('idProducto' => $id ,'tipo' => 'venta', 'actual' => 1));

        $precioPromocion = '';
        
        if($query->row()->esPromocion == 1 ){
            $precioPromocion = $this->db->get_where('precio', array('idProducto' => $id ,'tipo' => 'promocion', 'actual' => 1))->row()->valor;
        }

        return $precioPromocion;

    }

    function getPrecioCompraByIdProducto($id){

        $query = $this->db->get_where('precio', array('idProducto' => $id ,'tipo' => 'compra', 'actual' => 1));

        return $query->row();

    }

    function insertProductos($nombre,$codigo,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion)
    {
        $this->nombre   = $nombre;
        $this->codigo   = $codigo;
        $this->marca = $marca;
        $this->descripcion    = $descripcion;
        $this->stock   = $stock;

        $this->imagenes = $imagenes;
        $this->shortname = $shortname;
        $this->idCategoria    = $categoria;

        $this->db->insert('producto', $this);

        $id_producto = $this->db->insert_id();
        
        $this->insertPrecio($id_producto,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion);

    }
    
    function insertPrecio($idProducto,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion){

        $this->idProducto   = $idProducto;
        
        if (!$conPromocion){
            $fechaInicio = date("Y-m-d H:i:s");
            $fechaFin   = null;
            $conPromocion = 0;
        }else{
            $conPromocion = 1;
        }

        if ($conIva){
            $conIva = 1;
        }else{
            $conIva = 0;
        }

        $data = array(
            'idProducto' =>  $idProducto,
            'fechaDesde' => $fechaInicio ,
            'fechaHasta' => $fechaFin,
            'esPromocion' => $conPromocion,
            'tipo' => 'venta',
            'valor' => $precioVenta,
            'actual' => 1,
            'conIva' => $conIva
        );


        /********************/

        //Insert Precio Venta

        $this->db->insert('precio', $data);

        /********************/

        //Insert Precio Promocion
        if($conPromocion == 1){
            $data['tipo']   = 'promocion';
            $data['valor']   = $precioPromocion;

            $this->db->insert('precio', $data);
        }

        /********************/

        //Insert Precio Compra

        $data['tipo']   = 'compra';
        $data['valor']   = $precioCompra;

        $this->db->insert('precio', $data);

    }

    function updateProductos($id,$nombre,$codigo,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion)
    {
        $this->nombre   = $nombre;
        $this->codigo   = $codigo;
        $this->marca = $marca;
        $this->descripcion    = $descripcion;
        $this->stock   = $stock;

        if ($imagenes == ''){
            $imagenes = $this->getProductoById($id)->imagenes;
        }

        $this->imagenes = $imagenes;
        $this->shortname = $shortname;
        $this->idCategoria    = $categoria;

        $this->db->update('producto', $this, array('idProducto' => $id));

        
        $this->updatePrecio($id,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion);

    }

    function updatePrecio($idProducto,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion){

        $update = array(
            'actual' => 0
        );
        $this->db->update('precio', $update, array('idProducto' => $idProducto));


            if (!$conPromocion){
                $fechaInicio = date("Y-m-d H:i:s");
                $fechaFin   = null;
                $conPromocion = 0;
            }else{
                $conPromocion = 1;
            }

            if ($conIva){
                $conIva = 1;
            }else{
                $conIva = 0;
            }

            $data = array(
                'idProducto' =>  $idProducto,
                'fechaDesde' => $fechaInicio ,
                'fechaHasta' => $fechaFin,
                'esPromocion' => $conPromocion,
                'tipo' => 'venta',
                'valor' => $precioVenta,
                'actual' => 1,
                'conIva' => $conIva
            );


            /********************/

            //Insert Precio Venta

            $this->db->insert('precio', $data);

            /********************/

            //Insert Precio Promocion
            if($conPromocion == 1){
                $data['tipo']   = 'promocion';
                $data['valor']   = $precioPromocion;

                $this->db->insert('precio', $data);
            }

            /********************/

            //Insert Precio Compra

            $data['tipo']   = 'compra';
            $data['valor']   = $precioCompra;

            $this->db->insert('precio', $data);

    }

    function deleteProducto($id)
    {
        $this->borrado = 1;
        $this->db->update('producto', $this, array('idProducto' => $id));
    }
}