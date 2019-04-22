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
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/configuration');
		$this->load->view('templates/footer');
	}
	public function minAlert(){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }else{
	    $data = $this->all_model->get_all_banks();
		$minarray = array();
		$mindata = array();
		foreach ($data as $value) {
			$minarray[] = $value;
		}
		foreach ($minarray as $key => $val) {
			if ($val->Balance < $val->MinBalance) {
				$mindata[] = $val;
			}
		}
		echo json_encode($mindata);
	    }
	}
	public function maxAlert(){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }else{
	    $data = $this->all_model->get_all_banks();
		$maxarray = array();
		$maxdata = array();
		foreach ($data as $value) {
			$maxarray[] = $value;
		}
		foreach ($maxarray as $key => $val) {
			if ($val->Balance > $val->MaxBalance) {
				$maxdata[] = $val;
			}
		}
		echo json_encode($maxdata);
	    }
	}
}