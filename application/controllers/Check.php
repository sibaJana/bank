<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Check extends CI_Controller {
	public function __construct(){		
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
		$this->load->model('BankModel');
	}
	public function index(){
		$this->load->view('check');
	}
	public function loadData() {
		$recordPerPage = 5;
	     	
        $recordCount = $this->BankModel->accountActive();
       
      	$config['base_url'] = base_url('Check/loadData');
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
        $empRecord = $this->BankModel->getcustomerdata($recordPerPage,3);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['empData'] = $empRecord;
		echo json_encode($data);		
	}
}