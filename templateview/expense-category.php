<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Expense Categories</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="add-icon-box"><a href="add-new-category.php"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Category</a></div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Marketing</td>
                  <td>13/12/2015</td>
                  <td>Marketing expenses for affiliate payout</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Call Center</td>
                  <td>02/07/2016</td>
                  <td>Call center metric for the total cost</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Development</td>
                  <td>10/09/2012</td>
                  <td>Expenses associated with the research</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Inter Bank</td>
                  <td>25/11/2018</td>
                  <td>Interbank transfer</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
