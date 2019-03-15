<!-- Page Content  -->

<div id="content">
  <div class="container-fluid"> 
    <!-- <h1>PSP Income</h1> -->
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12"> 
          <!-- <div class="middle-section light-blue-box spacebottom2x clearfix"> -->
          <h2 class="modal-title">ADD PSP Income</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="pspIncome" method="post" >
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['token_pspincome']))
                  {
                    unset($_SESSION['token_pspincome']);
                  }
                  $_SESSION['token_pspincome'] = $token;
                ?>
              <input type="hidden" name="pspin_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Gerneral Information</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">PSP</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="psp" id="psp" onchange="">
                            <option selected="" value="">Select PSP</option>
                            <?php foreach ($all_psp as $psp) { ?>
                            <option value="<?php echo $psp->PspId; ?>"><?php echo $psp->PspName; ?></option>
                            <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control" name="bankid" id="bankid" />
                          <input type="text" class="form-control" name="bank" id="bank" readonly/>
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
                        <label class="col-md-5 col-sm-5 col-xs-12">Description</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description"></textarea>
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
                        <label class="col-md-5 col-sm-5 col-xs-12">Received date <span class="red">*</span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-5x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Processed Amount <!-- <span class="red">*</span> --></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plamtReceived" id="plamtReceived"  placeholder="Planned Processed Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="plcurr" id="plcurr" readonly>
                          <!-- <select class="form-control" name="plcurr" id="plcurr" readonly>
                            <option value="USD" selected="">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                          </select> --> 
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plcommval" id="plcommval" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plamtval" id="plamtval" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
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
                              <input type="text" class="form-control" name="plcommval" id="plcommval" onkeypress="javascript:return isNumber(event)" placeholder="Commission">
                            </div>
                          </div>
                          <div class="clearfix">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                 <input type="radio" name="plcomm" id="plamt" class="checkamt" value="">
                                <span class="label-text">Amount</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" name="plamtval" id="plamtval" onkeypress="javascript:return isNumber(event)" placeholder="Amount">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --> 
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Plan Total Comission</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="pltotcomm" id="pltotcomm" placeholder="Planned Total Comission" />
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plnetAmt" id="plnetAmt" placeholder="Planned Net Amount" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--planned info ends --> 
                  <!-- Actual info starts -->
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Actual Information</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Received date</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date">
                            <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-5x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Processed Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="acamtReceive" id="acamtReceive" onkeypress="javascript:return isNumber(event)" placeholder="Actual Processed Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="accurr" id="accurr" readonly>
                          <!--  <select class="form-control" name="accurr" id="accurr" onchange="" readonly>
                            <option selected="">USD</option>
                            <option>EUR</option>
                            <option>GBP</option>
                          </select> --> 
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="accommP" id="accommP" onkeypress="javascript:return isNumber(event)">
                          <input type="text" class="form-control xyz" name="accommval" id="accommval" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="acamtval" id="acamtval" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="display: none;" id="crr">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">CRR Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" name="crrComm" id="crrComm">
                          <input type="text" class="form-control xyz" name="crrAmt" id="crrAmt" placeholder="CRR Amount" readonly />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-5x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank Commission</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="bankcommP" id="bankcommP" onkeypress="javascript:return isNumber(event)">
                          <input type="text" class="form-control xyz" name="bankcomm" id="bankcomm" onkeypress="javascript:return isNumber(event)" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net To Bank Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="nettoBankAmt" id="nettoBankAmt" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
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
                              <input type="text" class="form-control" name="accommval" id="accommval" onkeypress="javascript:return isNumber(event)" placeholder="Commission">
                            </div>
                          </div>
                          <div class="clearfix">
                            <div class="form-check col-md-5 col-sm-5 col-xs-12">
                              <label>
                                 <input type="radio" name="accomm" id="acamt"> 
                                <span class="label-text">Amount</span> </label>
                            </div>
                            <div class="form-check col-md-7 col-sm-7 col-xs-12 no-padding">
                              <input type="text" class="form-control" name="acamtval" id="acamtval" onkeypress="javascript:return isNumber(event)" placeholder="Amount">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --> 
                    <!--  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Actual Total Comission</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="actotcomm" id="actotcomm" placeholder="Actual Total Comission" />
                        </div>
                      </div>
                    </div> --> 
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Net Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control xyz" name="acnetAmt" id="acnetAmt" placeholder="Actual Net Amount"/>
                        </div>
                      </div>
                    </div> --> 
                  </div>
                  <!--Actual info ends -->
                  <div class="col-xs-12 text-center spacetop2x">
                    <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>
                    <button type="button" id="addPspIncome" class="btn-submit transitions">Submit</button>
                    <!-- <button type="reset" class="btn-reset transitions">Reset</button> --> 
                    <a href="<?= base_url('psp_income');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a> </div>
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
<!-- <script>
  jQuery(document).ready(function ($) {
      var today = new Date();
$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });
  });
  
