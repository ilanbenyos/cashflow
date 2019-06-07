<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper ( 'url_helper' );
		$this->load->helper ( 'url' );
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('all_model');
		$this->load->helper('prodconfig');
	}
    public function index(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        //$this->load->view('test/test');
        //$this->load->view('templates/footer1');
    }
    public function test1(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test2(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test3(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test4(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test5(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test6(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
	
	 public function upload_test(){
        $this->load->view('test_upload');
    }
	public function Upload() {
       $config['upload_path'] = realpath(APPPATH . '../upload_document');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            print_r($error);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            print_r($data);

        }
    }

    public function test100()
    {
    	print date('l');
    	
    	$date = date('l');
    	$date1 = date('d/m/Y');
    	
    	$this->db->select('VendorId, VendorName, InvoiceType, ReminderOn,CreatedOn');
    	$this->db->from('vendormaster');
    	$this->db->where('InvoiceType', 'Weekly');
    	$this->db->where('ReminderOn',$date);
    	$this->db->where('Active',1);
    	$this->db->get();
    	$query1= $this->db->last_query();
    	
    	
    	$this->db->select('VendorId, VendorName, InvoiceType, ReminderOn,CreatedOn');
    	$this->db->from('vendormaster');
    	$this->db->where('InvoiceType', 'Monthly');
    	$this->db->where('ReminderOn !=',NULL);
    	$this->db->where('Day(STR_TO_DATE(REPLACE(ReminderOn , "/", ","),"%d,%m,%Y")) = day(NOW())');
    	$this->db->where('Active',1);
    	$this->db->get();
    	$query2= $this->db->last_query();
    	
    	$this->db->select('VendorId, VendorName, InvoiceType, ReminderOn,CreatedOn');
    	$this->db->from('vendormaster');
    	$this->db->where('InvoiceType', 'Quarterly');
    	$this->db->where('ReminderOn !=',NULL);
    	$this->db->where('Day(STR_TO_DATE(REPLACE(ReminderOn , "/", ","),"%d,%m,%Y")) = day(NOW())');
    	$this->db->where('Active',1);
    	$this->db->order_by('CreatedOn','DESC');
    	$this->db->get();
    	$query3= $this->db->last_query();
    	//$query3 = $this->db->get_compiled_select();
    	//}
    	//call center notification start
    	$this->db->select('c.NotificationId,c.VendorId,c.ExpId,c.Amount,v.VendorId,v.VendorName,v.IsCallCenter,v.Active');
    	$this->db->from('callcenternotification c');
    	$this->db->join('vendormaster v','v.VendorId = c.VendorId');
    	$this->db->where('v.Active',1);
    	$this->db->where('c.status',1);
    	$this->db->order_by('NotificationId','DESC');
    	$query4 = $this->db->get();
    	$callcenter = $query4->result();
    	//call center notification end
    	
    	//Bank Balance Alert start
    	$this->db->select('r.RequestId,r.VendorID,r.RequestAmount,c.CurName,v.VendorName as Name,r.CreatedOn');
    	//$this->db->from('callcenter_request r');
    	$this->db->from('callcenter_fund_request r');
    	$this->db->join('vendormaster v','v.VendorId = r.VendorID');
    	$this->db->join('currencymaster c','r.Currency = c.CurId');
    	$this->db->where('r.ReminderStatus',0);
    	$this->db->order_by('r.CreatedOn','DESC');
    	$callcenter_request= $this->db->get ()->result();
    	//print_r($this->db->last_query());
    	//Bank Balance Alert end
    	
    	//call center approved amount received
    	$this->db->select('c.createdon, c.vendor_id,c.status,c.adminread,c.Amount_ReceivedEuroVal,c.id,v.VendorID,v.VendorName');
    	$this->db->from('callcenter_expense_details c');
    	$this->db->join('vendormaster v','v.VendorId = c.vendor_id');
    	$this->db->where('c.status',1);
    	$this->db->where('adminread',0);//$this->db->where('adminread',null);
    	//$this->db->where('c.vendor_id',$_SESSION['userid']);
    	$this->db->order_by('createdon','DESC');
    	$query5 = $this->db->get();
    	$callcenter_expense_details = $query5->result();
    	$countcallcenter = count($callcenter_expense_details);
    	
    	//call center approved amount received
    	
    	$alldata = $this->db->query($query1." UNION ALL ".$query2. " UNION ALL " .$query3 );
    	
    	$result1 = $alldata->result();
  //  	$count1 = count($result1);
    	
    	
    	
    	$query_new= $this->db->query("Select id, Amount, RequestAmount , CurName, Name, CreatedOn, IsCallCenter, comment
From
(
Select c.NotificationId as id,c.Amount,0 as RequestAmount ,0 as CurName,v.VendorName as Name,c.CreatedOn,v.IsCallCenter,0 as InvoiceType,0 as ReminderOn, 'Call Center Expenses' as comment from callcenternotification c join vendormaster v on v.VendorId = c.VendorId where v.Active ='1' and c.status ='1' 
union
Select r.RequestId as id,0 as Amount,r.RequestAmount,c.CurName,v.VendorName as Name,r.CreatedOn,0 as IsCallCenter,0 as InvoiceType,0 as ReminderOn,'Requested Fund'as comment from callcenter_fund_request r join vendormaster v on v.VendorId = r.VendorID join currencymaster c on r.Currency = c.CurId where r.ReminderStatus ='0'
union
select c.id as id,c.Amount_ReceivedEuroVal as Amount,0 as RequestAmount,0 as CurName,v.VendorName as Name,c.createdon,0 as IsCallCenter,0 as InvoiceType,0 as ReminderOn,'Call Center received'as comment from callcenter_expense_details c join vendormaster v on v.VendorId = c.vendor_id where c.status='1' and c.adminread='0'
union
select VendorId as id,0 as Amount,0 as RequestAmount,0 as CurName, VendorName as Name,CreatedOn,0 as IsCallCenter, InvoiceType, ReminderOn,'reminder'as comment from vendormaster where InvoiceType = 'Weekly' and ReminderOn='$date' and Active='1'
union
select VendorId as id,0 as Amount,0 as RequestAmount,0 as CurName, VendorName as Name,CreatedOn,0 as IsCallCenter, InvoiceType, ReminderOn,'reminder'as comment from vendormaster where InvoiceType = 'Monthly' and ReminderOn !=null and Day(STR_TO_DATE(REPLACE(ReminderOn , '/', ','),'%d,%m,%Y')) = day(NOW()) and Active='1'
union
select VendorId as id,0 as Amount,0 as RequestAmount,0 as CurName, VendorName as Name,CreatedOn,0 as IsCallCenter, InvoiceType, ReminderOn,'reminder'as comment from vendormaster where InvoiceType = 'Quarterly' and ReminderOn !=null and Day(STR_TO_DATE(REPLACE(ReminderOn , '/', ','),'%d,%m,%Y')) = day(NOW()) and Active='1'
)A 
order by CreatedOn desc");
    	$query_res= $query_new->result();    	
    //	print count($query_res);exit();
    	
    //	$count1+= count($callcenter);
    //	$count1+= count($callcenter_request);
    //	$count1+= $countcallcenter;
    	
    	$count1= count($query_res);
    	
    	/*}
    	
    	}*/
    	
    	
    	
    	
    	?>
            <a href="#" <?php 
				  if($count1 > 0)
				  {
				  ?>
				  <?php 
				  }
				  ?>
				  >
            <?php 
				  if($count1 > 0)
				  {
				  ?>
            <abbr class="note-count" style="border-radius:10px;"><?php echo $count1; ?></abbr>
            <?php 
				  }
				  ?>
            <span><i class="fa fa-bell" aria-hidden="true"></i></span></a>
           <div class="notification-dropdown">
              <div class="note-title">You have <?php echo $count1; ?> notifications</div>
              <ul class="notification-menu">
                <li> 
                  <!-- inner menu: contains the actual data -->
                  <ul class="inner-menu">
                    <?php 
            
					foreach($query_res as $notif1)
					{
						
						if($notif1->comment=="Call Center Expenses")
						{
						?>
                    	<li> <a href="<?php echo base_url('Expenses/updateCallCenterExp/'.$notif1->id);?>"> <?php echo 'Call Center Expenses for -' . $notif1->Name;  ?> </a> </li>
                    	<?php 
						}
						if($notif1->comment=="Requested Fund")
						{
							$curr = 'USD';
							$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
							
							$val=json_decode($val);
							$exchange_rate = $val->rates->EUR;
							
							if ($notif1->CurName == 'EUR') {
								$euro_amount = $notif1->RequestAmount * 1;
								unset($_SESSION['euro_amt']);
								$_SESSION['euro_amt'.$notif1->id] = $euro_amount;
							}else{
								$euro_amount = $notif1->RequestAmount * $exchange_rate;
								unset($_SESSION['euro_amt']);
								$_SESSION['euro_amt'.$notif1->id] = $euro_amount;
							}
							?>
                     	<li> <a  href="<?php echo base_url('Expenses/updateCallCenterReqFund/'.$notif1->id);?>" > <?php echo $notif1->Name. ' Requested Fund Of  €' . number_format($euro_amount, 2, '.', ',')   ?> </a> </li>
                    	<?php 
						}
						if($notif1->comment=="Call Center received")
						{
						?>
                    	<li> <a href="<?php echo base_url('Expenses/updateCallCenterExpDetails/'.$notif1->id);?>"> <?php echo 'Call Center '.$notif1->Name.' received €' . $notif1->Amount;  ?> </a> </li>
                        <?php
						}
						if($notif1->comment=="reminder")
						{
						?>
                    	<li> <a href="<?php echo base_url('configuration/vendors/update_notification/'.$notif1->id);?>"> <?php echo 'Payment Reminder For -' . $notif1->Name;  ?> </a> </li>
                    	<?php 
						}
					}
			/*		
			         foreach($result1 as $notif)
                    {
                    	
                    	?>
                    <li> <a href="<?php echo base_url('configuration/vendors/update_notification/'.$notif->VendorId);?>"> <?php echo 'Payment Reminder For -' . $notif->VendorName;  ?> </a> </li>
                    <?php 
					}
					
					foreach($callcenter_request as $notif1)
						{
							//print_r($notif1->RequestAmount);

              $curr = 'USD';
              $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->EUR;
                        
                        if ($notif1->CurName == 'EUR') {
								$euro_amount = $notif1->RequestAmount * 1;
		                        unset($_SESSION['euro_amt']);
		                        $_SESSION['euro_amt'.$notif1->RequestId] = $euro_amount;
							}else{
								$euro_amount = $notif1->RequestAmount * $exchange_rate;
		                        unset($_SESSION['euro_amt']);
		                        $_SESSION['euro_amt'.$notif1->RequestId] = $euro_amount;
							}
						?>
                    <!-- <li> <a  class="announce" data-toggle="modal"   id="<?php  echo $notif1->RequestId.'^'.$notif1->RequestAmount.'^'.$notif1->Name .'^'.$notif1->CurName ?>"> <?php echo $notif1->Name. ' Requested Fund Of ' . $notif1->RequestAmount .' '.$notif1->CurName  ?> </a> </li> -->
                    <li> <a  href="<?php echo base_url('Expenses/updateCallCenterReqFund/'.$notif1->RequestId);?>" > <?php echo $notif1->Name. ' Requested Fund Of  €' . number_format($euro_amount, 2, '.', ',')   ?> </a> </li>
                    <?php 
						}					 
			  
						foreach($callcenter as $notif1)
						{

						?>
                    <li> <a href="<?php echo base_url('Expenses/updateCallCenterExp/'.$notif1->NotificationId);?>"> <?php echo 'Call Center Expenses for -' . $notif1->VendorName;  ?> </a> </li>
                    <?php 
						} 
					foreach($callcenter_expense_details as $notif1)
						{

						?>
                    <li> <a href="<?php echo base_url('Expenses/updateCallCenterExpDetails/'.$notif1->id);?>"> <?php echo 'Call Center '.$notif1->VendorName.' received €' . $notif1->Amount_ReceivedEuroVal;  ?> </a> </li>
                  
                    <?php 
						}
						
			*/		
						
						
					  ?>
                  </ul>
                </li>
              </ul>
              <div class="btm-view-all"><a href="<?php echo base_url('configuration/vendors/notification'); ?>">View all</a></div>
            </div>
            <?php 
    }
    
    public function db_query()
    {
    	//	$query3= $this->db->query("SELECT table_name FROM information_schema.tables");
    	//	$query3 = $this->db->query("Alter table crm_user add column mailing_group tinyint(1) default 0");
    //		$query3 = $this->db->query("UPDATE callcenter_fund_request SET CreatedOn = '2019-06-06 13:57:00' ");
    	$query3 = $this->db->query("select * from callcenter_fund_request");
    	
    	$data_1= $query3->result();
    	
    	print"<pre>";
    	print_r($data_1);
    	print"</pre>";
    }
}
