<?php
error_reporting(E_ERROR | E_PARSE);

class Data_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	
	public function pspIncome($year,$month1,$month2,$currency){
		$this->db->select('p.PspId as ID,pm.PspName as psp,sum(p.ActualNetAmt) as amount,p.Currency');
		$this->db->from('pspincome p');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		$this->db->where('p.ActualNetAmt !=','0'); 
		$this->db->where('MONTH(p.ActualDate)>=', $month1);
		$this->db->where('MONTH(p.ActualDate)<=', $month2);
        $this->db->where('YEAR(p.ActualDate)', $year);
		$this->db->where('p.Currency', $currency);
		$this->db->where('pm.Active', '1');
		$this->db->group_by('p.PspId'); 
		$this->db->order_by('p.PspId');
		return $this->db->get()->result_array();
	}
	
	public function BankIncome($year,$month1,$month2,$currency){
		$this->db->select('bm.BankName,sum(bm.Balance) as amount,c.CurName');
		$this->db->from('bankmaster bm');
	   $this->db->join('currencymaster c','c.CurId = bm.CurId','left');
		$this->db->where('bm.Balance !=','0'); 
		$this->db->where('MONTH(bm.ActualDate)>=', $month1);
		$this->db->where('MONTH(bm.ActualDate)<=', $month2);
        $this->db->where('YEAR(bm.ActualDate)', $year);
		$this->db->where('c.CurName', $currency);
		$this->db->where('bm.Active', '1');
		$this->db->group_by('bm.BankName'); 
		return $this->db->get()->result_array();
	}
	
	public function total_balance($year,$currency){
		$month_all= array("0","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$this->db->select('MONTH(ActualDate) as month,MONTHNAME(ActualDate) as m,sum(ActualNetAmt) as  Income');
		$this->db->from('pspincome');
        $this->db->where('YEAR(CreatedOn)', $year);
		$this->db->where('MONTH(ActualDate)!=',"");
		$this->db->where('Currency', $currency);
		$this->db->group_by('month,m'); 
		$this->db->order_by('month');
		$array1 =$this->db->get()->result_array();
		if(!empty($array1)){
			foreach($array1 as $array2){
					$array_new_1[$array2['m']]['month'] =$array2['month'];
					$array_new_1[$array2['m']]['income'] =$array2['Income'];
			}
		}else{
			$array_new_1 =$array1;
		}
		$this->db->select('MONTH(ActualDate) as month ,MONTHNAME(ActualDate) as m,sum(NetFromBank) as  outcome');
		$this->db->from('expenses');
        $this->db->where('YEAR(ActualDate)', $year);
		$this->db->where('MONTH(ActualDate)!=',"");
		$this->db->where('Currency', $currency);
		$this->db->group_by('month,m'); 
		$this->db->order_by('month');
		$array2=$this->db->get()->result_array();
		if(!empty($array2)){
			foreach($array2 as $array3){
					$array_new_2[$array3['m']]['month'] =$array3['month'];
					$array_new_2[$array3['m']]['outcome'] =$array3['outcome'];
			}	
		}else{
			$array_new_2 =$array2;
		}
		if(!empty($array1) && !empty($array2)){
		   $result_1 = array_merge_recursive($array_new_1,$array_new_2); 
		   foreach($result_1 as $result_2){
			   if(!empty($result_2['month'])){
			   		   if (sizeof($result_2['month']) > 1){
						   $month =$result_2['month'][1];
						   $result_2['month'] =null;
						    $result_2['month']  = $month;
					   }
			   }
			  if(!isset($result_2['outcome'])){
					 $result_2['outcome']="0.00";
			  }else if(!isset($result_2['income'])){
					 $result_2['income']="0.00";
			  }
			  $result_2['profit'] = $result_2['income']-$result_2['outcome'];
			  $result_array[]= $result_2;
		   }
		}else if(empty($array1) && empty($array2)){
			$result_array=$array1;
			
		}else if(empty($array1) && !empty($array2) ){
			 $result_1 = $array_new_2;
			  foreach($result_1 as $result_2){
				  if(!isset($result_2['outcome'])){
						 $result_2['outcome']="0.00";
				  }else if(!isset($result_2['income'])){
						 $result_2['income']="0.00";
				  }
				  $result_2['profit'] = $result_2['income']-$result_2['outcome'];
				  $result_array[]= $result_2;
			   }			 
		}else if(!empty($array1) && empty($array2) ){
			 $result_1 =$array_new_1; 
			  foreach($result_1 as $result_2){
				  if(!isset($result_2['outcome'])){
						 $result_2['outcome']="0.00";
				  }else if(!isset($result_2['income'])){
						 $result_2['income']="0.00";
				  }
				  $result_2['profit'] = $result_2['income']-$result_2['outcome'];
				  $result_array[]= $result_2;
			   }			 
		}
		foreach ($result_array as $values){
		$Result[$values['month']] =$values;
		}
		ksort($Result);
		foreach ($Result as $key=>$val){
			$final_array[$month_all[$key]] = $val;
		    $final_array[$month_all[$key]]['month'] =$month_all[$key];
	   }
		$final_array = array_values($final_array);
 	   return $final_array;
	}

	public function Expense_by_Category($year,$month1,$month2){
		//$this->db->select('distinct(CurName)');
		//$this->db->from('expenses');
		//$currency_array= $this->db->get()->result_array();

		 $this->db->select('ex.CatId,c.Category');
		 //foreach($currency_array as $currency){
			$this->db->select('sum(if(ex.Currency ="USD",ex.ActualAmt,0))as USD');
			$this->db->select('sum(if(ex.Currency ="EUR",ex.ActualAmt,0))as EUR');
	//	}

		$this->db->from('expenses ex');
		$this->db->join('expcategory c','ex.CatId = c.CatId','left');
		$this->db->where('ex.ActualAmt >','0.00'); 
		$this->db->where('MONTH(ex.ActualDate)>=', $month1);
		$this->db->where('MONTH(ex.ActualDate)<=', $month2);
        $this->db->where('YEAR(ex.ActualDate)', $year);
		$this->db->group_by('ex.CatId'); 
	    $this->db->order_by('ex.CatId');
	    return $this->db->get()->result_array();
		//return $this->db->last_query();
	}
}