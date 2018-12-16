<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<div id="content">
  <div class="container-fluid">
    <h1>Vendors</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Vendor</a></div>
		</div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table id="tablevendor" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Vendor Name</th>
                 <!-- <th>Category</th>-->
                  <th>Invoice</th>
                  <th>Status</th>
			  <th>Action</th>
                </tr>
              </thead>
              <tbody> 
			  <?php foreach ($vendors as $vendor) { ?>
                <tr>
                  <td><?php echo  $vendor->VendorName; ?></td>
                <!--      <td><?php // echo  $vendor->Category; ?></td>-->
                     <td><?php echo  $vendor->InvoiceType; ?></td>
				<td><?php if($vendor->Active == "1" ){ echo '<span class="completed bold">Active</span>' ; }else{ echo  '<span class="pending bold">Disabled</span>' ;} ?></td>
                   <td><a class="grey-icon edit_user" href="<?= base_url('configuration/vendors/update/'.$vendor->VendorId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
			  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
	
<!-- Button trigger modal --> 
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
                <form class="form-horizontal clearfix" action="<?php echo base_url ('configuration/vendors/createVendor/')?>" id="addvendor" method="post" autocomplete="off">
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
                           <?php foreach ($currency as $curr) {
                             ?>
                           <option value="<?php echo $curr->CurId; ?>"><?php echo $curr->CurName; ?></option>      
                                  <?php   } ?>
                          </select> 
                        </div>
                      </div>
                    </div>  
						<div class="col-md-12 col-sm-12 col-xs-12">
						     <div class="form-group">
								<label class="col-md-6 col-sm-6 col-xs-12">Status</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
					                <select class="form-control" name="Status" id="Status">
									<option value="1">Active</option>      
									<option value="0">Disabled</option>      
								</select>
								</div>
							</div>
						</div>
					  </div>
					</div>
					<div class="col-xs-12 text-center spacetop4x">
					<div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
					  <button type="submit" id="vendor-submit" class="btn-submit transitions">Submit</button>
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
       <!--edit user modal starts  -->
      <div class="modal common-modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Edit Users</h2>
            </div>
            <div class="modal-body">
              
            </div>
          </div>
        </div>
      </div>
      <!--edit user modal ends  -->
    </div>
  </div>
  <!-- Modal -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
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
  });
</script>
<script type="text/javascript">
  (function($){

      $('#Vname').on('blur', function() {
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
            

     }  
     return returnvar;
      });
})(jQuery);
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#BankId').on('change',function() {
        var BankId = document.getElementById("BankId").value;  
         $.ajax({
                url:"<?php echo base_url ('configuration/vendors/curr/')?>"+ BankId ,
                    type: "POST",
                    data : {BankId:BankId},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.currency.CurName);
                    var cur = $("#Curr").val(obj.currency.CurName);
                    //alert(obj.currency.CurName);
                    //$('select[name="Currency"] option[value=obj.currency.CurName').attr("selected","selected");
                    //document.getElementById('Currency').value = obj.currency.CurName;
                    //$("#Currency").val("United State");
                    //$('select[name^="Currency"] option[value="Bruce Jones"]').attr("selected","selected");
                    //$('#counCurrencytry').val('aaaa');
                    //$("#Currency").val(0);
                    //$('select option[value=cur]').attr("selected",true);
                    //setSelectedIndex(document.getElementById("Currency"),cur);
                   // $('select option[value="1"]').attr("selected",true);

                   }
               });

    });
    
  });
</script>

