<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Configuration</h1>
    <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
          { ?>
    <div class="white-bg">
      <div class="row">
        <div class="main-icon-wrap clearfix">
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('configuration/bank')?>"> <span class="icons"><i class="fa fa-university" aria-hidden="true"></i></span> <span class="medium-heading">Banks</span> </a> </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('configuration/users')?>""> <span class="icons"><i class="fa fa-users" aria-hidden="true"></i></span> <span class="medium-heading">Users</span> </a> </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('payment-processor')?>"> <span class="icons"><i class="fa fa-credit-card" aria-hidden="true"></i></span> <span class="medium-heading">PSP's</span> </a> </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('configuration/vendors')?>"> <span class="icons"><i class="fa fa-window-restore" aria-hidden="true"></i></span> <span class="medium-heading">Vendors</span> </a> </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="main-icon-wrap clearfix">
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('expenses')?>"> <span class="icons"><i class="fa fa-briefcase" aria-hidden="true"></i></span> <span class="medium-heading">Expenses</span> </a> </div>
          </div>
          <!-- <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="#""> <span class="icons"><img src="<?= base_url('assets/images/Bank-transaction.png')?>"/></span> <span class="medium-heading">Bank Transaction</span> </a> </div>
          </div> -->
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('Reports/psp_income')?>"> <span class="icons"><i class="fa fa-file-text-o" aria-hidden="true"></i></span> <span class="medium-heading">Reports</span> </a> </div>
          </div>
          
        </div>
      </div>
    </div>
    <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "CEO")){ ?>
      <div class="row">
        <div class="main-icon-wrap clearfix">
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('payment-processor')?>"> <span class="icons"><i class="fa fa-credit-card" aria-hidden="true"></i></span> <span class="medium-heading">PSP's</span> </a> </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('expenses')?>"> <span class="icons"><img src="<?= base_url('assets/images/Expense.png')?>"/></span> <span class="medium-heading">Expenses</span> </a> </div>
          </div>
           <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="bank-transaction""> <span class="icons"><img src="<?= base_url('assets/images/Bank-transaction.png')?>"/></span> <span class="medium-heading">Bank Transaction</span> </a> </div>
          </div> 
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('Reports/psp_income')?>"> <span class="icons"><img src="<?= base_url('assets/images/reports.png')?>"/></span> <span class="medium-heading">Reports</span> </a> </div>
          </div>
        </div>
      </div>
  <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Book Keeper")){ ?>
      <div class="row">
        <div class="main-icon-wrap clearfix">
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('payment-processor')?>"> <span class="icons"><i class="fa fa-credit-card" aria-hidden="true"></i></span> <span class="medium-heading">PSP's</span> </a> </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('expenses')?>"> <span class="icons"><img src="<?= base_url('assets/images/Expense.png')?>"/></span> <span class="medium-heading">Expenses</span> </a> </div>
          </div>
           <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="bank-transaction""> <span class="icons"><img src="<?= base_url('assets/images/Bank-transaction.png')?>"/></span> <span class="medium-heading">Bank Transaction</span> </a> </div>
          </div> 
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="config-icon-box"> <a href="<?= base_url('Reports/psp_income')?>"> <span class="icons"><img src="<?= base_url('assets/images/reports.png')?>"/></span> <span class="medium-heading">Reports</span> </a> </div>
          </div>
        </div>
      </div>
  <?php } ?>
  </div>
</div>
<script src="<?= base_url('assets/js/pnotify.custom.min.js')?>"></script>
<script type="text/javascript">
  
//$(document).ready(function(){
  function min(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url('configuration/configuration/minAlert') ?>',
      success: function(msg) {
          if (msg == 'loggedOut') {
            //alert(msg);
              window.location.href = '<?php echo base_url('login/') ?>';
          }
          else
          {
            
               var updateurl = '<?php echo base_url ("configuration/configuration/minAlert" ); ?>';
              
             $.each( JSON.parse(msg), function( key, value ) {
              //console.log(value);
            var output= "<ul>";
             output += "<li><a href="+updateurl+value.BankId+">"+value.MinBalance+"</a></li>";
             output += "<li><a href="+updateurl+value.BankId+">"+value.Balance+"</a></li>";
             output += "</ul>";
             //$.playSound("<?php //echo base_url('assets/popupnoti/slow-spring-board-longer-tail.mp3') ?>");
             new PNotify({
                  text: value.BankName + "'s" + ' Balance Is Below Minimum Balance Of ' + value.MinBalance,
                  type: 'danger',
            
              });
              });
           }
          }
      
  });
  }
  <?php if (isset($_SESSION['minBal'])) { ?>
      min();
  <?php unset ( $_SESSION ['minBal'] );
} ?>
  
//})
</script>
<script type="text/javascript">
//$(document).ready(function(){
  function max(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url('configuration/configuration/maxAlert') ?>',
      success: function(msg) {
          if (msg == 'loggedOut') {
            //alert(msg);
              window.location.href = '<?php echo base_url('login/') ?>';
          }
          else
          {
            
               var updateurl = '<?php echo base_url ("configuration/configuration/maxAlert" ); ?>';
              
             $.each( JSON.parse(msg), function( key, value ) {
              //console.log(value);
            var output= "<ul>";
             output += "<li><a href="+updateurl+value.BankId+">"+value.MaxBalance+"</a></li>";
             output += "<li><a href="+updateurl+value.BankId+">"+value.Balance+"</a></li>";
             output += "</ul>";
             //$.playSound("<?php //echo base_url('assets/popupnoti/slow-spring-board-longer-tail.mp3') ?>");
             new PNotify({
                  text: value.BankName + " 's" + ' Balance Is More Than Maximum Balance Of ' + value.MaxBalance,
                  type: 'danger',
            
              });
              });
                
           }
          }
      
  });
  }
  <?php if (isset($_SESSION['maxBal'])) { ?>
      max();
  <?php unset ( $_SESSION ['maxBal'] );
} ?>
//})
</script>
<script type="text/javascript">
//$(document).ready(function(){
  function rollingReserved(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url('psp_income/get_popup_notification') ?>',
      success: function(msg) {
          if (msg == 'loggedOut') {
            //alert(msg);
              window.location.href = '<?php echo base_url('login/') ?>';
          }
          else
          {
            
               var updateurl = '<?php echo base_url ("psp_income/get_popup_notification" ); ?>';
              
             $.each( JSON.parse(msg), function( key, value ) {
              //sconsole.log(value.TransId);
            var output= "<ul>";
             output += "<li><a href="+updateurl+value.TransId+">"+value.Description+"</a></li>";
             output += "<li><a href="+updateurl+value.TransId+">"+value.PlannedAmt+"</a></li>";
             output += "</ul>";
             //$.playSound("<?php //echo base_url('assets/popupnoti/slow-spring-board-longer-tail.mp3') ?>");
             new PNotify({
                  text: value.Description +' is due today of ' + 'amount: '+ value.PlannedAmt,
                  type: 'danger',
            
              });
              });
                
           }
          }
      
  });
  }
  <?php if (isset($_SESSION['rolling_reserve'])) { ?>
      rollingReserved();
  <?php unset ( $_SESSION ['rolling_reserve'] );
} ?>
//})
</script>