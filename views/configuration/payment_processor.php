<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
  ?>
  <!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Payment Processors</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add PSP</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table id="tabledata" class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>PSP Name</th>
                    <th>Bank Associated</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	 <?php foreach ($all_psp as $psp) { ?> 
                	<tr>
                        <td><?php echo $psp->PspName; ?></td>
                        <td><?php echo $psp->BankName; ?></td>
                        <td><?php echo date('d/m/Y', strtotime(str_replace('-','/', $psp->CreatedOn))); ?></td>
                        <td><?php echo $psp->Comments; ?></td>
				    <td><?php if($psp->Active == "1" ){ echo '<b class= "completed bold" >Active</b>' ; }else{ echo  '<b class= "pending bold" style="margin-left: 0px;">Disabled</b>' ;} ?></td>
                        <td><a class="grey-icon edit_psp" id="epsp<?php echo $psp->PspId?>" data-toggle="modal" data-target="#myModal1" data-action="<?php echo base_url('configuration/payment_processor/editpsp/')?><?php echo $psp->PspId?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
              <h2 class="modal-title">Add Payment Provider</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix" id="newpsp" method="post">
                	<?= form_open()?>
                    <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['add_psp']))
                    {
                     unset($_SESSION['add_psp']);
                   }
                   $_SESSION['add_psp'] = $token;
                   ?>
                   <input type="hidden" name="new_psp" value="<?php echo $token;?>">
                   <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
                  <div class="row clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">PSP Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="psp_name" id="psp_name" placeholder="PSP Name" />
                        </div>
                      </div>
                    </div>
<!--                     <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Date</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="date" placeholder="Date" id="date" value="<?php echo date("m/d/Y"); ?>" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Associated Bank</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" name="bank" id="bank" onchange="">
                            <option selected="" value="">Select Bank</option>
                            <?php foreach ($banks as $bank) { ?>
                            <option value="<?php echo $bank->BankId; ?>"><?php echo $bank->BankName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">PSP Type</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="psp_type" id="psp_type" placeholder="PSP Type" />
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">PSP Type</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" name="psp_type" id="psp_type" onchange="">
                            <?php foreach ($pspType as $psptype) { ?>
                            <option value="<?php echo $psptype->TypeId; ?>"><?php echo $psptype->TypeName; ?></option>            
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Payment Terms</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="payment_terms" id="payment_terms" placeholder="payment Terms" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Rolling Reserved %</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="crc" id="crc" placeholder="Rolling Reserved %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Commision</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="commision" id="commision" placeholder="Commision in %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
					      <select class="form-control" name="status" id="status">
                            <option value="1">Active</option>      
                            <option value="0">Disabled</option>      
                          </select>
                       </div>
                      </div>
                    </div>
                    <div class="col-xs-12 text-center spacetop2x">
                    	<div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                      <button type="button" class="btn-submit transitions" id="submitPsp">Submit</button>
                      <button type="reset" class="btn-reset transitions">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--edit psp modal starts  -->
      <div class="modal common-modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Edit Payment Provider</h2>
            </div>
            <div class="modal-body">
              
            </div>
          </div>
        </div>
      </div>
      <!--edit psp modal ends  -->
    </div>
  </div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>  
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  	(function($){
  		$('#psp_name').on('blur', function() {
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
      $('#status').on('blur', function() {
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

      $("#submitPsp").click(function(){
      var returnvar = true;
      if($("#psp_name").val() ==""){
           $("#psp_name").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#bank").val()==""){                  
           $("#bank").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#status").val()==""){                  
           $("#status").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){  
             $("#submitPsp").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('configuration/payment_processor/addPsp')?>",
                    type: "POST",
                    data : $("#newpsp").serialize(),
                    dataType: "html",
                   success: function(data) {
                   	if(data == 1){
                  		window.location.href = '<?php echo base_url('configuration/payment_processor') ?>';
                    }else{
                       window.location.href = '<?php echo base_url('configuration/payment_processor') ?>';
					}
                   }
               });

     }  
     return returnvar;
      });
  	})(jQuery);
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.edit_psp', function() {
	
	//$('.edit_psp').click(function(event) {
    var load_data2 = $(this).attr('data-action');
           $("#myModal1 .modal-body").load( load_data2 );
    	});
	});
</script>