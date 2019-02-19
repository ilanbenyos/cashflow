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
    <div id="bs-example-navbar-collapse-1">
      <ul class="sidebar-menu">
        <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "Admin"))
          { ?>
        <li class="treeview active"> <a href="#"><i class="fa fa-desktop" aria-hidden="true"></i> <span>Configuration</span></a>
          <ul class="treeview-menu menu-open">
            <!--<li><a href="<?= base_url('configuration/roles') ?>">Roles</a></li> -->
            <li><a href="<?= base_url('configuration/users')?>">Users</a></li>
            <li><a href="<?= base_url('configuration/bank')?>">Banks</a></li>
            <li><a href="<?= base_url('payment-processor')?>">Payment Processors</a></li>
            <li><a href="<?= base_url('configuration/vendors')?>">Vendors</a></li>
            <li><a href="<?= base_url('expense-category')?>">Expense Categories</a></li>
            <li><a href="<?= base_url('bank-transfer-type')?>">Bank Transfer Type</a></li>
          </ul>
        </li>
        <!-- <li><a href="planned-expense.php"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Planned Expense</span></a></li>
        <li><a href="actual-expense-details.php"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Actual Expense</span></a></li>-->
        <li><a href="<?= base_url('psp-income')?>"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
        <li class="treeview"> <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Reports/psp_income')?>">Total PSP Deposits</a></li>
                    <!-- <li><a href="income-by-processor.php">Income by Processor</a></li>-->
          </ul>
        </li> 
      <?php }else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['user_role'] == "CEO")){?>

       <li class="treeview"> <a href="#"><i class="fa fa-desktop" aria-hidden="true"></i> <span>Configuration</span></a>
          <ul class="treeview-menu">
             <!--<li><a href="<?= base_url('configuration/roles') ?>">Roles</a></li>-->
            <li><a href="<?= base_url('configuration/users')?>">Users</a></li>
            <li><a href="<?= base_url('configuration/bank')?>">Banks</a></li>
            <li><a href="<?= base_url('payment-processor')?>">Payment Processors</a></li>
            <li><a href="<?= base_url('configuration/vendors')?>">Vendors</a></li>
         <!--   <li><a href="<?= base_url('expense-category.php')?>">Expense Categories</a></li>--> 
          </ul>
        </li>
      <!--   <li><a href="planned-expense.php"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Planned Expense</span></a></li>
        <li><a href="actual-expense-details.php"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Actual Expense</span></a></li>
        <li><a href="deposit-details.php"><i class="fa fa-download" aria-hidden="true"></i> <span>Deposit Details</span></a></li> -->
		   <li><a href="<?= base_url('psp-income')?>"><i class="fa fa-download" aria-hidden="true"></i> <span>PSP Income</span></a></li>
       <!--  <li class="treeview"> <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Reports</span> </a>
          <ul class="treeview-menu">
            <li><a href="total-deposit-report.php">Total Deposits</a></li>
            <li><a href="income-by-processor.php">Income by Processor</a></li>
          </ul>
        </li> -->
      <?php }?>
      </ul>
    </div>
  </nav>
