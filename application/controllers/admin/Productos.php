<?php

class Productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');

        if (!sizeof($this->session->userdata('admin')) > 0){

            redirect('admin/login');

        }


    }

    public function index()
    {
       $this->lista();
    }

    public function lista(){
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);
        $this->load->model('admin/productos/productos_model','prod',TRUE);
        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        if (sizeof($this->cate->getCategorias()) == 0){
            $data['hasCategorias'] = false;
        }else{
            $data['hasCategorias'] = true;
        }

        $data['tituloAgregarCategoria'] = 'No poseemos registro de categorias. Primero debes agregar una categoria.';

        $data['tituloAgregar'] = 'Agregar Producto';



        /*************************INICIO PAGINACION********************************/

        $filters = array();

        $filter_nombre = trim($this->input->get('filter_nombre'));
        $filter_marca = trim($this->input->get('filter_marca'));
        $filter_stock = trim($this->input->get('filter_stock'));
        $filter_compra = trim($this->input->get('filter_compra'));
        $filter_venta = trim($this->input->get('filter_venta'));


        if (isset($filter_nombre)) {
            $filters['filter_nombre'] = $filter_nombre;
        }
        
        if (isset($filter_marca)) {
            $filters['filter_marca'] = $filter_marca;
        }
        
        if (isset($filter_stock)) {
            $filters['filter_stock'] = $filter_stock;
        }
        
        if (isset($filter_compra)) {
            $filters['filter_compra'] = $filter_compra;
        }
        
        if (isset($filter_venta)) {
            $filters['filter_venta'] = $filter_venta;
        }

        $total_row = sizeof($this->prod->getProductos($filters));

        $start = trim($this->input->get('per_page'));

        $filters['start'] = isset($start) ? ($start) : 0;
        $filters['limit'] = 10;

        /* Paginacion */

        $opciones = array();
        $opciones['per_page'] = $filters['limit'];
        $opciones['base_url'] = base_url() . "admin/productos/lista/";
        $opciones['total_rows'] = $total_row;
        $opciones['page_query_string'] = TRUE;
        $opciones['uri_segment'] = isset($start) ? ($start) : 0 ;
        $opciones['last_link'] = '>>';
        $opciones['first_link'] = '<<';

        $this->pagination->initialize($opciones);

        $data["links"] = $this->pagination->create_links();
        $data['productos_list'] = $this->prod->getProductos($filters);
        $data['filter_nombre'] = $filter_nombre;
        $data['filter_marca'] = $filter_marca;
        $data['filter_compra'] = $filter_compra;
        $data['filter_venta'] = $filter_venta;
        $data['filter_stock'] = $filter_stock;
        $data['url_filter']       = base_url()."admin/productos/lista/";

        /***************************FIN PAGINACION******************************/

        $data['content_for_layout'] = $this->load->view('admin/productos/index', $data, TRUE);
        $data['url_logout'] = base_url()."admin/login/cerrar_sesion";
        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function agregarProducto()
    {
        $this->load->library('form_validation');

        $this->load->model('admin/productos/categorias_model','cate',TRUE);
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputCodigo', 'Codigo', 'required');
        $this->form_validation->set_rules('inputMarca', 'Marca', 'required');
        $this->form_validation->set_rules('inputDescripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('inputStock', 'Stock', 'required');
        $this->form_validation->set_rules('inputShortName', 'ShortName', 'required');
        $this->form_validation->set_rules('inputPrecioCompra', 'Precio Costo', 'required');
        $this->form_validation->set_rules('inputPrecioVenta', 'Precio Venta', 'required');


        if ($this->input->post()){

            if ($this->input->post('inputPromocion') == 1){
                $this->form_validation->set_rules('inputDesde', 'Desde', 'required');
                $this->form_validation->set_rules('inputHasta', 'Hasta', 'required');
                $this->form_validation->set_rules('inputPrecioPromocion', 'Precio Promocion', 'required');
            }

        }

        $this->form_validation->set_message('required', '* Debes completar este campo.');

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;
        $data['ganancia'] = $this->configuraciones->get_config('ganancia')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/productos/agregarProductos', $data, TRUE);
            $data['url_logout'] = base_url()."admin/login/cerrar_sesion";
            $this->load->view('layouts/admin/headerMaster',$data);
            
        }
        else
        {
            $this->guardar();
        }

    


    }
    
    public function delete($id = null){

        $this->load->model('admin/productos/productos_model', 'prod', TRUE);

        if ($this->input->post()) {
            
            foreach ($this->input->post('selected') as $productID) {
                $this->prod->deleteProducto($productID);
            }

        }elseif ($id != null){
            $this->prod->deleteProducto($id);
        }

        redirect("admin/productos");
        
        
    }
    
    public function guardarCambiosEdicion($id){
        
        if ($this->input->post()) {

            $this->load->model('admin/productos/productos_model','prod',TRUE);

            $nombre = $this->input->post('inputNombre');
            $codigo = $this->input->post('inputCodigo');
            $marca = $this->input->post('inputMarca');
            $descripcion = $this->input->post('inputDescripcion');
            $stock = $this->input->post('inputStock');
            $shortname = $this->input->post('inputShortName');
            $categoria = $this->input->post('inputCategoria');
            $precioVenta = $this->input->post('inputPrecioVenta');
            $precioCompra = $this->input->post('inputPrecioCompra');
            $precioPromocion = $this->input->post('inputPrecioPromocion');

            $conIva = $this->input->post('inputIva');

            $conPromocion = $this->input->post('inputPromocion');

            if ($conIva){
                $precioCompra = ($precioCompra * 119) / 100;
            }

            $fechaInicio = $this->input->post('inputDesde');
            $fechaFin = $this->input->post('inputHasta');

            $imagenes = '';

            

            if (sizeof($_FILES['upload']['name']) > 0) {

                $imagenes = implode(";", $_FILES['upload']['name']);

                $total = count($_FILES['upload']['name']);

                for ($i = 0; $i < $total; $i++) {

                    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                    if ($tmpFilePath != "") {
                        $newFilePath = getcwd() . "/assets/" . $_FILES['upload']['name'][$i];

                        move_uploaded_file($tmpFilePath, $newFilePath);
                    }
                }

            }

            $this->prod->updateProductos($id,$nombre,$codigo,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion);

            redirect("admin/productos");

        }




    }

    public function guardar(){

        if ($this->input->post()) {

            $this->load->model('admin/productos/productos_model','prod',TRUE);

            $nombre = $this->input->post('inputNombre');
            $codigo = $this->input->post('inputCodigo');
            $marca = $this->input->post('inputMarca');
            $descripcion = $this->input->post('inputDescripcion');
            $stock = $this->input->post('inputStock');
            $shortname = $this->input->post('inputShortName');
            $categoria = $this->input->post('inputCategoria');

            $precioVenta = $this->input->post('inputPrecioVenta');
            $precioCompra = $this->input->post('inputPrecioCompra');
            $precioPromocion = $this->input->post('inputPrecioPromocion');

            $conIva = $this->input->post('inputIva');

            $conPromocion = $this->input->post('inputPromocion');

            if ($conIva){
                $precioCompra = ($precioCompra * 119) / 100;
            }

            $fechaInicio = $this->input->post('inputDesde');
            $fechaFin = $this->input->post('inputHasta');

            $imagenes = '';

            if (sizeof($_FILES['upload']['name']) > 0) {

                $imagenes = implode(";", $_FILES['upload']['name']);

                $total = count($_FILES['upload']['name']);

                for ($i = 0; $i < $total; $i++) {

                    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                    if ($tmpFilePath != "") {
                        $newFilePath = getcwd() . "/assets/" . $_FILES['upload']['name'][$i];

                        move_uploaded_file($tmpFilePath, $newFilePath);
                    }
                }

            }

            $this->prod->insertProductos($nombre,$codigo,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion);

            redirect("admin/productos");

        }




    }

    public function editar($id){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputCodigo', 'Codigo', 'required');
        $this->form_validation->set_rules('inputMarca', 'Marca', 'required');
        $this->form_validation->set_rules('inputDescripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('inputStock', 'Stock', 'required');
        $this->form_validation->set_rules('inputShortName', 'ShortName', 'required');
        $this->form_validation->set_rules('inputPrecioCompra', 'Precio Costo', 'required');
        $this->form_validation->set_rules('inputPrecioVenta', 'Precio Venta', 'required');
        
        $this->form_validation->set_message('required', '* Debes completar este campo.');
        
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/productos/productos_model', 'prod', TRUE);

        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();

        $data['producto'] = $this->prod->getProductoById($id);

        $precioVenta = $this->prod->getPrecioVentaByIdProducto($id);

        $producto = $this->prod->getProductoById($id);

        $imagen = '';

        $imagenesArray = explode(';',$producto->imagenes);
        
        if ($this->input->post()){
            $precioVenta->esPromocion = null;
            $precioVenta->conIva = null;


            if ($this->input->post('inputPromocion') == 1){
                $this->form_validation->set_rules('inputDesde', 'Desde', 'required');
                $this->form_validation->set_rules('inputHasta', 'Hasta', 'required');
                $this->form_validation->set_rules('inputPrecioPromocion', 'Precio Promocion', 'required');
            }

        }

        for ($i = 0; $i < sizeof($imagenesArray); $i++){

            $imagen .= "<div class='file-preview-frame' id='preview-".$imagenesArray[$i]."' data-fileindex='0'><img src='".base_url()."assets/".$imagenesArray[$i]."' class='file-preview-image'><div class='file-thumbnail-footer'><div class='file-footer-caption' title='".$imagenesArray[$i]."'>.$imagenesArray[$i].</div></div></div>";

        }

        $data['imagenes'] = $imagen;

        $data['precioVenta'] = $precioVenta;

        $data['precioPromocion'] = $this->prod->getPrecioPromocionByIdProducto($id);

        $data['precioCompra'] = $this->prod->getPrecioCompraByIdProducto($id);

        $data['idProducto'] = $id;

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;
        
        $data['ganancia'] = $this->configuraciones->get_config('ganancia')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/productos/edit', $data, TRUE);
            $data['url_logout'] = base_url()."admin/login/cerrar_sesion";
            $this->load->view('layouts/admin/headerMaster',$data);
        }else
        {
            $this->guardarCambiosEdicion($id);
        }
    }

}
