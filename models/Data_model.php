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
		//$this->db->select('bm.BankName,sum(bm.Balance) as amount,c.CurName');
		$this->db->select('bm.BankName,bm.Balance as amount,c.CurName');
		//$this->db->select('bm.BankName,sum(bm.EuroValue) as amount,c.CurName');
		$this->db->from('bankmaster bm');
	   	$this->db->join('currencymaster c','c.CurId = bm.CurId','left');
		
		$this->db->where('bm.Active', '1');
		$this->db->group_by('bm.BankName'); 
		return $this->db->get()->result_array();
		/*foreach ($array as $val) {
			//print_r($val['CurName']);
			//print_r($val['amount']);
			$amount = $val['amount'];
			$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$val['CurName']);
                                
                        $val=json_decode($val);
                       
                        $exchange_rate = $val->rates->EUR;
                        //echo $exchange_rate;
                        $euro_amount = $amount * $exchange_rate;

        	$array['euroValue'] = $euro_amount;  
		
		}
		return $array;*/
	}
	
	public function total_balance($year){
		$month_all= array("0","jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
		$this->db->select('MONTH(ActualDate) as month,MONTHNAME(ActualDate) as m,sum(EuroValue) as  Income');
		$this->db->from('pspincome');
        //$this->db->where('YEAR(CreatedOn)', $year);
        $this->db->where('YEAR(ActualDate)', $year);
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
 	   //return $final_array;
 	   if ($final_array == null) {
 	   	return $final_array = array();
 	   }else{
 	   	return $final_array;
 	   }
	}

	public function Expense_by_Category($year,$month1,$month2){
		$this->db->select('distinct(Currency)');
		$this->db->from('expenses');
		$currency_array= $this->db->get()->result_array();
		 $this->db->select('ex.CatId,SUM(ex.EuroValue) as amount,c.Category');
		 /*foreach($currency_array as $currency){
			$this->db->select('sum(if(ex.Currency ="'.$currency['Currency'].'",ex.ActualAmt,0))as '.$currency['Currency']);
		}*/
	//  $this->db->select('ex.CatId,c.Category,sum(if(ex.Currency ="EUR",ex.ActualAmt,0))as amount_eur,sum(if(ex.Currency ="USD",ex.ActualAmt,0))as amount_usd');

		$this->db->from('expenses ex');
		$this->db->join('expcategory c','ex.CatId = c.CatId','left');
		$this->db->where('ex.EuroValue >','0.00'); 
		$this->db->where('MONTH(ex.ActualDate)>=', $month1);
		$this->db->where('MONTH(ex.ActualDate)<=', $month2);
        $this->db->where('YEAR(ex.ActualDate)', $year);
        $this->db->where('c.Active',1);
		$this->db->group_by('ex.CatId'); 
	    //$this->db->order_by('ex.CatId');
	    $this->db->get();
		$query1= $this->db->last_query();

	    $this->db->select('0,(sum(ActualCom) +(AdditionalFees)) as amount,"PSP" As Category');
		$this->db->from('pspincome');
		$this->db->where('ActualCom !=','0');
		$this->db->where('MONTH(ActualDate)>=', $month1);
		$this->db->where('MONTH(ActualDate)<=', $month2);
        $this->db->where('YEAR(ActualDate)', $year);
		//$this->db->order_by('TransId');
		$this->db->get();
		$query2= $this->db->last_query();

		$alldata = $this->db->query($query1." UNION ALL ".$query2);
				   
		$result1 = $alldata->result_array();
	    return $result1;
	}

	
	public function psp_income_vs_commision($year,$month1,$month2){
		//$this->db->select('p.PspId as ID,pm.PspName as psp, (sum(p.ActualCom) /sum(p.ActualAmt))*100 as per ,p.Currency');
		$this->db->select('p.PspId as ID,pm.PspName as psp, ifNull((sum(p.ActualCom) /sum(p.ActualAmt))*100,0) as per');
		$this->db->from('pspincome p');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		$this->db->where('p.ActualAmt !=','0'); 
		$this->db->where('MONTH(p.ActualDate)>=', $month1);
		$this->db->where('MONTH(p.ActualDate)<=', $month2);
        $this->db->where('YEAR(p.ActualDate)', $year);
		//$this->db->where('p.Currency', $currency);
		$this->db->where('pm.Active', '1');
		$this->db->group_by('p.PspId'); 
		$this->db->order_by('p.PspId');
		return $this->db->get()->result_array();
		  
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
	public function callCenterExoense($year,$month1,$month2){
		$this->db->select('c.ExpId,c.ExpName,c.VendorId,sum(c.ExpAmount) as amount,ex.Category');
		$this->db->from('callcenterexpenses c');
		$this->db->join('expcategory ex','ex.CatId = c.ExpName','left');
		$this->db->where('c.ExpAmount >','0.00'); 
		$this->db->where('MONTH(c.ExpDate)>=', $month1);
		$this->db->where('MONTH(c.ExpDate)<=', $month2);
        $this->db->where('YEAR(c.ExpDate)', $year);
		$this->db->group_by('c.ExpName'); 
	    $this->db->order_by('c.ExpName');
	    return $this->db->get()->result_array();
	}

	//dashboard queries start
	public function totalBankIncome(){
		$this->db->select('TransId,BankId,sum(EuroValue) as amount,ActualDate');
		$this->db->from('pspincome');
		//$this->db->where('ActualDate',date('Y-m'));
		$this->db->where('EuroValue >','0.00'); 
		//$this->db->where('MONTH(ActualDate) = ',date('m'));
		$this->db->where('MONTH(ActualDate) = ',date('04'));
		$this->db->group_by('BankId');
		return $this->db->get()->result_array();
	}
	public function curBankBal(){

		/*$this->db->select('sum(Balance) as monthly,0 as lastmonth');
		$this->db->from('bankmaster');
		$this->db->where('Active',1);
		$this->db->where('IsDelete',1);
		$array1 = $this->db->get()->result_array();
		//print_r($array);
		$new = array();
		foreach ($array1 as $value) {
			
			$new['monthly'] = $value['monthly'];
		}
		$this->db->select('0,sum(TotalBankBalnce) as lastmonth');
		$this->db->from('currentbankbalance');
		$this->db->where('BalanceDate<= DATE_SUB(NOW(), INTERVAL 1 MONTH)');
		$array2 = $this->db->get()->result_array();

		foreach ($array2 as $value1) {
			$new['lastmonth'] = $value1['lastmonth'];
		}
		return $new;*/
		/*$this->db->select('sum(Balance) as monthly,0 as lastmonth');
		$this->db->from('bankmaster');
		$this->db->where('Active',1);
		$this->db->where('IsDelete',1);
		$this->db->get();
		$query1= $this->db->last_query();

		$this->db->select('0,sum(TotalBankBalnce)');
		$this->db->from('currentbankbalance');
		$this->db->where('BalanceDate<= DATE_SUB(NOW(), INTERVAL 1 MONTH)');
		$this->db->get();
		$query2= $this->db->last_query();
		
		

		$alldata = $this->db->query($query1." UNION ".$query2);
		$result1 = $alldata->result_array();
		return $result1;*/
		$query= $this->db->query("SELECT SUM(monthly) as monthly ,SUM(lastmonth) as lastmonth FROM (
			SELECT sum(Balance) as monthly,0 as lastmonth 
			FROM `bankmaster` WHERE `Active` = 1 AND `IsDelete` = 1 
			UNION 
			SELECT 0,sum(TotalBankBalnce) 
			FROM `currentbankbalance` WHERE `BalanceDate` <= DATE_SUB(NOW(), INTERVAL 1 MONTH)
			) A");
			$result=$query->result_array();
			return $result;

	}

	public function totalBankExpenses(){
		
		/*$this->db->select('sum(BankCom) as comm,0');
		$this->db->from('pspincome');
		$this->db->where('MONTH(CreatedOn) = ',date('m'));
		$this->db->get();
		$query1= $this->db->last_query();

		$this->db->select('sum(FinalBankComm),0');
		$this->db->from('expenses');
		$this->db->where('MONTH(CreatedOn) = ',date('m'));
		$this->db->get();
		$query2= $this->db->last_query();

		$this->db->select('sum(Amount),0');
		$this->db->from('banktransfercharges');
		$this->db->where('MONTH(CreatedOn) = ',date('m'));
		$this->db->get();
		$query3= $this->db->last_query();

		$this->db->select('sum(InCom),sum(OutCom)');
		$this->db->from('bankmaster');
		$this->db->where('MONTH(CreatedOn) = ',date('m'));
		$this->db->get();
		$query4= $this->db->last_query();

		$alldata = $this->db->query($query1." UNION ".$query2." UNION ".$query3." UNION ".$query4);
		$result1 = $alldata->result_array();
		return $result1;*/
		$query= $this->db->query("SELECT SUM(bankcomm) as comm FROM (
							SELECT sum(BankCom) as bankcomm
							FROM `pspincome` 
							WHERE MONTH(CreatedOn) = '05'
							UNION 
							SELECT sum(FinalBankComm) 
							FROM `expenses` 
							WHERE MONTH(CreatedOn) = '05'
							UNION 
							SELECT sum(Amount) 
							FROM `banktransfercharges` 
							WHERE MONTH(CreatedOn) = '05'
							UNION 
							SELECT (sum(InCom) +(OutCom)) 
							FROM `bankmaster` WHERE MONTH(CreatedOn) = '05'
							) A

		");
			$result=$query->result_array();
			return $result;





	}
	public function bankCommissions(){
		/*$this->db->select('p.BankId,sum(p.BankCom) as incomm,0 as outcomm,0');
		$this->db->from('pspincome p');
		$this->db->join('bankmaster b','b.BankId = p.BankId');
		$this->db->get();
		$query1= $this->db->last_query();

		$this->db->select('e.BankId,sum(e.FinalBankComm),0,0');
		$this->db->from('expenses e');
		$this->db->join('bankmaster b','b.BankId = e.BankId');
		$this->db->get();
		$query2= $this->db->last_query();

		$this->db->select('bt.FromBank,bt.ToBank,sum(bt.MoneyInFees) as incomm,sum(bt.MoneyOutFees)');
		$this->db->from('banktransaction bt');
		$this->db->join('bankmaster b','b.BankId = bt.FromBank');
		$this->db->where('bt.ToBank= b.BankId');
		$this->db->get();
		$query4= $this->db->last_query();

		$alldata = $this->db->query($query1." UNION ".$query2." UNION ".$query4);
		$result1 = $alldata->result_array();
		return $result1;*/
		$query= $this->db->query("SELECT A.BankId, BankName ,SUM(incomm) as incomm,SUM(outcomm) as outcomm, BankName ,SUM(incomm) + SUM(outcomm) TotalComm FROM 
(
SELECT `BankId`, sum(BankCom) as incomm, 0 as `outcomm`
FROM `pspincome` GROUP BY `BankId`
UNION 
SELECT `BankId`,0, sum(FinalBankComm)
FROM `expenses` GROUP BY `BankId`
UNION 
SELECT `FromBank`,0, sum(MoneyOutFees) 
FROM `banktransaction` GROUP BY `FromBank`
UNION 
SELECT `ToBank`, sum(MoneyInFees),0 
FROM `banktransaction` GROUP BY `ToBank`
)A 
INNER JOIN bankmaster b ON A.BankId=b.BankId
GROUP BY A.BankId
ORDER BY TotalComm  DESC 
Limit 4");
			$result=$query->result_array();
			return $result;
	}
	public function banksIncomm(){
		$query= $this->db->query("SELECT SUM(NetAmount) value, Monthval, b.BankName
									FROM 
									(
									SELECT SUM(NetBankAmt) NetAmount, MONTHNAME(CreatedOn) Monthval, Bankid  FROM pspincome
									WHERE NetBankAmt > 0 AND CreatedOn > DATE_SUB(now(), INTERVAL 6 MONTH)
									GROUP BY CreatedOn,Bankid

									) A 
									INNER JOIN bankmaster b ON A.bankid = b.Bankid
									Group By Monthval, BankName
									ORDER By Monthval");
			$result=$query->result_array();
			return $result;
	}
	
	
	public function banksIncomm2(){
		$query= $this->db->query("SELECT SUM(NetAmount) value
									FROM 
									(
									SELECT SUM(NetBankAmt) NetAmount, MONTHNAME(CreatedOn) Monthval, Bankid  FROM pspincome
									WHERE NetBankAmt > 0 AND CreatedOn > DATE_SUB(now(), INTERVAL 6 MONTH)
									GROUP BY CreatedOn,Bankid

									) A 
									INNER JOIN bankmaster b ON A.bankid = b.Bankid
									Group By Monthval, BankName
									ORDER By Monthval");
			$result=$query->result_array();
			return $result;
	}
	public function bankBalance(){
		$this->db->select('BankId,BankName,Balance');
		$this->db->from('bankmaster');
		return $this->db->get()->result();
	}
	
}