</script> --> 
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
                    $("#plcurr").val(obj.getpsp.CurName);
                    $("#accurr").val(obj.getpsp.CurName);
                    $("#accommP").val(obj.getpsp.Commission);
                    var commAmount = $("#accommP").val();
                    var commAmount = commAmount;
                    $("#bankcommP").val(obj.getpsp.InComP);
                    $("#accommval").val(commAmount);
                    if (obj.getpsp.Crr > 0.00) {
                      $("#crr").show();
                    $("#crrComm").val(obj.getpsp.Crr);
                    }else{
                      $("#crr").hide();
                    }

                    //net to bank amount calculation start
                    var acamtReceive = $("#acamtReceive").val();
                    if (acamtReceive == "") {
                        var actualAmt = 0;
                    }else{
                        var actualAmt = acamtReceive;
                    }
                    var accommP = $("#accommval").val();
                    var bankcommP = $("#bankcommP").val();
                    //var commAmount = ("#acamtval").val();

                    var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

                    var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

                    var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm)).toFixed(2);
                    $("#bankcomm").val(bankcomm);
                    $("#acamtval").val(commAmount);
                    $("#nettoBankAmt").val(netToBank);
                    //net to bank amount calculation end
                    /*var actualAmt = $("#acamtReceive").val();
                    var CRR = obj.getpsp.Crr;
                    var CRR = ((actualAmt/CRR)*100);
                    alert(CRR);*/
                   }
               });

    });
    $('#plcurr').on('change',function() {
      var plcurr = document.getElementById("plcurr").value;
      $("#accurr").val(plcurr);
    });

    $( "#acamtReceive" ).keyup(function( event ) { 
      var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
      var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
      var crrAmt = (crrComm/100);                                    
      var crrAmt = Number(actualAmt*crrAmt).toFixed(2);
      //alert(crrAmt);
      $("#crrAmt").val(crrAmt);                                      //CRR Amount
      console.log('actualAmt' + actualAmt);
      console.log('crrComm' + crrComm);
      console.log('crrAmt' + crrAmt);
      //alert(actualAmt);



      //net to bank amount calculation start
      var accommP = $("#accommval").val();                          //PSP Commission 
      var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
      //var commAmount = ("#acamtval").val();

      var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

      var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

      

      var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm)).toFixed(2);  
      $("#bankcomm").val(bankcomm);
      $("#acamtval").val(commAmount);
      $("#nettoBankAmt").val(netToBank);

      /*console.log('commission %' +  accommP);
      console.log('bankcommP %' +  bankcommP);

      console.log('Bank commission' +  bankcomm);
      console.log('commission Amount' +  commAmount);

      console.log('Net To Bank' +  netToBank);*/
      //net to bank amount calculation end
    });

      /*$('#pldatereceive').datepicker({
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd'
    });*/
