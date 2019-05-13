<?php 
    $this->db->select('RoleId,RoleName,Active');
    $this->db->from('rolemaster');
    $this->db->where('RoleId',4);
    $callCenter = $this->db->get ()->result();
    //print_r($callCenter);
  ?>

<nav class="navbar navbar-inverse" id="sidebar">
<!--<ul class="sidebar-menu">
    <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
          { ?>
    <li class="treeview"> <a href=""><i class="fa fa-desktop" aria-hidden="true"></i> <span>Configuration</span></a>
      <ul class="treeview-menu">
        <li class="users"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-users" aria-hidden="true"></i> <span>Users</span></a></li>
        <li class="banks"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-university" aria-hidden="true"></i> <span>Banks</span></a></li>
        <li class="psp"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-credit-card" aria-hidden="true"></i> <span>Payment Processors</span></a></li>
        <li class="vendors"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-window-restore" aria-hidden="true"></i> <span>Vendors</span></a></li>
        <li class="expCategories"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-database" aria-hidden="true"></i> <span>Expense Categories</span></a></li>
        <li class="bankTransType"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-exchange" aria-hidden="true"></i> <span>Bank Transfer Type</span></a></li>
      </ul>
    </li>
    <li class="psp-income"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    <?php 
        foreach ($callCenter as $value) { ?>
    <li class="callCenterExp"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa"><img class="call-centre-icon img-responsive" src="<?= base_url('assets/images/callcenter-expenses.png')?>"></i><span>Call Center Expenses</span></a></li>
    <?php }
        ?>
    <li class="expenses"><a href='javascript:void(0)' onclick='savesubcat()'><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li class="bankTrans"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li class="treeview"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
      <ul class="treeview-menu">
        <li class="total-income"><a href='javascript:void(0)' onclick='savesubcat()'>Total Income Per PSP </a></li>
        <li class="invsout"><a href='javascript:void(0)' onclick='savesubcat()'>Income vs Outcome </a></li>
        <li class="venOutcome"><a href='javascript:void(0)' onclick='savesubcat()'>Outcome For Vendors</a></li>
        <li class="pspInVsOut"><a href='javascript:void(0)' onclick='savesubcat()'>PSP Income vs Commissions</a></li>
        <li class="bankBal"><a href='javascript:void(0)' onclick='savesubcat()'>Current Banks Balance</a></li>
        <li class="totalExp"><a href='javascript:void(0)' onclick='savesubcat()'>Total Expenses Per Category</a></li>
        <li class="callCenterExpRep"><a href='javascript:void(0)' onclick='savesubcat()'>Call Center Expenses</a></li>
      </ul>
    </li>
    <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "CEO")){?>
    <li class="psp-income"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    <li class="expenses"><a href='javascript:void(0)' onclick='savesubcat()'><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li class="bankTrans"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li class="treeview"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
      <ul class="treeview-menu">
        <li class="total-income"><a href='javascript:void(0)' onclick='savesubcat()'>Total Income Per PSP </a></li>
        <li class="invsout"><a href='javascript:void(0)' onclick='savesubcat()'>Income vs Outcome </a></li>
        <li class="venOutcome"><a href='javascript:void(0)' onclick='savesubcat()'>Outcome For Vendors</a></li>
        <li class="pspInVsOut"><a href='javascript:void(0)' onclick='savesubcat()'>PSP Income vs Commissions</a></li>
        <li class="bankBal"><a href='javascript:void(0)' onclick='savesubcat()'>Current Banks Balance</a></li>
        <li class="totalExp"><a href='javascript:void(0)' onclick='savesubcat()'>Total Expenses Per Category</a></li>
        <li class="callCenterExpRep"><a href='javascript:void(0)' onclick='savesubcat()'>Call Center Expenses</a></li>
      </ul>
    </li>
    <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Book Keeper")){?>
    <li class="psp-income"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    <li class="expenses"><a href='javascript:void(0)' onclick='savesubcat()'><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li class="bankTrans"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li class="treeview"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
      <ul class="treeview-menu">
        <li class="total-income"><a href='javascript:void(0)' onclick='savesubcat()'>Total Income Per PSP </a></li>
        <li class="invsout"><a href='javascript:void(0)' onclick='savesubcat()'>Income vs Outcome </a></li>
        <li class="venOutcome"><a href='javascript:void(0)' onclick='savesubcat()'>Outcome For Vendors</a></li>
        <li class="pspInVsOut"><a href='javascript:void(0)' onclick='savesubcat()'>PSP Income vs Commissions</a></li>
        <li class="bankBal"><a href='javascript:void(0)' onclick='savesubcat()'>Current Banks Balance</a></li>
        <li class="totalExp"><a href='javascript:void(0)' onclick='savesubcat()'>Total Expenses Per Category</a></li>
        <li class="callCenterExpRep"><a href='javascript:void(0)' onclick='savesubcat()'>Call Center Expenses</a></li>
      </ul>
    </li>
    <?php }elseif (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Call Center User")) { ?>
      <li class="callCenter"><a href='javascript:void(0)' onclick='savesubcat()'><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Call Center Expenses</span></a></li>
      <?php  } ?>
  </ul>-->

