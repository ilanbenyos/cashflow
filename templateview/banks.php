<?php include('header.php'); ?>
  <?php include('left-sidebar.php'); ?>
  <!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Bank Accounts</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a href="add-new-bank.php"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Bank</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>Swift Code</th>
                    <th>Currency</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Bank of America</td>
                    <td>12457869</td>
                    <td>HDFC125</td>
                    <td>USD</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>Deutsche Bank</td>
                    <td>124572569</td>
                    <td>HDFC125</td>
                    <td>EUR</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>HSBC</td>
                    <td>42587935</td>
                    <td>HSBC121</td>
                    <td>USD</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>Bank of Cyprus</td>
                    <td>12457869</td>
                    <td>HDFC125</td>
                    <td>GBP</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <!-- <tr>
                    <td>Punjab National Bank</td>
                    <td>12457869</td>
                    <td>PNB25</td>
                    <td>USD</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr> -->
                  <!-- <tr>
                    <td>Bank of America</td>
                    <td>425789</td>
                    <td>BA45825</td>
                    <td>USD</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr> -->
                  <tr>
                    <td>Industrial & Commercial<br/>Bank of China</td>
                    <td>4872365</td>
                    <td>ICBC85</td>
                    <td>EUR</td>
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
  <!-- Modal -->
  
  <?php include('footer.php'); ?>
