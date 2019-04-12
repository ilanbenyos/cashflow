<?php
class Configuration extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->helper ( 'url_helper' );
		$this->load->helper ( 'url' );
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('all_model');
        $this->load->database();
        $this->load->helper('prodconfig');

	}
	public function index(){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		
		$data['results'] = $this->all_model->get_all_banks();
		$balance = array();
		$minBalance = array();
		$maxBalance = array();
		foreach ($data['results'] as $value) {
			$balance[] = $value->Balance;
			$minBalance[] = $value->MinBalance;
			$maxBalance[] = $value->MaxBalance;
			
			/*if ($value->Balance < $value->MinBalance) {
				$_SESSION['pop_mes'] = "Minimum bank balance for $value->BankName Bank  is $value->MinBalance."; 
			}elseif($value->Balance > $value->MaxBalance){
				$_SESSION['pop_mes'] = "Maximum bank balance for $value->BankName Bank  is $value->MaxBalance.";
			}*/
			

		}/*
		$this->db->select('BankId,BankName,Balance,MinBalance');
			$this->db->from('bankmaster');
			$this->db->where_in('MinBalance < ',$minBalance);
			$bankBalance= $this->db->get ()->result();
			print_r($this->db->last_query());*/

		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/configuration');
		$this->load->view('templates/footer');
	}
}