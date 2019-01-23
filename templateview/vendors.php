<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Vendors</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="add-icon-box"><a href="add-new-vendor.php"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Vendor</a></div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Vendor Name</th>
                  <th>Category</th>
                  <th>Invoice</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Continnum</td>
                  <td>Marketing</td>
                  <td>Monthly Payment</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Fedfx</td>
                  <td>Call Center</td>
                  <td>Quarterly Payment</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Camel</td>
                  <td>Development</td>
                  <td>Weekly Payment</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Vita</td>
                  <td>Interbank</td>
                  <td>Yearly Payment</td>
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
