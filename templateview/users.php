<?php include('header.php'); ?>
  <?php include('left-sidebar.php'); ?>
  <!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Users</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Users</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Priviledges</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Smith</td>
                    <td>smith@gmail.com</td>
                    <td>abc123</td>
                    <td>Admin</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>Johson</td>
                    <td>johson@gmail.com</td>
                    <td>abc123</td>
                    <td>CEO</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>David</td>
                    <td>david@gmail.com</td>
                    <td>abc123</td>
                    <td>Book Keeper</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Button trigger modal --> 
      <!-- Modal -->
      <div class="modal common-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Add New Users</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix">
                  <div class="row clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Date</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Time</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="" placeholder="Time" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="" placeholder="Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Password</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="" placeholder="Password" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="" placeholder="Email" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Role</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Admin</option>
                            <option>CEO</option>
                            <option>Book Keeper</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><strong>Associated Priviledges</strong></div>
                        <div class="col-md-9 col-sm-8 col-xs-12">Maintain Bank Details, Maintain PSP, Maintain Expense Categories, Maintain Planned Expense, Maintain Actual Expense, Reports.</div>
                      </div>
                    </div>
                    <div class="col-xs-12 text-center spacetop2x">
                      <button type="submit" class="btn-submit transitions">Submit</button>
                      <button type="reset" class="btn-reset transitions">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  
  <?php include('footer.php'); ?>
