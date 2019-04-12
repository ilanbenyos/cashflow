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
