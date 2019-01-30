<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>PSP Income</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <div class="middle-section light-blue-box spacebottom2x clearfix">
            <form class="form-horizontal clearfix" id="pspIncome" method="post">
                <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['token_editpspincome']))
                  {
                    unset($_SESSION['token_editpspincome']);
                  }
                  $_SESSION['token_editpspincome'] = $token;
                ?>
      <input type="hidden" name="pspin_edittoken" value="<?php echo $token;?>">
      <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">PSP</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="psp" id="psp" onchange="">
                            <option selected="" value="">Select PSP</option>
                            <?php foreach ($all_psp as $psp) { ?>

                            <option <?php if($psp->PspId == $allPspIncome->PspId){ echo 'selected="selected"'; } ?> value="<?php echo $psp->PspId; ?>"><?php echo $psp->PspName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="hidden" class="form-control" name="bankid" id="bankid" />
                          <input type="text" class="form-control" name="bank" id="bank" value="<?php echo $allPspIncome->BankName ?>" />
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="bank" id="bank" onChange="">
                             <option selected="" value="">Select Bank</option>
                            <?php foreach ($banks as $bank) { ?>
                            <option value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description" value=""><?php echo $allPspIncome->Description ?></textarea>
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
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" value="<?php //echo $allPspIncome->ExpDate ?>" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Planned Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="plamtReceived" id="plamtReceived" placeholder="Amount Received" value="<?php echo $allPspIncome->PlannedAmt ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="plcurr" id="plcurr">
                            <option value="USD" selected="">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Commission</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="clearfix spacebottom1x">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                <input type="radio" name="plcomm" id="plcomm" class="checkcomm" value="" checked="">
                                <span class="label-text">%</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" name="plcommval" id="plcommval" placeholder="Commission">
                            </div>
                          </div>
                          <div class="clearfix">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                <input type="radio" name="plcomm" id="plamt" class="checkamt" value="">
                                <span class="label-text">Amount</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" name="plamtval" id="plamtval" placeholder="Amount">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Net Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="plnetAmt" id="plnetAmt" placeholder="Planned Net Amount" value="<?php echo $allPspIncome->PlannedNetAmt ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--planned info ends -->
                  <!-- Actual info starts -->
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Actual Received date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php //echo $allPspIncome->ActualDate ?>" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Actual Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="acamtReceive" id="acamtReceive" placeholder="Amount Received" value="<?php echo $allPspIncome->ActualAmt ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="accurr" id="accurr" onchange="">
                            <option selected="">USD</option>
                            <option>EUR</option>
                            <option>GBP</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Commission</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="clearfix spacebottom1x">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                <input type="radio" name="accomm" id="accomm" class="checkcomm" checked>
                                <span class="label-text">%</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" name="accommval" id="accommval" placeholder="Commission">
                            </div>
                          </div>
                          <div class="clearfix">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                <input type="radio" name="accomm" id="acamt">
                                <span class="label-text">Amount</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" name="acamtval" id="acamtval" placeholder="Amount">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Net Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="acnetAmt" id="acnetAmt" placeholder="Actual Net Amount" value="<?php echo $allPspIncome->ActualNetAmt ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Actual info ends -->
                  <!-- <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box"> -->
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Date Received</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date Received" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="col-xs-12 text-left spacetop2x">
                      <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                      <button type="submit" class="cmn-btn transitions" id="editPspIncome">Edit PSP Income</button>
                    </div> -->
                    <div class="col-xs-12 text-center spacetop2x">
                  <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                  <button type="submit" id="editPspIncome" class="btn-submit transitions">Submit</button>
                  <a href="<?= base_url('psp_income');?>" class="btn-reset transitions">Cancel</a>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#psp').on('change',function() {
        var pspid=document.getElementById("psp").value;  
         $.ajax({
                url:"<?php echo base_url ('Psp_income/getBanks/')?>"+ pspid ,
                    type: "POST",
                    data : {pspid:pspid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.getpsp);
                    $("#bank").val(obj.getpsp.BankName);
                    $("#bankid").val(obj.getpsp.BankId);
                    
                   }
               });

    });
    $('#plcurr').on('change',function() {
      var plcurr = document.getElementById("plcurr").value;
      $("#accurr").val(plcurr);
    });

        $('#plamtval').attr('disabled',true);
        $('#acamtval').attr('disabled',true);
    $('input[type="radio"]').click(function(){  
    if ($(this).is(':checked'))   // Planned PSP Income
    {   //alert($(this).is(':checked'));
      //alert($(this).attr('id'));
      //if($(this).val() == "plcomm"){

        if($(this).attr('id')== "plcomm"){
        //alert($(this).attr('id'));
        $('#plamtval').val('');  // to clear input fields
        $("#plamtval").attr('disabled', true);
        $("#plcommval").attr('disabled', false);
        $( "#plcommval").click(function() {
        $( "#plcommval" ).keyup();
      });
      }else if($(this).attr('id') == "plamt"){
        $('#plcommval').val('');  // to clear input fields
        $("#plcommval").attr('disabled', true);
        $("#plamtval").attr('disabled', false);
        $( "#plamtval").click(function() {
        $( "#plamtval" ).keyup();
      });
    }
    }
    if ($(this).is(':checked'))   // Actual PSP Income
    {
      //alert($(this).attr('id'));
      //if($(this).val() == "plcomm"){
        if($(this).attr('id')== "accomm"){
        //alert($(this).attr('id'));
        $('#acamtval').val('');  // to clear input fields
        $("#acamtval").attr('disabled', true);
        $("#accommval").attr('disabled', false);
          $( "#accommval").click(function() {
          $( "#accommval" ).keyup();
        });
      }else if($(this).attr('id') == "acamt"){
        $('#accommval').val('');  // to clear input fields
        $("#accommval").attr('disabled', true);
        $("#acamtval").attr('disabled', false);
        $( "#acamtval").click(function() {
          $( "#acamtval" ).keyup();
        });
      }
    }
  });

    $( "#plcommval" ).keyup(function( event ) {    // Planned PSP Income
      var plamt =document.getElementById("plamtReceived").value;  
      var comm = document.getElementById("plcommval").value;
      var amt = document.getElementById("plamtval").value;
      var commission = (comm/100);  // 0.5%
      var commamt = (plamt*commission);
      $("#plamtval").val(commamt);
      var plnetamt = (plamt-commamt);
      $("#plnetAmt").val(plnetamt);
      
    })/*.keydown(function( event ) {
      //alert(11111);
    });*/
    $( "#plamtval" ).keyup(function( event ) {  // Planned PSP Income
      var plamt =document.getElementById("plamtReceived").value;  
      var comm = document.getElementById("plcommval").value;
      var amt = document.getElementById("plamtval").value;
      //var commission = (comm/100);  // 0.5%
      var plnetamt = (plamt-amt);
      $("#plnetAmt").val(plnetamt);
      
    })/*.keydown(function( event ) {
      //alert(11111);
    });*/

    $( "#accommval" ).keyup(function( event ) {    // Actual PSP Income
      var acamt =document.getElementById("acamtReceive").value;  
      var comm = document.getElementById("accommval").value;
      var amt = document.getElementById("acamtval").value;
      var commission = (comm/100);  // 0.5%
      var commamt = (acamt*commission);
      $("#acamtval").val(commamt);
      var acnetamt = (acamt-commamt);
      $("#acnetAmt").val(acnetamt);
    })

    $( "#acamtval" ).keyup(function( event ) {  // Actual PSP Income
      var acamt =document.getElementById("acamtReceive").value;  
      var comm = document.getElementById("accommval").value;
      var amt = document.getElementById("acamtval").value;
      //var commission = (comm/100);  // 0.5%
      var acnetamt = (acamt-amt);
      $("#acnetAmt").val(acnetamt);
      
    })

  });

</script>
<!-- <script type="text/javascript">
    (function($){
      $('#psp').on('blur', function() {
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
      $('#acdatereceive').on('blur', function() {
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
      $('#acamtReceive').on('blur', function() {
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
      $("#addPspIncome").click(function(){
      var returnvar = true;
      if($("#psp").val() ==""){
           $("#psp").css("border", "1px solid #be1622");           
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
          if($("#acdatereceive").val()==""){                  
           $("#acdatereceive").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#acamtReceive").val()==""){                  
           $("#acamtReceive").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){ 
            alert(returnvar);
            var bank = document.getElementById('bank').value;
            alert(bank);
             $("#addPspIncome").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('add-psp-income/')?>",
                    type: "POST",
                    data : $("#pspIncome").serialize(),
                    dataType: "html",
                   success: function(data) {
                    console.log(data);
                    if(data == 1){
                      window.location.href = '<?php echo base_url('psp-income') ?>';
                    }else{
                       window.location.href = '<?php echo base_url('psp-income') ?>';
                    }
                   }
               });

     }  
     return returnvar;
      });
    })(jQuery);
</script>  -->
