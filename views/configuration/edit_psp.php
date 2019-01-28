<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
    popup2 ();
}
?>
<div class="defination-box clearfix">
                <form class="form-horizontal clearfix" id="edit_pspdata" method="post">
                	<?= form_open()?>
                    <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['edit_psp']))
                    {
                     unset($_SESSION['edit_psp']);
                   	}
                   $_SESSION['edit_psp'] = $token;
                   ?>
                   <input type="hidden" name="edit_pspdetails" value="<?php echo $token;?>">
                   <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
                   <input type="hidden" name="pspstatus" id="pspstatus" value="<?php echo $getpsp->Active ?>">
                   <input type="hidden" name="pspid" id="pspid" value="<?php echo $getpsp->PspId ?>">
                  <div class="row clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">PSP Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="psp_name1" id="psp_name1" value="<?php echo $getpsp->PspName; ?>" placeholder="PSP Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Associated Bank</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" name="bank1" id="bank1" >
                            <?php foreach ($banks as $bank) { ?>
                            <!-- <option value="<?php echo $bank->BankId; ?>"> <?php echo $bank->BankName; ?></option> --> 
                            <option <?php if($bank->BankId == $getpsp->BankId){ echo 'selected="selected"'; } ?> value="<?php echo $bank->BankId ?>"><?php echo $bank->BankName?> </option>     
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">PSP Type</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="psp_type1" id="psp_type1" placeholder="PSP Type" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Payment Terms</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="payment_terms1" id="payment_terms1" placeholder="payment Terms" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Current Rolling Reserve</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="crc1" id="crc1" placeholder="Current Rolling Reserve" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Commision</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="commision1" id="commision1" placeholder="Commision" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <textarea class="form-control" name="message1" id="message1" placeholder="Message" value=""><?php echo $getpsp->Comments; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
					      <select class="form-control" name="status1" id="status1" onchange="">
                           <!--  <option value="1">Active</option>      
                            <option value="0">Deactive</option>  -->     
                            <option selected="selected" value="<?php echo $getpsp->Active; ?>"><?php if( $getpsp->Active == "1"){ echo "Active";}else{ echo "Disabled";}?> </option>
				      		<option value="<?php if( $getpsp->Active== "1"){ echo "0";}else{ echo "1";}?>"><?php if( $getpsp->Active == "1"){ echo "Disabled";}else{ echo "Active";}?> </option>    
                          </select>
                       </div>
                      </div>
                    </div>
                    <div class="col-xs-12 text-center spacetop2x">
                    	<div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                      <button type="button" class="btn-submit transitions" id="editPsp_submit">Submit</button>
                      <button type="reset" class="btn-reset transitions">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
              <script type="text/javascript">
  	(function($){
  		$('#psp_name1').on('blur', function() {
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
      $('#bank1').on('blur', function() {
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
      $('#status1').on('blur', function() {
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

      $("#editPsp_submit").click(function(){
      var returnvar = true;
      if($("#psp_name1").val() ==""){
           $("#psp_name1").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#bank1").val()==""){                  
           $("#bank1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#status1").val()==""){                  
           $("#status1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){  
             $("#editPsp_submit").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('configuration/payment_processor/editpspData/')?><?php echo $getpsp->PspId ?>",
                    type: "POST",
                    data : $("#edit_pspdata").serialize(),
                    dataType: "html",
                   success: function(data) {
                   	if(data == 1){
                  		window.location.href = '<?php echo base_url('configuration/payment_processor') ?>';
                    }else{
                       window.location.href = '<?php echo base_url('configuration/payment_processor') ?>';
					}
                   }
               });

     }  
     return returnvar;
      });
  	})(jQuery);
</script>
