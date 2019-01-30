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
				 <div class="row clearfix spacetop4x">
					<div class="clearfix">
					  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Vendor Name</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
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
							<label class="col-md-4 col-sm-4 col-xs-12">Invoice Type</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <select class="form-control" name="InvoiceType" id="InvoiceType" onchange="">
								<option selected="" value="">Select Invoice</option>
								<option value="Weekly">Weekly</option>
								<option value="Monthly">Monthly</option>
								<option value ="Quarterly">Quarterly</option>
								<option value="Yearly">Yearly</option>
							  </select>
							</div>
						  </div>
						</div>
						  <div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Amount</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <input type="text" class="form-control" name="Amount"  id="Amount" placeholder="Amount" />
							</div>
						  </div>
						</div>
					  </div>
					
					  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
					
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <select class="form-control" name="BankName" id="BankName" onchange="">
								<option selected="" value="">Select Bank</option>
								 <?php foreach ($banks as $bank) { ?>
								<option value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>      
									<?php   } ?>
							  </select>
							</div>
						  </div>
						</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label class="col-md-4 col-sm-4 col-xs-12">Comments</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
							  <input type="text" class="form-control" name="Comments"  id="Comments" placeholder="Comments" />
							</div>
						  </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
						     <div class="form-group">
								<label class="col-md-4 col-sm-4 col-xs-12">Status</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
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

