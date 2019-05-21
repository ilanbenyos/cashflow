<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('data_model');
		$this->load->library ('subquery');

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
        print_r(json_encode($data, true));
    }
	
    function get_balance(){
			$year =$_POST['year'];
			//$currency =$_POST['currency'];
			//$data = $this->data_model->total_balance($year,$currency);
			$data = $this->data_model->total_balance($year);
	  //print_r($this->db->last_query()); exit();
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
		//print_r($this->db->last_query());exit();
		$new_data = array();
		if(!empty($data)){
			foreach ($data as $single_array){
				array_shift($single_array);
				 $single_array['color']=$this->randomColor();
				$new_data[]=$single_array;
			}
		}else{
			$new_data=$data;
		}
		
		print_r(json_encode($new_data, true));
    }
    function randomColor(){
    /*$result = array('rgb' => '', 'hex' => '');
    foreach(array('r', 'b', 'g') as $col){
        $rand = mt_rand(0, 255);
        $result['rgb'][$col] = $rand;
        $dechex = dechex($rand);
        if(strlen($dechex) < 2){
            $dechex = '0' . $dechex;
        }
        $result['hex'] .= $dechex;
    }
    return $result;*/
    $hex = '#';
 
//Create a loop.
foreach(array('r', 'g', 'b') as $color){
    //Random number between 0 and 255.
    $val = mt_rand(0, 255);
    //Convert the random number into a Hex value.
    $dechex = dechex($val);
    //Pad with a 0 if length is less than 2.
    if(strlen($dechex) < 2){
        $dechex = "0" . $dechex;
    }
    //Concatenate
    $hex .= $dechex;
}
 
//Print out our random hex color.
return $hex;
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
    function callCenterExpense(){
    	$year =$_POST['year'];
		$month1 =$_POST['month1'];
		$month2 =$_POST['month2'];
		if($month2=="" && $month1!=""){
			$month2 =$month1;
		}else if($month1=="" && $month2!=""){
			$month1 =$month2;
		}
    	$data = $this->data_model->callCenterExoense($year,$month1,$month2);
    	//print_r($this->db->last_query());exit();
    	$new_data = array();
		if(!empty($data)){
			foreach ($data as $single_array){
				array_shift($single_array);
				$single_array['color']=$this->randomColor();
				$new_data[]=$single_array;
			}
		}else{
			$new_data=$data;
		}
		//print_r($this->db->last_query());exit();
		print_r(json_encode($new_data, true));
    }
    //dashboard reports starts
    public function totalBankIncome(){
    	$data = $this->data_model->totalBankIncome();
    	//$data = $this->currBankBal();
    	print_r(json_encode($data, true));
    }
    public function currBankBal(){
    	$data = $this->data_model->curBankBal();
    	//print_r($data);exit();
    	print_r(json_encode($data, true));
    }
	public function totalBankExp(){
		$data = $this->data_model->totalBankExpenses();
		print_r(json_encode($data, true));
	}
	public function bankComm(){
		$data = $this->data_model->bankCommissions();
		print_r(json_encode($data, true));
	}
	public function bankIncome(){
		
		
		
		$banksIncomm = $this->data_model->banksIncomm();
	
		$pids = array();
		$data = array();
		$data2 = array();
foreach ($banksIncomm as $h) {
    $data2[] = $h['Monthval'];
	//$data2[] = $pids;
}
foreach ($banksIncomm as $h) {
    $pids[] = $h['BankName'];
	//$data2[] = $pids;
}
$mData = array();
$mfinalData = array();
$finalseriesData = array();
$bankseriesData = array();
$finalbankseriesData = array();
$seriesData = array();
$input = array_map("unserialize", array_unique(array_map("serialize", $data2)));
$input2 = array_map("unserialize", array_unique(array_map("serialize", $pids)));
foreach($input as $mrow)
{
	$mData['label'] = $mrow;
	$mfinalData[] = $mData;
}
foreach($input2 as $bkrow)
{
	$bankseriesData['seriesname'] = $bkrow;
	
        $new = array();
		$new2 = array();
        foreach($banksIncomm as $a){
            if($a['BankName'] == $bkrow)
		
		$new2[] =$a; 	
				
        }
       
   
	
	
	//print"<pre>"; print_r($new2); print"</pre>";
	/*
	foreach($input as $mrow)
	{
	$query= $this->db->query("SELECT SUM(NetAmount) AS value
									FROM 
									(
									SELECT SUM(NetBankAmt) NetAmount, MONTHNAME(CreatedOn) Monthval, Bankid  FROM pspincome
									WHERE NetBankAmt > 0 AND CreatedOn > DATE_SUB(now(), INTERVAL 6 MONTH)
									GROUP BY CreatedOn,Bankid
									ORDER By CreatedOn DESC

									) A 
									INNER JOIN bankmaster b ON A.bankid = b.Bankid
									where b.BankName = '".$bkrow."' AND b.BankName = '".$bkrow."'
									");
			$result[]=$query->result();
	}
	$bankseriesData['data'] = $result;
	*/
	 //$new['value']= $new;
	$bankseriesData['data'] = $new2; 
	$finalbankseriesData[] = $bankseriesData;
	
}

foreach($finalbankseriesData as $final)
{
	$newfi = $final['data'];
}
$data['cat']=$input;
$data['bankname']=$input2;
$data['series']=$banksIncomm;
$data['bankseriesData']=$finalbankseriesData;
$data['mfinalData']=$mfinalData;
/*
foreach ($banksIncomm as $val) {
			$data2['label'] = $val->BankName;
	        $data2['value'] = $val->NetAmount;
			$data2['color'] = "#0e1727";
            $data[] = $data2;
		}
*/
		print_r(json_encode($data, true));
	}
	
	public function testarray()
	{
	}
	public function bankBalance(){
		$data_1 = $this->data_model->bankBalance();
		
		$data = array();
		$data2 = array();
		
		$data4 = array();
		$data5 = array();
		$data3 = array();
		foreach ($data_1 as $val) {
			$data2['label'] = $val->BankName;
	        $data2['value'] = $val->Balance;
			$data2['color'] = "#0e1727";
			$data2['link'] = "newchart-json-".$val->BankName;
			
            $data[] = $data2;
		}
		 $data3['bankbalance'] = $data;
		 $chart = array();
		 $data6 = array();
		  $data7 = array();
		   $data8 = array();
		    $data9 = array();
		 foreach ($data_1 as $val) {
			 $data4['id'] = $val->BankName;
			 
			 $query= $this->db->query("SELECT BankBalance as value,MONTHNAME(BalanceDate) label,BankId FROM `newcurrentbankbalance` WHERE`BankId`='".$val->BankId."' AND BalanceDate > DATE_SUB(now(), INTERVAL 12 MONTH) Group By label,BankId ORDER By label");
			$result=$query->result_array();
			
			 $new = array();
		$new2 = array();
        foreach($result as $a){
            if($a['BankId'] == $val->BankId)
		
		$new2[] =$a; 	
				
        }
			
			
			
			 $chart= array (
				'xaxisname' => 'Monthwise',
				'yaxisname' => $val->BankName.' Bank Balance',
				'theme' => 'fusion',
				'palettecolors' => '#0e1727',
				//'bgColor'=>"#e6e6e6",
		
		);
		$data7['chart']=$chart;
		$data7['data']=$new2;
		$data4['linkedchart'] =$data7; 
		//$data4['linkedchart'] = $data8;
		
		$data9[] =$data4;
		 }
		 $data3['modaldata'] = $data9;
		 $log = "date:" . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "modaldata". PHP_EOL
                . "modaldata: " .json_encode($data3['modaldata']).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_psp, $log . "\n", FILE_APPEND );
		 
		print_r(json_encode($data3, true));
	}
	 
	
	public function currentBal(){
		$data = $this->data_model->currentBankBal();
		print_r(json_encode($data, true));
	}
}