<div class="menu-container">
  <div class="crbnMenu">
    <ul class="menu">
      <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
          { ?>
      <li class="drop-arrow"> <a class="nav-link" href="#"><i class="fa fa-desktop" aria-hidden="true"></i> <span>Configuration</span></a>
        <ul>
          <li class="users"><a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>Users</span></a></li>
          <li class="banks"><a href="#"><i class="fa fa-university" aria-hidden="true"></i> <span>Banks</span></a></li>
          <li class="psp"><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>Payment Processors</span></a></li>
          <li class="vendors"><a href="#"><i class="fa fa-window-restore" aria-hidden="true"></i> <span>Vendors</span></a></li>
          <li class="expCategories"><a href="#"><i class="fa fa-database" aria-hidden="true"></i> <span>Expense Categories</span></a></li>
          <li class="bankTransType"><a href="#"><i class="fa fa-exchange" aria-hidden="true"></i> <span>Bank Transfer Type</span></a></li>
        </ul>
      </li>
      <li class="psp-income"><a class="nav-link" href="#"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
      <?php 
        foreach ($callCenter as $value) { ?>
      <li class="callCenterExp"><a class="nav-link" href="#"><i class="fa"><img class="call-centre-icon img-responsive" src="<?= base_url('assets/images/callcenter-expenses.png')?>"></i><span>Call Center Expenses</span></a></li>
      <?php }
        ?>
        
      <li class="expenses"><a class="nav-link" href="#"><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
      <li class="bankTrans"><a class="nav-link" href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
      <li class="drop-arrow"><a class="nav-link" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
        <ul>
          <li class="total-income"><a href="#">Total Income Per PSP </a></li>
          <li class="invsout"><a href="#">Income vs Outcome </a></li>
          <li class="venOutcome"><a href="#">Outcome For Vendors</a></li>
          <li class="pspInVsOut"><a href="#">PSP Income vs Commissions</a></li>
          <li class="bankBal"><a href="#">Current Banks Balance</a></li>
          <li class="totalExp"><a href="#">Total Expenses Per Category</a></li>
          <li class="callCenterExpRep"><a href="#">Call Center Expenses</a></li>
        </ul>
      </li>
      <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "CEO")){?>
      <li class="psp-income"><a class="nav-link" href="#"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
      <li class="expenses"><a class="nav-link" href="#"><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
      <li class="bankTrans"><a class="nav-link" href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
      <li class="drop-arrow"><a class="nav-link" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
        <ul>
          <li class="total-income"><a href="#">Total Income Per PSP </a></li>
          <li class="invsout"><a href="#">Income vs Outcome </a></li>
          <li class="venOutcome"><a href="#">Outcome For Vendors</a></li>
          <li class="pspInVsOut"><a href="#">PSP Income vs Commissions</a></li>
          <li class="bankBal"><a href="#">Current Banks Balance</a></li>
          <li class="totalExp"><a href="#">Total Expenses Per Category</a></li>
          <li class="callCenterExpRep"><a href="#">Call Center Expenses</a></li>
        </ul>
      </li>
      <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Book Keeper")){?>
      <li class="psp-income"><a class="nav-link" href="#"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
      <li class="expenses"><a class="nav-link" href="#"><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
      <li class="bankTrans"><a class="nav-link" href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
      <li class="drop-arrow"><a class="nav-link" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
        <ul>
          <li class="total-income"><a href="#">Total Income Per PSP </a></li>
          <li class="invsout"><a href="#">Income vs Outcome </a></li>
          <li class="venOutcome"><a href="#">Outcome For Vendors</a></li>
          <li class="pspInVsOut"><a href="#">PSP Income vs Commissions</a></li>
          <li class="bankBal"><a href="#">Current Banks Balance</a></li>
          <li class="totalExp"><a href="#">Total Expenses Per Category</a></li>
          <li class="callCenterExpRep"><a href="#">Call Center Expenses</a></li>
        </ul>
      </li>
      <?php }elseif (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Call Center User")) { ?>
        <li class="callCenter"><a class="nav-link" href="#"><i class="fa"><img class="call-centre-icon img-responsive" src="<?= base_url('assets/images/callcenter-expenses.png')?>"></i> <span>Call Center Expenses</span></a></li>
        <li class="callCenterProfile"><a class="nav-link" href="#"><i class="fa"><img class="call-centre-icon img-responsive" src="<?= base_url('assets/images/my-profile-icon.png')?>"></i> <span>My Profile</span></a></li>
        <?php  } ?>
    </ul>
  </div>
</div>
</nav>
