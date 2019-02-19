<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('data_model');

	}
	
	function get_psp_income(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		$currency =$_POST['currency'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		$data = $this->data_model->pspIncome($year,$month1,$month2,$currency);
		if(!empty($data)){
			foreach ($data as $single_array){
				array_shift($single_array);
				$new_data[]=$single_array;
			}
		}else{
			$new_data=$data;
		}
        print_r(json_encode($new_data, true));
    }
	
	 function get_bank_income(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		$data = $this->data_model->BankIncome($year,$month1,$month2);
        print_r(json_encode($data, true));
    }
	
    function get_balance(){
			$year ='2019';//$_POST['year'];
	
		echo '<pre/>';
      print_r($data);
    }
	
	function get_expense_by_category(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		$data = $this->data_model->Expense_by_Category($year,$month1,$month2);
		if(!empty($data)){
			foreach ($data as $single_array){
				array_shift($single_array);
				$new_data[]=$single_array;
			}
		}else{
			$new_data=$data;
		}
		print_r(json_encode($new_data, true));
    }
	
	
}
