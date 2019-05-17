<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<?php 
  if (isset($callCenter)) {
    $isSet = $callCenter->NotificationId;
  }else{
    $isSet = "";
  }
  //print_r($_SESSION);
 ?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid"> 
    <!-- <h1>PSP Income</h1> -->
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12"> 
          <!-- <div class="middle-section light-blue-box spacebottom2x clearfix"> -->
          <h2 class="modal-title">ADD Expense</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="expenses" method="post" enctype="multipart/form-data" >
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['token_expense']))
                  {
                    unset($_SESSION['token_expense']);
                  }
                  $_SESSION['token_expense'] = $token;
                ?>
              <input type="hidden" name="expense_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <input type="hidden" name="shareAmount" id="shareAmount">
              <input type="hidden" name="BankOutCommAmount" id="BankOutCommAmount">
              <input type="hidden" name="TransferCommAmount" id="TransferCommAmount">
              <input type="hidden" name="callCenterNotiId" id="callCenterNotiId" value="<?php echo $isSet ?>">
              <div class="row clearfix spacetop3x spacebottom2x">
                <div class="clearfix row-flex">
                  <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Gerneral Information</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Vendor</label>
                        <div class="col-md-1 col-sm-1" id="tooltip"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i><span class="tooltiptext">Add New Vendor</span></span></a></div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control vendor" name="vendor" id="vendor" onchange="">
                            <?php  if(!empty($vendors_first)){
							 foreach ($vendors as $vendor) { ?>
                            <option <?php if($vendor->VendorId== $vendors_first->VendorId){ echo 'selected="selected"'; } ?> value="<?php echo $vendor->VendorId; ?>"><?php echo $vendor->VendorName; ?></option>
                            <?php }  }else{ ?>
                            <option selected="" value="">Select Vendor</option>
                            <?php foreach ($vendors as $vendor) { ?>
                            <option value="<?php echo $vendor->VendorId; ?>"><?php echo $vendor->VendorName; ?></option>
                            <?php   } }?>
                          </select>
                        </div>
                      </div>
                    </div>
					 <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Expense Category</label>
                        <div class="col-md-7 col-sm-7 col-xs-12"> 
                          <!-- <input type="hidden" name="transferAmt" id="transferAmt"> -->
                          <select class="form-control" name="expCat" id="expCat" onchange="">
                            <option selected="" value="">Select Expense Category</option>
                            <?php foreach ($expCat as $cat) { ?>
                            <option value="<?php echo $cat->CatId; ?>"><?php echo $cat->Category; ?></option>
                            <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank</label>
                        <div class="col-md-7 col-sm-7 col-xs-12"> 
                          <!-- <input type="hidden" class="form-control" name="bankid" id="bankid" />
                          <input type="text" class="form-control" name="bank" id="bank" readonly/> -->
                          <select class="form-control" name="bankid" id="bankid" onchange="">
                            <option selected="" value="">Select Bank</option>
                            <?php foreach ($banks as $bank) { ?>
                            <option value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>
                            <?php   } ?>
                          </select>
                          <input type="hidden" class="form-control" name="outCommP" id="outCommP" />
                        </div>
                      </div>
                    </div>
					<div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Description</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <?php if(!empty($isSet)){ 
                            $des = array();
                            $this->db->select('NotificationId,VendorId,CallCenterExpId,PlannedDate');
                            $this->db->from('callcenternotification');
                            $this->db->where('NotificationId',$isSet);
                            $query = $this->db->get();
                            $res = $query->row();
                            $res = explode(',', $res->CallCenterExpId);
                            
                             $first = reset($res);
                             $last = end($res);

                             $data['first'] = $first;
                             $data['last'] = $last;
                            foreach ($data as $value) {
                            $this->db->select('ExpId,ExpName,ExpAmount,ExpDate,ExpenseId');
                            $this->db->from('callcenterexpenses');
                            $this->db->where('ExpId',$value);
                            $query1 = $this->db->get();
                            $res1 = $query1->result();
                            foreach ($res1 as  $val) {
                              $des[] = date('d/m/Y', strtotime(str_replace('-','/', $val->ExpDate)));
                            }
                            }
                            if (count($res) > 0 && count($res) == 1) {
                              $desc = 'Invoice Date - ' .$des[0];
                            }else{
                              $desc = 'First Invoice Date - ' .$des[0] . ' Last Invoice Date - ' .$des[1] ;
                            }
                            
                           ?>
                          <textarea class="form-control" name="desc" id="desc" rows="2" placeholder="Description" ><?php echo $desc ?></textarea>
                          <?php }else{ ?>
                          <textarea class="form-control" name="desc" id="desc" placeholder="Description" ></textarea>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="plcurr" id="plcurr" readonly>
                        </div>
                      </div>
                    </div>
                    
                   
                    <!--planned info starts -->
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <h4>Planned Information</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Planned date <span class="red">*</span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <?php if (!empty($callCenter)) { ?>
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" value="<?php echo date('d/m/Y', strtotime(str_replace('-','/', $callCenter->PlannedDate))) ?>" placeholder="Planned Date" />
                            <?php }else{ ?>
                            <input type="text" class="form-control" name="pldatereceive" id="pldatereceive" placeholder="Planned Date" />
                            <?php  } ?>
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group align-4x-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Planned Amount <span class="red">*</span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <?php if (!empty($callCenter)) { ?>
                          <input type="text" class="form-control xyz" name="plamtReceived" id="plamtReceived" value="<?php echo $callCenter->Amount ?>" onkeypress="javascript:return isNumber(event)" placeholder="Planned Amount" />
                          <?php }else { ?>
                          <input type="text" class="form-control xyz" name="plamtReceived" id="plamtReceived" onkeypress="javascript:return isNumber(event)" placeholder="Planned Amount" />
                          <?php } ?>
                        </div>
                      </div>
                    </div>
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
                            <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-end-date="0d" name="acdatereceive" id="acdatereceive" placeholder="Actual Date" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Actual Amount</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="acamtReceive" id="acamtReceive" onkeypress="javascript:return isNumber(event)" placeholder="Actual Amount" />
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" name="accurr" id="accurr" readonly>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Transfer Type</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="transType" id="transType" onchange="">
                            <option selected="" value="">Select Transfer Type</option>
                            <?php foreach ($transType as $type) { ?>
                            <option value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>
                            <?php   } ?>
                          </select>
                          <input type="hidden" class="form-control" name="transferCommP" id="transferCommP">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Share %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="shareP" id="shareP" placeholder="Share %" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Final bank commission </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="fbc" id="fbc" placeholder="Final Bank Commission" readonly/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Net From Bank </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="nfb" id="nfb" placeholder="Net From Bank"  />
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
                    <button type="submit" id="addExpense" class="btn-submit transitions">Submit</button>
                    <!-- <button type="reset" class="btn-reset transitions">Reset</button> --> 
                    <a href="<?= base_url('expenses');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a> 
				</div>
                  <!-- </div> --> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal common-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content clearfix">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Add New Vendor</h2>
          </div>
          <div class="modal-body clearfix">
            <div class="defination-box clearfix">
              <form class="form-horizontal clearfix"  id="addvendor" method="post" autocomplete="off">
                <?= form_open()?>
                <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['vendor_details']))
                    {
                     unset($_SESSION['vendor_details']);
                   }
                   $_SESSION['vendor_details'] = $token;
                   ?>
                <input type="hidden" name="vendor_details" value="<?php echo $token;?>">
                <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
                <div class="row clearfix spacetop4x">
                  <div class="clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Vendor Name</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="Vname" id="Vname" placeholder="Vendor Name" />
                          </div>
                        </div>
                      </div>
                      <!--	<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Category</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <select class="form-control" name="ExpCatID" id="ExpCatID" onchange="">
								<option selected="" value="">Select Expense Category</option>
								  <?php// foreach ($categories as $category) { ?>
								<option value="<?php //echo $category->CatId; ?> "><?php // $category->Category; ?></option>
								  <?php //} ?>
							  </select>
							</div>
						  </div>
						</div> -->
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Invoice Frequency</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="InvoiceType" id="InvoiceType" onchange="">
                              <option selected="" value="">Select Frequency</option>
                              <option value="Weekly">Weekly</option>
                              <option value="Monthly">Monthly</option>
                              <option value ="Quarterly">Quarterly</option>
                              <option value="Yearly">Yearly</option>
                              <option value="PerTransaction">Per Transaction</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="weekly" style="display: none;">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Reminder On</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="weekly_reminder" id="weekly_reminder" onchange="">
                              <option selected="" value="">Select Days</option>
                              <option value="Sunday">Sunday</option>
                              <option value="Monday">Monday</option>
                              <option value="Tuesday">Tuesday</option>
                              <option value="Wednesday">Wednesday</option>
                              <option value="Thursday">Thursday</option>
                              <option value="Friday">Friday</option>
                              <option value="Saturday">Saturday</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="monthly" style="display: none;">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Reminder On</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group date" data-provide="datepicker">
                              <input type="text" class="form-control" name="monthly_reminder" id="monthly_reminder" />
                              <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="quartely" style="display: none;">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Reminder On</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group date" data-provide="datepicker">
                              <input type="text" class="form-control" name="quartely_reminder" id="quartely_reminder" />
                              <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Invoice Date</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group date" data-provide="datepicker">
                              <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" />
                              <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Comments</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="Comments"  id="Comments" placeholder="Comments" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box"> 
                      
                      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <select class="form-control" name="BankId" id="BankId" onchange="">
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
                          <label class="col-md-6 col-sm-6 col-xs-12">Currency</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" class="form-control" name="Curr" id="Curr" />
                            <!--  <input type="text" class="form-control" name="Currency" id="Currency"> -->
                            <select class="form-control" name="Currency" id="Currency" >
                              <!-- <option selected="" value="" id="val"></option> -->
                              <option selected="" value="">Select Currency</option>
                              <?php foreach ($currency as $curr) {
                             ?>
                              <option value="<?php echo $curr->CurId; ?>"><?php echo $curr->CurName; ?></option>
                              <?php   } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!--BANK--->
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Bank</label>
                          <div class="col-md-6 col-sm-6 col-xs-12"> 
                            <!--  <input type="text" class="form-control" name="Currency" id="Currency"> -->
                            <select class="form-control" name="bank" id="bank" >
                              <!-- <option selected="" value="" id="val"></option> -->
                              <option selected="" value="">Select Bank</option>
                              <?php foreach ($banks as $bank) {
                             ?>
                              <option value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>
                              <?php   } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Bank Addess</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="bank_add"  id="bank_add" placeholder="Bank Addess" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">IBAN</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="iban"  id="iban" placeholder="IBAN" />
                          </div>
                        </div>
                      </div>
                      <!-- END -->
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Status</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="Status" id="Status">
                              <!-- <option selected="" value="">Select Status</option> -->
                              <option value="1">Active</option>
                              <option value="0">Disabled</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 checkbox">
                            <label>
                              <input type="checkbox" name="callcenter" id="callcenter">
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span> <span class="acceptance">Call Center</span> </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="show1" style="display: none;">
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Call Center Location</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="callcenterLocation" id="callcenterLocation" placeholder="Call Center Location">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Call Center Manager</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="callcenterManager" id="callcenterManager" placeholder="Call Center Manager">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-6 col-sm-6 col-xs-12">Call Center Cash Balance</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control xyz" name="callcenterCashBAl" id="callcenterCashBAl" placeholder="Call Center Cash Balance">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="show3" style="display: none;">
                        <div class="form-group"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 text-center spacetop4x">
                    <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>
                    <button type="button" id="vendor-submit" class="btn-submit transitions">Submit</button>
                    <button type="reset" class="btn-reset transitions">Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--modal end---> 
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
<script>
  jQuery(document).ready(function ($) {
      var today = new Date();
$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });
  });
  
