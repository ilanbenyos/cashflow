<!-- Sidebar  -->
<!-- <nav id="sidebar"> </nav>-->

<!--<nav class="navbar navbar-inverse" id="sidebar" role="navigation">
  <ul class="nav sidebar-nav">
    <li> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-desktop" aria-hidden="true"></i> <span>Configuration</span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="index.php">Roles</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="banks.php">Banks</a></li>
        <li><a href="payment-processor.php">Payment Processors</a></li>
        <li><a href="vendors.php">Vendors</a></li>
        <li><a href="expense-category.php">Expense Categories</a></li>
      </ul>
    </li>
    <li><a href="planned-expense.php"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Planned Expense</span></a></li>
    <li><a href="actual-expense-details.php"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Actual Expense</span></a></li>
    <li><a href="deposit-details.php"><i class="fa fa-download" aria-hidden="true"></i> <span>Deposit Details</span></a></li>
    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="total-deposit-report.php">Total Deposits</a></li>
        <li><a href="income-by-processor.php">Income by Processor</a></li>
      </ul>
    </li>
  </ul>
</nav>-->

<nav class="navbar navbar-inverse" id="sidebar">
  <!--<ul class="sidebar-menu page-sidebar-menu page-sidebar-menu-light">
    <li> <a href="javascript:;"> <i class="icon-logout"></i> <span class="title">Quick Sidebar</span> <span class="arrow "></span> </a>
      <ul class="sub-menu">
        <li><a href="<?= base_url('configuration/users')?>"><i class="fa fa-users" aria-hidden="true"></i> <span>Users</span></a></li>
        <li><a href="<?= base_url('configuration/bank')?>"><i class="fa fa-university" aria-hidden="true"></i> <span>Banks</span></a></li>
        <li><a href="<?= base_url('payment-processor')?>"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>Payment Processors</span></a></li>
        <li><a href="<?= base_url('configuration/vendors')?>"><i class="fa fa-window-restore" aria-hidden="true"></i> <span>Vendors</span></a></li>
        <li><a href="<?= base_url('expense-category')?>"><i class="fa fa-database" aria-hidden="true"></i> <span>Expense Categories</span></a></li>
        <li><a href="<?= base_url('bank-transfer-type')?>"><i class="fa fa-exchange" aria-hidden="true"></i> <span>Bank Transfer Type</span></a></li>
      </ul>
    </li>
    <li><a href="<?= base_url('psp-income')?>"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    <li><a href="<?= base_url('expenses')?>"><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li><a href="<?= base_url('bank-transaction')?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li> <a href="javascript:;"> <i class="icon-envelope-open"></i> <span class="title">Email Templates</span> <span class="arrow "></span> </a>
      <ul class="sub-menu">
        <li><a href="<?= base_url('Reports/psp_income')?>">Total Income Per PSP </a></li>
        <li><a href="<?= base_url('Reports/total_balance')?>">Income Vs Outcome </a></li>
        <li><a href="<?= base_url('Reports/vendor_outcome')?>">Outcome for Vendors</a></li>
        <li><a href="<?= base_url('Reports/psp_commision')?>">PSP Income vs Commissions</a></li>
        <li><a href="<?= base_url('Reports/bank_balance')?>">Current Banks Balance </a></li>
        <li><a href="<?= base_url('Reports/expense_category')?>">Total Expenses Per Category</a></li>
      </ul>
    </li>
  </ul>-->
  <?php 
    $this->db->select('RoleId,RoleName,Active');
    $this->db->from('rolemaster');
    $this->db->where('RoleId',4);
    $callCenter = $this->db->get ()->result();
    //print_r($callCenter);
  ?>
  
  <ul class="sidebar-menu">
    <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
          { ?>
    <li class="treeview"> <a href="<?= base_url('configuration')?>"><i class="fa fa-desktop" aria-hidden="true"></i> <span>Configuration</span></a>
      <ul class="treeview-menu">
        <li><a href="<?= base_url('configuration/users')?>"><i class="fa fa-users" aria-hidden="true"></i> <span>Users</span></a></li>
        <li><a href="<?= base_url('configuration/bank')?>"><i class="fa fa-university" aria-hidden="true"></i> <span>Banks</span></a></li>
        <li><a href="<?= base_url('payment-processor')?>"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>Payment Processors</span></a></li>
        <li><a href="<?= base_url('configuration/vendors')?>"><i class="fa fa-window-restore" aria-hidden="true"></i> <span>Vendors</span></a></li>
        <li><a href="<?= base_url('expense-category')?>"><i class="fa fa-database" aria-hidden="true"></i> <span>Expense Categories</span></a></li>
        <li><a href="<?= base_url('bank-transfer-type')?>"><i class="fa fa-exchange" aria-hidden="true"></i> <span>Bank Transfer Type</span></a></li>
      </ul>
    </li>
    <li><a href="<?= base_url('psp-income')?>"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    
        <?php 
        foreach ($callCenter as $value) { ?>
          <li><a href="<?= base_url('all-expenses')?>"><i class="fa"><img class="call-centre-icon img-responsive" src="<?= base_url('assets/images/callcenter-expenses.png')?>"></i><span>Call Center Expenses</span></a></li>
        <?php }
        ?>

    <li><a href="<?= base_url('expenses')?>"><i  class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li><a href="<?= base_url('bank-transaction')?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li class="treeview"> <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
      <ul class="treeview-menu">
        <li><a href="<?= base_url('Reports/psp_income')?>">Total Income Per PSP </a></li>
        <li><a href="<?= base_url('Reports/total_balance')?>">Income Vs Outcome </a></li>
        <li><a href="<?= base_url('Reports/vendor_outcome')?>">Outcome for Vendors</a></li>
        <li><a href="<?= base_url('Reports/psp_commision')?>">PSP Income vs Commissions</a></li>
        <li><a href="<?= base_url('Reports/bank_balance')?>">Current Banks Balance </a></li>
        <li><a href="<?= base_url('Reports/expense_category')?>">Total Expenses Per Category</a></li>
        <li><a href="<?= base_url('Reports/callCenterExp')?>">Call Center Expenses</a></li>
      </ul>
    </li>
    <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "CEO")){?>
    <li><a href="<?= base_url('psp-income')?>"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    <li><a href="<?= base_url('expenses')?>"><i i class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li><a href="<?= base_url('bank-transaction')?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li class="treeview"> <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
      <ul class="treeview-menu">
        <li><a href="<?= base_url('Reports/psp_income')?>">Total Income Per PSP </a></li>
        <li><a href="<?= base_url('Reports/total_balance')?>">Income Vs Outcome </a></li>
        <li><a href="<?= base_url('Reports/vendor_outcome')?>">Outcome for Vendors</a></li>
        <li><a href="<?= base_url('Reports/psp_commision')?>">PSP Income vs Commissions</a></li>
        <li><a href="<?= base_url('Reports/bank_balance')?>">Current Banks Balance </a></li>
        <li><a href="<?= base_url('Reports/expense_category')?>">Total Expenses Per Category</a></li>
      </ul>
    </li>
    <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Book Keeper")){?>
    <li><a href="<?= base_url('psp-income')?>"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
    <li><a href="<?= base_url('expenses')?>"><i i class="fa fa-briefcase"  aria-hidden="true"></i> <span>Expenses</span></a></li>
    <li><a href="<?= base_url('bank-transaction')?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Bank Transaction</span></a></li>
    <li class="treeview"> <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
      <ul class="treeview-menu">
        <li><a href="<?= base_url('Reports/psp_income')?>">Total Income Per PSP </a></li>
        <li><a href="<?= base_url('Reports/total_balance')?>">Income Vs Outcome </a></li>
        <li><a href="<?= base_url('Reports/vendor_outcome')?>">Outcome for Vendors</a></li>
        <li><a href="<?= base_url('Reports/psp_commision')?>">PSP Income vs Commissions</a></li>
        <li><a href="<?= base_url('Reports/bank_balance')?>">Current Banks Balance </a></li>
        <li><a href="<?= base_url('Reports/expense_category')?>">Total Expenses Per Category</a></li>
      </ul>
    </li>
    <?php }elseif (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Call Center User")) { ?>
      <li><a href="<?= base_url('all-expenses')?>"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Call Center Expenses</span></a></li>
      <li><a href="<?= base_url('all-expenses')?>"><i class="fa fa-users" aria-hidden="true"></i> <span>Profile</span></a></li>
      <?php  } ?>
  </ul> 
</nav>