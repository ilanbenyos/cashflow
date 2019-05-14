<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/fusioncharts.php');

class Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('data_model');

	}
	public function psp_incomes(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
		$this->load->view('templates/content');
		$this->load->view('reports/total_deposit');
		$this->load->view('templates/footer');
	}
	public function psp_income(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
		$this->load->view('templates/content');*/
		$this->load->view('reports/total_deposit');
		//$this->load->view('templates/footer');
	}
	public function bank_balance(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');*/
		$this->load->view('reports/bank_balance');
		//$this->load->view('templates/footer');
	}
		public function total_balance(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');*/
		$this->load->view('reports/total_balance');
		//$this->load->view('templates/footer');
	}
	public function expense_category(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');*/
		$this->load->view('reports/expense_category');
		//$this->load->view('templates/footer');
	}
	public function psp_commision(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');*/
		$this->load->view('reports/psp_income_commision');
		//$this->load->view('templates/footer');
	}
	public function vendor_outcome(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');*/
		$this->load->view('reports/vendor_outcome');
		//$this->load->view('templates/footer');
	}
	public function chart(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('reports/test_chart');
		$this->load->view('templates/footer');
	}
	public function callCenterExp(){
		/*$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');*/
		$this->load->view('reports/callcenter-expense-category');
		//$this->load->view('templates/footer');
	}
	public function dashboard1(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
		$this->load->view('templates/content');
		$this->load->view('reports/dashboard1');
		$this->load->view('templates/footer');
	}
	public function dashboard(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
		$this->load->view('templates/content');
		$this->load->view('reports/dashboard');
		$this->load->view('templates/footer');
	}
}
