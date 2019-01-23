<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Deposit Details</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <div class="top-section spacebottom2x clearfix">
            <div class="col-xs-12 no-padding">
              <form class="form-horizontal clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <label class="col-lg-3 col-md-4 col-sm-4 col-xs-12">Entry Date</label>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                      <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" placeholder="Entry Date" id="" />
                        <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 text-right">
                  <button type="submit" class="cmn-btn transitions">Save</button>
                </div>
              </form>
            </div>
          </div>
          <div class="middle-section light-blue-box spacebottom2x clearfix">
            <form class="form-horizontal clearfix">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onChange="">
                            <option selected="">HSBC</option>
                            <option>ICICI</option>
                            <option>Bank of America</option>
                            <option>HDFC</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">PSP</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">PSP 01</option>
                            <option>PSP 02</option>
                            <option>PSP 03</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" name="message" placeholder="Message"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Amount Received</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="" placeholder="Amount Received" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">USD</option>
                            <option>EUR</option>
                            <option>GBP</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Commission</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="clearfix spacebottom1x">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                <input type="radio" name="radio">
                                <span class="label-text">%</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" id="" placeholder="Commission">
                            </div>
                          </div>
                          <div class="clearfix">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                <input type="radio" name="radio">
                                <span class="label-text">Amount</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" id="" placeholder="Amount">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Date Received</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date Received" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 text-left spacetop2x">
                      <button type="submit" class="cmn-btn transitions">Add Deposit Details</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Bank</th>
                  <th>PSP</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Commission</th>
                  <th>Amount Received</th>
                  <th>Date Received</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>HSBC</td>
                  <td>UPayCard</td>
                  <td>Inter Account</td>
                  <td>$10,000</td>
                  <td>10%</td>
                  <td>11450</td>
                  <td>13/12/2018</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>HDFC</td>
                  <td>Paypal</td>
                  <td>Deposit from BU</td>
                  <td>$50,000</td>
                  <td>20%</td>
                  <td>45,000</td>
                  <td>15/05/2018</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Bank Leumi</td>
                  <td>Terraxa</td>
                  <td>Inter Account</td>
                  <td>$75,000</td>
                  <td>$2000</td>
                  <td>73,000</td>
                  <td>10/08/2018</td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Bank of America</td>
                  <td>UPayCard</td>
                  <td>Deposit from EN BU</td>
                  <td>$84,000</td>
                  <td>25%</td>
                  <td>80,000</td>
                  <td>07/04/2018</td>
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
