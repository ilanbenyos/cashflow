<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();

}
?>
<!-- Page Content  -->
<div class="defination-box clearfix">
            <form class="form-horizontal clearfix" method="post" id="editBank_Trans">
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['edit_banktrans']))
                  {
                    unset($_SESSION['edit_banktrans']);
                  }
                  $_SESSION['edit_banktrans'] = $token;
                ?>
              <input type="hidden" name="editbanktrans_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop4x">
          <div class="clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
            
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
              <label class="col-md-4 col-sm-4 col-xs-12">From Bank</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" name="fromBank1" id="fromBank1" onchange="">
                <option selected="" value="">Select From Bank</option>
                            <?php foreach ($banks as $bank1) { ?>

                            <option <?php if ($bank1->BankId == $getTransaction->FromBank) { echo 'selected="selected"'; }  ?> value="<?php echo $bank1->BankId; ?>"><?php echo $bank1->BankName; ?></option>      
                                  <?php   } ?>
                </select>
              </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
              <label class="col-md-4 col-sm-4 col-xs-12">To Bank</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" name="toBank1" id="toBank1" onchange="">
                <option selected="" value="">Select To Bank</option>
                            <?php foreach ($banks as $bank2) { ?>

                            <option <?php if ($bank2->BankId == $getTransaction->ToBank) { echo 'selected="selected"'; }  ?> value="<?php echo $bank2->BankId; ?>"><?php echo $bank2->BankName; ?></option>      
                                  <?php   } ?>
                </select>
              </div>
              </div>
            </div>
            </div>
          
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
            <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                <label class="col-md-4 col-sm-4 col-xs-12">Amount</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control xyz" name="amount1" id="amount1" value="<?php echo number_format($getTransaction->Amount, 2, '.', ',') ?>" placeholder="Amount" />
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Transfer Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="transferAmt1" id="transferAmt1" value="<?php //echo $charges->Amount ?>">
                          <select class="form-control" name="transType1" id="transType1" onchange="">
                            <option selected="" value="">Select Transfer Type</option>
                            <?php foreach ($transType as $type) { ?>

                            <option <?php if ($type->BankTransferId == $getTransaction->BankTransferId) { echo 'selected="selected"'; }  ?> value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="charges1" style="display: none">
                     <div class="form-group">
                      <label class="col-md-4 col-sm-4 col-xs-12">Transfer Charges</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control xyz" name="transferCharges1" id="transferCharges1" placeholder="Transfer Charges" />
                      </div>
                    </div>
                  </div>
            </div>
          </div>
          <div class="col-xs-12 text-center spacetop4x">
          <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
            <button type="button" id="bankTransaction-edit" class="btn-submit transitions">Submit</button>
            <button type="reset" class="btn-reset transitions">Reset</button>
          </div>
          </div>
            </form>
          </div>
<!-- Modal -->
<script type="text/javascript">

  /*$(document).ready(function(){
    var fromBankId1 = document.getElementById("fromBank1").value;  
        //console.log(fromBankId1);
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>"+ fromBankId1 ,
                    type: "POST",
                    data : {fromBankId1:fromBankId1},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      console.log(obj.charges);
                      var charges = obj.charges.Amount
                      $("#transferAmt1").val(charges);
                    }else{
                      console.log('obj' + obj.charges);
                      var charges = 0;
                      $("#transferAmt1").val(charges);
                    }
                   }
               });
  });*/
    /*$('#fromBank1').on('change',function() {
        var fromBankId1 = document.getElementById("fromBank1").value;  
        //console.log(fromBankId1);
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>"+ fromBankId1 ,
                    type: "POST",
                    data : {fromBankId1:fromBankId1},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      console.log(obj.charges);
                      var charges = obj.charges.Amount
                      $("#transferAmt1").val(charges);
                    }else{
                      console.log('obj' + obj.charges);
                      var charges = 0;
                      $("#transferAmt1").val(charges);
                    }
                   }
               });

    });*/
        var transType = document.getElementById("transType1").value;  
        var fromBankId = document.getElementById("fromBank1").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges1").show();
                    var obj = JSON.parse(data);
                    console.log(obj);
                    if(obj.charges != null){
                      var charges = obj.charges.Amount
                      $("#transferCharges1").val(charges);
                    }else{
                      var charges = 0;
                      $("#transferCharges1").val(charges);
                    }
                   }
               });

    $('#transType1').on('change',function() {
        var transType = document.getElementById("transType1").value;  
        var fromBankId = document.getElementById("fromBank1").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges1").show();
                    var obj = JSON.parse(data);
                    console.log(obj);
                    if(obj.charges != null){
                      var charges = obj.charges.Amount
                      $("#transferCharges1").val(charges);
                    }else{
                      var charges = 0;
                      $("#transferCharges1").val(charges);
                    }
                   }
               });

    });
    $('#fromBank1').on('change',function() {
        var transType = document.getElementById("transType1").value;  
        var fromBankId = document.getElementById("fromBank1").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges1").show();
                    var obj = JSON.parse(data);
                    console.log(obj);
                    if(obj.charges != null){
                      var charges = obj.charges.Amount
                      $("#transferCharges1").val(charges);
                    }else{
                      var charges = 0;
                      $("#transferCharges1").val(charges);
                    }
                   }
               });

    });
  
</script>
<script type="text/javascript">
  (function($){
     $('#fromBank1').on('blur', function() {
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
      $('#toBank1').on('blur', function() {
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
      $('#amount1').on('blur', function() {
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
      $('#transType1').on('blur', function() {
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
  $("#bankTransaction-edit").click(function(){
      var returnvar = true;
        if($("#fromBank1").val() ==""){
           $("#fromBank1").css("border", "1px solid #be1622");           
           returnvar = false;
          }
         
          if($("#toBank1").val()==""){                  
           $("#toBank1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#amount1").val()==""){                  
           $("#amount1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#toBank1").val()==""){                  
           $("#toBank1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#transType1").val()==""){                  
           $("#transType1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){ 
              //alert(returnvar);
             $("#bankTransaction-edit").hide();
             $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('bank_transaction/update/')?><?php echo $getTransaction->TransId ?>",
                    type: "POST",
                    data : $("#editBank_Trans").serialize(),
                    dataType: "html",
                   success: function(data) {
                    console.log(data);
                      if(data == 1)
                      {
                        window.location.href = '<?php echo base_url('bank-transaction') ?>';
                      }
                      else
                      {
                        window.location.href = '<?php echo base_url('bank-transaction') ?>';
                      }
                   }
               });
     }  
     return returnvar;
      });
})(jQuery);
</script>

