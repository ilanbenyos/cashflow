<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Add New Bank</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="addbankform" method="post" action="">
			<?php 
			$token = md5(uniqid(rand(), TRUE));

if(isset ($_SESSION['form_token_addbank']))

{
	
	unset($_SESSION['form_token_addbank']);
	
}
$_SESSION['form_token_addbank'] = $token;
			?>
			<input type="hidden" name="my_token_addbank" value="<?php echo $token;?>">
              <div class="row clearfix spacetop4x">
                <div class="row-flex clearfix">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" placeholder="Bank Name" id="BankName" name="BankName" />
                        </div>
                      </div>
                    </div>
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Balance</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" placeholder="Balance" id="Balance" name="Balance" />
                        </div>
                      </div>
                    </div>
           <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="cur" id="cur" onChange="">
                             <!-- <option selected="" value="">Select Currency</option> -->
                            <?php foreach ($currency as $curr) {
                             ?>
                           <option value="<?php echo $curr->CurId; ?>"><?php echo $curr->CurName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>          
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Inflow Commission %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="InComP" name="InComP" placeholder="Inflow Commission %" />
                        </div>
                      </div>
                    </div>
					
                    
                  </div>
                  
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Outgo Commission %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="OutComP" id="OutComP" placeholder="Outgo Commission %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Inflow Commission Per Transitions</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="InCom" id="InCom" placeholder="Inflow Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
                   
					
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Outgo Commission Per Transitions</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="OutCom" id="OutCom" placeholder="Outgo Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                         <select class="form-control" name="status" id="status">
                            <option value="1">Active</option>      
                            <option value="0">Disabled</option>      
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 text-center spacetop2x">
				<div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                  <button type="submit" id="addbankbtn" class="btn-submit transitions">Submit</button>
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

