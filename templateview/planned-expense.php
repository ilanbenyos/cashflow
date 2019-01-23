<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Planned Expense</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 inline-divs text-right">
          <div class="month-expense-box">Planned the expense of the month
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
          <div class="add-icon-box"><a href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Category</a></div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Amount</th>
                  <th>Description</th>
                  <th>Upload Invoice</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Marketing</td>
                  <td>10,000</td>
                  <td>Marketing expenses for affiliate payout</td>
                  <td><div class="form-inline inline-upload-box">
                      <div class="input-group">
                        <input type="text" class="form-control file-upload-text" placeholder="Upload file" />
                        <span class="input-group-btn">
                        <button type="button" class="file-upload-btn">
                        Upload
                        <input type="file" class="btn file-upload" name="myFile" />
                        </button>
                        </span> </div>
                    </div></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Call Center</td>
                  <td>5,00,000</td>
                  <td>Call center metric for the total cost</td>
                  <td><div class="form-inline inline-upload-box">
                      <div class="input-group">
                        <input type="text" class="form-control file-upload-text" placeholder="Upload file" />
                        <span class="input-group-btn">
                        <button type="button" class="file-upload-btn">
                        Upload
                        <input type="file" class="btn file-upload" name="myFile" />
                        </button>
                        </span> </div>
                    </div></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Development</td>
                  <td>25,000</td>
                  <td>Expenses associated with the research</td>
                  <td><div class="form-inline inline-upload-box">
                      <div class="input-group">
                        <input type="text" class="form-control file-upload-text" placeholder="Upload file" />
                        <span class="input-group-btn">
                        <button type="button" class="btn file-upload-btn">
                        Upload
                        <input type="file" class="file-upload" name="myFile" />
                        </button>
                        </span> </div>
                    </div></td>
                  <td><a class="grey-icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td>Inter Bank</td>
                  <td>9,000</td>
                  <td>Interbank transfer</td>
                  <td><div class="form-inline inline-upload-box">
                      <div class="input-group">
                        <input type="text" class="form-control file-upload-text" placeholder="Upload file" />
                        <span class="input-group-btn">
                        <button type="button" class="btn file-upload-btn">
                        Upload
                        <input type="file" class="file-upload" name="myFile" />
                        </button>
                        </span> </div>
                    </div></td>
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