/*$('input.form-control').keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
      
      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
      
      console.log(num2);
      
      $this.val(num2);
  });
    function RemoveRougeChar(convertString){
    
    
    if(convertString.substring(0,1) == ","){
        
        return convertString.substring(1, convertString.length)            
        
    }
    return convertString;
    
}*/

        /*$('#plamtval').attr('disabled',true);
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
  });*/

    /*$( "#plcommval" ).keyup(function( event ) {    // Planned PSP Income
      var plamt =document.getElementById("plamtReceived").value;  
      var comm = document.getElementById("plcommval").value;
      var amt = document.getElementById("plamtval").value;*/
      /*var commission = (comm/100);  // 0.5%
      var commamt = (plamt*commission);
      $("#plamtval").val(commamt);
      var plnetamt = (plamt-commamt);
      $("#plnetAmt").val(plnetamt);*/
                /*var plcommV = (comm/100);
                var plcomm = (plamt*plcommV);
                //var plcommA = (comm/plcommA);
                //alert(plcomm);

                var plcommA = (plcommV*plcomm); //1000*0.1 = 100
                $("#plamtval").val(plcommA);

                var pltotcomm = (plcomm+plcommA); //1000+100
                $("#pltotcomm").val(pltotcomm); 
                var plnetamt = (plamt-pltotcomm); //10000-1100
                $("#plnetAmt").val(plnetamt);*/

      /*var commission = (comm/100);  // 0.5%
      var commamt = (plamt*commission);
      var pltotcomm = (comm+amt);
      $("#pltotcomm").val(pltotcomm); 
      //$("#plamtval").val(commamt);
      var plnetamt = (plamt-commamt);
      $("#plnetAmt").val(plnetamt);
    })/*.keydown(function( event ) {
      //alert(11111);
    });*/
    /*$( "#plamtval" ).keyup(function( event ) {  // Planned PSP Income
      var plamt =document.getElementById("plamtReceived").value;  
      var comm = document.getElementById("plcommval").value;
      var amt = document.getElementById("plamtval").value;
      //var commission = (comm/100);  // 0.5%
      var plnetamt = (plamt-amt);
      $("#plnetAmt").val(plnetamt);
      
    })*//*.keydown(function( event ) {
      //alert(11111);
    });*/

    /*$( "#accommval" ).keyup(function( event ) {    // Actual PSP Income
      var acamt =document.getElementById("acamtReceive").value;  
      var comm = document.getElementById("accommval").value;
      var amt = document.getElementById("acamtval").value;*/
      /*var commission = (comm/100);  // 0.5%
      var commamt = (acamt*commission);
      $("#acamtval").val(commamt);
      var acnetamt = (acamt-commamt);
      $("#acnetAmt").val(acnetamt);*/
      /*var accommV = (comm/100);
      var accomm = (acamt*accommV);
      //var plcommA = (comm/plcommA);
      //alert(plcomm);
      var accommA = (accommV*accomm); //1000*0.1 = 100
      $("#acamtval").val(accommA);

      var actotcomm = (accomm+accommA); //1000+100
      $("#actotcomm").val(actotcomm); 
      var acnetamt = (acamt-actotcomm); //10000-1100
      $("#acnetAmt").val(acnetamt);
    })

    $( "#acamtval" ).keyup(function( event ) {  // Actual PSP Income
      var acamt =document.getElementById("acamtReceive").value;  
      var comm = document.getElementById("accommval").value;
      var amt = document.getElementById("acamtval").value;
      //var commission = (comm/100);  // 0.5%
      var acnetamt = (acamt-amt);
      $("#acnetAmt").val(acnetamt);
      
    })*/

  });

</script> 
<script type="text/javascript">
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
      /*$('#plamtReceived').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="")
        { 
          $(this).css("border", "1px solid #CCCCCC");                         
        }
        else if($(this).val()=="") 
        {
          $(this).css("border", "1px solid #be1622");
        }
      })*/
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
       $('#acamtReceive').on('blur', function() {
        $('#acdatereceive').css("border", "1px solid #CCCCCC");
            if($('#acdatereceive').val()!="")
        { 
          $('#acdatereceive').css("border", "1px solid #CCCCCC");                         
        }
        else if($('#acdatereceive').val()=="") 
        {
          $('#acdatereceive').css("border", "1px solid #be1622");
        }
      })
      $('#acamtval').on('blur', function() {
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
       /* var GivenDate = $("#acdatereceive").val();
       var CurrentDate = new Date();
       console.log(CurrentDate);
       GivenDate = new Date(GivenDate);
       console.log(GivenDate);*/
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="")
        { 
          $(this).css("border", "1px solid #CCCCCC");                         
        }/*else if(GivenDate > CurrentDate)
        {
          $(this).css("border", "1px solid #008000");    
        }*/
        else if($(this).val()=="") 
        {
          $(this).css("border", "1px solid #be1622");
        }
      })
      /*$('#acdatereceive').on('blur', function() {
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
      })*/
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
          /*if($("#plamtReceived").val()==""){                  
           $("#plamtReceived").css("border", "1px solid #be1622");
           returnvar = false;
          }*/
          if($("#acamtval").val()==""){                  
           $("#acamtval").css("border", "1px solid #be1622");
           returnvar = false;
          }
          var actualAmt = $("#acamtReceive").val();
          var actualDate = $("#acdatereceive").val();
          if(actualAmt != "" && actualDate == ""){
            $("#acdatereceive").css("border", "1px solid #be1622");
            returnvar = false;
            //alert(returnvar);
          }
          /*if($("#acdatereceive").val()==""){                  
           $("#acdatereceive").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#acamtReceive").val()==""){                  
           $("#acamtReceive").css("border", "1px solid #be1622");
           returnvar = false;
          }*/
          if(returnvar == true){
            //alert(returnvar);
             $("#addPspIncome").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('add-psp-income')?>",
                    type: "POST",
                    data : $("#pspIncome").serialize(),
                    dataType: "html",
                   success: function(data) {
                    //console.log(data);
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
</script> 
