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
		//$currency = $_POST['currency'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		//$data = $this->data_model->pspIncome($year,$month1,$month2,$currency);
		$data = $this->data_model->pspIncome($year,$month1,$month2);
		//echo $data;
        print_r(json_encode($data, true));
    }
	
	 function get_bank_income(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		//$currency = $_POST['currency'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		//$data = $this->data_model->BankIncome($year,$month1,$month2,$currency);
		$data_1 = $this->data_model->BankIncome($year,$month1,$month2);
		$currency = 'USD';
		$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$currency);
                                
        $val=json_decode($val);
        $exchange_rate = $val->rates->EUR;
        $data = array();
		foreach ($data_1 as $val) {
			$amount = $val['amount'];
			/*$currency = 'USD';
			$cval=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$val['CurName']);
	                                
	        $cval=json_decode($cval);
	        $exchange_rate = $cval->rates->EUR;*/
	        if ($val['CurName'] == 'EUR') {
	        	$val['euroVal'] = $amount * 1;
	        }else{
	        	$euro_amount = $amount * $exchange_rate;
            	$val['euroVal'] = $euro_amount;
	        }
            $data[] = $val;
		}
		//print_r($this->db->last_query());exit();
        print_r(json_encode($data, true));
    }
	
    function get_balance(){
			$year =$_POST['year'];
			//$currency =$_POST['currency'];
			//$data = $this->data_model->total_balance($year,$currency);
			$data = $this->data_model->total_balance($year);
	  //print_r($data); exit();
	 print_r(json_encode($data, true));
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
	
	function get_psp_income_vs_commision(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		//$currency = $_POST['currency'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		//$data = $this->data_model->psp_income_vs_commision($year,$month1,$month2,$currency);
		$data = $this->data_model->psp_income_vs_commision($year,$month1,$month2);
		//print_r($this->db->last_query());exit();
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
	function vendor_expense_outcome(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		//$currency = $_POST['currency'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		//$data = $this->data_model->vendor_expenses($year,$month1,$month2,$currency);
		$data = $this->data_model->vendor_expenses($year,$month1,$month2);
		//print_r($this->db->last_query());
        print_r(json_encode($data, true));
    }
    function vendor_pspIncome_outcome(){
		$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		//$currency = $_POST['currency'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
		//$data = $this->data_model->vendor_psp($year,$month1,$month2,$currency);
		$data = $this->data_model->vendor_psp($year,$month1,$month2);
		//print_r($this->db->last_query());
		//echo $data;
        print_r(json_encode($data, true));
    }
	
}
