<!DOCTYPE HTML>
<html>
<head>
<title>Cash Flow</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?= base_url('assets/favicon.ico')?>" type="image/x-icon">
<link rel="icon" href="<?= base_url('assets/favicon.ico')?>" type="image/x-icon">
<!--------------- Bootstrap CSS --------------->
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/datepicker.css') ?>">
<!------------- Common Stylesheet ------------->
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/datatable.css') ?>">
<link href="<?= base_url('assets/css/pnotify.custom.min.css')?>" media="all" rel="stylesheet" type="text/css" />
<script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src=" https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script src=" https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<script type="text/javascript">
   $(function(){
   $(".announce").click(function(){
	var val = this.id;	
    var num = val.split("^");
	var txt = "";
	var txt = num[2]+" requested for fund of " +num[1]+' '+num[3];
	var paragraph = document.getElementById("label_note");
	paragraph.innerHTML = txt;
     $('#myModal_popo').modal('show');
   });
   });
</script>
</head>
 <?php 
 if (isset ( $_SESSION ['session_exp'] )) {
   popup3 ();
}
 ?>
<body>
<header class="site-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 no-padding relative">
        <?php if ($_SESSION['user_role'] == "Call Center User") { 
      		$url = base_url('all-expenses');
      	 }else{
      	 	$url = base_url('configuration');;
      	 } ?>
        <div class="logo"> <a href="<?= $url; ?>"><img class="aligncenter img-responsive" src="<?= base_url('assets/images/logo.png')?>"></a></div>
        <div class="navbar-bars">
          <button type="button" id="sidebarCollapse" class="navbar-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 no-left-pad">
        <div class="top-header-right clearfix">
          <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true))
          { ?>
          <div class="user-detail"><a href="#"><span><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $_SESSION['user_email'] ?></span></a>
            <div class="user-dropdown"><span><a href="#"><?php echo $_SESSION['user_role'] ?></a></span><span><a href="<?php echo base_url('/login/logout');?>">Signout</a></span></div>
          </div>
          <?php }?>
          <div class="notification-detail">
            <?php 
          
              
               $date = date('l');
               $date1 = date('d/m/Y');

               
		   if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
               {
               
               	/*
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
				   $this->db->select('c.createdon, c.vendor_id,c.status,c.adminread,c.Amount_ReceivedEuroVal as Amount_ReceivedEuroVal,c.id as id,v.VendorID,v.VendorName as VendorName');
				   $this->db->from('callcenter_expense_details c');
				   $this->db->join('vendormaster v','v.VendorId = c.vendor_id');
				   $this->db->where('c.status',1);
				   $this->db->where('adminread',0);//$this->db->where('adminread',null);
				   //$this->db->where('c.vendor_id',$_SESSION['userid']);
				   $this->db->order_by('createdon','DESC');
				   $query5 = $this->db->get();
				   $callcenter_expense_details = $query5->result();
				   $countcallcenter = count($callcenter_expense_details);
*/
				     //call center approved amount received
				   
	//			   $alldata = $this->db->query($query1." UNION ALL ".$query2. " UNION ALL " .$query3 );
				   
	//			   $result1 = $alldata->result();
				//   $count1 = count($result1);

			//	   $count1+= count($callcenter);
		//		   $count1+= count($callcenter_request);
		//		   $count1+= $countcallcenter;
					  
				   $query_new= $this->db->query("Select id, Amount, RequestAmount , CurName, Name, CreatedOn, IsCallCenter, comment
From
(
Select c.NotificationId as id,c.Amount,0 as RequestAmount ,0 as CurName,v.VendorName as Name,c.CreatedOn,v.IsCallCenter,0 as InvoiceType,0 as ReminderOn, 'Call Center Expenses' as comment from callcenternotification c join vendormaster v on v.VendorId = c.VendorId where v.Active ='1' and c.status ='1' 
union
Select r.RequestId as id,0 as Amount,r.RequestAmount,c.CurName,v.VendorName as Name,r.CreatedOn,0 as IsCallCenter,0 as InvoiceType,0 as ReminderOn,'Requested Fund'as comment from callcenter_fund_request r join vendormaster v on v.VendorId = r.VendorID join currencymaster c on r.Currency = c.CurId where r.ReminderStatus ='0'
union
select c.id as id,c.Amount_ReceivedEuroVal as Amount,0 as RequestAmount,0 as CurName,v.VendorName as Name,c.createdon,0 as IsCallCenter,0 as InvoiceType,0 as ReminderOn,'Call Center received'as comment from callcenter_expense_details c join vendormaster v on v.VendorId = c.vendor_id where c.status='1' and c.adminread='0'
union
select c.id as id,c.Amount_ReceivedEuroVal as Amount,0 as RequestAmount,c.currency as CurName,v.VendorName as Name,c.CreatedOn,0 as IsCallCenter,0 as InvoiceType,0 as ReminderOn,'Call Center Fund received'as comment from callcenter_fund_details c join vendormaster v on v.VendorId = c.vendor_id where c.status='1' and c.adminread='0'
union
select VendorId as id,0 as Amount,0 as RequestAmount,0 as CurName, VendorName as Name,CreatedOn,0 as IsCallCenter, InvoiceType, ReminderOn,'reminder'as comment from vendormaster where InvoiceType = 'Weekly' and ReminderOn='$date' and Active='1'
union
select VendorId as id,0 as Amount,0 as RequestAmount,0 as CurName, VendorName as Name,CreatedOn,0 as IsCallCenter, InvoiceType, ReminderOn,'reminder'as comment from vendormaster where InvoiceType = 'Monthly' and ReminderOn !=null and Day(STR_TO_DATE(REPLACE(ReminderOn , '/', ','),'%d,%m,%Y')) = day(NOW()) and Active='1'
union
select VendorId as id,0 as Amount,0 as RequestAmount,0 as CurName, VendorName as Name,CreatedOn,0 as IsCallCenter, InvoiceType, ReminderOn,'reminder'as comment from vendormaster where InvoiceType = 'Quarterly' and ReminderOn !=null and Day(STR_TO_DATE(REPLACE(ReminderOn , '/', ','),'%d,%m,%Y')) = day(NOW()) and Active='1'
)A 
order by CreatedOn desc");
				   $query_res= $query_new->result();			
				   $count1= count($query_res);// $count1+= count($query_res);
				   //print_r($this->db->last_query());
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
						if($notif1->comment=="Call Center Fund received")
						{/*
							if ($notif1->CurName == '1')
							{$currr ="EUR";}
							if ($notif1->CurName == '2')
							{$currr ="USD";}
							$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$currr);
							
							$val=json_decode($val);
							$exchange_rate = $val->rates->EUR;
							
							if ($notif1->CurName == 'EUR') {
								$euro_amount = $notif1->Amount * 1;
						
							}else{
								$euro_amount = $notif1->Amount * $exchange_rate;
								
							}
							*/
							?>
                    	<li> <a href="<?php echo base_url('Expenses/updateCallCenterFundDetails/'.$notif1->id);?>"> <?php echo 'Call Center '.$notif1->Name.' received €' . $notif1->Amount; ?> </a> </li>
                        <?php
						}
						if($notif1->comment=="reminder")
						{
							?>
                    	<li> <a href="<?php echo base_url('configuration/vendors/update_notification/'.$notif1->id);?>"> <?php echo 'Payment Reminder For -' . $notif1->Name;  ?> </a> </li>
                    	<?php 
						}
					}
				/*	     foreach($result1 as $notif)
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
            <?php }
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Call Center User"))
               {
               	
               	$userid = $_SESSION['userid'];
               
               	$query_new2= $this->db->query("Select id, Amount, currency ,createdon, comment From(
               			Select c.id as id ,c.ActualAmt as Amount,c.currency as currency,c.createdon as createdon,'callcenter_expense_details' as comment from callcenter_expense_details c join usermaster u on c.vendor_id = u.CallCenterVendorId where c.status ='0' and u.UserID ='$userid' 
union
               			Select c.id as id,c.ActualAmt as Amount,c.currency as currency ,c.createdon as createdon,'callcenter_fund_details' as comment from callcenter_fund_details c join usermaster u on c.vendor_id = u.CallCenterVendorId where c.status ='0' and u.UserID ='$userid'
)A 
order by createdon desc");
               	$query_res2= $query_new2->result();
               	$countcallcenter= count($query_res2);
               	/*
				   $this->db->select('c.id,c.ActualAmt');
				   $this->db->from('callcenter_expense_details c');
				   $this->db->join('usermaster u','c.vendor_id = u.CallCenterVendorId');
				   $this->db->where('c.status',0);
				   $this->db->where('u.UserID',$_SESSION['userid']);
				   $this->db->order_by('c.createdon','DESC');
				   $query4 = $this->db->get();
				   $callcenter_expense_details = $query4->result();
				   $countcallcenter = count($callcenter_expense_details);
				   
				   $this->db->select('c.id,c.ActualAmt,c.currency');
				   $this->db->from('callcenter_fund_details c');
				   $this->db->join('usermaster u','c.vendor_id = u.CallCenterVendorId');
				   $this->db->where('c.status',0);
				   $this->db->where('u.UserID',$_SESSION['userid']);
				   $this->db->order_by('c.createdon','DESC');
				   $query5 = $this->db->get();
				   $callcenter_fund_details = $query5->result();
				   //print_r($this->db->last_query());
				   $countcallcenterReq = count($callcenter_fund_details);
				   //print_r($countcallcenterReq);
				   $countcallcenter+= $countcallcenterReq;
				*/
               	
               	
				   ?>
			
            <?php 
				  if($countcallcenter > 0)
				  {
				  ?>
            <abbr class="note-count" style="border-radius:10px;"><?php echo $countcallcenter; ?></abbr>
            <?php 
				  }
				  ?>
            <span><i class="fa fa-bell" aria-hidden="true"></i></span></a>
            <div class="notification-dropdown">
              <div class="note-title">You have <?php echo $countcallcenter; ?> notifications</div>
              <ul class="notification-menu">
                <li> 
                  <!-- inner menu: contains the actual data -->
                  <ul class="inner-menu">
                    <?php 
                    foreach($query_res2 as $notif1)
                    {
                    	if($notif1->comment=="callcenter_expense_details")
                    	{
                    		$Currency = $notif1->currency;
                    		if ($Currency == 1) {
                    			$currency = "€";
                    		}elseif ($Currency == 2) {
                    			$currency = "$";
                    		}
                    		?>
                    <li> <a href="<?php echo base_url('Expenses/updateCallCenterExpDetails/'.$notif1->id);?>"> <?php echo 'Admin Added expense amount of ' .$currency. $notif1->Amount;  ?> </a> </li>
                    <?php 
                    	}
                    	if($notif1->comment=="callcenter_fund_details")
                    	{
                    		$Currency = $notif1->currency;
                    		if ($Currency == 1) {
                    			$currency = "€";
                    		}elseif ($Currency == 2) {
                    			$currency = "$";
                    		}
                    		//print_r($currency);
                    		?>
							<li> <a href="<?php echo base_url('Expenses/updateCallCenterFundDetails/'.$notif1->id);?>"> <?php echo 'Admin Added Fund amount of ' . $currency . $notif1->Amount;  ?> </a> </li>
						<?php 
                    	}
                    }
                    
                    /*
					foreach($callcenter_expense_details as $notif1)
						{

						?>
                    <li> <a href="<?php echo base_url('Expenses/updateCallCenterExpDetails/'.$notif1->id);?>"> <?php echo 'Admin Added expense amount of 	€' . $notif1->ActualAmt;  ?> </a> </li>
                    <?php 
						}
						foreach ($callcenter_fund_details as  $notif2) { 
							$Currency = $notif2->currency;
							if ($Currency == 1) {
								$currency = "€";
							}elseif ($Currency == 2) {
								$currency = "$";
							}
							//print_r($currency);
							?>
							<li> <a href="<?php echo base_url('Expenses/updateCallCenterFundDetails/'.$notif2->id);?>"> <?php echo 'Admin Added Fund amount of ' . $currency . $notif2->ActualAmt;  ?> </a> </li>
						<?php }
						*/
					  ?>
                  </ul>
                </li>
              </ul>
              <div class="btm-view-all"><a href="<?php echo base_url('configuration/vendors/notification'); ?>">View all</a></div>
            </div>
			 <?php  } ?>


			
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!----- Header ends -----> 
<!----- Wrapper starts ----->
<div class="wrapper">
 <!--  Invoice modal starts -->
    <div class="modal common-modal" id="myModal_popo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
      <div class="modal-dialog" role="document">
        <div class="modal-content clearfix">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Notice</h2>
          </div>
          <div class="modal-body clearfix">
            <div class="defination-box clearfix">
              <p id="label_note"></p>
            </div>
            <div class="col-xs-12 text-center spacetop2x">
              <button type="button" data-dismiss="modal" class="btn-submit transitions invoice" data-value="1">OK</button>
              <!-- <button type="button" data-dismiss="modal" class="btn-submit transitions invoice" data-value="0">NO</button> --> 
            </div>
          </div>
        </div>
      </div>
    </div>
<!--  Invoice modal ends --> 