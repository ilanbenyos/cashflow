<?php 
$this->db->select('UserID,Name,RoleId,CallCenterVendorId,Active');
      $this->db->from('usermaster');
      $this->db->where('UserID',$_SESSION['userid']);
      $this->db->where('Active',1);
      $query = $this->db->get();
      $VendorId = $query->row();
      //print_r($vendors->VendorId);
 ?>
<!-- Page Content  -->
<!--<div id="content">
  <div class="container-fluid">-->
    <!-- <h1>PSP Income</h1> -->
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <!-- <div class="middle-section light-blue-box spacebottom2x clearfix"> -->
            <h2 class="modal-title">Edit Call Center Expnese</h2>
            <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="edit-expenses" method="post" enctype="multipart/form-data" >
                <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['token_expense_edit']))
                  {
                    unset($_SESSION['token_expense_edit']);
                  }
                  $_SESSION['token_expense_edit'] = $token;
                ?>
              <input type="hidden" name="expense_token_edit" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <input type="hidden" name="Vendorid" value="<?php echo $VendorId->CallCenterVendorId ?>">

              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex"> 
                  <!--planned info starts -->
                  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <h4>General Information</h4>
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <?php if($_SESSION['user_role'] == "Admin") { ?>
                      <div class="col-md-12 col-sm-12 col-xs-12" >
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Select Vendor</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="Vendorid" id="vendor" onchange="">
                            <option selected="" value="">Select Vendor</option>
                            <?php foreach ($vendors as $val) { 
                              ?>
                            <option <?php if($val->VendorId == $expenses->VendorId){ echo 'selected="selected"'; } ?> value="<?php echo $val->VendorId; ?>"><?php echo $val->VendorName; ?></option>   
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Expense Name</label>
                        <div class="col-md-7 col-sm-7 col-xs-12"> 
                          <!-- <input type="hidden" name="transferAmt" id="transferAmt"> -->
                          <select class="form-control" name="expName" id="expName" onchange="">
                            <option selected="" value="">Select Expense Category</option> 
                            <?php foreach ($expCat as $cat) { ?>

                            <option <?php if($cat->CatId == $expenses->ExpName){ echo 'selected="selected"'; } ?> value="<?php echo $cat->CatId; ?>"><?php echo $cat->Category; ?></option>      
                                  <?php   } ?> 
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Expense Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="expAmount" id="expAmount" onkeypress="javascript:return isNumber(event)"  value="<?php if($_SESSION['user_role'] != "Admin"){ echo $expenses->ExpAmount;}else{ echo $expenses->EuroValue; } ?>" placeholder="Expense Amount" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Expense date <!-- <span class="red">*</span> --></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="expDate" id="expDate" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $expenses->ExpDate))) ?>" placeholder="Expense Date" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Expense Payment Type</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="expPaymentType" id="expPaymentType" onchange="">
                            <option selected="" value="<?php echo $expenses->ExpPaymentType ?>"><?php echo $expenses->ExpPaymentType ?></option>
                            <option value="Wire">Wire</option>
                            <option value="Cash">Cash</option>
                            <!-- <?php foreach ($pspType as $psptype) { ?>
                            <option value="<?php echo $psptype->TypeId; ?>"><?php echo $psptype->TypeName; ?></option>
                            <?php   } ?> -->
                          </select>
                        </div>
                      </div>
                    </div>
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Document Upload</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
						<?php if($expenses->DocumentPath){ ?>
							<input disabled name="upload_file" value="<?php echo $expenses->DocumentPath?>" id="upload_file" class="file">
						 <div class="input-group col-xs-12">
							<a download href="/upload_document/<?php echo $expenses->DocumentPath?>" title="Download Document" class="btn btn-transparent text-blue"><i class="fa  fa-cloud-download"></i> </a>
							
						<a  href="/upload_document/<?php echo $expenses->DocumentPath?>" target="_blank" title="view Document" class="btn btn-transparent text-blue"><i class="fa fa-eye"></i> </a>
						</div>
						 <?php }else{ ?>
                        <input type="file" name="upload_file"  id="upload_file" class="file">
                        <div class="input-group col-xs-12">
						  <input class="form-control" data-icon="false" name="upload_doc" id="upload_doc" disabled placeholder="Upload file" type="text"/>
						  <span class="input-group-btn">
							<button class="browse browse-btn" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
						  </span>
						</div>
						<?php  } ?>
                        </div>
                      </div>
					</div>
                  </div>
                  
                  <!--planned info ends --> 
                  <!--Actual info ends -->
                  <div class="col-xs-12 text-center spacetop2x">
                    <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>
                    <!-- <button type="submit" id="editExpense" class="btn-submit transitions">Submit</button> -->
                    <!-- <button type="reset" class="btn-reset transitions">Reset</button> --> 
                    <a href="<?= base_url('all-expenses');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a> </div>
                  <!-- </div> --> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script> 
<script type="text/javascript">
  $(document).ready(function(){
    $('#vendor').attr('disabled',true);
    $('#expName').attr('disabled',true);
    $('#expAmount').attr('disabled',true);
    $('#expDate').attr('disabled',true);
    $('#expPaymentType').attr('disabled',true);
	//upload doc validation//
		$('#upload_file').on('blur', function() {
			if($('#upload_file').val()!=""){
				var file =$('#upload_file').val();
				var reg = /(.*?)\.(pdf|PDF|png|PNG|xlsx|XLSX)$/;
				if(!file.match(reg)){
					$(this).css("border", "1px solid #be1622");
				}else{
					$(this).css("border", "1px solid #CCCCCC"); 
				}
			}else{
				$(this).css("border", "1px solid #CCCCCC"); 
			}
		})
		//--------------------//

  })
  $("#editExpense").click(function(){
        var returnvar = true;
		//upload doc validation//
			if($('#upload_file').val()!=""){
			var file =$('#upload_file').val();
			   var reg = /(.*?)\.(pdf|PDF|png|PNG|xlsx|XLSX)$/;
			   if(!file.match(reg))
			   {
					$(this).css("border", "1px solid #be1622");
					returnvar = false;
			   }
			}
			//---------------------// 
      if($("#expName").val() ==""){
           $("#expName").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#expAmount").val() ==""){
           $("#expAmount").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#expDate").val()==""){                  
           $("#expDate").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#expPaymentType").val()==""){                    
           $("#expPaymentType").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){
            //alert(returnvar); 
             $("#editExpense").hide();
            $(".page-loader").show();

     } 
     return returnvar;
      });
</script>