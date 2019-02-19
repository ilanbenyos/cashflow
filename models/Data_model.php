<?php
class Data_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	
	public function pspIncome($year,$month1,$month2,$currency){
		$this->db->select('p.PspId as ID,pm.PspName as psp,sum(p.ActualNetAmt) as amount');
		$this->db->from('pspincome p');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		$this->db->where('p.ActualNetAmt !=','0'); 
		$this->db->where('MONTH(p.CreatedOn)>=', $month1);
		$this->db->where('MONTH(p.CreatedOn)<=', $month2);
        $this->db->where('YEAR(p.CreatedOn)', $year);
		$this->db->where('p.Currency', $currency);
		$this->db->where('pm.Active', '1');
		$this->db->group_by('p.PspId'); 
		$this->db->order_by('p.PspId');
		return $this->db->get()->result_array();
	}
	
	public function BankIncome($year,$month1,$month2){
		$this->db->select('BankName,sum(Balance) as amount');
		$this->db->from('bankmaster');
		$this->db->where('Balance !=','0'); 
		$this->db->where('MONTH(CreatedOn)>=', $month1);
		$this->db->where('MONTH(CreatedOn)<=', $month2);
        $this->db->where('YEAR(CreatedOn)', $year);
		$this->db->where('Active', '1');
		$this->db->group_by('BankName'); 
		return $this->db->get()->result_array();
	}
	
	public function total_balance($year){
		$this->db->select('MONTHNAME(CreatedOn) as month ,sum(ActualNetAmt) as  Income');
		$this->db->from('pspincome');
        $this->db->where('YEAR(CreatedOn)', $year);
		$this->db->group_by('month'); 
		$this->db->order_by('month');
		$array_1=$this->db->get()->result_array();
		
		$this->db->select('MONTHNAME(ExpDate) as month ,sum(ActualAmt) as  Income');
		$this->db->from('expenses');
        $this->db->where('YEAR(ExpDate)', $year);
		$this->db->group_by('month'); 
		$this->db->order_by('month');
		$array_2=$this->db->get()->result_array();
				 
		
	}

	public function Expense_by_Category($year,$month1,$month2){
		$this->db->select('distinct(Currency)');
		$this->db->from('expenses');
		$currency_array= $this->db->get()->result_array();

		 $this->db->select('ex.CatId,c.Category');
		 foreach($currency_array as $currency){
			$this->db->select('sum(if(ex.Currency ="'.$currency['Currency'].'",ex.ActualAmt,0))as '.$currency['Currency']);
		}
		$this->db->from('expenses ex');
		$this->db->join('expcategory c','ex.CatId = c.CatId','left');
		$this->db->where('ex.ActualAmt >','0.00'); 
		$this->db->where('MONTH(ex.ExpDate)>=', $month1);
		$this->db->where('MONTH(ex.ExpDate)<=', $month2);
        $this->db->where('YEAR(ex.ExpDate)', $year);
		$this->db->group_by('ex.CatId'); 
	    $this->db->order_by('ex.CatId');
	    return $this->db->get()->result_array();
	}
}