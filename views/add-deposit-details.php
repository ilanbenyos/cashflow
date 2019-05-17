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
            <form class="form-horizontal clearfix" id="pspIncome" method="post" enctype="multipart/form-data" >
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
              <input type="hidden" name="crrVal" id="crrVal">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Gerneral Information</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
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
					<div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="accommP" id="accommP" >
                          <input type="hidden" class="form-control xyz" name="accommval" id="accommval"  >
                          <input type="text" class="form-control xyz" name="accommval_hid" id="accommval_hid" onkeypress="javascript:return isNumber(event)" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control" name="bankid" id="bankid" />
                          <input type="hidden" class="form-control" name="bank" id="bank" />
                          <input type="text" class="form-control"  name="bank_hid" id="bank_hid" />
                        </div>
                      </div>
                    </div>
					
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Description</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description"></textarea>
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
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control" name="plcurr" id="plcurr">
						   <input type="text" class="form-control"  name="plcurr_hid" id="plcurr_hid" />
                          <!-- <select class="form-control" name="plcurr" id="plcurr" readonly>
                            <option value="USD" selected="">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                          </select> --> 
                        </div>
                      </div>
                    </div>
                    
                  <!--planned info starts -->
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Planned Information</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
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
					  <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plamtval" id="plamtval" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group align-5x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Processed Amount <!-- <span class="red">*</span> --></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plamtReceived" id="plamtReceived"  placeholder="Planned Processed Amount" />
                        </div>
                      </div>
                    </div>
                    
                   
                  
                   
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plnetAmt" id="plnetAmt" placeholder="Planned Net Amount" />
                        </div>
                      </div>
                    </div>
					<div class="clearfix"></div>
					 <!--planned info ends --> 
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Document Upload</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="file" name="upload_file" id="upload_file" class="file">
                        <div class="input-group col-xs-12">
						  <input class="form-control" data-icon="false" name="upload_doc" id="upload_doc" disabled placeholder="Upload file" type="text"/>
						  <span class="input-group-btn">
							<button class="browse browse-btn" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
						  </span>
						</div>
                          <!--<input class="form-control"  data-icon="false" name="upload_doc" id="upload_doc" type="file"/>-->
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
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 checkbox">
                            <label>
                              <input type="checkbox" id="myCheck" onclick="check()">
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span> <span class="acceptance">Insert Manually</span> </label>
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
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="accurr" id="accurr" readonly> -->
                          <!--  <select class="form-control" name="accurr" id="accurr" onchange="" readonly>
                            <option selected="">USD</option>
                            <option>EUR</option>
                            <option>GBP</option>
                          </select> --> 
                        <!-- </div>
                      </div>
                    </div> -->
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="accommP" id="accommP" onkeypress="javascript:return isNumber(event)">
                          <input type="text" class="form-control xyz" name="accommval" id="accommval" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="acamtval" id="acamtval" onkeypress="javascript:return isNumber(event)" >
                          <input type="text" class="form-control xyz"  id="acamtval_hid" onkeypress="javascript:return isNumber(event)" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Additional Fees</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="additionalFees" id="additionalFees" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="display: none;" id="crr">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Rolling Reserved Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" name="crrComm" id="crrComm">
                          <input type="text" class="form-control xyz" name="crrAmt" id="crrAmt" placeholder="CRR Amount" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-5x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank Commission</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="bankcommP" id="bankcommP" onkeypress="javascript:return isNumber(event)">
                          <input type="hidden" class="form-control xyz" name="bankInflowComm" id="bankInflowComm" onkeypress="javascript:return isNumber(event)">
                          <input type="hidden" class="form-control xyz" name="bankcomm" id="bankcomm" >
                          <input type="text" class="form-control xyz"  id="bankcomm_hid" onkeypress="javascript:return isNumber(event)">
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
				  <div class="clearfix"></div>
                  <!--Actual info ends -->
                  <div class="col-xs-12 text-center spacetop2x">
                    <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>
                    <button type="submit" id="addPspIncome" class="btn-submit transitions">Submit</button>
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
	function check() {
	  if(document.getElementById("myCheck").checked == true){
			$('#acamtval_hid').attr('disabled',false);
			$('#bankcomm_hid').attr('disabled',false);
			$('#crrAmt').attr('disabled',false);
	  }else{
			$('#acamtval_hid').attr('disabled',true);
			$('#bankcomm_hid').attr('disabled',true);
			$("#bankcomm_hid").val($("#bankcomm").val());
			$("#acamtval_hid").val($("#acamtval").val());
			$('#crrAmt').attr('disabled',true);
	  }
	  
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
      //sort by albhabetical order start
    /*var options = $('select#psp option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
        //console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });*/
    //sort by albhabetical order end

$('#crrAmt').attr('disabled',true);
$('#bank_hid').attr('disabled',true);
$('#plcurr_hid').attr('disabled',true);
$('#accommval_hid').attr('disabled',true);
$('#acamtval_hid').attr('disabled',true);
$('#bankcomm_hid').attr('disabled',true);



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
                    $("#bank_hid").val(obj.getpsp.BankName);
                    $("#bankid").val(obj.getpsp.BankId);
                    $("#plcurr").val(obj.getpsp.CurName);
                    $("#plcurr_hid").val(obj.getpsp.CurName);
                    $("#accurr").val(obj.getpsp.CurName);
                    $("#accommP").val(obj.getpsp.Commission);
                    $("#bankInflowComm").val(obj.getpsp.InCom);
                    var commAmount = $("#accommP").val();
                    $("#bankcommP").val(obj.getpsp.InComP);
					if (obj.getpsp.Crr > 0.00) {
						$("#crr").show();
						$("#crrComm").val(obj.getpsp.Crr);
						$("#crrVal").val(obj.getpsp.Crr);
					}else{
						  $("#crrComm").val(obj.getpsp.Crr);
						  $("#crr").hide();
					}
					if(document.getElementById("myCheck").checked == false){
					
						$("#accommval").val(commAmount);
						$("#accommval_hid").val(commAmount);
						
						

						//net to bank amount calculation start
						var acamtReceive = $("#acamtReceive").val();
						if (acamtReceive == "") {
							var actualAmt = 0;
						}else{
							acamtReceive = acamtReceive.replace( /,/g, "" );
							 var actualAmt =parseInt(acamtReceive);
						}
			console.log('actualAmt->'+actualAmt);
				
		
						var accommP = $("#accommval").val();
						var bankcommP = $("#bankcommP").val();
						var additionalfees = $("#additionalFees").val();
						var rolingReserved = $("#crrAmt").val();
			console.log('accommP->'+accommP);			
			console.log('bankcommP->'+bankcommP);			
			console.log('additionalfees->'+additionalfees);			
			console.log('rolingReserved->'+rolingReserved);	
			
						if (rolingReserved == "") {
							var rolingReserved = 0;
						}else{
							var rolingReserved = rolingReserved;
						}
						
						if (additionalfees != "") {
							var fees = additionalfees;
						}else{
							var fees = 0;
						}
						
						var bankInflowComm = $("#bankInflowComm").val();
			console.log('bankInflowComm->'+bankInflowComm);
			
						var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);
			console.log('bankcomm->(actualAmt**(bankcommP/100)))'+bankcomm);	
						var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);
						var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees)-parseInt(rolingReserved);
						var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);
					
					
			console.log('commAmount->'+commAmount);			
			console.log('bankcomm1->'+bankcomm1);				
			console.log('bankcomm2->'+bankcomm2);				
						if (bankcomm2 =="NaN" || bankcomm2 == 0) {
							bankcomm2 = 0;
						}else{	
							var bankcomm2 = Number(parseInt(bankInflowComm)+parseInt(bankcomm2)).toFixed(2);
						}
						
						var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)-parseInt(rolingReserved)).toFixed(2);
						
						if(bankcomm2 == "NaN"){
							bankcomm2=0.00;
						}
					   $("#bankcomm").val(bankcomm2);
					   $("#bankcomm_hid").val(bankcomm2);
						if(commAmount == "NaN"){
							commAmount=0.00;
						}
						$("#acamtval").val(commAmount);
						$("#acamtval_hid").val(commAmount);
						
						if(netToBank  == "NaN"){
							netToBank=0.00;
						}
						$("#nettoBankAmt").val(netToBank);
						
					   }
					}
				});
				
    });

    $('#plcurr').on('change',function() {
		var plcurr = document.getElementById("plcurr").value;
		$("#accurr").val(plcurr);
    });
	
    $("#acamtReceive" ).keyup(function( event ) { 
		if(document.getElementById("myCheck").checked == false){
						
			var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
			var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
			var crrAmt = (crrComm/100);                                    
			var crrAmt = Number(actualAmt*crrAmt).toFixed(2);
			var additionalfees = document.getElementById("additionalFees").value;
	console.log('actualAmt->'+actualAmt);		
	console.log('crrComm->'+crrComm);		
	console.log('crrAmt->'+crrAmt);		
	console.log('additionalfees->'+additionalfees);
	
			if (additionalfees != "") {
				var fees = additionalfees;
			}else{
				var fees = 0;
			}

			$("#crrAmt").val(crrAmt);                                      //CRR Amount
			var accommP = $("#accommval").val();                          //PSP Commission 
			var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
			var bankInflowComm = $("#bankInflowComm").val();              //Bank Inflow Commission Per Transition
			var rolingReserved = $("#crrAmt").val();
			var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);
			var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);
			var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees)-parseInt(rolingReserved);
	
	console.log('accommP->'+accommP+' bankcommP->'+bankcommP+' bankInflowComm->'+bankInflowComm+' rolingReserved->'+rolingReserved);
	console.log('bankcomm->'+bankcomm+' commAmount->'+commAmount+' bankcomm1->'+bankcomm1);
		
			var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);
			if (bankcomm2 =="NaN" || bankcomm2 == 0) {
				bankcomm2 = 0;
            }else{	
				var bankcomm2 = Number(parseInt(bankInflowComm)+parseInt(bankcomm2)).toFixed(2);
            }
	console.log('bankcomm2->'+bankcomm2);
		
			var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)-parseInt(rolingReserved)).toFixed(2); 
			if(netToBank == "NaN"){
				netToBank=0.00;
			}if(commAmount == "NaN"){
				commAmount=0.00;
			}if(bankcomm2 == "NaN"){
				bankcomm2=0.00;
			} 
		
			$("#bankcomm").val(bankcomm2);
			$("#bankcomm_hid").val(bankcomm2);
			$("#acamtval").val(commAmount);
			$("#acamtval_hid").val(commAmount);
			$("#nettoBankAmt").val(netToBank);
	console.log('bankcomm->'+bankcomm2+' acamtval->'+commAmount+' Net To Bank->' +  netToBank);	  
		  
		}else if(document.getElementById("myCheck").checked == true){
			var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
			var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
			var crrAmt = (crrComm/100);                                    
			var crrAmt = Number(actualAmt*crrAmt).toFixed(2);
			$("#crrAmt").val(crrAmt);      
	console.log('actualAmt->'+actualAmt);		
	console.log('crrComm->'+crrComm);		
	console.log('crrAmt->'+crrAmt);		
	console.log('additionalfees->'+additionalfees);
		}
    });
	
	
    $( "#additionalFees" ).keyup(function( event ) { 
	    if(document.getElementById("myCheck").checked == false){
				var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
				if(!actualAmt){
					actualAmt = 0;
				}
				var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
				var crrAmt = (crrComm/100);                                    
				var crrAmt = Number(actualAmt*crrAmt).toFixed(2);
				var additionalfees = document.getElementById("additionalFees").value;
				
		console.log('actualAmt->' + actualAmt);
		console.log('crrComm->' + crrComm);
		console.log('crrAmt->' + crrAmt);
		console.log('additionalfees->' + additionalfees);

				if (additionalfees != "") {
					var fees = additionalfees;
				}else{
					var fees = 0;
				}

				$("#crrAmt").val(crrAmt);                                      //CRR Amount

			//net to bank amount calculation start
				var accommP = $("#accommval").val();                          //PSP Commission 
				if(!accommP){
					accommP = 0;
				}
				var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
				if(!bankcommP){
					bankcommP = 0;
				}
				var bankInflowComm = $("#bankInflowComm").val();              //Bank Inflow Commission Per Transition
				if(!bankInflowComm){
					bankInflowComm = 0;
				}
				var rolingReserved = $("#crrAmt").val();
				if(!rolingReserved){
					rolingReserved = 0;
				}

				  var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);
				  var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);
				  var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees)-parseInt(rolingReserved);

			console.log('bankcomm->'+bankcomm+' accommP->'+accommP+'bankInflowComm-> '+bankInflowComm+'rolingReserved->'+rolingReserved);
			console.log('commAmount->'+commAmount);
			console.log('bankcomm1->'+bankcomm1);
					if(!bankcomm1){
						bankcomm1 = 0;
					}
					var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);
			console.log('bankcomm2->'+bankcomm2);

					var bankcomm2 = Number(parseInt(bankInflowComm)+parseInt(bankcomm2)).toFixed(2);
			console.log('bankcomm2->'+bankcomm2);

					var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)-parseInt(rolingReserved)).toFixed(2);  
					if(bankcomm2 == "NaN"){
						bankcomm2=0.00;
					}     
				   $("#bankcomm").val(bankcomm2);
				   $("#bankcomm_hid").val(bankcomm2);
				   if(commAmount == "NaN"){
						commAmount=0.00;
					}  
				  $("#acamtval").val(commAmount);
				  $("#acamtval_hid").val(commAmount);
				  if(netToBank == "NaN"){
						netToBank=0.00;
					} 
				  $("#nettoBankAmt").val(netToBank);
			console.log('bankcomm->'+bankcomm2+' acamtval->'+commAmount+'nettoBankAmt-> '+nettoBankAmt);
		}		
	});
	
     
  });

