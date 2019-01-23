<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Income by Processor</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 inline-divs text-left spacebottom3x">
          <div class="month-expense-box">Income sort by month
            <div class="form-inline">
              <div class="input-group">
                <select class="form-control" name="" id="" onchange="">
                  <option selected="">Jan</option>
                  <option>Feb</option>
                  <option>Mar</option>
                  <option>Apr</option>
                  <option>May</option>
                  <option>Jun</option>
                  <option>Jul</option>
                  <option>Aug</option>
                  <option>Sep</option>
                  <option>Oct</option>
                  <option>Nov</option>
                  <option>Dec</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix spacebottom1x">
          <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
            <div class="table-responsive common-table box-table">
              <table class="table table-bordered" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Processor</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Upay</td>
                    <td>10,000</td>
                  </tr>
                  <tr>
                    <td>Terraxa</td>
                    <td>5,00,000</td>
                  </tr>
                  <tr>
                    <td>Visa</td>
                    <td>25,000</td>
                  </tr>
                  <tr>
                    <td>Paypal</td>
                    <td>9,000</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
            <div class="row">
              <div class="data-box clearfix">
                <div class="col-md-4 col-sm-12"><span>Last Month</span></div>
                <div class="col-md-8 col-sm-12">Data in graph dynamically</div>
              </div>
              <div class="data-box clearfix">
                <div class="col-md-4 col-sm-12"><span>Current</span></div>
                <div class="col-md-8 col-sm-12">Data in graph dynamically</div>
              </div>
              <div class="data-box clearfix">
                <div class="col-md-4 col-sm-12"><span>Last Year</span></div>
                <div class="col-md-8 col-sm-12">Data in graph dynamically</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
