<?php

class Cotizaciones extends CI_Controller {

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
        $this->load->model('admin/cotizaciones/cotizaciones_model','coti',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        /*************************INICIO PAGINACION********************************/

        $filters = array();

        $filters['filter_estado'] = '1';
        
        $total_row = sizeof($this->coti->getCotizaciones($filters));

        $start = trim($this->input->get('per_page'));

        $filters['start'] = isset($start) ? ($start) : 0;
        $filters['limit'] = 10;

        /* Paginacion */

        $opciones = array();
        $opciones['per_page'] = $filters['limit'];
        $opciones['base_url'] = base_url() . "admin/cotizaciones/lista/";
        $opciones['total_rows'] = $total_row;
        $opciones['page_query_string'] = TRUE;
        $opciones['uri_segment'] = isset($start) ? ($start) : 0 ;
        $opciones['last_link'] = '>>';
        $opciones['first_link'] = '<<';

        $this->pagination->initialize($opciones);

        $data["links"] = $this->pagination->create_links();
        $data['cotizaciones_list'] = $this->coti->getCotizaciones($filters);

        $data['url_ajax'] = base_url()."admin/cotizaciones/getCotizacionById";
        $data['email_send'] = base_url()."admin/cotizaciones/enviarCorreo";
        $data['descargar_excel'] = base_url()."admin/cotizaciones/descargarExcel";
        

        /***************************FIN PAGINACION******************************/

        $data['content_for_layout'] = $this->load->view('admin/cotizaciones/cotizaciones', $data, TRUE);
        $data['url_logout'] = base_url()."admin/login/cerrar_sesion";
        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function historialCotizaciones(){
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);
        
        $this->load->model('admin/cotizaciones/cotizaciones_model','coti',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        /*************************INICIO PAGINACION********************************/

        $filters = array();
        
        $inputEstado = trim($this->input->post('inputEstados'));

        if (isset($inputEstado) && $inputEstado != 0){

            $filters['filter_estado'] = $inputEstado;
            $data['estado'] = $inputEstado;

        }else{
            $data['estado'] = $inputEstado;
        }

        $total_row = sizeof($this->coti->getCotizaciones($filters));

        $start = trim($this->input->get('per_page'));


        $filters['start'] = isset($start) ? ($start) : 0;
        $filters['limit'] = 10;

        /* Paginacion */

        $opciones = array();
        $opciones['per_page'] = $filters['limit'];
        $opciones['base_url'] = base_url() . "admin/cotizaciones/historialCotizaciones/";
        $opciones['total_rows'] = $total_row;
        $opciones['page_query_string'] = TRUE;
        $opciones['uri_segment'] = isset($start) ? ($start) : 0 ;
        $opciones['last_link'] = '>>';
        $opciones['first_link'] = '<<';

        $this->pagination->initialize($opciones);

        $data["links"] = $this->pagination->create_links();
        $data['cotizaciones_list'] = $this->coti->getCotizaciones($filters);
        $data['estados_list'] = $this->coti->getEstados();

        $data['url_ajax'] = base_url()."admin/cotizaciones/getCotizacionById";
        $data['base_url'] = base_url() . "admin/cotizaciones/historialCotizaciones";
        $data['descargar_excel'] = base_url()."admin/cotizaciones/descargarExcel";


        /***************************FIN PAGINACION******************************/

        $data['content_for_layout'] = $this->load->view('admin/cotizaciones/historialCotizaciones', $data, TRUE);
        $data['url_logout'] = base_url()."admin/login/cerrar_sesion";
        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function descargarExcel(){
        
        $id = $this->input->get('id');

        $this->crearExcel($id,'descargar');

    }

    public function crearExcel($id,$tipo = null)
    {

        $this->load->model('admin/cotizaciones/cotizaciones_model', 'coti', TRUE);

        $cotizacion = $this->coti->getCotizacionById($id);
        $productos_list = $this->coti->getDetalleCotizacionById($id);

        $this->load->library('excel');

        $objPHPExcel = PHPExcel_IOFactory::load(getcwd() . "/assets/Presupuesto-Nuevo-2016-Arueda.xlsx");

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->setTitle('Cotizacion');

        $objPHPExcel->getActiveSheet()->setCellValue('C14', $cotizacion->nombre);


        $cell = 22;

        foreach ($productos_list as $row) {

            $objPHPExcel->getActiveSheet()->insertNewRowBefore($cell, 1);

            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $row['nombre']);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $row['marca']);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $row['descripcion']);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $row['cantidad']);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $row['valor']);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $row['subtotal']);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $cell++;
        }

        $cell += 2;
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $cotizacion->total);

        $filename = 'Cotizacion_' . str_replace(' ', '_', $cotizacion->nombre) . '.xls';

        if ($tipo == null) {

            $objPHPExcel = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $path = getcwd() . "/assets/" . $filename;
            $objPHPExcel->save($path);
            return $path;
        }else{
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); //no cache
            $objPHPExcel = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objPHPExcel->save('php://output');
        }
    }
    
    public function enviarCorreo(){

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => $this->configuraciones->get_config('smtp_user')->row()->valor,
            'smtp_pass' => $this->configuraciones->get_config('smtp_pass')->row()->valor,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->load->model('admin/cotizaciones/cotizaciones_model','coti',TRUE);

        $cotizacion = $this->coti->getCotizacionById($this->input->post('idCot'));

        $this->email->from($this->configuraciones->get_config('smtp_user')->row()->valor, 'Atom');
        $this->email->to($cotizacion->correoContacto);
        $this->email->subject('Respuesta cotizacion atom');
        $this->email->message($this->input->post('editor1'));
        $this->email->attach($this->crearExcel($this->input->post('idCot')));
        $this->email->send();

        $this->coti->updateCotizacionById($this->input->post('idCot'));

        redirect('admin/cotizaciones');


    }

    public function getCotizacionById(){

        $this->load->model('admin/cotizaciones/cotizaciones_model','coti',TRUE);

        if (isset($_POST['idCotizacion'])) {

            $data['productos_list'] = $this->coti->getDetalleCotizacionById($_POST['idCotizacion']);
            $data['cotizacion'] = $this->coti->getCotizacionById($_POST['idCotizacion']);

            $ContenidoString =$this->load->view('admin/cotizaciones/detalleCotizacion', $data, TRUE);

            $json = array("detalle" =>  $ContenidoString);

            header("Content-Type: application/json", true);

            echo json_encode($json);

            exit;
        }
        
        
    }


}
