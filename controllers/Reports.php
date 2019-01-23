<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('all_model');

	}
	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('reports/total_deposit');
		$this->load->view('templates/footer');
	}
	
}