</script> 
<script type="text/javascript">
    (function($){
		
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
			}
		})
		//--------------------//
		
      $('#psp').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
        if($(this).val()!=""){ 
          $(this).css("border", "1px solid #CCCCCC");                         
        }else if($(this).val()=="") {
          $(this).css("border", "1px solid #be1622");
        }
      })
      $('#bank_hid').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
        if($(this).val()!=""){ 
          $(this).css("border", "1px solid #CCCCCC");                         
        }else if($(this).val()==""){
          $(this).css("border", "1px solid #be1622");
        }
      })

      $('#pldatereceive').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
        if($(this).val()!=""){ 
          $(this).css("border", "1px solid #CCCCCC");                         
        }else if($(this).val()==""){
          $(this).css("border", "1px solid #be1622");
        }
      })
	  
       $('#acamtReceive').on('blur', function() {
        $('#acdatereceive').css("border", "1px solid #CCCCCC");
        if($('#acdatereceive').val()!=""){ 
          $('#acdatereceive').css("border", "1px solid #CCCCCC");                         
        }else if($('#acdatereceive').val()=="") {
          $('#acdatereceive').css("border", "1px solid #be1622");
        }
      })
	  
      $('#acamtval_hid').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
        if($(this).val()!=""){ 
          $(this).css("border", "1px solid #CCCCCC");                         
        }else if($(this).val()==""){
          $(this).css("border", "1px solid #be1622");
        }
      })
       
  
		$('#acdatereceive').on('blur', function() {
			$(this).css("border", "1px solid #CCCCCC");
			if($(this).val()!=""){ 
			  $(this).css("border", "1px solid #CCCCCC");                         
			}else if($(this).val()==""){
			  $(this).css("border", "1px solid #be1622");
			}
		})
     
		$("#addPspIncome").click(function(){
			var returnvar = true;

			//upload doc validation//
				if($('#upload_file').val()!=""){
					var file =$('#upload_file').val();
					var reg = /(.*?)\.(pdf|PDF|png|PNG|xlsx|XLSX)$/;
					if(!file.match(reg)){
							$(this).css("border", "1px solid #be1622");
							returnvar = false;
					}
				}
			//--------------------//
			
			if($("#psp").val() ==""){
				$("#psp").css("border", "1px solid #be1622");           
				returnvar = false;
			}
			if($("#bank_hid").val() ==""){
				$("#bank_hid").css("border", "1px solid #be1622");           
				returnvar = false;
			}

			if($("#pldatereceive").val()==""){                  
				$("#pldatereceive").css("border", "1px solid #be1622");
				returnvar = false;
			}
			
			if($("#acamtval_hid").val()==""){                  
				$("#acamtval_hid").css("border", "1px solid #be1622");
				returnvar = false;
			}
			var actualAmt = $("#acamtReceive").val();
			var actualDate = $("#acdatereceive").val();
			if(actualAmt != "" && actualDate == ""){
				$("#acdatereceive").css("border", "1px solid #be1622");
				returnvar = false;
			}
			if(returnvar == true){
				$('#crrAmt').attr('disabled',false);
				$("#bankcomm").val($("#bankcomm_hid").val());
				$("#acamtval").val($("#acamtval_hid").val());
				$("#addPspIncome").hide();
				$(".page-loader").show();
			} 
			return returnvar;
		});
    })(jQuery);
</script> 
