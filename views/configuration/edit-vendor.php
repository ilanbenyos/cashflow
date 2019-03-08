<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Edit Vendor Details</h2>
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
							  <input type="text" class="form-control" name="Vname" id="Vname" value="<?php echo $Vendor_details->VendorName; ?>"  placeholder="Vendor Name" />
							</div>
						  </div>
						</div>
										<!--	<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Category</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <select class="form-control" name="ExpCatID" id="ExpCatID" onchange="">
								<option value="<?php //echo $Vendor_details->CategoryId; ?> "><?php //echo $Vendor_details->Category; ?></option>
								
								  <?php //foreach ($categories as $category) { ?>
								<option value="<?php //echo $category->CatId; ?> "><?php //echo $category->Category; ?></option>
								  <?php //} ?>
							  </select>
							</div>
						  </div>
						</div>--> 
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Invoice Frequency</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <select class="form-control" name="InvoiceType" id="InvoiceType" onchange="">
								<option value="<?php echo $Vendor_details->InvoiceType; ?> "><?php echo $Vendor_details->InvoiceType; ?></option>
								<option value="Weekly">Weekly</option>
								<option value="Monthly">Monthly</option>
								<option value ="Quarterly">Quarterly</option>
								<option value="Yearly">Yearly</option>
								<option value="PerTransaction">Per Transaction</option>
							  </select>
							</div>
						  </div>
						</div>
						
                    <div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Comments</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <input type="text" class="form-control" name="Comments"  id="Comments" value="<?php echo $Vendor_details->Comments; ?>" placeholder="Comments" />
							</div>
						  </div>
						</div>
					  </div>
					  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
						
						<!-- <div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							   <select class="form-control" name="BankId" id="BankId" onchange="">
								<option value="<?php echo $Vendor_details->BankID; ?> "><?php echo $Vendor_details->BankName; ?></option>
								 <?php foreach ($banks as $bank) { ?>
								<option value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>      
									<?php   } ?>
							  </select>
							</div>
						  </div>
						</div> -->
						<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="Currency" id="Currency" onChange="">
                             <!-- <option selected="" value="">Select Currency</option> -->
                            <?php foreach ($currency as $curr) {
                             ?>
                           <option <?php if($curr->CurId == $Vendor_details->CurId){ echo 'selected="selected"'; } ?> value="<?php echo $curr->CurId; ?>"><?php echo $curr->CurName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div> 
						<div class="col-md-12 col-sm-12 col-xs-12">
						     <div class="form-group">
								<label class="col-md-4 col-sm-4 col-xs-12">Status</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
					                <select class="form-control" name="Status" id="Status">
									<option value="<?php echo $Vendor_details->Active; ?> "><?php if($Vendor_details->Active ==1) { echo "Active" ;}else{ echo "Disable"; }?></option>
									<option value="1">Active</option>      
									<option value="0">Disabled</option>      
								</select>
								</div>
							</div>
						</div>
					  </div>
					</div>
					<div class="col-xs-12 text-center spacetop4x">
					<div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
					  <button type="submit" id="vendor-submit" class="btn-submit transitions">Submit</button>
					  <button type="reset" class="btn-reset transitions" onclick="window.history.go(-1); return false;">Cancel</button>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



<script type="text/javascript">
  (function($){

      $('#Vname').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="")
        { 
          $(this).css("border", "1px solid #CCCCCC");                         
        }
        else if($(this).val()=="") 
        {
          $(this).css("border", "1px solid #be1622");
        }
      })
	  
  
  $("#vendor-submit").click(function(){

      var returnvar = true;
 
		  if($("#Vname").val() ==""){
           $("#Vname").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#ExpCatID").val() ==""){
            $("#ExpCatID").css("border", "1px solid #be1622");
            returnvar = false;
          }
          if($("#InvoiceType").val() ==""){
           $("#InvoiceType").css("border", "1px solid #be1622");
           returnvar = false;
          }
		  
		  if($("#Amount").val() ==""){
           $("#Amount").css("border", "1px solid #be1622");
           returnvar = false;
          }
		   if($("#BankName").val() ==""){
           $("#BankName").css("border", "1px solid #be1622");
           returnvar = false;
          }
		   if($("#Status").val() ==""){
           $("#Status").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){  
             $("#vendor-submit").hide();
            $(".page-loader").show();
            

     }  
     return returnvar;
      });
})(jQuery);
</script>
