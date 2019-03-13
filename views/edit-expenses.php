<?php print_r($expenses); exit(); ?>
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
              <!-- <input type="hidden" name="editexpense_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <input type="hidden" name="shareAmount" id="shareAmount" value="<?php echo number_format($expenses->ShareAmount, 2, '.', ',') ?>">
              <input type="hidden" name="BankOutCommAmount" id="BankOutCommAmount" value="<?php echo number_format($expenses->BankOutCommAmount, 2, '.', ',') ?>">
              <input type="hidden" name="TransferCommAmount" id="TransferCommAmount" value="<?php echo number_format($expenses->TransferCommAmount, 2, '.', ',') ?>"> -->
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Gerneral Information</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Vendor</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
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
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank</label>
                        <div class="col-md-7 col-sm-7 col-xs-12"> 
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
                        <label class="col-md-5 col-sm-5 col-xs-12">Description</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description" value="<?php echo $expenses->Description ?>"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Expense Category</label>
                        <div class="col-md-7 col-sm-7 col-xs-12"> 
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
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Planned Information</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Planned date <span class="red">*</span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $expenses->ExpDate))) ?>" placeholder="Planned Date" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Planned Amount <span class="red">*</span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12"><span>
                          <input type="text" class="form-control xyz" name="plamtReceived" id="plamtReceived" value="<?php echo number_format($expenses->PlannedAmt, 2, '.', ',') ?>" onkeypress="javascript:return isNumber(event)" placeholder="Planned Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="plcurr" id="plcurr" value="<?php echo $expenses->Currency ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Transfer Type</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" name="transferAmt" id="transferAmt">
                          <select class="form-control" name="transType" id="transType" onchange="">
                            <option selected="" value="">Select Transfer Type</option>
                            <?php foreach ($transType as $type) { ?>
                            <option <?php if($type->BankTransferId == $expenses->BankTransferId){ echo 'selected="selected"'; } ?> value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>
                            <?php   } ?>
                          </select>
                          <input type="hidden" class="form-control xyz" name="transferCommP" id="transferCommP" value="<?php echo $expenses->TransferCommP ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Share %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="shareP" id="shareP" value="<?php echo number_format($expenses->Share, 2, '.', ',') ?>" onkeypress="javascript:return isNumber(event)">
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
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Actual Information</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Actual date</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date">
                            <?php  if ($expenses->ActualDate != '0000-00-00') { ?>
                            <input type="text" class="form-control" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $expenses->ActualDate))) ?>" placeholder="Actual Date" />
                            <?php }else{ ?>
                            <input type="text" class="form-control" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive"  placeholder="Actual Date" />
                            <?php } ?>
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Actual Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="acamtReceive" id="acamtReceive" value="<?php echo number_format($expenses->ActualAmt, 2, '.', ',') ?>" onkeypress="javascript:return isNumber(event)" placeholder="Actual Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="accurr" id="accurr"  value="<?php echo $expenses->Currency ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Final bank commission</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="fbc" id="fbc" value="<?php echo number_format($expenses->FinalBankComm, 2, '.', ',') ?>" placeholder="Final Bank Commission" readonly/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net From Bank</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="nfb" id="nfb" value="<?php echo number_format($expenses->NetFromBank, 2, '.', ',') ?>" placeholder="Net From Bank" />
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
                    <a href="<?= base_url('expenses');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a> </div>
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
    $('#vendor').attr('disabled',true);
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
                    console.log(obj.banks.OctComP);
                    //$("#bank").val(obj.banks.BankName);
                    //$("#bankid").val(obj.banks.BankId);
                    $("#outCommP").val(obj.banks.OctComP);
                    $("#plcurr").val(obj.banks.CurName);
                    $("#accurr").val(obj.banks.CurName);

                    //start
                    var actualAmout = $("#acamtReceive").val().replace(/,/gi, "");
                    var outCommP = obj.banks.OctComP;
                    var transferCommP = $("#transferCommP").val();
                    var shareP =  $("#shareP").val();
                    if(actualAmout == ""){
                      var actualAmout = 0;
                    }else{
                      var actualAmout = actualAmout;
                    }

                    if (outCommP == "") {
                      var outCommP = 0;
                    }else{
                      var outCommP = outCommP;
                    }

                    if (transferCommP == "") {
                      var transferCommP = 0;
                    }else{
                      var transferCommP = transferCommP;
                    }

                    if (shareP == "") {
                      var shareP = 0;
                    }else{
                      var shareP = shareP;
                    }

                    console.log('actualAmout' + actualAmout);
                    console.log('outCommP' + outCommP);
                    console.log('transferCommP' + transferCommP);
                    console.log('shareP' + shareP);

                    var outComm = (actualAmout*(outCommP/100));
                    var transferComm = (actualAmout*(transferCommP/100));
                    var shareComm = (transferComm*(shareP/100));

                    console.log('outComm' + outComm);
                    console.log('transferComm' + transferComm);
                    console.log('shareComm' + shareComm);
                    console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

                    var totalComm = (parseInt(outComm)+parseInt(shareComm));
                    var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

                    $("#fbc").val(totalComm);
                    $("#nfb").val(netAmount);
                    //end
                   }
               });
    });
    $('#transType').on('change',function() {
      var transType = document.getElementById("transType").value;
      var bankid = document.getElementById("bankid") .value;
      $.ajax({
                url:"<?php echo base_url ('Expenses/transferAmt/')?>"+ transType ,
                    type: "POST",
                    data : {transType:transType,bankid:bankid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    //console.log(obj.transferAmt.Amount);
                    //$("#transferAmt").val(obj.transferAmt.Amount);
                     if (obj.result == null) {
                          var transferCommP = 0;
                      }else{
                          var transferCommP = (obj.result.Amount);
                      }
                      $("#transferCommP").val(transferCommP);

                      //start
                      var actualAmout = $("#acamtReceive").val().replace(/,/gi, "");
                      
                      var outCommP = $("#outCommP").val();
                      var transferCommP = transferCommP;
                      var shareP =  $("#shareP").val();

                      if(actualAmout == ""){
                        var actualAmout = 0;
                      }else{
                        var actualAmout = actualAmout;
                      }

                      if (outCommP == "") {
                        var outCommP = 0;
                      }else{
                        var outCommP = outCommP;
                      }

                      if (transferCommP == "") {
                        var transferCommP = 0;
                      }else{
                        var transferCommP = transferCommP;
                      }

                      if (shareP == "") {
                        var shareP = 0;
                      }else{
                        var shareP = shareP;
                      }

                      console.log('actualAmout' + actualAmout);
                      console.log('outCommP' + outCommP);
                      console.log('transferCommP' + transferCommP);
                      console.log('shareP' + shareP);

                      var outComm = (actualAmout*(outCommP/100));
                      var transferComm = (actualAmout*(transferCommP/100));
                      var shareComm = (transferComm*(shareP/100));

                      console.log('outComm' + outComm);
                      console.log('transferComm' + transferComm);
                      console.log('shareComm' + shareComm);
                      console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

                      var totalComm = (parseInt(outComm)+parseInt(shareComm));
                      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

                      $("#fbc").val(totalComm);
                      $("#nfb").val(netAmount);
                      //end
                    
                   }
               });
    });
    $('#plcurr').on('change',function() {
      var plcurr = document.getElementById("plcurr").value;
      $("#accurr").val(plcurr);
    });
    
    //Net From Bank Calculation
    
    $( "#acamtReceive" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val().replace(/,/gi, "");
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var shareP =  $("#shareP").val();
      /*console.log('actualAmout' + actualAmout);
      console.log('outCommP' + outCommP);
      console.log('transferCommP' + transferCommP);
      console.log('shareP' + shareP);*/

      var outComm = (actualAmout*(outCommP/100));
      var transferComm = (actualAmout*(transferCommP/100));
      var shareComm = (transferComm*(shareP/100));
      /*console.log('outComm' + outComm);
      console.log('transferComm' + transferComm);
      console.log('shareComm' + shareComm);
      console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));*/
      var totalComm = (parseInt(outComm)+parseInt(shareComm));
      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));
      /*console.log('totalComm' + totalComm);
      console.log('netAmount' + netAmount);*/
      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);


    var shareAmount = $("#shareAmount").val(shareP/100);
    var BankOutCommAmount = $("#BankOutCommAmount").val(outCommP/100);
    var TransferCommAmount = $("#TransferCommAmount").val(transferCommP/100);
    });

    $( "#shareP" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val();
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var shareP =  $("#shareP").val();

      if(actualAmout == ""){
        var actualAmout = 0;
      }else{
        var actualAmout = actualAmout;
      }

      if (outCommP == "") {
        var outCommP = 0;
      }else{
        var outCommP = outCommP;
      }

      if (transferCommP == "") {
        var transferCommP = 0;
      }else{
        var transferCommP = transferCommP;
      }

      if (shareP == "") {
        var shareP = 0;
      }else{
        var shareP = shareP;
      }

      console.log('actualAmout' + actualAmout);
      console.log('outCommP' + outCommP);
      console.log('transferCommP' + transferCommP);
      console.log('shareP' + shareP);

      var outComm = (actualAmout*(outCommP/100));
      var transferComm = (actualAmout*(transferCommP/100));
      var shareComm = (transferComm*(shareP/100));

      console.log('outComm' + outComm);
      console.log('transferComm' + transferComm);
      console.log('shareComm' + shareComm);
      console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

      var totalComm = (parseInt(outComm)+parseInt(shareComm));
      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);


      var shareAmount = $("#shareAmount").val(shareP/100);
      var BankOutCommAmount = $("#BankOutCommAmount").val(outCommP/100);
      var TransferCommAmount = $("#TransferCommAmount").val(transferCommP/100);
    });

    /*$('#transType').on('change',function() { 
      var actualAmout = $("#acamtReceive").val();
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var shareP =  $("#shareP").val();

      if(actualAmout == ""){
        var actualAmout = 0;
      }else{
        var actualAmout = actualAmout;
      }

      if (outCommP == "") {
        var outCommP = 0;
      }else{
        var outCommP = outCommP;
      }

      if (transferCommP == "") {
        var transferCommP = 0;
      }else{
        var transferCommP = transferCommP;
      }

      if (shareP == "") {
        var shareP = 0;
      }else{
        var shareP = shareP;
      }

      console.log('actualAmout' + actualAmout);
      console.log('outCommP' + outCommP);
      console.log('transferCommP' + transferCommP);
      console.log('shareP' + shareP);

      var outComm = (actualAmout*(outCommP/100));
      var transferComm = (actualAmout*(transferCommP/100));
      var shareComm = (transferComm*(shareP/100));

      console.log('outComm' + outComm);
      console.log('transferComm' + transferComm);
      console.log('shareComm' + shareComm);
      console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

      var totalComm = (parseInt(outComm)+parseInt(shareComm));
      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);
    });*/
    
    /*$('#bankid').on('change',function() {
      var actualAmout = $("#acamtReceive").val();
      var outCommP = $("#outCommP").val();
      var transferCommP = $("#transferCommP").val();
      var shareP =  $("#shareP").val();
      alert(111)
      if(actualAmout == ""){
        var actualAmout = 0;
      }else{
        var actualAmout = actualAmout;
      }

      if (outCommP == "") {
        var outCommP = 0;
      }else{
        var outCommP = outCommP;
      }

      if (transferCommP == "") {
        var transferCommP = 0;
      }else{
        var transferCommP = transferCommP;
      }

      if (shareP == "") {
        var shareP = 0;
      }else{
        var shareP = shareP;
      }

      console.log('actualAmout' + actualAmout);
      console.log('outCommP' + outCommP);
      console.log('transferCommP' + transferCommP);
      console.log('shareP' + shareP);

      var outComm = (actualAmout*(outCommP/100));
      var transferComm = (actualAmout*(transferCommP/100));
      var shareComm = (transferComm*(shareP/100));

      console.log('outComm' + outComm);
      console.log('transferComm' + transferComm);
      console.log('shareComm' + shareComm);
      console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

      var totalComm = (parseInt(outComm)+parseInt(shareComm));
      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));

      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);
    });*/

  });

</script> 
<script type="text/javascript">
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
          if($("#expCat").val() ==""){
           $("#expCat").css("border", "1px solid #be1622");           
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
          if($("#transType").val()==""){                  
           $("#transType").css("border", "1px solid #be1622");
           returnvar = false;
          }
          var actualAmt = $("#acamtReceive").val();
          var actualDate = $("#acdatereceive").val();
          if(actualAmt != "" && actualDate == ""){
            $("#acdatereceive").css("border", "1px solid #be1622");
            returnvar = false;
            //alert(returnvar);
          }

          if(returnvar == true){
            $('#bankid').attr('disabled',false);
            $('#transType').attr('disabled',false);
            $('#shareP').attr('disabled',false);
            $('#vendor').attr('disabled',false);
            $("#addExpense").hide();
            $(".page-loader").show();
     } 
     return returnvar;
      });
</script> 
<!-- 
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