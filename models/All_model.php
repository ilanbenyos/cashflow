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
	    $this->db->select ( 'DATE_FORMAT(CreatedOn,"%d/%m/%Y") as date, DATE_FORMAT(CreatedOn,"%h:%i:%s") as time ,`UserID`, `Name`, `Email`, `Password`, `RoleId`' );
	    
	    $this->db->from ( 'usermaster' );
	    $this->db->where ( 'UserID', $id );
	    return $this->db->get ()->row ();
	}
}
