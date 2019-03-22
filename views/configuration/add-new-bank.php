<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Add New Bank</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="addbankform" method="post" action="">
              <?php 
			$token = md5(uniqid(rand(), TRUE));

if(isset ($_SESSION['form_token_addbank']))

{
	
	unset($_SESSION['form_token_addbank']);
	
}
$_SESSION['form_token_addbank'] = $token;
			?>
              <input type="hidden" name="my_token_addbank" value="<?php echo $token;?>">
              <div class="row clearfix spacetop4x">
                <div class="row-flex clearfix">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-10 col-sm-12 col-xs-12 text-center">
                      <h4>General Information</h4>
                    </div>
                    <div class="col-md-2 hidden-sm hidden-xs"> &nbsp; </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Bank Name</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control" required placeholder="Bank Name" id="BankName" name="BankName" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Balance</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" placeholder="Balance" id="Balance" name="Balance" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Currency</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="cur" id="cur" onChange="">
                             <option selected="" value="">Select Currency</option>
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
                        <label class="col-md-5 col-sm-5 col-xs-12">Status</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control" name="status" id="status">
                            <option selected="" value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Disabled</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Transfer Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="transfertype" id="transfertype">
                            <?php foreach ($transferType as $type) {
                             ?>
                           <option value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                          </select> 
                        </div>
                      </div>
                    </div> --> 
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-container">
                        <div class="form-group">
                          <div class="col-md-12">
                              <label><span class="add-one"><i class="fa fa-plus-square" aria-hidden="true"></i> Transfer Type</span></label>
                          </div>
                        </div>
                        <div class="dynamic-stuff"> </div>
                      </div>
                      <div class="form-group dynamic-element" style="display:none">
                        <div class="col-md-5">
                          <select id="rol" name="rol[]" class="form-control">
                            <?php foreach ($transferType as $type) {
                             ?>
                           <option value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                        <div class="col-md-4 no-padding">
                          <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount"  onkeypress="javascript:return isNumber(event)"/>
                        </div>
                        <div class="col-md-3">
                          <div class="action-icons">
                            <span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                            <span class="edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></span>
                            </div>
                        </div>
                      </div>
                    </div> --> 
                    <!--<div class="dynamic-stuff"> </div>
                    <span id="errmsg"></span>
					         <button class="btn btn-sm btn-primary add_more_button">Add More Fields</button>--> 
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-10 col-sm-12 col-xs-12 text-center">
                      <h4>Money-In Commisions</h4>
                    </div>
                    <div class="col-md-2 hidden-sm hidden-xs"> &nbsp; </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Inflow Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" id="InComP" name="InComP" placeholder="Inflow Commission %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group align-top">
                        <label class="col-md-5 col-sm-5 col-xs-12">Inflow Commission Per Transitions</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="InCom" id="InCom" placeholder="Inflow Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12 text-center">
                      <h4>Money-Out Commisions</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Outgo Commission %</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="OutComP" id="OutComP" placeholder="Outgo Commission %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Outgo Fix Commission</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="hidden" class="form-control xyz" name="OutCom" id="OutCom" placeholder="Outgo Commission Per Transitions" />
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-container">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <button class="add-one add_more_button"><i class="fa fa-plus-square" aria-hidden="true"></i> Transfer Type</button>
                                </div>
                              </div>
                              <div class="dynamic-stuff"> </div>
                              <span id="errmsg" class="help-block form-error"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-container">
           <div class="form-group">
                          <div class="col-md-12">
              <button class="add-one add_more_button"><i class="fa fa-plus-square" aria-hidden="true"></i> Transfer Type</button>
                          </div>
                        </div>
             <div class="dynamic-stuff"> </div>
                    <span id="errmsg" class="help-block form-error"></span>
            </div></div> --> 
                    
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="amount" id="amount" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div> --> 
                  </div>
                </div>
                <div class="col-xs-12 text-center spacetop2x">
                  <div class="page-loader" style="display:none;">
                    <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                  </div>
                  <button type="submit" id="addbankbtn" class="btn-submit transitions">Submit</button>
                  <!-- <button type="reset" class="btn-reset transitions">Reset</button> --> 
                  <a href="<?= base_url('configuration/bank');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a> </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal --> 
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script> 
<script>
    $(document).ready(function() {
    
    var array = <?php echo json_encode($transferType); ?>;
    console.log(array.length);
    var max_fields_limit      = array.length; //set limit for maximum input fields
    var x = 0; //initialize counter for text box
    $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        if(x < max_fields_limit){ //check conditions
            x++; //counter increment
        var option = '';
        $.each( array, function( key, value ) {
          //alert( key + ": " + value.BankTransferId );
          option += '<option value="'+ value.BankTransferId + '">' + value.BanktransferName + '</option>';

        });
        /*$('.dynamic-stuff').append('<div><select id="transfer_type'+x+' class="type_input" name="transfertype[]">'+option+
        '</select><input type="text" id="amount'+x+'" class="amount_input" name="amount[]" onkeypress="javascript:return isNumber(event)"/><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div><span id="emailspan" value="0"></span>'); //add input field */
		
		$('.dynamic-stuff').append('<div class="form-group dynamic-element"><div class="col-md-5"><select id="transfer_type'+x+'" class="form-control type_input" name="transfertype[]">'+option+
        '</select></div><div class="col-md-4 no-padding"><input type="text" id="amount'+x+'" class="form-control amount_input" name="amount[]" onkeypress="javascript:return isNumber(event)"/><span class="help-block form-error" id="emailspan'+x+'" value="0"></span></div><div class="col-md-3"><div class="action-icons"><span class="remove_field delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span></div></div></div>'); //add input field
		
 $('input#amount'+x).focus();
        $('input#amount'+x).blur(function(){
         var amt = $('input#amount'+x).val();
         if(amt == ""){
          $('.add_more_button').attr('disabled', true);
            $("#emailspan"+x).html('Please enter Amount');  
         }
         else{
          $('.add_more_button').attr('disabled', false);
           // $("#emailspan").html('<font color="#cc0000"></font>');  
           $("#emailspan"+x).hide();
         }
        });
        //document.getElementById("amount"+x).onblur = function() {myFunction()};
        
        }else{
          $("#errmsg").html('Can not add more.');  
        }
    });  
    $('.dynamic-stuff').on("click",".remove_field", function(e){
 $("#emailspan"+x).hide();		//user click on remove text links
        e.preventDefault(); $(this).closest('.form-group').remove(); x--;
       
        $('.add_more_button').attr('disabled', false);
    })

});
</script> 
<script type="text/javascript">
    
$('form#addbankform').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
    $('.amount_input').each(function() {
        $(this).rules("add", 
            {
                required: true
            });
    });
    
	

	

});
$('#addbankform').validate({ // initialize the plugin
        rules: {
            BankName: {
                required: true,
            }
			amount: {
                required: true,
            }
        },
        submitHandler: function (form) { // for demo
            $("#addbankbtn").hide();
            $(".page-loader").show();
            form.submit();
        }
});
</script>