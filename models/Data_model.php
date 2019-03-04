<?php
error_reporting(E_ERROR | E_PARSE);
class Data_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	
	public function pspIncome($year,$month1,$month2){
		//$this->db->select('p.PspId as ID,pm.PspName as psp,sum(p.ActualNetAmt) as amount,p.Currency');
		$this->db->select('p.PspId as ID,pm.PspName as psp,sum(p.EuroValue) as amount');
		$this->db->from('pspincome p');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		//$this->db->where('p.ActualNetAmt !=','0'); 
		$this->db->where('p.EuroValue !=','0'); 
		$this->db->where('MONTH(p.ActualDate)>=', $month1);
		$this->db->where('MONTH(p.ActualDate)<=', $month2);
        $this->db->where('YEAR(p.ActualDate)', $year);
		//$this->db->where('p.Currency', $currency);
		$this->db->where('pm.Active', '1');
		$this->db->group_by('p.PspId'); 
		$this->db->order_by('p.PspId');
		return $this->db->get()->result_array();
	}
	
	public function BankIncome($year,$month1,$month2){
		$this->db->select('bm.BankName,sum(bm.Balance) as amount,c.CurName');
		//$this->db->select('bm.BankName,sum(bm.EuroValue) as amount,c.CurName');
		$this->db->from('bankmaster bm');
	   	$this->db->join('currencymaster c','c.CurId = bm.CurId','left');
		$this->db->where('bm.Balance !=','0'); 
		//$this->db->where('bm.EuroValue !=','0');
		$this->db->where('MONTH(bm.CreatedOn)>=', $month1);
		$this->db->where('MONTH(bm.CreatedOn)<=', $month2);
        $this->db->where('YEAR(bm.CreatedOn)', $year);
		//$this->db->where('c.CurName', $currency);
		$this->db->where('bm.Active', '1');
		$this->db->group_by('bm.BankName'); 
		return $this->db->get()->result_array();
	}
	
	public function total_balance($year){
		$month_all= array("0","jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
		$this->db->select('MONTH(ActualDate) as month,MONTHNAME(ActualDate) as m,sum(EuroValue) as  Income');
		$this->db->from('pspincome');
        $this->db->where('YEAR(CreatedOn)', $year);
		$this->db->where('MONTH(ActualDate)!=',"");
		//$this->db->where('Currency', $currency);
		$this->db->group_by('month'); 
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
		$this->db->select('MONTH(ActualDate) as month ,MONTHNAME(ActualDate) as m,sum(EuroValue) as  outcome');
		$this->db->from('expenses');
        $this->db->where('YEAR(ActualDate)', $year);
		$this->db->where('MONTH(ActualDate)!=',"");
		//$this->db->where('Currency', $currency);
		$this->db->group_by('month'); 
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
		$this->db->select('distinct(Currency)');
		$this->db->from('expenses');
		$currency_array= $this->db->get()->result_array();

		 $this->db->select('ex.CatId,c.Category');
		 foreach($currency_array as $currency){
			$this->db->select('sum(if(ex.Currency ="'.$currency['Currency'].'",ex.ActualAmt,0))as '.$currency['Currency']);
		}
	//  $this->db->select('ex.CatId,c.Category,sum(if(ex.Currency ="EUR",ex.ActualAmt,0))as amount_eur,sum(if(ex.Currency ="USD",ex.ActualAmt,0))as amount_usd');

		$this->db->from('expenses ex');
		$this->db->join('expcategory c','ex.CatId = c.CatId','left');
		$this->db->where('ex.ActualAmt >','0.00'); 
		$this->db->where('MONTH(ex.ActualDate)>=', $month1);
		$this->db->where('MONTH(ex.ActualDate)<=', $month2);
        $this->db->where('YEAR(ex.ActualDate)', $year);
		$this->db->group_by('ex.CatId'); 
	    $this->db->order_by('ex.CatId');
	    return $this->db->get()->result_array();
	    print_r($this->db->last_query());exit();
	}

	
	public function psp_income_vs_commision($year,$month1,$month2){
		//$this->db->select('p.PspId as ID,pm.PspName as psp, (sum(p.ActualCom) /sum(p.ActualAmt))*100 as per ,p.Currency');
		$this->db->select('p.PspId as ID,pm.PspName as psp, (sum(p.ActualCom) /sum(p.ActualAmt))*100 as per ,p.Currency');
		$this->db->from('pspincome p');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		$this->db->where('p.EuroValue !=','0'); 
		$this->db->where('MONTH(p.ActualDate)>=', $month1);
		$this->db->where('MONTH(p.ActualDate)<=', $month2);
        $this->db->where('YEAR(p.ActualDate)', $year);
		//$this->db->where('p.Currency', $currency);
		$this->db->where('pm.Active', '1');
		$this->db->group_by('p.PspId'); 
		$this->db->order_by('p.PspId');
		 return $this->db->get()->result_array();
		  // $this->db->last_query();
	} 
	public function vendor_expenses($year,$month1,$month2){
		$this->db->select('e.TransId,e.VendorId,e.BankId,e.Currency,sum(e.ActualAmt) as amount,v.VendorId,v.VendorName');
		$this->db->from('expenses e');
		$this->db->join('vendormaster v','v.VendorId = e.VendorId','left');
		$this->db->where('e.ActualAmt !=','0');
		$this->db->where('MONTH(e.ActualDate)>=', $month1);
		$this->db->where('MONTH(e.ActualDate)<=', $month2);
        $this->db->where('YEAR(e.ActualDate)', $year);
		//$this->db->where('e.Currency', $currency);
		$this->db->where('e.Active', '1');
		$this->db->group_by('e.VendorId'); 
		$this->db->order_by('e.TransId');
		return $this->db->get()->result_array();
	}
	public function vendor_psp($year,$month1,$month2){
		$this->db->select('p.TransId,p.PspId,p.BankId,p.Currency,sum(p.ActualCom) as amount,pm.PspId,pm.PspName');
		$this->db->from('pspincome p');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		$this->db->where('p.ActualCom !=','0');
		$this->db->where('MONTH(p.ActualDate)>=', $month1);
		$this->db->where('MONTH(p.ActualDate)<=', $month2);
        $this->db->where('YEAR(p.ActualDate)', $year);
		//$this->db->where('p.Currency', $currency);
		$this->db->group_by('pm.PspName'); 
		$this->db->order_by('p.TransId');
		return $this->db->get()->result_array();
	}
}