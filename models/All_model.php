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
		$this->db->select('u.UserID,u.Email,u.Name,u.Password,u.RoleId,r.RoleName,u.Active');
    	$this->db->from('usermaster u');
    	$this->db->join('rolemaster r', 'r.RoleId = u.RoleId');
    	$this->db->where('u.Email', $username);
    	$this->db->where('u.Active', 1);
    	$this->db->where('u.IsDelete', 1);
		$this->db->where('u.Password', $password);
		return $this->db->get()->row();
	}
	public function get_user_details($id){
	    $this->db->select ( 'DATE_FORMAT(CreatedOn,"%d/%m/%Y") as date, DATE_FORMAT(CreatedOn,"%h:%i:%s") as time ,`UserID`, `Name`, `Email`, `Password`, `RoleId`,`Active`,`CallCenterVendorId`' );
	    
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
		$this->db->where('B.IsDelete',1);
		$this->db->order_by($value,$orderBy);
	    return $this->db->get ()->result ();
	}
	public function get_vendor_details(){
	    $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Currency,v.Active,v.IsDelete' );
	    $this->db->from ( 'vendormaster v' );
		//$this->db->join('callcenter_expense_category c', 'v.CategoryId=c.CatId');
		$this->db->order_by('v.Active','DESC');
		$this->db->where('v.IsDelete',1);
		$this->db->order_by('v.VendorId','DESC');
	    return $this->db->get ()->result(); 
	}
	public function get_vendor_details_byid($id){
	    $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Currency,v.InvoiceDate,v.Active,v.Comments,v.ReminderOn,v.IsCallCenter,v.CallCenterlocation,v.CallCenterManager,v.CallCenterCashBalance, c.CurId,c.CurName,v.Bank,v.BankAddress,v.IBAN' );
	    $this->db->from ( 'vendormaster v' );
	    $this->db->join('currencymaster c','c.CurId = v.Currency');
		//$this->db->join('callcenter_expense_category c', 'v.CategoryId=c.CatId');
		//$this->db->join('bankmaster b', 'v.BankId=b.BankId');
		$this->db->where('v.VendorId',$id);
	    return $this->db->get ()->row();
	}
	
	public function get_vendor_currency_byid($id){
	    $this->db->select ( 'c.CurName' );
	    $this->db->from ( 'vendormaster v' );
	    $this->db->join('currencymaster c','c.CurId = v.Currency');
		$this->db->where('v.VendorId',$id);
	    return $this->db->get ()->row();
	}
	
	public function get_active_categories(){
	    $this->db->select ( 'Category,CatId ' );
	    $this->db->from ( 'callcenter_expense_category' );
	    $this->db->order_by('Category','ASC');
		$this->db->where('Active',1);
	    return $this->db->get ()->result();
	}
	public function get_all_psp(){
		$this->db->select('p.PspId, p.PspName, p.BankId, p.CreatedOn, p.Comments, b.BankId, b.BankName,p.Active,p.Balance');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','p.BankId = b.BankId');
		$this->db->where('p.Active',1);
		$this->db->where('p.IsDelete',1);
		$this->db->order_by('p.PspName','ASC');
		$this->db->order_by('p.Active','DESC');
		$this->db->order_by('p.CreatedOn','DESC');
		return $this->db->get ()->result();
	}
	public function get_all_psps(){
		$this->db->select('p.PspId, p.PspName, p.BankId, p.CreatedOn, p.Comments, b.BankId, b.BankName,p.Active,p.Balance');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','p.BankId = b.BankId');
		//$this->db->where('p.Active',1);
		$this->db->where('p.IsDelete',1);
		$this->db->order_by('p.Active','DESC');
		$this->db->order_by('p.CreatedOn','DESC');
		return $this->db->get ()->result();
	}
	public function get_all_active_banks_with_psp($id){
		$this->db->select('p.PspId, p.PspName, p.BankId, p.CreatedOn, p.Comments, b.BankId, b.BankName,p.Active,p.Balance');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','p.BankId = b.BankId');
		//$this->db->where('p.Active',1);
		$this->db->where('b.BankId',$id);
		/*$this->db->order_by('p.Active','DESC');
		$this->db->order_by('p.CreatedOn','DESC');*/
		return $this->db->get ()->result();
	}
	public function get_all_banks(){
		$this->db->select('BankId,BankName,Balance,MinBalance,MaxBalance');
		$this->db->from('bankmaster');
		$this->db->where('Active',1);
		$this->db->where('IsDelete',1);
		$this->db->order_by('BankName','ASC');
		return $this->db->get ()->result();
	}
	public function get_psp($id){
		$this->db->select('p.PspId,p.PspName,p.BankId,p.Balance,p.Comments,p.Active,b.BankName,b.BankId,b.CurId,cm.CurName,p.PayTerm,p.Commission,p.Crr,p.TypeId,b.InComP,b.InCom');
		$this->db->from('pspmaster p');
		$this->db->join('bankmaster b','b.BankId = p.BankId');
		$this->db->join('currencymaster cm','cm.CurId = b.CurId');
		$this->db->where('p.PspId',$id);
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
		$this->db->order_by('CurName','ASC');
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
		$this->db->order_by('TypeName','ASC');
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
		$this->db->from('callcenter_expense_category');
		$this->db->where('Active',1);
		$this->db->order_by('CreatedOn','DESC');
		return $this->db->get()->result();
	}
	public function getcategory($id){
		$this->db->select('CatId,Category,CreatedOn,Active');
		$this->db->from('callcenter_expense_category');
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
		$this->db->order_by('BanktransferName','ASC');
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
	public function GET_vendors($id){
		$this->db->select('v.VendorId,v.VendorName,v.Active,v.Currency');
		$this->db->from('vendormaster v');
		$this->db->where('v.Active',1);
		$this->db->where('v.IsDelete',1);
		$this->db->where('v.VendorId',$id);
		return $this->db->get()->row();;
	}
	public function vendors(){
		$this->db->select('v.VendorId,v.VendorName,v.Active,v.Currency');
		$this->db->from('vendormaster v');
		/*$this->db->join('currencymaster c','c.CurId = v.Currency');
		$this->db->join('bankmaster b','b.CurId = v.Currency');*/
		$this->db->where('v.Active',1);
		$this->db->where('v.IsDelete',1);
		$this->db->order_by('v.VendorName','ASE');
		return $this->db->get()->result();
	}
	public function getBanks($id){
		/*$this->db->select('v.VendorId,v.VendorName,v.Active,v.Currency,c.CurId,c.CurName,b.BankId,b.BankName,b.OctComP');
		$this->db->from('vendormaster v');
		$this->db->join('currencymaster c','c.CurId = v.Currency');
		$this->db->join('bankmaster b','b.CurId = v.Currency');
		$this->db->where('v.Active',1);
		//$this->db->where('v.VendorId',$id);
		$this->db->where('b.BankId',$id);
		return $this->db->get()->row();*/
		$this->db->select('c.CurId,c.CurName,b.BankId,b.BankName,b.OctComP');
		$this->db->from('bankmaster b');
		$this->db->join('currencymaster c','c.CurId = b.CurId');
		$this->db->where('b.Active',1);
		//$this->db->where('v.VendorId',$id);
		$this->db->where('b.BankId',$id);
		return $this->db->get()->row();
	}
	public function getTransferTypeAmount($id){
		$this->db->select('bt.BankTransferId,bt.BanktransferName,bt.Active,bc.BankTransferId,bc.BankId,bc.Amount');
		$this->db->from('banktransfertype bt');
		$this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId');
		$this->db->where('bc.BankId',$id);
		return $this->db->get()->row();
	}
	public function getTransferTypeAmount1($id){
		$this->db->select('bt.BankTransferId,bt.BanktransferName,bt.Active,bc.BankTransferId,bc.BankId,bc.Amount');
		$this->db->from('banktransfertype bt');
		$this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId');
		$this->db->where('bc.BankTransferId',$id);
		return $this->db->get()->row();
	}

	public function getallExpenses(){
		$this->db->select('e.TransId,e.VendorId,e.BankId,e.Description,e.Currency,e.CatId,e.PlannedAmt,e.ExpDate,e.ActualDate,e.ActualAmt,e.BankTransferId,e.Share,e.FinalBankComm,e.NetFromBank,e.Active,v.VendorId,v.VendorName,b.BankId,b.BankName,bc.BankTransferId,bc.Amount,bt.BanktransferName,bt.BankTransferId');
		$this->db->from('expenses e');
		$this->db->join('vendormaster v','v.VendorId = e.VendorId');
		$this->db->join('banktransfercharges bc','bc.BankTransferId = e.BankTransferId AND bc.BankId =  e.BankId','left');
		$this->db->join('banktransfertype bt','bt.BankTransferId = bc.BankTransferId','left');
		$this->db->join('bankmaster b','b.BankId = e.BankId');
		//$this->db->where('bc.BankId =  e.BankId');
		$this->db->where('e.Active',1);
		$this->db->order_by('e.CreatedOn','DESC');
		return $this->db->get()->result();
	}
	public function getexpenses($id){
		/*$this->db->select('e.TransId,e.VendorId,e.BankId,e.Description,e.Currency,e.CatId,e.PlannedAmt,e.ExpDate,e.ActualDate,e.ActualAmt,e.BankTransferId,e.Share,e.FinalBankComm,e.NetFromBank,e.Active,e.ShareAmount,e.BankOutCommP,e.BankOutCommAmount,e.TransferCommP,e.TransferCommAmount,v.VendorId,v.VendorName,b.BankId,b.BankName,bc.BankTransferId,bc.Amount,bt.BanktransferName,bt.BankTransferId');
		$this->db->from('expenses e');
		$this->db->join('vendormaster v','v.VendorId = e.VendorId');
		$this->db->join('banktransfercharges bc','bc.BankTransferId = e.BankTransferId');
		$this->db->join('banktransfertype bt','bt.BankTransferId = bc.BankTransferId');
		$this->db->join('bankmaster b','b.BankId = e.BankId');
		$this->db->where('e.Active',1);
		$this->db->where('e.TransId',$id);*/
		$this->db->select('e.TransId,e.VendorId,e.BankId,e.DocumentPath,e.Description,e.Currency,e.CatId,e.PlannedAmt,e.ExpDate,e.ActualDate,e.ActualAmt,e.BankTransferId,e.Share,e.FinalBankComm,e.NetFromBank,e.Active,e.ShareAmount,e.BankOutCommP,e.BankOutCommAmount,e.TransferCommP,e.TransferCommAmount,v.VendorId,v.VendorName,b.BankId,b.BankName,bt.BanktransferName,bt.BankTransferId');
		$this->db->from('expenses e');
		$this->db->join('vendormaster v','v.VendorId = e.VendorId');
		//$this->db->join('banktransfercharges bc','bc.BankTransferId = e.BankTransferId');
		$this->db->join('banktransfertype bt','bt.BankTransferId = e.BankTransferId');
		$this->db->join('bankmaster b','b.BankId = e.BankId');
		$this->db->where('e.Active',1);
		$this->db->where('e.TransId',$id);
		return $this->db->get()->row();
	}
	public function getAllBankTransaction(){
		$this->db->select('B.TransId,B.FromBank,B.Amount,B.BankTransferId,B.MoneyOutFees,B.ToBank,B.MoneyInFees,B.CreatedOn,bt.BanktransferName,bt.BankTransferId,bm.BankId,bm.BankName as fromBank,bmt.BankId,bmt.BankName as toBank');
		$this->db->from('banktransaction B');
		$this->db->join('banktransfertype bt','bt.BankTransferId = B.BankTransferId','left');
		//$this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId','left');
		$this->db->join('bankmaster bm','bm.BankId = B.FromBank','left');
		$this->db->join('bankmaster bmt','bmt.BankId = B.ToBank','left');
		$this->db->order_by('B.CreatedOn','DESC');
		return $this->db->get()->result();
	}
	public function getBankTransaction($id){
		$this->db->select('b.TransId,b.FromBank,b.Amount,b.BankTransferId,b.MoneyOutFees,b.ToBank,b.MoneyInFees,b.CreatedOn,bt.BankTransferId,bt.BanktransferName');
		$this->db->from('banktransaction b');
		$this->db->join('banktransfertype bt','bt.BankTransferId = b.BankTransferId');
		$this->db->where('b.TransId',$id);
		return $this->db->get()->row();
	}
	public function getAllNotifications(){
		$this->db->select('*');
		$this->db->from('vendormaster');
		$this->db->where('Active',1);
		$this->db->where('Comments!=',"");
		$this->db->ORDER_BY('VendorId','DESC');
		return $this->db->get()->result();
	}
	public function getAllCallCenterExp($vendorid){ 
		$this->db->select('c.ExpId,c.ExpName,c.VendorId,c.ExpAmount,c.EuroValue,c.ExpDate,c.ExpPaymentType,c.IsInvoiceGen,e.CatId,e.Category,e.Active');
		$this->db->from('callcenterexpenses c');
		$this->db->join('callcenter_expense_category e','c.ExpName = e.CatId');
		//$this->db->join('usermaster u','c.VendorId = u.CallCenterVendorId');
		$this->db->where('c.VendorId',$vendorid);
		$this->db->where('e.Active',1);
		$this->db->where('c.IsDelete',1);
		//$this->db->order_by('c.CreatedOn','DESC');
		$this->db->order_by('c.CreatedOn','DESC');
		//$this->db->join('psptype p','p.TypeId=c.ExpPaymentType');
		
		//$this->db->where('p.Active',1);
		return $this->db->get()->result();
	}
	public function editCallCenterExp($id){
		$this->db->select('c.ExpId,c.ExpName,c.DocumentPath,c.VendorId,c.ExpAmount,c.EuroValue,c.ExpDate,c.ExpPaymentType,e.CatId,e.Category,e.Active');
		$this->db->from('callcenterexpenses c');
		$this->db->join('callcenter_expense_category e','c.ExpName = e.CatId');
		//$this->db->join('psptype p','p.TypeId=c.ExpPaymentType');
		/*$this->db->where('e.Active',1);
		$this->db->where('p.Active',1);*/
		$this->db->where('c.ExpId',$id);
		return $this->db->get()->row();
	}
	public function generateMonthlyInvoice(){
		/*$this->db->select('ExpId,ExpName,sum(ExpAmount) as amount,CreatedOn,ExpDate');
		$this->db->from('callcenterexpenses');
		$this->db->where('IsInvoiceGen',0);
		$this->db->where('MONTH(ExpDate)=MONTH(CURRENT_DATE())');
		$this->db->group_by('ExpId');*/
		//$this->db->order_by('ExpId','DESC');
		$this->db->select('c.ExpId,c.VendorId,c.ExpName,sum(c.ExpAmount) as amount,sum(c.EuroValue) as amount_euro,c.CreatedOn,c.ExpDate,u.UserID,u.CallCenterVendorId');
		$this->db->from('callcenterexpenses c');
		$this->db->join('usermaster u','c.VendorId = u.CallCenterVendorId');
		//$this->db->where('u.UserID',$_SESSION['userid']);
		$this->db->where('c.IsInvoiceGen',0);
		$this->db->where('MONTH(c.ExpDate)=MONTH(CURRENT_DATE())');
		$this->db->group_by('c.ExpId');
		return $this->db->get()->result();
	}
	public function generateMonthlyInvoiceAdmin(){ 
		$this->db->select('ExpId,VendorId,ExpName,sum(ExpAmount) as amount,CreatedOn,ExpDate');
		$this->db->from('callcenterexpenses');
		$this->db->where('IsInvoiceGen',0);
		$this->db->where('IsDelete',1);
		$this->db->where('MONTH(ExpDate)=MONTH(CURRENT_DATE())');
		$this->db->group_by('ExpId');
		//$this->db->order_by('ExpId','DESC');
	
		return $this->db->get()->result();
	}
	public function callCenterNoti(){
		$this->db->select('NotificationId,VendorId,ExpId,Amount,PlannedDate,Status');
		$this->db->from('callcenternotification');
		$this->db->where('Status',1);
		return $this->db->get()->row();
	}
	public function getCallCenterVendor(){
		 $this->db->select ( 'v.VendorId,v.VendorName,v.InvoiceType,v.Currency,v.Active' );
	    $this->db->from ( 'vendormaster v' );
	    $this->db->where('IsCallCenter',1);
		$this->db->order_by('v.Active','DESC');
		$this->db->order_by('v.VendorId','DESC');
	    return $this->db->get ()->result(); 
	}
	public function callCenterVendor($id){
		$this->db->select('NotificationId,VendorId,ExpId,Amount,PlannedDate,Status');
		$this->db->from('callcenternotification');
		$this->db->where('NotificationId',$id);
		$this->db->where('Status',1);
		return $this->db->get()->row();
	}
	public function getAllCallCenterVendor(){
		$this->db->select('c.ExpId,c.ExpName,c.VendorId,c.ExpAmount,c.EuroValue,c.ExpDate,c.ExpPaymentType,c.IsInvoiceGen,e.CatId,e.Category,e.Active,v.VendorId,v.VendorName');
		$this->db->from('callcenterexpenses c');
		$this->db->join('callcenter_expense_category e','c.ExpName = e.CatId');
		//$this->db->join('usermaster u','c.VendorId = u.CallCenterVendorId');
		$this->db->join('vendormaster v','c.VendorId=v.VendorId');
		$this->db->where('e.Active',1);
		$this->db->where('c.IsDelete',1);
		//$this->db->order_by('c.CreatedOn','DESC');
		$this->db->order_by('c.CreatedOn','DESC');
		return $this->db->get ()->result(); 
	}
	public function getCallCenterVendorUser(){   // get call center vendor assign to user
		$this->db->select('u.UserID,u.CallCenterVendorId,v.VendorId,v.VendorName');
		$this->db->from('usermaster u');
		$this->db->join('vendormaster v','u.CallCenterVendorId=v.VendorId');
		$this->db->where('u.Active',1);
		$this->db->where('u.IsDelete',1);
		return $this->db->get ()->result(); 

	}
	public function getAllcallcenternotification(){
		$this->db->select('c.NotificationId,c.VendorId,c.ExpId,c.Amount,v.VendorId,v.VendorName,v.IsCallCenter,v.Active');
	   $this->db->from('callcenternotification c');
	   $this->db->join('vendormaster v','v.VendorId = c.VendorId');
	   $this->db->where('v.Active',1);
	   $this->db->where('c.status',1);
	   $this->db->order_by('NotificationId','DESC');
	   return $this->db->get ()->result(); 

	}
	/*public function getCallCenterVendorName($id){
		$this->db->select('c.ExpId,v.VendorId,v.VendorName');
		$this->db->from('callcenterexpenses c');
		$this->db->join('vendormaster v','c.VendorId=v.VendorId');
		$this->db->where('c.ExpId',$id);
		$this->db->where('c.IsDelete',1);
		$this->db->order_by('c.CreatedOn','DESC'); 
		return $this->db->get()->row();
	}*/
	public function getCallCenterFunds($id){
		$this->db->select('RequestId,VendorID,RequestAmount,Currency');
		$this->db->from('callcenter_fund_request');
		$this->db->where('RequestId',$id);
		return $this->db->get()->row();
	}
	public function profileDetails(){
		$this->db->select('v.VendorName,v.InvoiceType,v.Comments,c.CurName,v.BankAddress,v.IBAN,v.CallCenterCashBalance,v.Comments,v.Balance,u.Email,u.Password,b.BankName,v.Active');
	      $this->db->from('vendormaster v');
		  $this->db->join('usermaster u','v.VendorId = u.CallCenterVendorId');
		  $this->db->join('bankmaster b','v.Bank = b.BankId','left');
		  $this->db->join('currencymaster c','v.Currency = c.CurId','left');
	      $this->db->where('u.UserID',$_SESSION['userid']);
	      return $this->db->get()->row();
	}
	
}
