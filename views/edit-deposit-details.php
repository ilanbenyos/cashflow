<?php //print_r($crrData);exit();
  if ($crrData) {
    $crrSet = "set";
  }else{
    $crrSet = "not";
  }
 ?> 
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>PSP Income</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <!-- <div class="middle-section light-blue-box spacebottom2x clearfix"> -->
		   <h2 class="modal-title">EDIT PSP Income</h2>
            <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="pspIncome" method="post" enctype="multipart/form-data">
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
      <input type="hidden" name="crrVal" id="crrVal" value="<?php echo $allPspIncome->isCRR ?>">
      <input type="hidden" name="crrVAlId" id="crrVAlId" value="<?php echo $allPspIncome->CRRId ?>">
      <input type="hidden" name="crrValue" id="crrValue">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>General Information</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">PSP</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="psp" id="psp" onchange="" readonly>
                            <option selected="" value="">Select PSP</option>
                            <?php foreach ($all_psp as $psp) { ?>

                            <option <?php if($psp->PspId == $allPspIncome->PspId){ echo 'selected="selected"'; } ?> value="<?php echo $psp->PspId; ?>"><?php echo $psp->PspName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
					<div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="accommP" id="accommP" onkeypress="javascript:return isNumber(event)">
                          <input type="hidden" class="form-control xyz" name="accommval" id="accommval" value="<?php echo $allPspIncome->ActualComP ?>" onkeypress="javascript:return isNumber(event)">
						  <input type="text" class="form-control xyz" name="accommval_hid" id="accommval_hid" value="<?php echo $allPspIncome->ActualComP ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control" name="bankid" id="bankid" value="<?php echo $allPspIncome->BankId ?>" />
                          <input type="text" class="form-control" name="bank_hid" id="bank_hid" value="<?php echo $allPspIncome->BankName ?>" />
                          <input type="hidden" class="form-control" name="bank" id="bank" value="<?php echo $allPspIncome->BankName ?>" />
                        </div>
                      </div>
                    </div>
					   <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Description</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description" value="" style="height: 44px;"><?php echo $allPspIncome->Description ?></textarea>
                        </div>
                      </div>
                    </div>
              
                     <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control" name="plcurr" id="plcurr" value="<?php echo $allPspIncome->Currency; ?>" >
                          <input type="text" class="form-control" name="plcurr_hid" id="plcurr_hid" value="<?php echo $allPspIncome->Currency; ?>" >
                         
                        </div>
                      </div>
                    </div>
                    
                    
                 
                    
                  <!--planned info starts -->
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Planned Information</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12"> Received date <span class="red">*</span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <!-- <?php if ($allPspIncome->isCRR == 0 && $allPspIncome->CRRId != 0) { ?>
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ExpDate))) ?>" />
                            <?php }else{ ?>
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualDate))) ?>" />
                            <?php } ?> -->
                            <?php if($allPspIncome->isCRR == 0 && $allPspIncome->CRRId == 0 && $allPspIncome->ExpDate != '0000-00-00'){ ?>
                              <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ExpDate))) ?>" />
                              <?php }elseif($allPspIncome->isCRR == 1 && $allPspIncome->CRRId == 0 && $allPspIncome->ExpDate != '0000-00-00'){ ?>
                                <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ExpDate))) ?>" />
                              <?php }else{ ?>
                                <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ExpDate))) ?>" />
                              <?php } ?>
                            
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plamtval" id="plamtval" value="<?php echo $allPspIncome->PlannedCom ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12"> Processed Amount <!-- <span class="red">*</span> --></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="plamtReceived" id="plamtReceived" value="<?php echo $allPspIncome->PlannedAmt ?>" onkeypress="javascript:return isNumber(event)" placeholder="Planned Processed Amount"  />
                        </div>
                      </div>
                    </div>
                  
                   
                    

                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12 xyz">
                          <input type="text" class="form-control" name="plnetAmt" id="plnetAmt" placeholder="Planned Net Amount" value="<?php echo $allPspIncome->PlannedNetAmt ?>" />
                        </div>
                      </div>
                    </div>
					<div class="clearfix"></div>
					<div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Document Upload</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
						<?php if($allPspIncome->DocumentPath){ ?>
							<input disabled name="upload_file" value="<?php echo $allPspIncome->DocumentPath?>" id="upload_file" class="file">

						 <div class="input-group col-xs-12">
							<a download href="/upload_document/<?php echo $allPspIncome->DocumentPath?>" title="Download Document" class="btn btn-transparent text-blue"><i class="fa  fa-cloud-download"></i> </a>
							
							<a  href="/upload_document/<?php echo $allPspIncome->DocumentPath?>" target="_blank" title="view Document" class="btn btn-transparent text-blue"><i class="fa fa-eye"></i> </a>
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
                  <!-- Actual info starts -->
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
					<div class="col-md-10 col-sm-12 col-xs-12 text-center">
                      <h4>Actual Information</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Received date</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date">
                            <!-- <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualDate))) ?>" /> -->
                            <!-- <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualDate))) ?>" /> -->
                            <!-- <?php if ($allPspIncome->isCRR == 0 && $allPspIncome->CRRId != 0 ) { ?>
                              <?php if($allPspIncome->ActualDate != '0000-00-00'){ ?>
                                <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo '1'; ?>" />
                              <?php }else { ?>
                                <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo '2'; ?>" />
                              <?php }?>
                            <?php }elseif($allPspIncome->isCRR == 1 && $allPspIncome->CRRId == 0) {?>
                              <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo '3';?> ?>" />
                            <?php }elseif ($allPspIncome->isCRR == 0 && $allPspIncome->CRRId == 0) { ?>
                              <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo '5';?>" />
                            <?php }else{?>
                            <input type="text" class="form-control" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo '4';?>" />
                            <?php } ?> -->
                            <?php if ($allPspIncome->isCRR == 0 && $allPspIncome->CRRId == 0 && $allPspIncome->ActualDate == '0000-00-00') { ?>
                              <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php //echo '1'; ?>" />
                           <?php }elseif ($allPspIncome->isCRR == 0 && $allPspIncome->CRRId > 0 && $allPspIncome->ActualDate == '0000-00-00') { ?>
                             <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php //echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualDate))) ?>" />
                           <?php }elseif ($allPspIncome->isCRR == 1 && $allPspIncome->CRRId == 0 && $allPspIncome->ActualDate == '0000-00-00') { ?>
                            <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php //echo '1'; ?>" />
                           <?php }else { ?>
                               <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" placeholder="Actual Received Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualDate))) ?>" />
                           <?php }?>

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
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Processed Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="acamtReceive" id="acamtReceive" value="<?php echo $allPspIncome->ActualAmt ?>" onkeypress="javascript:return isNumber(event)" placeholder="Actual Processed Amount"  />
                          
                        </div>
                      </div>
                    </div>
            
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Commission Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="acamtval" id="acamtval" value="<?php echo $allPspIncome->ActualCom ?>"  onkeypress="javascript:return isNumber(event)">
						   <input type="text" class="form-control xyz" name="acamtval_hid" id="acamtval_hid" value="<?php echo $allPspIncome->ActualCom ?>" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Additional Fees</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="additionalFees" id="additionalFees" value="<?php echo $allPspIncome->AdditionalFees; ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
              
                   <?php if ($crrSet == "set") { ?>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="crr">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Rolling Reserved Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" name="crrComm" id="crrComm">
                             <input type="text" class="form-control xyz" name="crrAmt" id="crrAmt" value="<?php echo $crrData->PlannedAmt;; ?>" placeholder="CRR Amount"/>
                         
                          
                        </div>
                      </div>
                    </div>
                   <?php  }elseif ($allPspIncome->isCRR == 1 && $allPspIncome->CRRId == 0) { ?>
                     <div class="col-md-12 col-sm-12 col-xs-12" id="crr">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Rolling Reserved Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" name="crrComm" id="crrComm">
                             <input type="text" class="form-control xyz" name="crrAmt" id="crrAmt" value="<?php //echo $allPspIncome->PlannedAmt; ?>" placeholder="CRR Amount">
                          
                        </div>
                      </div>
                    </div>
                   <?php } ?>
                   <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank Commission</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
						<input type="hidden" class="form-control xyz" name="bankcommP" id="bankcommP" onkeypress="javascript:return isNumber(event)">
                          <input type="text"  class="form-control xyz" name="bankcomm_hid" id="bankcomm_hid" value="<?php echo $allPspIncome->BankCom ?>" >			
                        <input type="hidden"  class="form-control xyz" name="bankcomm" id="bankcomm" value="<?php echo $allPspIncome->BankCom ?>" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net To Bank Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="nettoBankAmt" id="nettoBankAmt" value="<?php echo $allPspIncome->NetBankAmt ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    
                      <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Processed Start Date</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">

                            <?php if (($allPspIncome->ActualProcessedStartDate== '0000-00-00')||($allPspIncome->ActualProcessedStartDate== '')) { ?>
                            <input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" name="acproccessed_startdate" id="acproccessed_startdate" placeholder="Start Date" value="" />
                           <?php }else { ?>
                               <input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" name="acproccessed_startdate" id="acproccessed_startdate" placeholder="Start Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualProcessedStartDate))) ?>" />
                           <?php }?>                           
                            
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          
                                                       </div>
                        </div>
         
                      </div>
                    </div>
                    
                    
                                          <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Processed End Date</label>

                          <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                           
                           <?php if (($allPspIncome->ActualProcessedEndDate== '0000-00-00')||($allPspIncome->ActualProcessedEndDate== '')) { ?>
                            <input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" name="acproccessed_enddate" id="acproccessed_enddate" placeholder="End Date" value="" />
                           <?php }else { ?>
                               <input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" name="acproccessed_enddate" id="acproccessed_enddate" placeholder="End Date" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $allPspIncome->ActualProcessedEndDate))) ?>" />
                           <?php }?> 
                           
                             <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
				
					<div class="clearfix"></div>
                  <!--Actual info ends -->
                    <div class="col-xs-12 text-center spacetop2x">
                  <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                  <button type="submit" id="editPspIncome" class="btn-submit transitions">Submit</button>
                  <a href="<?= base_url('psp_income');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a>
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
<script type="text/javascript">
  $(document).ready(function(){
	$('#crrAmt').attr('disabled',true);
    $('#psp').attr('disabled',true);
	$('#accommval_hid').attr('disabled',true);
	$('#bank_hid').attr('disabled',true);
	$('#plcurr_hid').attr('disabled',true);
	$('#acamtval_hid').attr('disabled',true);
	$('#bankcomm_hid').attr('disabled',true);


    var pldatereceive = $("#pldatereceive").val();
    var acdatereceive = $("#acdatereceive").val();
    //alert(acdatereceive);
    //var end = $("#pldatereceive").val();
    $('#pldatereceive').datepicker({
    format: "d/mm/yyyy",
    todayHighlight: true,
    startDate: pldatereceive,
    //maxDate: 0,
    //endDate: end,
    autoclose: true
      });

if(document.getElementById("myCheck").checked == true){
			var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
			var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
			var crrAmt = (crrComm/100);                                    
			var crrAmt = Number(actualAmt*crrAmt).toFixed(2);
			$("#crrAmt").val(crrAmt);      
	console.log('actualAmt->'+actualAmt);		
	console.log('crrComm->'+crrComm);		
	console.log('crrAmt->'+crrAmt);		
	console.log('additionalfees->'+additionalfees);
}else if(document.getElementById("myCheck").checked == false){
if ($("#acamtReceive").val() == 0.00) {
    if (($("#crrVal").val() == 0) && ($("#crrVAlId").val() == 0)) {
	//Not CRR record and Actual amount is zero
      $( "#acamtReceive" ).keyup(function( event ) {
        var pspid=document.getElementById("psp").value;  
         $.ajax({
                url:"<?php echo base_url ('Psp_income/getBanks/')?>"+ pspid ,
                    type: "POST",
                    data : {pspid:pspid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    //console.log(obj.getpsp);
                    $("#bank").val(obj.getpsp.BankName);
                    $("#bank_hid").val(obj.getpsp.BankName);
                    $("#bankid").val(obj.getpsp.BankId);
                    $("#plcurr").val(obj.getpsp.CurName);
                    $("#plcurr_hid").val(obj.getpsp.CurName);
                    $("#accurr").val(obj.getpsp.CurName);
                    $("#accommP").val(obj.getpsp.Commission);
                    var commAmount = $("#accommP").val();
                    var commAmount = commAmount;
                    $("#bankcommP").val(obj.getpsp.InComP);
					
                    $("#accommval").val(commAmount);
                    $("#accommval_hid").val(commAmount);


                    var additionalfees = $("#additionalFees").val();
                    if (additionalfees != "") {
                      var fees = additionalfees;
                    }else{
                      var fees = 0;
                    }

                    //net to bank amount calculation start
                    var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
                    var accommP = $("#accommval").val();                          //PSP Commission 
                    var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
                    //var commAmount = ("#acamtval").val();

                    var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

                    var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

                    var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees);
                    var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);

                    var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)).toFixed(2);  
                    $("#bankcomm").val(bankcomm2);
                    $("#bankcomm_hid").val(bankcomm2);
					
                    $("#acamtval").val(commAmount);
                    $("#acamtval_hid").val(commAmount);
					
                    $("#nettoBankAmt").val(netToBank);

                    
                    //net to bank amount calculation end
                   }
               });
       });
      $( "#additionalFees" ).keyup(function( event ) { 
      var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
     /* var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
      var crrAmt = (crrComm/100);                                    
      var crrAmt = Number(actualAmt*crrAmt).toFixed(2);*/
      var additionalfees = document.getElementById("additionalFees").value;

      if (additionalfees != "") {
        var fees = additionalfees;
      }else{
        var fees = 0;
      }



      //net to bank amount calculation start
      var accommP = $("#accommval").val();                          //PSP Commission 
      var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
      //var commAmount = ("#acamtval").val();

      var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

      var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

      var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees);
      var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);

      var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)).toFixed(2);  
      $("#bankcomm").val(bankcomm2);
      $("#bankcomm_hid").val(bankcomm2);
      $("#acamtval").val(commAmount);
      $("#acamtval_hid").val(commAmount);
      $("#nettoBankAmt").val(netToBank);

      /*console.log('commission %' +  accommP);
      console.log('bankcommP %' +  bankcommP);

      console.log('Bank commission' +  bankcomm);
      console.log('commission Amount' +  commAmount);

      console.log('Net To Bank' +  netToBank);*/
      //net to bank amount calculation end
    });
    }else if(($("#crrVal").val() == 0) && ($("#crrVAlId").val() != 0)){        //CRR record and Actual amount is zero 
	
      $( "#acamtReceive" ).keyup(function( event ) {
        $("#accommval").attr('disabled',true);
        $("#acamtval").attr('disabled',true);
        var pspid=document.getElementById("psp").value;  
        //alert(pspid);
         $.ajax({
                url:"<?php echo base_url ('Psp_income/getBanks/')?>"+ pspid ,
                    type: "POST",
                    data : {pspid:pspid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    //console.log(obj.getpsp);
                    $("#bank").val(obj.getpsp.BankName);
                    $("#bank_hid").val(obj.getpsp.BankName);
                    $("#bankid").val(obj.getpsp.BankId);
                    $("#plcurr").val(obj.getpsp.CurName);
                    $("#plcurr_hid").val(obj.getpsp.CurName);
                    $("#accurr").val(obj.getpsp.CurName);
                    $("#accommP").val(obj.getpsp.Commission);
                    var commAmount = $("#accommP").val();
                    var commAmount = commAmount;
                    $("#bankcommP").val(obj.getpsp.InComP);
                    //$("#accommval").val(commAmount);
                    
                    var additionalfees = $("#additionalFees").val();
                    if (additionalfees != "") {
                      var fees = additionalfees;
                    }else{
                      var fees = 0;
                    }

                    //net to bank amount calculation start
                    var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
                    //var accommP = $("#accommval").val();                          //PSP Commission 
                    var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
                    //var commAmount = ("#acamtval").val();

                    var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

                    //var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

                    var bankcomm1 = parseInt(actualAmt)-parseInt(fees);
                    var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);

                    var netToBank = Number(parseInt(actualAmt)-parseInt(bankcomm2)-parseInt(fees)).toFixed(2);  
                    $("#bankcomm").val(bankcomm2);
                    $("#bankcomm_hid").val(bankcomm2);
					$("#nettoBankAmt").val(netToBank);

                  
                   }
               });
      });
      $( "#additionalFees" ).keyup(function( event ) { 
      var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
     /* var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
      var crrAmt = (crrComm/100);                                    
      var crrAmt = Number(actualAmt*crrAmt).toFixed(2);*/
      var additionalfees = document.getElementById("additionalFees").value;

      if (additionalfees != "") {
        var fees = additionalfees;
      }else{
        var fees = 0;
      }



      //net to bank amount calculation start
      var accommP = $("#accommval").val();                          //PSP Commission 
      var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
      //var commAmount = ("#acamtval").val();

      var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

      var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

      var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees);
      var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);

      

      var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)).toFixed(2);  
      $("#bankcomm").val(bankcomm2);
      $("#bankcomm_hid").val(bankcomm2);
      $("#acamtval").val(commAmount);
      $("#acamtval_hid").val(commAmount);
      $("#nettoBankAmt").val(netToBank);

      /*console.log('commission %' +  accommP);
      console.log('bankcommP %' +  bankcommP);

      console.log('Bank commission' +  bankcomm);
      console.log('commission Amount' +  commAmount);

      console.log('Net To Bank' +  netToBank);*/
      //net to bank amount calculation end
    });
    }else if(($("#crrVal").val() == 1) && ($("#crrVAlId").val() == 0)){
		
    $( "#acamtReceive" ).keyup(function( event ) { 
      var pspid=document.getElementById("psp").value;  
        $.ajax({
                url:"<?php echo base_url ('Psp_income/getBanks/')?>"+ pspid ,
                    type: "POST",
                    data : {pspid:pspid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.getpsp);
                    $("#bankcommP").val(obj.getpsp.InComP);
                    $("#accommval").val(obj.getpsp.Commission);
                    $("#accommval_hid").val(obj.getpsp.Commission);
					
                    if (obj.getpsp.Crr > 0.00) {
                      $("#crr").show();
                    $("#crrComm").val(obj.getpsp.Crr);
                    $("#crrValue").val(obj.getpsp.Crr);
                    }else{
                      $("#crr").hide();
                    }
                   }
               });
      var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
      var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
      //alert(crrComm);
      var crrAmt = (crrComm/100);                                    
      var crrAmt = Number(actualAmt*crrAmt).toFixed(2);

      var additionalfees = document.getElementById("additionalFees").value;

      if (additionalfees != "") {
        var fees = additionalfees;
      }else{
        var fees = 0;
      }
      //alert(crrAmt);
      $("#crrAmt").val(crrAmt);                                      //CRR Amount
      /*console.log('actualAmt' + actualAmt);
      console.log('crrComm' + crrComm);
      console.log('crrAmt' + crrAmt);*/
      //alert(actualAmt);



      //net to bank amount calculation start
      var accommP = $("#accommval").val();                          //PSP Commission 
      var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
      var rolingReserved = $("#crrAmt").val();
      //console.log('rolingReserved' + rolingReserved);
      //var commAmount = ("#acamtval").val();

      var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);
      
      var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

      var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees)-parseInt(rolingReserved);
      var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);
      //console.log('bankcomm1  ' + bankcomm1);

      var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)-parseInt(rolingReserved)).toFixed(2); 
      //console.log('Net To Bank' +  netToBank);
      $("#bankcomm").val(bankcomm2);
	   $("#bankcomm_hid").val(bankcomm2);
      $("#acamtval").val(commAmount);
      $("#acamtval_hid").val(commAmount);
      $("#nettoBankAmt").val(netToBank);

     
    });
	
    $( "#additionalFees" ).keyup(function( event ) { 
      var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");   //actual process amount
      var crrComm = document.getElementById("crrComm").value;        // CRR Commission %
      //alert(crrComm);
      var crrAmt = (crrComm/100);                                    
      var crrAmt = Number(actualAmt*crrAmt).toFixed(2);
      var additionalfees = document.getElementById("additionalFees").value;

      if (additionalfees != "") {
        var fees = additionalfees;
      }else{
        var fees = 0;
      }


      //alert(crrAmt);
      $("#crrAmt").val(crrAmt);                                      //CRR Amount
      console.log('actualAmt' + actualAmt);
      console.log('crrComm' + crrComm);
      console.log('crrAmt' + crrAmt);
      //alert(actualAmt);



      //net to bank amount calculation start
      var accommP = $("#accommval").val();                          //PSP Commission 
      var bankcommP = $("#bankcommP").val();                        //BAnk Inflow Commission
      var rolingReserved = $("#crrAmt").val();
      //var commAmount = ("#acamtval").val();

      var bankcomm = Number(actualAmt*(bankcommP/100)).toFixed(2);

      var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

      var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees)-parseInt(rolingReserved);
      var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);
      

      var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)-parseInt(fees)-parseInt(rolingReserved)).toFixed(2);  
      $("#bankcomm").val(bankcomm2);
      $("#bankcomm_hid").val(bankcomm2);
	  
      $("#acamtval").val(commAmount);
	  $("#acamtval_hid").val(commAmount);
      $("#nettoBankAmt").val(netToBank);
    });
	}
}else{
  //alert("4");
}

}
      
    
  });


