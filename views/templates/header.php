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
          
               /*$this->db->select('*');
               $this->db->from('vendormaster');
               $this->db->where('Active',1);
               $this->db->where('ReminderOn !=',"");
               $this->db->order_by('VendorId','desc');
               $query = $this->db->get();
               $result = $query->result();*/

               /*foreach ($result as $value) {
                 if ($value->InvoiceType == 'Quarterly') {
                    $val = $value->ReminderOn ;
                    $effectiveDate = date('Y-m', strtotime("+3 months", strtotime($val)));
                    //print_r($effectiveDate);
                    
               /*echo 'effectiveDate' . $effectiveDate;
               echo '<br>';
               echo date('Y-m');*/
               /*if ($effectiveDate == date('Y-m')) {
                  $date2 = $effectiveDate;
               }else{
                  $date2 = "";

                 }
               }
               }*/
               $date = date('l');
               $date1 = date('d/m/Y');

               /*$this->db->select('VendorId,VendorName,InvoiceType,ReminderOn,Comments,Active,ReminderStatus,ModifiedOn');
               $this->db->from('vendormaster');
               $this->db->or_where('InvoiceType = "Weekly" AND ReminderOn = "'. $date .'"');
               $this->db->or_where('InvoiceType = "Monthly" AND ReminderOn = "'. $date1 .'"');
               foreach ($result as $value) {
                 if ($value->InvoiceType == 'Quarterly') {
                    $val = $value->ReminderOn ;
                    $effectiveDate = date('Y-m', strtotime("+3 months", strtotime($val)));
                    
               if ($effectiveDate == date('Y-m')) {
                  $date2 = $effectiveDate;

               }else{
                  $date2 = "";

                 }
               $this->db->or_where('InvoiceType = "Quarterly" AND ReminderOn <= "'.  $date2 .'" AND ReminderOn != "'."".'"');
               }

              }
               $this->db->where('Active',1);
               $this->db->where('ReminderOn !=',"");
               $this->db->order_by('VendorId','desc');

               $query1 = $this->db->get();
               $result1 = $query1->result();
               $count1 = count($result1);*/
               //print_r($this->db->last_query());
		   if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
               {
               

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
					$this->db->from('callcenter_request r');
					$this->db->join('vendormaster v','v.VendorId = r.VendorID');
					$this->db->join('currencymaster c','r.Currency = c.CurId');
					$this->db->where('r.ReminderStatus',0);
					$this->db->order_by('r.CreatedOn','DESC');
					$callcenter_request= $this->db->get ()->result();
				   //Bank Balance Alert end

				   $alldata = $this->db->query($query1." UNION ALL ".$query2. " UNION ALL " .$query3);
				   
				   $result1 = $alldata->result();
				   $count1 = count($result1);

				   $count1+= count($callcenter);
				   $count1+= count($callcenter_request);
					  
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
					foreach($callcenter_request as $notif1)
						{

						?>
                    <li> <a  class="announce" data-toggle="modal"   id="<?php  echo $notif1->RequestId.'^'.$notif1->RequestAmount.'^'.$notif1->Name .'^'.$notif1->CurName ?>"> <?php echo $notif1->Name. ' Requested Fund Of ' . $notif1->RequestAmount .' '.$notif1->CurName  ?> </a> </li>
                    <?php 
						}
					foreach($result1 as $notif)
					{

					?>
                    <li> <a href="<?php echo base_url('configuration/vendors/update_notification/'.$notif->VendorId);?>"> <?php echo 'Payment Reminder For -' . $notif->VendorName;  ?> </a> </li>
                    <?php 
					}
					 
			  
						foreach($callcenter as $notif1)
						{

						?>
                    <li> <a href="<?php echo base_url('Expenses/updateCallCenterExp/'.$notif1->NotificationId);?>"> <?php echo 'Call Center Expenses for -' . $notif1->VendorName;  ?> </a> </li>
                    <?php 
						}
						
						
					  ?>
                  </ul>
                </li>
              </ul>
              <div class="btm-view-all"><a href="<?php echo base_url('configuration/vendors/notification'); ?>">View all</a></div>
            </div>
            <?php } ?>
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