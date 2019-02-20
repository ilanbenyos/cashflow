<style type="text/css">
  .required-field::before {
  content: "*";
  color: red;
}
</style>
<?php //print_r($expenses); ?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <!-- <h1>PSP Income</h1> -->
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <!-- <div class="middle-section light-blue-box spacebottom2x clearfix"> -->
            <h2 class="modal-title">Edit Expenses</h2>
            <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="edit-expenses" method="post" >
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
      <input type="hidden" name="shareAmount" id="shareAmount" value="<?php echo $expenses->ShareAmount ?>">
      <!-- <input type="hidden" name="BankOutCommP" id="BankOutCommP" value="<?php echo $expenses->BankOutCommP ?>"> -->
      <input type="hidden" name="BankOutCommAmount" id="BankOutCommAmount" value="<?php echo $expenses->BankOutCommAmount ?>">
      <input type="hidden" name="TransferCommAmount" id="TransferCommAmount" value="<?php echo $expenses->TransferCommAmount ?>">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Vendor</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="vendor" id="vendor" onchange="">
                            <option selected="" value="">Select Vendor</option>
                            <?php foreach ($vendors as $vendor) { ?>
                            <option <?php if($vendor->VendorId == $expenses->VendorId){ echo 'selected="selected"'; } ?> value="<?php echo $vendor->VendorId; ?>"><?php echo $vendor->VendorName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <!-- <input type="hidden" class="form-control" name="bankid" id="bankid" value="<?php echo $expenses->BankId ?>"/>
                          <input type="text" class="form-control" name="bank" id="bank" value="<?php echo $expenses->BankName ?>" readonly/> -->
                          <select class="form-control" name="bankid" id="bankid" onchange="">
                            <option selected="" value="">Select Bank</option>
                            <?php foreach ($banks as $bank) { ?>
                            <option <?php if($bank->BankId == $expenses->BankId){ echo 'selected="selected"'; } ?> value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>      
                                  <?php   } ?>
                          </select>
                          <input type="hidden" class="form-control" name="outCommP" id="outCommP" value="<?php echo $expenses->BankOutCommP ?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description" value="<?php echo $expenses->Description ?>"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Expense Category</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <!-- <input type="hidden" name="transferAmt" id="transferAmt"> -->
                          <select class="form-control" name="expCat" id="expCat" onchange="">
                            <option selected="" value="">Select Expense Category</option>
                            <?php foreach ($expCat as $cat) { ?>

                            <option <?php if($cat->CatId == $expenses->CatId){ echo 'selected="selected"'; } ?> value="<?php echo $cat->CatId; ?>"><?php echo $cat->Category; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <!--planned info starts -->
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Planned Received date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <span class="required-field"><span>
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $expenses->ExpDate))) ?>" placeholder="Planned Received Date" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Planned Processed Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <span class="required-field"><span><input type="text" class="form-control" name="plamtReceived" id="plamtReceived" value="<?php echo $expenses->PlannedAmt ?>" onkeypress="javascript:return isNumber(event)" placeholder="Planned Processed Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="plcurr" id="plcurr" value="<?php echo $expenses->Currency ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Transfer Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="hidden" name="transferAmt" id="transferAmt">
                          <select class="form-control" name="transType" id="transType" onchange="">
                            <option selected="" value="">Select Transfer Type</option>
                            <?php foreach ($transType as $type) { ?>

                            <option <?php if($type->BankTransferId == $expenses->BankTransferId){ echo 'selected="selected"'; } ?> value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-12 col-sm-12 col-xs-12" style="display: none;">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Transfer Commission</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="hidden" class="form-control" name="transferCommP" id="transferCommP" placeholder="Transfer Commission" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Share %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="shareP" id="shareP" value="<?php echo $expenses->Share ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Shares %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="plshares" id="plshares" value="<?php echo $expenses->Shares ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <!--planned info ends -->
                  <!-- Actual info starts -->
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Actual Received date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <?php  if ($expenses->ActualDate != '0000-00-00') { ?>
                            <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $expenses->ActualDate))) ?>" placeholder="Actual Received Date" />
                          <?php }else{ ?>
                            <input type="text" class="form-control" name="acdatereceive" id="acdatereceive"  placeholder="Actual Received Date" /> 
                          <?php } ?>
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Actual Processed Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="acamtReceive" id="acamtReceive" value="<?php echo $expenses->ActualAmt ?>" onkeypress="javascript:return isNumber(event)" placeholder="Actual Processed Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="accurr" id="accurr"  value="<?php echo $expenses->Currency ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Final bank commission </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="fbc" id="fbc" value="<?php echo $expenses->FinalBankComm ?>" placeholder="Planned Net Amount" readonly/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Net From Bank </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="nfb" id="nfb" value="<?php echo $expenses->NetFromBank ?>" placeholder="Planned Net Amount" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Actual info ends -->
                    <div class="col-xs-12 text-center spacetop2x">
                  <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                  <button type="submit" id="editExpense" class="btn-submit transitions">Submit</button>
                  <!-- <button type="reset" class="btn-reset transitions">Reset</button> -->
                   <a href="<?= base_url('expense');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a>
                </div>
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
    /*$('#vendor').on('change',function() {
        var vendorId=document.getElementById("vendor").value;  
         $.ajax({
                url:"<?php echo base_url ('Expenses/getBanks/')?>"+ vendorId ,
                    type: "POST",
                    data : {vendorId:vendorId},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.banks);
                    //$("#bank").val(obj.banks.BankName);
                    //$("#bankid").val(obj.banks.BankId);
                    $("#plcurr").val(obj.banks.CurName);
                    $("#accurr").val(obj.banks.CurName);
                   }
               });

    });*/

     $('#bankid').on('change',function() {
        var bankid=document.getElementById("bankid").value;  
         $.ajax({
                url:"<?php echo base_url ('Expenses/getBanks/')?>"+ bankid ,
                    type: "POST",
                    data : {bankid:bankid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.banks);
                    //$("#bank").val(obj.banks.BankName);
                    //$("#bankid").val(obj.banks.BankId);
                    $("#plcurr").val(obj.banks.CurName);
                    $("#accurr").val(obj.banks.CurName);
                   }
               });

    });
    $('#transType').on('change',function() {
      var transType = document.getElementById("transType").value; 
      $.ajax({
                url:"<?php echo base_url ('Expenses/transferAmt/')?>"+ transType ,
                    type: "POST",
                    data : {transType:transType},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    //console.log(obj.transferAmt.Amount);
                    //$("#transferAmt").val(obj.transferAmt.Amount);
                    if (obj.transferAmt == null) {
                          var transferAmt = 0;
                      }else{
                          var transferCommP = (obj.transferAmt.Amount);
                          
                      }
                      $("#transferCommP").val(transferCommP);
                    
                   }
               });
    });
    $('#plcurr').on('change',function() {
      var plcurr = document.getElementById("plcurr").value;
      $("#accurr").val(plcurr);
    });
