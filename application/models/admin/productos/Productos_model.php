<?php

class Productos_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function getProductos(){
        
        $query = $this->db->get_where('producto', array('borrado' => 0));

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

    function insertProductos($nombre,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion)
    {
        $this->nombre   = $nombre;
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

    function deleteProducto($id)
    {
        $this->borrado = 1;
        $this->db->update('producto', $this, array('idProducto' => $id));
    }
}