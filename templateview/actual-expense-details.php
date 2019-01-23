<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Actual Details</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <div class="top-section spacebottom2x clearfix">
            <div class="col-xs-12 no-padding">
              <form class="form-horizontal clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <label class="col-lg-3 col-md-4 col-sm-4 col-xs-12">Bank Name</label>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                      <select class="form-control" name="" id="" onChange="">
                        <option selected="">HSBC</option>
                        <option>ICICI</option>
                        <option>Bank of America</option>
                        <option>HDFC</option>
                      </select>
                    </div>
                  </div>
                </div>
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
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right">
                  <button type="submit" class="cmn-btn transitions">Save</button>
                </div>
              </form>
            </div>
          </div>
          <div class="middle-section light-blue-box spacebottom2x clearfix">
            <form class="form-horizontal clearfix">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="row-flex clearfix">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Category</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Category 01</option>
                            <option>Category 02</option>
                            <option>Category 03</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Vendor Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Vendor 01</option>
                            <option>Vendor 02</option>
                            <option>Vendor 03</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Invoice Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Weekly Payment</option>
                            <option>Monthly Payment</option>
                            <option>Quarterly Payment</option>
                            <option>Yearly Payment</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Invoice Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="" placeholder="Invoive Amount" />
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
                          <input type="text" class="form-control" id="" placeholder="Commission" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Tentative Payment Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Tentative Payment Date" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Actual Payment Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Actual Payment Date" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Payment Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Completed</option>
                            <option>Pending</option>
                            <option>In Process</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 text-center spacetop2x">
                  <button type="submit" class="cmn-btn transitions">Add Expense</button>
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
                  <th>Category</th>
                  <th>Vendor Name</th>
                  <th>Invoice Type</th>
                  <th>Invoice Amount</th>
                  <th>Currency</th>
                  <th>Commission %</th>
                  <th>Tentative payment date</th>
                  <th>Actual payment date</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Marketing</td>
                  <td>Continum</td>
                  <td>Monthly payment</td>
                  <td>10,000</td>
                  <td>USD</td>
                  <td>10</td>
                  <td>10/12/2018</td>
                  <td>13/12/2018</td>
                  <td><span class="pending bold">Pending</span></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Call Center</td>
                  <td>Fedfx</td>
                  <td>Quarterly payment
                    </thd>
                  <td>50,000</td>
                  <td>EUR</td>
                  <td>20</td>
                  <td>05/04/2016</td>
                  <td>09/04/2016</td>
                  <td><span class="completed bold">Completed</span></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Development</td>
                  <td>Camel</td>
                  <td>Yearly payment</td>
                  <td>5,00,000</td>
                  <td>GBP</td>
                  <td>25</td>
                  <td>18/10/2018</td>
                  <td>24/10/2018</td>
                  <td><span class="in-process bold">In Process</span></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Stationery</td>
                  <td>XYZ</td>
                  <td>Weekly payment</td>
                  <td>70,000</td>
                  <td>USD</td>
                  <td>30</td>
                  <td>10/12/2018</td>
                  <td>13/12/2018</td>
                  <td><span class="pending bold">Pending</span></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Banking</td>
                  <td>ABC</td>
                  <td>Monthly payment</td>
                  <td>80,000</td>
                  <td>EUR</td>
                  <td>40</td>
                  <td>21/05/2018</td>
                  <td>26/05/2018</td>
                  <td><span class="completed bold">Completed</span></td>
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
