<?php include('header.php'); ?>
<?php include('left-sidebar.php'); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Add New Category</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix">
              <div class="row clearfix spacetop4x">
                <div class="clearfix">
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Vendor</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Affiliate</option>
                            <option>Marketing</option>
                            <option>Development</option>
                            <option>Interbank</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Category</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Marketing</option>
                            <option>Call Center</option>
                            <option>Development</option>
                            <option>Interbank</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
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
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                </div>
                <div class="col-xs-12 text-center spacetop4x">
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
<!-- Modal -->

<?php include('footer.php'); ?>
