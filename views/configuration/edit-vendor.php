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
							<option value="<?php //echo $Vendor_details->InvoiceType; ?> "><?php //echo $Vendor_details->InvoiceType; ?></option>
							<option value="Weekly">Weekly</option>
							<option value="Monthly">Monthly</option>
							<option value ="Quarterly">Quarterly</option>
							<option value="Yearly">Yearly</option>
							<option value="PerTransaction">Per Transaction</option>
						  </select>
						</div>
					  </div>
					</div>
					<input type="hidden" name="reminder" id="reminder" value="<?php echo $Vendor_details->ReminderOn; ?>">
					<input type="hidden" name="invoiceTyp" id="invoiceTyp" value="<?php echo $Vendor_details->InvoiceType; ?>">

					<?php //if ($Vendor_details->InvoiceType == 'Weekly') { ?>
						<div class="col-md-12 col-sm-12 col-xs-12" id="weekly" style="display: none;">
		              <div class="form-group">
		              <label class="col-md-4 col-sm-4 col-xs-12">Reminder On</label>
		              <div class="col-md-8 col-sm-8 col-xs-12">
		                 <select class="form-control" name="weekly_reminder" id="weekly_reminder" onchange="">
		                  <option selected="" value="<?php //echo $Vendor_details->ReminderOn ?>"></option>
		                  <option value="Sunday">Sunday</option>
		                  <option value="Monday">Monday</option>
		                  <option value="Tuesday">Tuesday</option>
		                  <option value="Wednesday">Wednesday</option>
		                  <option value="Thursday">Thursday</option>
		                  <option value="Friday">Friday</option>
		                  <option value="Saturday">Saturday</option>
		                </select> 
		              </div>
		              </div>
            		</div>
					<?php //}elseif ($Vendor_details->InvoiceType == 'Monthly') { ?>
						<div class="col-md-12 col-sm-12 col-xs-12" id="monthly" style="display: none;">
		              <div class="form-group">
		              <label class="col-md-4 col-sm-4 col-xs-12">Reminder On</label>
		              <div class="col-md-8 col-sm-8 col-xs-12">
		                 <div class="input-group date" data-provide="datepicker">
		                    <input type="text" class="form-control" name="monthly_reminder" id="monthly_reminder"  />
		                    <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
		                  </div>
		              </div>
		              </div>
		            </div>
					<?php //}elseif ($Vendor_details->InvoiceType == 'Quarterly') { ?>
						<div class="col-md-12 col-sm-12 col-xs-12" id="quartely" style="display: none;">
		              <div class="form-group">
		              <label class="col-md-4 col-sm-4 col-xs-12">Reminder On</label>
		              <div class="col-md-8 col-sm-8 col-xs-12">
		                <div class="input-group date" data-provide="datepicker">
		                    <input type="text" class="form-control" name="quartely_reminder" id="quartely_reminder"/>
		                    <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
		                    </div>
		              </div>
		              </div>
		            </div>
					<?php //} ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
		              <div class="form-group">
		              <label class="col-md-4 col-sm-4 col-xs-12">Invoice Date</label>
		              <div class="col-md-8 col-sm-8 col-xs-12">
		                <div class="input-group date" data-provide="datepicker">
		                    <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $Vendor_details->InvoiceDate)));  ?>" />
		                    <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
		                  </div>
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
					
					 <!--BANK--->
					  <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12">Bank</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <!--  <input type="text" class="form-control" name="Currency" id="Currency"> -->
                            <select class="form-control" name="bank" id="bank" >
                              <!-- <option selected="" value="" id="val"></option> -->
                              <option selected="" value="">Select Bank</option>
                              <?php foreach ($banks as $bank) {
                             ?>
                              <option  <?php if($bank->BankId == $Vendor_details->Bank){ echo 'selected="selected"'; } ?> value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>
                              <?php   } ?>
                            </select>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12">Bank Addess</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="bank_add"  id="bank_add" placeholder="Bank Addess" value="<?php echo $Vendor_details->BankAddress; ?>" />
                          </div>
                        </div>
                      </div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12">IBAN</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="iban"  id="iban" placeholder="IBAN"  value="<?php echo $Vendor_details->IBAN; ?>"/>
                          </div>
                        </div>
                      </div>
					  <!-- END -->
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
						
			            <?php if ($Vendor_details->IsCallCenter == 1) { ?>
			            	<div class="col-md-12 col-sm-12 col-xs-12">
				              <div class="form-group">
				              <label class="col-md-6 col-sm-6 col-xs-12">Call Center </label>
				              <div class="col-md-6 col-sm-6 col-xs-12">
				                <input type="checkbox" name="callcenter" id="callcenter" <?= ( $Vendor_details->IsCallCenter=='1'?  "checked" : "") ?>>
				              </div>
				              </div>
				            </div>
			            	<div class="col-md-12 col-sm-12 col-xs-12" id="show1">
				              <div class="form-group">
				              <label class="col-md-6 col-sm-6 col-xs-12">Call Center Location</label>
				              <div class="col-md-6 col-sm-6 col-xs-12">
				                <input type="text" class="form-control" name="callcenterLocation" id="callcenterLocation" value="<?php echo $Vendor_details->CallCenterlocation ?>" placeholder="Call Center Location">
				              </div>
				              </div>
				            </div>
				            <div class="col-md-12 col-sm-12 col-xs-12" id="show2">
				              <div class="form-group">
				              <label class="col-md-6 col-sm-6 col-xs-12">Call Center Manager</label>
				              <div class="col-md-6 col-sm-6 col-xs-12">
				                <input type="text" class="form-control" name="callcenterManager" id="callcenterManager" value="<?php echo $Vendor_details->CallCenterManager ?>" placeholder="Call Center Manager">
				              </div>
				              </div>
				            </div>
				            <div class="col-md-12 col-sm-12 col-xs-12" id="show3">
				              <div class="form-group">
				              <label class="col-md-6 col-sm-6 col-xs-12">Call Center Cash Balance</label>
				              <div class="col-md-6 col-sm-6 col-xs-12">
				                <input type="text" class="form-control xyz" name="callcenterCashBAl" id="callcenterCashBAl" value="<?php echo number_format($Vendor_details->CallCenterCashBalance, 2, '.', ','); ?>" placeholder="Call Center Cash Balance">
				              </div>
				              </div>
				            </div>
			            <?php }else{ ?>
			            	<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 checkbox">
                            <label>
                              <input type="checkbox" name="callcenter" id="callcenter">
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span> <span class="acceptance">Call Center</span> </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="show1" style="display: none;">
                        <div class="form-group">
                        	<label class="col-md-6 col-sm-6 col-xs-12">Call Center Location</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="callcenterLocation" id="callcenterLocation" placeholder="Call Center Location">
                          </div>
                        </div>
                        <div class="form-group">
                        	<label class="col-md-6 col-sm-6 col-xs-12">Call Center Manager</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="callcenterManager" id="callcenterManager" placeholder="Call Center Manager">
                          </div>
                        </div>
                        <div class="form-group">
                        	<label class="col-md-6 col-sm-6 col-xs-12">Call Center Cash Balance</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control xyz" name="callcenterCashBAl" id="callcenterCashBAl" placeholder="Call Center Cash Balance">
                          </div>
                        </div>
                      </div>
			            <?php } ?>
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
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
 <script type="text/javascript">
  $(document).ready(function(){
    var reminderValue = $("#invoiceTyp").val();	
    var reminder = $("#reminder").val();
    $("#InvoiceType").val(reminderValue);
    if(reminderValue == 'Weekly'){
        $("#weekly").show();
        $("#weekly_reminder").val(reminder);
        $("#monthly").hide();
        $("#quartely").hide();
      }else if(reminderValue == 'Monthly'){
        $("#monthly").show();
        $("#monthly_reminder").val(reminder);
        $("#weekly").hide();
        $("#quartely").hide();
      }else if(reminderValue == 'Quarterly'){
        $("#monthly").hide();
        $("#weekly").hide();
        $("#quartely").show();
        $("#quartely_reminder").val(reminder);
      }
      else{
        $("#monthly").hide();
        $("#weekly").hide();
        $("#quartely").hide();
      }



    $("#InvoiceType").on('change',function(){
      var reminderValue = $("#InvoiceType").val();
      var reminderon = $("#ReminderOn").val();	
      if(reminderValue == 'Weekly'){
        $("#weekly").show();
        $("#monthly").hide();
        $("#quartely").hide();
      }else if(reminderValue == 'Monthly'){
        $("#monthly").show();
        $("#weekly").hide();
        $("#quartely").hide();
      }else if(reminderValue == 'Quarterly'){
        $("#monthly").hide();
        $("#weekly").hide();
        $("#quartely").show();
      }
      else{
        $("#monthly").hide();
        $("#weekly").hide();
        $("#quartely").hide();
      }
    });

    $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $("#show1").show();
                $("#show2").show();
                $("#show3").show();
            }
            else if($(this).prop("checked") == false){
                $("#show1").hide();
                $("#show2").hide();
                $("#show3").hide();
            }
        });
  });
</script> 
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
<script type="text/javascript">
	$('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $("#show1").show();
                $("#show2").show();
                $("#show3").show();
            }
            else if($(this).prop("checked") == false){
                $("#show1").hide();
                $("#show2").hide();
                $("#show3").hide();
            }
        });
</script>
