<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content -->

<div id="content">
  <div class="container-fluid">
    <h1>CEO</h1>
    <div class="white-bg">
      <div class="row spacebottom2x row-flex box-color">
        <div class="col-md-4 col-sm-4">
          <div class="box">
            <div class="box-left"> <i class="fa fa-level-down txt-green" aria-hidden="true"></i> </div>
            <div class="box-right">
              <span class="large-txt">56466</span>
              <span class="medium-txt txt-green">Deposits</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="box">
            <div class="box-left"> <i class="fa fa-external-link txt-orange" aria-hidden="true"></i> </div>
            <div class="box-right">
              <span class="large-txt">23566</span>
              <span class="medium-txt txt-orange">Expenses</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="box">
            <div class="box-left"> <i class="fa fa-line-chart txt-blue" aria-hidden="true"></i> </div>
            <div class="box-right">
              <span class="large-txt">366555</span>
              <span class="medium-txt txt-blue">Planned Expense</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-flex paddingtop15x spacebottom2x ceo">
        <div class="flex-inner">
          <div class="flex-content">
            <div class="col-md-6 col-sm-12 smmargin20">
              <div class="grey-box">
                <h2>Latest Deposits</h2>
                <div class="table-responsive common-table">
                  <table class="table table-hover" cellpadding="0" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Bank</th>
                        <th>PSP</th>
                        <th>Amount</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>HSBC</td>
                        <td>UPayCard</td>
                        <td>$10,000</td>
                        <td>13/12/2018</td>
                      </tr>
                      <tr>
                        <td>HDFC</td>
                        <td>Paypal</td>
                        <td>$50,000</td>
                        <td>15/05/2018</td>
                      </tr>
                      <tr>
                        <td>Bank Leumi</td>
                        <td>Terraxa</td>
                        <td>$75,000</td>
                        <td>10/08/2018</td>
                      </tr>
                      <tr>
                        <td>Bank of America</td>
                        <td>UPayCard</td>
                        <td>$84,000</td>
                        <td>07/04/2018</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="grey-box">
                <h2>Latest Expenses</h2>
                <div class="table-responsive common-table">
                  <table class="table table-hover" cellpadding="0" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Vendor Name</th>
                        <th>Invoice Amount</th>
                        <th>Actual payment date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Marketing</td>
                        <td>Continum</td>
                        <td>10,000</td>
                        <td>13/12/2018</td>
                      </tr>
                      <tr>
                        <td>Call Center</td>
                        <td>Fedfx</td>
                        <td>50,000</td>
                        <td>09/04/2016</td>
                      </tr>
                      <tr>
                        <td>Development</td>
                        <td>Camel</td>
                        <td>5,00,000</td>
                        <td>24/10/2018</td>
                      </tr>
                      <tr>
                        <td>Stationery</td>
                        <td>XYZ</td>
                        <td>70,000</td>
                        <td>13/12/2018</td>
                      </tr>
                      <tr>
                        <td>Banking</td>
                        <td>ABC</td>
                        <td>80,000</td>
                        <td>26/05/2018</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row paddingtop15x top0padding">
        <div class="col-md-12">
          <div class="graph-chart">
            <h2>Deposit & Expense</h2>
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
