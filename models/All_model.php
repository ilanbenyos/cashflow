<?php
class All_model extends CI_Model {
	
	public function __construct() {
		$this->load->database ();
	}
	public function create_user($date,$name,$password,$email,$role){
		$userinfo = array(
			'Name' => $name,
			'Email' => $email,
			'Password' => $password,
			'CreatedOn' => $date,
			'RoleId' => $role
		);
		$this->db->insert('usermaster',$userinfo);
	}
	public function user_login($username, $password)
	{
		/*$this->db->select('Name,Password');
		$this->db->from('usermaster');
		$this->db->where('Email', $username);
		$this->db->where('Password', $password);*/
		$this->db->select('u.UserID,u.Email,u.Name,u.Password,u.RoleId,r.RoleName');
    	$this->db->from('usermaster u');
    	$this->db->join('rolemaster r', 'r.RoleId = u.RoleId');
    	$this->db->where('u.Email', $username);
		$this->db->where('u.Password', $password);
		return $this->db->get()->row();
	}
	public function get_user_details($id){
	    $this->db->select ( 'DATE_FORMAT(CreatedOn,"%d/%m/%Y") as date, DATE_FORMAT(CreatedOn,"%h:%i:%s") as time ,`UserID`, `Name`, `Email`, `Password`, `RoleId`,`Active`' );
	    
	    $this->db->from ( 'usermaster' );
	    $this->db->where ( 'UserID', $id );
	    return $this->db->get ()->row ();
	}
	
	public function getbankData($table,$columns,$wherecol,$id){
	    $this->db->select ( $columns);
	    
	    $this->db->from ( $table );
		$this->db->where($wherecol,$id);
	    return $this->db->get ()->row ();
	}
	
	public function listData($table,$columns,$orderBy='DESC',$value,$join){
	    $this->db->select ( $columns);
	    
	    $this->db->from ( $table );
		$this->db->join ('usermaster UM', 'B.CreatedBy = UM.UserID');
		$this->db->order_by($value,$orderBy);
	    return $this->db->get ()->result ();
	}
	public function get_vendor_details(){
	    $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Amount,v.BankName,v.Active ' );
	    $this->db->from ( 'vendormaster v' );
		//$this->db->join('expcategory c', 'v.CategoryId=c.CatId');
		$this->db->order_by('v.Active','DESC');
		$this->db->order_by('v.VendorId','DESC');
	    return $this->db->get ()->result();
	}
	public function get_vendor_details_byid($id){
	    $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Amount,v.CategoryId,v.Active,v.Comments ,b.BankName,v.BankName as BankID' );
	    $this->db->from ( 'vendormaster v' );
		//$this->db->join('expcategory c', 'v.CategoryId=c.CatId');
		$this->db->join('bankmaster b', 'v.BankName=b.BankId');
		$this->db->where('v.VendorId',$id);
	    return $this->db->get ()->row();
	}
	public function get_active_categories(){
	    $this->db->select ( 'Category,CatId ' );
	    $this->db->from ( 'expcategory' );
		$this->db->where('Active',1);
	    return $this->db->get ()->result();
	}
	public function get_all_psp(){
		$this->db->select('p.PspId, p.PspName, p.BankId, p.CreatedOn, p.Comments, b.BankId, b.BankName,p.Active');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','p.BankId = b.BankId');
		$this->db->order_by('p.Active','DESC');
		$this->db->order_by('p.CreatedOn','DESC');
		return $this->db->get ()->result();
	}
	public function get_all_banks(){
		$this->db->select('BankId,BankName');
		$this->db->from('bankmaster');
		$this->db->where('Active',1);
		return $this->db->get ()->result();
	}
	public function get_psp($id){
		$this->db->select('p.PspId,p.PspName,p.BankId,p.Comments,p.Active,b.BankName,b.BankId,p.PspType,p.PayTerm,p.Commission,p.Crr');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','b.BankId = p.BankId');
		$this->db->where('PspId',$id);
		return $this->db->get()->row();
	}
	
}
