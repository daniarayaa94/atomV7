<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
    }
    
	public function index()
	{
		//$this->load->view('welcome_message');
        
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        //$this->layout->view('index',$data);

        $data['content_for_layout'] = $this->load->view('admin/dashboard/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
