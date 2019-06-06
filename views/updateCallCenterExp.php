<?php //print_r($expenses); ?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid"> 
    <!-- <h1>PSP Income</h1> -->
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12"> 
          <!-- <div class="middle-section light-blue-box spacebottom2x clearfix"> -->
          <h2 class="modal-title">Edit Expense</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="edit-expenses" method="post" enctype="multipart/form-data">
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['token_edit-expenses']))
                  {
                    unset($_SESSION['token_edit-expenses']);
                  }
                  $_SESSION['token_edit-expenses'] = $token;
                ?>
              <input type="hidden" name="editexpense_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
			  <input type="hidden" name="callcenterid" value="<?php echo $callcenter_expense_details->id ?>">
			   <input type="hidden" name="currency" value="<?php echo $callcenter_expense_details->currency ?>">
			   <input type="hidden" name="vendor_id" value="<?php echo $callcenter_expense_details->vendor_id ?>">
              
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>General Information</h4>
                    </div>
                    
                    <?php if ($_SESSION['user_role'] == "Admin"){?>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Amount Added</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="addedamount" id="addedamount" value="<?php echo number_format($callcenter_expense_details->Amount_ReceivedEuroVal, 2, '.', ',') ?>"  readonly>
                        </div>
                      </div>
                    </div>
					
					<div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Received Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="receivedamount" id="receivedamount" <?php if($callcenter_expense_details->status == 1){ echo "readonly"; }?> value="<?php echo number_format($callcenter_expense_details->Amount_ReceivedEuroVal, 2, '.', ',') ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
					
					
					<div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group checkbox">
                            <label>
                              <input type="checkbox" name="received" id="received" <?= ( $callcenter_expense_details->status=='1'?  "checked" : "") ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span> <span class="acceptance">Is Amount Received</span> </label>
                         
                        </div>
                      </div>
                    <?php }elseif ($_SESSION['user_role'] == "Call Center User"){?>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Amount Added</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="addedamount" id="addedamount" value="<?php echo number_format($callcenter_expense_details->ActualAmt, 2, '.', ',') ?>"  readonly>
                        </div>
                      </div>
                    </div>
					
					<div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Received Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="receivedamount" id="receivedamount" <?php if($callcenter_expense_details->status == 1){ echo "readonly"; }?> value="<?php echo number_format($callcenter_expense_details->Amount_Received, 2, '.', ',') ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
					
					
					<div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group checkbox">
                            <label>
                              <input type="checkbox" name="received" id="received" <?= ( $callcenter_expense_details->status=='1'?  "checked" : "") ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span> <span class="acceptance">Is Amount Received</span> </label>
                         
                        </div>
                      </div>
                    <?php }?>
                    
                    
                    
                  </div>
                  <!--planned info starts -->
                  
                  <!--planned info ends --> 
                  <!-- Actual info starts -->
                  
					<div class="clearfix"></div>
                  <!--Actual info ends -->
				  <?php if($callcenter_expense_details->status == 0){ ?>
                  <div class="col-xs-12 text-center spacetop2x">
                    <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>
                    <button type="submit" id="editExpense" class="btn-submit transitions">Submit</button>
                    <!-- <button type="reset" class="btn-reset transitions">Reset</button> --> 
                    <a href="<?= base_url('all-expenses');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a> </div>
					<?php } ?>
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
    $('#bankid').attr('disabled',true);
    $('#transType').attr('disabled',true);
    $('#shareP').attr('disabled',true);
	$('#receivedamount').keyup(function(event) {
	$("#receivedamount").val(function(index, value) {
		console.log('in');
      value = value.replace(/,/g,'');
      return numberWithCommas(value);
  });
    });
	function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
    


  });

</script> 
<script type="text/javascript">

$('#receivedamount').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="0.00" && $(this).val()!="")
        { 
          $(this).css("border", "1px solid #CCCCCC");                         
        }
        else
        {
          $(this).css("border", "1px solid #be1622");
        }
      })
   $("#editExpense").click(function(){
        var returnvar = true;
		//upload doc validation//
			
			//---------------------// 
      if($("#receivedamount").val() == "0.00" || $("#receivedamount").val() == ""){
           $("#receivedamount").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          
          if(returnvar == true){
           
            //$('#vendor').attr('disabled',false);
            $("#addExpense").hide();
            $(".page-loader").show();
     } 
     return returnvar;
      });
</script> 
