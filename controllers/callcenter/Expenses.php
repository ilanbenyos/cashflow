<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper ( 'url_helper' );
		$this->load->helper ( 'url' );
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('all_model');
		$this->load->helper('prodconfig');
	}
        
	public function index(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}
        echo 'test';
		//$data['getallExpenses'] = $this->all_model->getallExpenses();
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('call_center/expenses');
		$this->load->view('templates/footer');*/
	}
	

}