/*
    //final bank commission calculation
    $( "#fbc" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val();
      var fbc = $("#fbc").val();
      var netFromBank = parseInt(actualAmout)+parseInt(fbc);
      //alert(netFromBank);
      $("#nfb").val(netFromBank);
    });
    $( "#acamtReceive" ).keyup(function( event ) { 
      var fbc = $("#fbc").val();
      var actualAmout = $("#acamtReceive").val();
      var netFromBank = parseInt(actualAmout)+parseInt(fbc);
      console.log(netFromBank);
      $("#nfb").val(netFromBank);
    });*/
     //Net From Bank Calculation
    
    
    $( "#acamtReceive" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val();
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var TransferCommAmount = $("#TransferCommAmount").val();
      var shareP =  $("#shareP").val();


      $("#shareAmount").val(shareP/100);
      //$("#BankOutCommP").val(outCommP);
      $("#BankOutCommAmount").val(outCommP/100);
      $("#TransferCommAmount").val(transferCommP/100);

      var outComm = parseInt(actualAmout*outCommP/100);
      var transferComm =(actualAmout*TransferCommAmount);
      var share   = parseInt((transferCommP/100)*(shareP/100));


      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(share));
      var totalComm = (parseInt(outComm)+parseInt(share));
      //$("#transferCommP").val(transferCommP);

      

      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);

    });
    $( "#shareP" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val();
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var TransferCommAmount = $("#TransferCommAmount").val();
      var shareP =  $("#shareP").val();


      $("#shareAmount").val(shareP/100);
      //$("#BankOutCommP").val(outCommP);
      $("#BankOutCommAmount").val(outCommP/100);
      $("#TransferCommAmount").val(transferCommP/100);

      var outComm = parseInt(actualAmout*outCommP/100);
      var transferComm =(actualAmout*TransferCommAmount);
      var share   = parseInt((transferCommP/100)*(shareP/100));


      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(share));
      var totalComm = (parseInt(outComm)+parseInt(share));
      //$("#transferCommP").val(transferCommP);

      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);

    });
    $( "#transType" ).on('change',function() { 
      var actualAmout = $("#acamtReceive").val();
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var TransferCommAmount = $("#TransferCommAmount").val();
      var shareP =  $("#shareP").val();


      $("#shareAmount").val(shareP/100);
      //$("#BankOutCommP").val(outCommP);
      $("#BankOutCommAmount").val(outCommP/100);
      $("#TransferCommAmount").val(transferCommP/100);

      var outComm = parseInt(actualAmout*outCommP/100);
      var transferComm =(actualAmout*TransferCommAmount);
      var share   = parseInt((transferCommP/100)*(shareP/100));


      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(share));
      var totalComm = (parseInt(outComm)+parseInt(share));
      //$("#transferCommP").val(transferCommP);

      
      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);

    });

  });

</script><!-- 
<script type="text/javascript">
    (function($){
      $('#vendor').on('blur', function() {
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
      $('#bank').on('blur', function() {
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
      $('#plamtReceived').on('blur', function() {
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
      $('#pldatereceive').on('blur', function() {
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
      $("#editExpense").click(function(){
        var returnvar = true;
      if($("#vendor").val() ==""){
           $("#vendor").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#bank").val() ==""){
           $("#bank").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#pldatereceive").val()==""){                  
           $("#pldatereceive").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#plamtReceived").val()==""){                  
           $("#plamtReceived").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){
             $("#editExpense").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('add-expenses')?>",
                    type: "POST",
                    data : $("#edit-expenses").serialize(),
                    dataType: "html",
                   success: function(data) {
                    console.log(data);
                    if(data == 1){
                      window.location.href = '<?php echo base_url('expenses') ?>';
                    }else{
                      window.location.href = '<?php echo base_url('expenses') ?>';
                    }
                   }
               });

     } 
     return returnvar;
      });
    })(jQuery);
</script>  -->
