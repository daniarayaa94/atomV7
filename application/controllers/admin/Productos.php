<?php

class Productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {

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

        $data['productos_list'] = $this->prod->getProductos();

        $data['content_for_layout'] = $this->load->view('admin/productos/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function agregarProducto()
    {
        $this->load->library('form_validation');

        $this->load->model('admin/productos/categorias_model','cate',TRUE);
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputMarca', 'Marca', 'required');
        $this->form_validation->set_rules('inputDescripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('inputStock', 'Stock', 'required');
        $this->form_validation->set_rules('inputShortName', 'ShortName', 'required');
        $this->form_validation->set_rules('inputPrecioCompra', 'Precio Costo', 'required');
        $this->form_validation->set_rules('inputPrecioVenta', 'Precio Venta', 'required');

        $this->form_validation->set_message('required', '* Debes completar este campo.');

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;
        $data['ganancia'] = $this->configuraciones->get_config('ganancia')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/productos/agregarProductos', $data, TRUE);
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
    
    public function guardar(){
        
        if ($this->input->post()) {

            $this->load->model('admin/productos/productos_model','prod',TRUE);

            $nombre = $this->input->post('inputNombre');
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

            $this->prod->insertProductos($nombre,$marca,$descripcion,$stock,$shortname,$categoria,$imagenes,$precioCompra,$precioVenta,$fechaInicio,$fechaFin,$conPromocion,$conIva,$precioPromocion);

            redirect("admin/productos");

        }




    }

    public function editar($id){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inputMarca', 'Marca', 'required');
        $this->form_validation->set_rules('inputDescripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('inputStock', 'Stock', 'required');
        $this->form_validation->set_rules('inputShortName', 'ShortName', 'required');
        $this->form_validation->set_rules('inputPrecioCosto', 'Precio Costo', 'required');
        $this->form_validation->set_rules('inputPrecioVenta', 'Precio Venta', 'required');

        $this->form_validation->set_message('required', '* Debes completar este campo.');
        
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/productos/productos_model', 'prod', TRUE);

        $this->load->model('admin/productos/categorias_model','cate',TRUE);

        $data['categorias_list'] = $this->cate->getCategorias();

        $data['producto'] = $this->prod->getProductoById($id);

        $data['precioVenta'] = $this->prod->getPrecioVentaByIdProducto($id);

        $data['precioPromocion'] = $this->prod->getPrecioPromocionByIdProducto($id);

        $data['precioCompra'] = $this->prod->getPrecioCompraByIdProducto($id);

        $data['idProducto'] = $id;

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;
        
        $data['ganancia'] = $this->configuraciones->get_config('ganancia')->row()->valor;

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_for_layout'] = $this->load->view('admin/productos/edit', $data, TRUE);

            $this->load->view('layouts/admin/headerMaster',$data);
        }else
        {

        }
    }

    

}
