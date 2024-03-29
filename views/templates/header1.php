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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



</head>

<body>
<header class="site-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 no-padding relative">
        <div class="logo"> <a href="<?php echo base_url('configuration'); ?>"><img class="aligncenter img-responsive" src="<?= base_url('assets/images/logo.png')?>"></a></div>
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
               

           $this->db->select('VendorId, VendorName, InvoiceType, ReminderOn');
           $this->db->from('vendormaster');
           $this->db->where('InvoiceType', 'Weekly');
           $this->db->where('ReminderOn',$date);
           $this->db->where('Active',1);
           $this->db->get();
           $query1= $this->db->last_query();
           
           
           $this->db->select('VendorId, VendorName, InvoiceType, ReminderOn');
           $this->db->from('vendormaster');
           $this->db->where('InvoiceType', 'Monthly');
          $this->db->where('ReminderOn !=',NULL);
           $this->db->where('Day(STR_TO_DATE(REPLACE(ReminderOn , "/", ","),"%d,%m,%Y")) = day(NOW())');
           $this->db->where('Active',1);
           $this->db->get();
          $query2= $this->db->last_query();

           $this->db->select('VendorId, VendorName, InvoiceType, ReminderOn');
           $this->db->from('vendormaster');
           $this->db->where('InvoiceType', 'Quarterly');
           $this->db->where('ReminderOn !=',NULL);
           $this->db->where('Day(STR_TO_DATE(REPLACE(ReminderOn , "/", ","),"%d,%m,%Y")) = day(NOW())');
           $this->db->where('Active',1);
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
          $query4 = $this->db->get();
           $callcenter = $query4->result();
          //call center notification end

           //Bank Balance Alert start
          /*$this->db->select('BankId,BankName,Balance,MinBalance,MaxBalance');
          $this->db->from('bankmaster');
          $this->db->where('Active',1);
          $this->db->where('IsDelete',1);
          $this->db->order_by('BankName','ASC');
          $bankBalance= $this->db->get ()->result();
          $minBalance = array();
          $MaxBalance = array();
          $minCount =array();
          foreach ($bankBalance as $bal) {
            $minBalance[]['bal'] = $bal->MinBalance;
            $minBalance[]['id'] = $bal->BankId;
            $MaxBalance[] = $bal->MaxBalance;
            
          }
          print_r($minBalance);*/
           //Bank Balance Alert end

           $alldata = $this->db->query($query1." UNION ALL ".$query2. " UNION ALL " .$query3);
           
           $result1 = $alldata->result();
           $count1 = count($result1);

           $count1+= count($callcenter);
            
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
          <ul class="notification-menu">
          <li class="note-title">You have <?php echo $count1; ?> notifications</li>
          <li> 
            <!-- inner menu: contains the actual data -->
            <ul class="inner-menu">
            <?php 
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
          <li class="btm-view-all"><a href="<?php echo base_url('configuration/vendors/notification'); ?>">View all</a></li>
          </ul>
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
