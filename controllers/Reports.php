<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('data_model');

	}
	public function psp_income(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('reports/total_deposit');
		$this->load->view('templates/footer');
	}
	public function bank_income(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('reports/bank_deposit');
		$this->load->view('templates/footer');
	}
	public function total_balance(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('reports/total_balance');
		$this->load->view('templates/footer');
	}
	public function expense_category(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('reports/expense_category');
		$this->load->view('templates/footer');
	}
}