</script> 
<script type="text/javascript">
  $(document).ready(function(){
    //vendor start//
	
	
	 $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $("#show1").show();
                $("#show2").show();
                $("#show3").show();
            }
            else if($(this).prop("checked") == false){
                $("#show1").hide();
                $("#show2").hide();
                $("#show3").hide();
            }
        });
		
	   $("#weekly").hide();
    $("#InvoiceType").on('change',function(){
      var reminderValue = $("#InvoiceType").val();
      if(reminderValue == 'Weekly'){
        $("#weekly").show();
        $("#monthly").hide();
        $("#quartely").hide();
      }else if(reminderValue == 'Monthly'){
        $("#monthly").show();
        $("#weekly").hide();
        $("#quartely").hide();
      }else if(reminderValue == 'Quarterly'){
        $("#monthly").hide();
        $("#weekly").hide();
        $("#quartely").show();
      }
      else{
        $("#monthly").hide();
        $("#weekly").hide();
        $("#quartely").hide();
      }
    });
	  $("#vendor-submit").click(function(){

      var returnvar = true;
 
		  if($("#Vname").val() ==""){
           $("#Vname").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          //if($("#ExpCatID").val() ==""){
          //  $("#ExpCatID").css("border", "1px solid #be1622");
          //  returnvar = false;
         // }
          if($("#InvoiceType").val() ==""){
           $("#InvoiceType").css("border", "1px solid #be1622");
           returnvar = false;
          }
		  
		  if($("#Amount").val() ==""){
           $("#Amount").css("border", "1px solid #be1622");
           returnvar = false;
          }
        if($("#Currency").val() ==""){
         $("#Currency").css("border", "1px solid #be1622");
         returnvar = false;
        }
		   if($("#BankName").val() ==""){
           $("#BankName").css("border", "1px solid #be1622");
           returnvar = false;
          }
		   if($("#Status").val() ==""){
           $("#Status").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){  
             $("#vendor-submit").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('configuration/vendors/createVendor_Ajax/')?>",
                    type: "POST",
                    data : $("#addvendor").serialize(),
                    dataType: "html",
                   success: function(data) {
					  if(data == 'success'){
                      window.location.href = '<?php echo base_url('add-expenses') ?>';
                    }else{
                      window.location.href = '<?php echo base_url('add-expenses') ?>';
                    }
                    }
               });

     }  
      });

	//vendor end//
    //sort by albhabetical order start
    /*var options = $('select#bankid option');
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

    //sort by albhabetical order start
    /*var options1 = $('select#vendor option');
    var arr1 = options1.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr1.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    
    options1.each(function(i, o) {
        //console.log(i);
        o.value = arr1[i].v;
        $(o).text(arr1[i].t);
    });*/
    //sort by albhabetical order end


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
    /*var bankid=document.getElementById("bankid").value;
    var transType = document.getElementById("transType").value;
    console.log(transType);
    $.ajax({ 
      url:"<?php echo base_url ('Expenses/transferAmt1/')?>",
                    type: "POST",
                    data : {transType:transType,bankid:bankid},
                    dataType: "html",
                    success: function(data) {
                      var obj = JSON.parse(data);
                      console.log('transferAmt1 ' + obj.result);
                    $("#outCommP").val(obj.banks.OctComP);
                    $("#plcurr").val(obj.banks.CurName);
                    $("#accurr").val(obj.banks.CurName);
                    }

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
                    //var transferComm = (actualAmout*(transferCommP/100));
                    var transferComm = transferCommP;
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
      //alert(transType);
      $.ajax({
                url:"<?php echo base_url ('Expenses/transferAmt')?>",
                    type: "POST",
                    data : {transType:transType,bankid:bankid},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.result);
                    //$("#transferCommP").val(obj.transferAmt.Amount/100);
                    //alert(obj.transferAmt);
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
                      //var transferComm = (actualAmout*(transferCommP/100));
                      var transferComm = transferCommP;
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

    //final bank commission calculation
    /*$( "#fbc" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val();
      var fbc = $("#fbc").val();
      var netFromBank = (parseInt(actualAmout)+parseInt(fbc));
      //console.log(netFromBank);
      $("#nfb").val(netFromBank);
    });

    $( "#acamtReceive" ).keyup(function( event ) { 
      var fbc = $("#fbc").val();
      var actualAmout = $("#acamtReceive").val();
      var netFromBank = (parseInt(actualAmout)+parseInt(fbc));
      console.log(netFromBank);
      $("#nfb").val(netFromBank);
    });*/

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
      //var transferComm = (actualAmout*(transferCommP/100));
      var transferComm = transferCommP;
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
    //var TransferCommAmount = $("#TransferCommAmount").val(transferCommP/100);
    var TransferCommAmount = $("#TransferCommAmount").val(transferCommP);
    });

    $( "#shareP" ).keyup(function( event ) { 
      var actualAmout = $("#acamtReceive").val().replace(/,/gi, "");
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

      var outComm = (actualAmout*(outCommP/100));               //(1000*(10/100)) = 100
      //var transferComm = (actualAmout*(transferCommP/100));     //(1000*(5/100)) = 50
      var transferComm = transferCommP;                         // 5 
      var shareComm = (transferComm*(shareP/100));              //(5*(60/100)) = 3

      console.log('outComm' + outComm);
      console.log('transferComm' + transferComm);
      console.log('shareComm' + shareComm);
      console.log(parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));    

      var totalComm = (parseInt(outComm)+parseInt(shareComm));                         //100+3= 103
      var netAmount = (parseInt(actualAmout)+parseInt(outComm)+parseInt(shareComm));   //1000+100+3 = 1130

      $("#fbc").val(totalComm);
      $("#nfb").val(netAmount);


      /*var shareAmount = $("#shareAmount").val(shareP/100);
      var BankOutCommAmount = $("#BankOutCommAmount").val(outCommP/100);
      var TransferCommAmount = $("#TransferCommAmount").val(transferCommP/100);*/
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
      $('#bankid').on('blur', function() {
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
      $('#transType').on('blur', function() {
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
      $('#expCat').on('blur', function() {
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


      $("#addExpense").click(function(){
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
		
      if($("#vendor").val() ==""){
           $("#vendor").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#bankid").val() ==""){
           $("#bankid").css("border", "1px solid #be1622");           
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
            //alert(returnvar);
             $("#addExpense").hide();
            $(".page-loader").show();
             /* $.ajax({
                url:"<?php echo base_url ('add-expenses')?>",
                    type: "POST",
                    data : $("#expenses").serialize(),
                    dataType: "html",
                   success: function(data) {
                    console.log(data);
                    if(data == 1){
                      window.location.href = '<?php echo base_url('expenses') ?>';
                    }else{
                      window.location.href = '<?php echo base_url('expenses') ?>';
                    }
                   }
               });*/

     } 
     return returnvar;
      });
    })(jQuery);
</script> 