</script>
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
                    //console.log(obj.getpsp);
                    $("#bank").val(obj.getpsp.BankName);
                    $("#bank_hid").val(obj.getpsp.BankName);
					
                    $("#bankid").val(obj.getpsp.BankId);
                    $("#plcurr").val(obj.getpsp.CurName);
                    $("#plcurr_hid").val(obj.getpsp.CurName);
					
                    $("#accurr").val(obj.getpsp.CurName);
                    $("#accommP").val(obj.getpsp.Commission);
                    var commAmount = $("#accommP").val();
                    var commAmount = commAmount;
                    $("#bankcommP").val(obj.getpsp.InComP);
                    $("#accommval").val(commAmount);
                    $("#accommval_hid").val(commAmount);
					
                    if (obj.getpsp.Crr > 0) {
                      $("#crr").show();
                    $("#crrComm").val(obj.getpsp.Crr);
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

                    var bankcomm = (actualAmt*(bankcommP/100));

                    var commAmount = Number(actualAmt*(accommP/100)).toFixed(2);

                    var bankcomm1 = parseInt(actualAmt)-parseInt(commAmount)-parseInt(fees);
                    var bankcomm2 = Number((bankcommP/100)*bankcomm1).toFixed(2);

                    var netToBank = Number(parseInt(actualAmt)-parseInt(commAmount)-parseInt(bankcomm2)).toFixed(2); ;
                    $("#bankcomm").val(bankcomm2);
                    $("#bankcomm_hid").val(bankcomm2);
                    $("#acamtval").val(commAmount);
					$("#acamtval_hid").val(commAmount);
                    $("#nettoBankAmt").val(netToBank);
                    //net to bank amount calculation end
                   }
               });

    });

    /*$('#plcurr').on('change',function() {
      var plcurr = document.getElementById("plcurr").value;
      $("#accurr").val(plcurr);
    });*/

    $( "#acamtReceive" ).keyup(function( event ) { 
      if ($("#crrAmt").attr('readonly',true)) {
           //var crrAmt = document.getElementById("crrAmt").value;
           //$("#crrAmt").val(crrAmt);
      }else{
        var actualAmt = $("#acamtReceive").val().replace(/,/gi, "");
      var crrComm = document.getElementById("crrComm").value;
      //alert(crrComm);
      var crrAmt = (crrComm/100); 
      var crrAmt = Number(actualAmt*crrAmt).toFixed(2); 
      //alert(crrAmt);
      $("#crrAmt").val(crrAmt);
      //alert(actualAmt);
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
			}else{
				$(this).css("border", "1px solid #CCCCCC"); 
			}
		})
		//--------------------//
		
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
 
	   $('#bank_hid').on('blur', function() {
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
 
      $("#editPspIncome").click(function(){
		 
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
          var actualAmt = $("#acamtReceive").val();
          var actualDate = $("#acdatereceive").val();
          if (actualAmt == 0.00) {
            $("#acdatereceive").css("border", "1px solid #CCCCCC");  
            returnvar = true;
          }else if(actualAmt != 0.00 && actualDate == ""){
            $("#acdatereceive").css("border", "1px solid #be1622");
            returnvar = false;
          }
          if(returnvar == true){
            //alert(returnvar);
            $('#psp').attr('disabled',false);
			$('#crrAmt').attr('disabled',false);
			$("#bankcomm").val($("#bankcomm_hid").val());
			$("#acamtval").val($("#acamtval_hid").val());
            $("#editPspIncome").hide();
            $(".page-loader").show();
     } 
     return returnvar;
      });
    })(jQuery);
</script> 

