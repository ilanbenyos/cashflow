<?php include('header.php'); ?>
  <?php include('left-sidebar.php'); ?>
  <!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Roles</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Create Roles</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Priviledges</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Admin</td>
                    <td>Maintain Roles, Users</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>CEO</td>
                    <td>Reports</td>
                    <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                  <tr>
                    <td>Book Keeper</td>
                    <td> Maintain Banks, PSPs, Expense Categories, Planned and Actual Expense</td>
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
              <h2 class="modal-title">Create Roles</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix">
                  <div class="row clearfix">
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Role Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="rolename" placeholder="Enter Role Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Maintain Bank Details </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Maintain PSP </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Maintain Expense Categories </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Maintain Planned Expense </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Maintain Actual Expense </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Reports </label>
                        </div>
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
