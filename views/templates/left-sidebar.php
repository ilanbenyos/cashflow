<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
      <h3>Menu</h3>
    </div>
    <ul class="list-unstyled components">
      <li class="active"> <a href="#OrgSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Configuration</a>
        <ul class="collapse list-unstyled" id="OrgSubmenu" data-parent="#sidebar">
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
      
      <li class="active"> <a href="#PersonneSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
        <ul class="collapse list-unstyled" id="PersonneSubmenu" data-parent="#sidebar">
          <li><a href="<?= base_url('Reports/psp_income')?>">Total Income Per PSP </a></li>
			<li><a href="<?= base_url('Reports/total_balance')?>">Income Vs Outcome </a></li>
			<li><a href="<?= base_url('Reports/vendor_outcome')?>">Outcome for Vendors</a></li>
			<li><a href="<?= base_url('Reports/psp_commision')?>">PSP Income vs Commissions</a></li>
			<li><a href="<?= base_url('Reports/bank_balance')?>">Current Banks Balance </a></li>
			<li><a href="<?= base_url('Reports/expense_category')?>">Total Expenses Per Category</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!--<nav class="navbar navbar-inverse" id="sidebar">
    <div id="bs-example-navbar-collapse-1">
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
      <?php } ?>
      </ul>
    </div>
  </nav>-->