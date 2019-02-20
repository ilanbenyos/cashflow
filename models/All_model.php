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
		$this->db->join ('currencymaster C', 'B.CurId = C.CurId');
		$this->db->order_by($value,$orderBy);
	    return $this->db->get ()->result ();
	}
	public function get_vendor_details(){
	    $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Currency,v.Active' );
	    $this->db->from ( 'vendormaster v' );
		//$this->db->join('expcategory c', 'v.CategoryId=c.CatId');
		$this->db->order_by('v.Active','DESC');
		$this->db->order_by('v.VendorId','DESC');
	    return $this->db->get ()->result(); 
	}
	public function get_vendor_details_byid($id){
	    $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Currency,v.Active,v.Comments , c.CurId,c.CurName' );
	    $this->db->from ( 'vendormaster v' );
	    $this->db->join('currencymaster c','c.CurId = v.Currency');
		//$this->db->join('expcategory c', 'v.CategoryId=c.CatId');
		//$this->db->join('bankmaster b', 'v.BankId=b.BankId');
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
		$this->db->where('p.Active',1);
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
		$this->db->select('p.PspId,p.PspName,p.BankId,p.Comments,p.Active,b.BankName,b.BankId,b.CurId,cm.CurName,p.PayTerm,p.Commission,p.Crr,p.TypeId');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','b.BankId = p.BankId');
		$this->db->join('currencymaster cm','cm.CurId = b.CurId');
		$this->db->where('PspId',$id);
		return $this->db->get()->row();
	}
	public function getPspIncome(){
		$this->db->select('p.*,b.BankName,b.BankId,pm.PspId,pm.PspName');
		$this->db->from('pspincome p');
		$this->db->join('bankmaster b','b.BankId = p.BankId','left');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		//$this->db->where('p.isCRR',1);
		$this->db->order_by('p.CreatedOn','DESC');
		return $this->db->get()->result();
	}
	public function pspIncome($id){
		$this->db->select('p.*,b.BankName,b.BankId,pm.PspId,pm.PspName');
		$this->db->from('pspincome p');
		$this->db->join('bankmaster b','b.BankId = p.BankId','left');
		$this->db->join('pspmaster pm','pm.PspId = p.PspId','left');
		//$this->db->where('p.CRRId',$id);
		$this->db->where('p.TransId',$id);
		$this->db->order_by('p.CreatedOn','DESC');
		return $this->db->get()->row();
	}
	public function getAllCurrency(){
		$this->db->select('CurId,CurName,CurSymbol,Active,CreatedOn');
		$this->db->from('currencymaster');
		$this->db->where('Active',1);
		return $this->db->get()->result();
	}
	public function getCurrency($id){
		$this->db->select('cm.CurId,cm.CurName,cm.Active,b.CurId,b.BankId');
		$this->db->from('currencymaster cm');
		$this->db->join('bankmaster b','cm.CurId =b.CurId');
		$this->db->where('b.BankId',$id);
		$this->db->where('cm.Active',1);
		return $this->db->get()->row();
	}
	public function allPspType(){
		$this->db->select('TypeId,TypeName,Active');
		$this->db->from('psptype');
		$this->db->where('Active',1);
		return $this->db->get()->result();
	}
	public function getpsptype($id){
		$this->db->select('pt.TypeId,pt.TypeName,pt.Active,pm.TypeId,pm.PspId');
		$this->db->from('psptype pt');
		$this->db->join('pspmaster pm','pm.TypeId = pt.TypeId');
		$this->db->where('pm.PspId',$id);
		$this->db->where('Active',1);
		return $this->db->get()->row();
	}
	public function getAllCategories(){
		$this->db->select('CatId,Category,Description,CreatedOn,Active');
		$this->db->from('expcategory');
		$this->db->where('Active',1);
		return $this->db->get()->result();
	}
	public function getcategory($id){
		$this->db->select('CatId,Category,CreatedOn,Active');
		$this->db->from('expcategory');
		$this->db->where('CatId',$id);
		return $this->db->get()->row();
	}
	public function BankTransferdetails($id){
		$this->db->select('bc.BankTransferId,bt.BanktransferName,bc.BankId,bc.Amount,b.BankId');
		$this->db->from('banktransfercharges bc');
		$this->db->join('bankmaster b','b.BankId = bc.BankId');
		$this->db->join('banktransfertype bt','bt.BankTransferId = bc.BankTransferId');
		//$this->db->join('banktransfercharges bc','bc.BankId = bt.BankId');
		$this->db->where('bc.BankId',$id);
		return $this->db->get()->result(); 
	}
	public function getBankTransferData(){
		$this->db->select('bc.BankTransferId,bc.BankId,bc.Amount,b.BankId,b.BankName');
		$this->db->from('banktransfercharges bc');
		$this->db->join('bankmaster b','b.BankId = bc.BankId');
		//$this->db->join('banktransfercharges bc','bc.BankId = bt.BankId');
		return $this->db->get()->result();
	}
	public function getTransferType(){
		$this->db->select('BankTransferId,BanktransferName,Active,CreatedBy');
		$this->db->from('banktransfertype');
		$this->db->where('Active',1);
		return $this->db->get()->result();
	}
	public function transferType($id){
		$this->db->select('BankTransferId,BanktransferName,Active,CreatedBy');
		$this->db->from('banktransfertype');
		$this->db->where('BankTransferId',$id);
		return $this->db->get()->row();
	}
	public function getBankTransferdetails($id){
		$this->db->select('bc.BankTransferId,bc.BankId,bc.Amount,b.BankId,bt.BankTransferId,bt.BanktransferName');
		$this->db->from('banktransfercharges bc');
		$this->db->join('bankmaster b','b.BankId = bc.BankId');
		$this->db->join('banktransfertype bt','bt.BankTransferId = bc.BankTransferId');
		$this->db->where('bc.BankId',$id);
		return $this->db->get()->result();
	}
	public function getCrrGeneratedData($id){    // get only CRR data
		$this->db->select('*');
		$this->db->from('pspincome');
		$this->db->where('CRRId',$id);
		//$this->db->where('p.TransId',$id);
		$this->db->order_by('CreatedOn','DESC');
		return $this->db->get()->row();
	}
	public function vendors(){
		$this->db->select('v.VendorId,v.VendorName,v.Active,v.Currency');
		$this->db->from('vendormaster v');
		/*$this->db->join('currencymaster c','c.CurId = v.Currency');
		$this->db->join('bankmaster b','b.CurId = v.Currency');*/
		$this->db->where('v.Active',1);
		return $this->db->get()->result();
	}
	public function getBanks($id){
		$this->db->select('v.VendorId,v.VendorName,v.Active,v.Currency,c.CurId,c.CurName,b.BankId,b.BankName,b.OctComP');
		$this->db->from('vendormaster v');
		$this->db->join('currencymaster c','c.CurId = v.Currency');
		$this->db->join('bankmaster b','b.CurId = v.Currency');
		$this->db->where('v.Active',1);
		//$this->db->where('v.VendorId',$id);
		$this->db->where('b.BankId',$id);
		return $this->db->get()->row();
	}
	public function getTransferTypeAmount($id){
		$this->db->select('bt.BankTransferId,bt.BanktransferName,bt.Active,bc.BankTransferId,bc.BankId,bc.Amount');
		$this->db->from('banktransfertype bt');
		$this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId');
		$this->db->where('bt.BankTransferId',$id);
		return $this->db->get()->row();
	}
	public function getallExpenses(){
		$this->db->select('e.TransId,e.VendorId,e.BankId,e.Description,e.Currency,e.CatId,e.PlannedAmt,e.ExpDate,e.ActualDate,e.ActualAmt,e.BankTransferId,e.Share,e.FinalBankComm,e.NetFromBank,e.Active,v.VendorId,v.VendorName,b.BankId,b.BankName,bc.BankTransferId,bc.Amount,bt.BanktransferName,bt.BankTransferId');
		$this->db->from('expenses e');
		$this->db->join('vendormaster v','v.VendorId = e.VendorId');
		$this->db->join('banktransfercharges bc','bc.BankTransferId = e.BankTransferId');
		$this->db->join('banktransfertype bt','bt.BankTransferId = bc.BankTransferId');
		$this->db->join('bankmaster b','b.BankId = e.BankId');
		$this->db->where('e.Active',1);
		$this->db->order_by('e.CreatedOn','DESC');
		return $this->db->get()->result();
	}
	public function getexpenses($id){
		$this->db->select('e.TransId,e.VendorId,e.BankId,e.Description,e.Currency,e.CatId,e.PlannedAmt,e.ExpDate,e.ActualDate,e.ActualAmt,e.BankTransferId,e.Share,e.FinalBankComm,e.NetFromBank,e.Active,e.ShareAmount,e.BankOutCommP,e.BankOutCommAmount,e.TransferCommP,e.TransferCommAmount,v.VendorId,v.VendorName,b.BankId,b.BankName,bc.BankTransferId,bc.Amount,bt.BanktransferName,bt.BankTransferId');
		$this->db->from('expenses e');
		$this->db->join('vendormaster v','v.VendorId = e.VendorId');
		/*$this->db->join('banktransfertype bt','bt.BankTransferId = e.ExpCatId');*/
		$this->db->join('banktransfercharges bc','bc.BankTransferId = e.BankTransferId');
		$this->db->join('banktransfertype bt','bt.BankTransferId = bc.BankTransferId');
		$this->db->join('bankmaster b','b.BankId = e.BankId');
		$this->db->where('e.Active',1);
		$this->db->where('e.TransId',$id);
		return $this->db->get()->row();
	}
	public function getAllBankTransaction(){
		$this->db->select('TransId,FromBank,Amount,BankTransferId,MoneyOutFees,ToBank,MoneyInFees,CreatedOn');
		$this->db->from('banktransaction');
		return $this->db->get()->result();
	}
	public function getBankTransaction($id){
		$this->db->select('b.TransId,b.FromBank,b.Amount,b.BankTransferId,b.MoneyOutFees,b.ToBank,b.MoneyInFees,b.CreatedOn,bt.BankTransferId,bt.BanktransferName');
		$this->db->from('banktransaction b');
		$this->db->join('banktransfertype bt','bt.BankTransferId = b.BankTransferId');
		$this->db->where('b.TransId',$id);
		return $this->db->get()->row();
	}
	
}
