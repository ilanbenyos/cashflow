<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Update Bank Details</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="addbankform" method="post" action="">
			<?php 
			$token = md5(uniqid(rand(), TRUE));

if(isset ($_SESSION['form_token_editbank']))

{
	
	unset($_SESSION['form_token_editbank']);
	
}
$_SESSION['form_token_editbank'] = $token;
			?>
			<input type="hidden" name="my_token_editbank" value="<?php echo $token;?>">
              <div class="row clearfix spacetop4x">
                <div class="row-flex clearfix">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" placeholder="Bank Name" value="<?php echo $result->BankName; ?>" id="BankName" name="BankName" />
                        </div>
                      </div>
                    </div>
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Balance</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" placeholder="Balance" value="<?php echo $result->Balance; ?>" id="Balance" name="Balance" />
                        </div>
                      </div>
                    </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="cur" id="cur" onChange="">
                            <?php //print_r($currency);
                            foreach ($currency as $curr) { ?>
                            <option <?php if($curr->CurId == $currencyId->CurId){ echo 'selected="selected"'; } ?> value="<?php echo $curr->CurId; ?>"><?php echo $curr->CurName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>             
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Inward Commission %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="InComP" value="<?php echo $result->InComP; ?>" name="InComP" placeholder="Inflow Commission %" />
                        </div>
                      </div>
                    </div>
					 
                    
                  </div>
                  
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Outward Commission %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="OutComP" value="<?php echo $result->OctComP; ?>" id="OutComP" placeholder="Outgo Commission %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Inward Commission Per Transitions</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="InCom" value="<?php echo $result->InCom; ?>" id="InCom" placeholder="Inflow Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
                   
					
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Outward Commission Per Transitions</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="OutCom" value="<?php echo $result->OutCom; ?>" id="OutCom" placeholder="Outgo Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                         <select class="form-control" name="status" id="status">
                            <option selected="selected" value="<?php echo $result->Active; ?>"><?php if( $result->Active == "1"){ echo "Active";}else{ echo "Disabled";}?> </option>
				      <option value="<?php if( $result->Active== "1"){ echo "0";}else{ echo "1";}?>"><?php if( $result->Active == "1"){ echo "Disabled";}else{ echo "Active";}?> </option>     
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
                  <a href="<?= base_url('configuration/bank');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a>
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

