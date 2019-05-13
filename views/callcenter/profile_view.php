<!-- Page Content  -->
<?print_r( $Vendor_details);?>

<!--<div id="content">
  <div class="container-fluid">-->
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Profile Details</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix"  id="addvendor" method="post" autocomplete="off">
              <?= form_open()?>
              <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['vendor_details']))
                    {
                     unset($_SESSION['vendor_details']);
                   }
                   $_SESSION['vendor_details'] = $token;
                   ?>
              <input type="hidden" name="vendor_details" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop4x">
                <div class="clearfix">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Vendor Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Vname" id="Vname" value="<?php echo $Vendor_details->VendorName; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Invoice Frequency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Frequency" id="Frequency" value="<?php echo $Vendor_details->InvoiceType; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Email</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Email" id="Email" value="<?php echo $Vendor_details->Email; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Password</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Password" id="Password" value="<?php echo $Vendor_details->Password; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Comments</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Comments" id="Comments" value="<?php echo $Vendor_details->Comments; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Vname" id="Vname" value="<?php echo $Vendor_details->CurName; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Vname" id="Vname" value="<?php echo $Vendor_details->BankName; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank Address</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Vname" id="Vname" value="<?php echo $Vendor_details->BankAddress; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">IBAN</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Vname" id="Vname" value="<?php  echo $Vendor_details->IBAN; ?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input readonly type="text" class="form-control" name="Vname" id="Vname" value="<?php if($Vendor_details->Active ==1) { echo "Active" ;}else{ echo "Disable"; }?>"  placeholder="Vendor Name" />
                        </div>
                      </div>
                    </div>
                  </div>
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
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --> 

