<?php include('header.php'); ?>
  <?php include('left-sidebar.php'); ?>
  <!-- Page Content  -->
  
  <div id="content">
    <div class="container-fluid">
      <h1>Total Deposits</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 inline-divs text-right">
            <div class="month-expense-box">Total Deposits of Month
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
            <div class="month-expense-box">Year
              <div class="form-inline">
                <div class="input-group">
                  <select class="form-control" name="" id="" onchange="">
                    <option selected="">2018</option>
                    <option>2017</option>
                    <option>2016</option>
                    <option>2015</option>
                    <option>2014</option>
                    <option>2013</option>
                    <option>2012</option>
                    <option>2011</option>
                    <option>2010</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 no-padding">
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
            <div class="col-lg-10 col-md-12 col-sm-12">
              <div class="flex-wrapper spacetop6x spacebottom6x">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 single-chart"> <svg viewBox="0 0 36 36" class="circular-chart purple">
                  <path class="circle-bg purple"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <path class="circle"
        stroke-dasharray="35, 100"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <text x="18" y="20.35" class="percentage purple">30%</text>
                  </svg>
                  <div class="amount-box purple-box spacetop3x">
                    <div class="bank-name">HDFC</div>
                    <div class="total-amount">8K</div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 single-chart"> <svg viewBox="0 0 36 36" class="circular-chart fluorescent">
                  <path class="circle-bg fluorescent"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <path class="circle"
        stroke-dasharray="15, 100"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <text x="18" y="20.35" class="percentage fluorescent">15%</text>
                  </svg>
                  <div class="amount-box fluorescent-box spacetop3x">
                    <div class="bank-name">Bank of America</div>
                    <div class="total-amount">5K</div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 single-chart"> <svg viewBox="0 0 36 36" class="circular-chart blue">
                  <path class="circle-bg blue"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <path class="circle"
        stroke-dasharray="50, 100"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <text x="18" y="20.35" class="percentage blue">50%</text>
                  </svg>
                  <div class="amount-box blue-box spacetop3x">
                    <div class="bank-name">Bank Leumi</div>
                    <div class="total-amount">15K</div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 single-chart"> <svg viewBox="0 0 36 36" class="circular-chart green">
                  <path class="circle-bg green"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <path class="circle"
        stroke-dasharray="70, 100"
        d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
      />
                  <text x="18" y="20.35" class="percentage green">75%</text>
                  </svg>
                  <div class="amount-box green-box spacetop3x">
                    <div class="bank-name">HSBC</div>
                    <div class="total-amount">25K</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php'); ?>
