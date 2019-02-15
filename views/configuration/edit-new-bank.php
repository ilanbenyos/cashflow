<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Update Bank Details</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" id="addbankform" method="post" action="">
			<?php 
			$token = md5(uniqid(rand(), TRUE));

if(isset ($_SESSION['form_token_editbank']))

{
	
	unset($_SESSION['form_token_editbank']);
	
}
$_SESSION['form_token_editbank'] = $token;
			?>
			<input type="hidden" name="my_token_editbank" value="<?php echo $token;?>">
              <div class="row clearfix spacetop4x">
                <div class="row-flex clearfix">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Bank Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" placeholder="Bank Name" value="<?php echo $result->BankName; ?>" id="BankName" name="BankName" />
                        </div>
                      </div>
                    </div>
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Balance</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" placeholder="Balance" value="<?php echo $result->Balance; ?>" id="Balance" name="Balance" />
                        </div>
                      </div>
                    </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Currency</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="cur" id="cur" onChange="">
                            <?php //print_r($currency);
                            foreach ($currency as $curr) { ?>
                            <option <?php if($curr->CurId == $currencyId->CurId){ echo 'selected="selected"'; } ?> value="<?php echo $curr->CurId; ?>"><?php echo $curr->CurName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>             
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Inward Commission %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="InComP" value="<?php echo $result->InComP; ?>" name="InComP" placeholder="Inflow Commission %" />
                        </div>
                      </div>
                    </div>

                  <!--  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Transfer Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                           <?php 
                            $i = 1;
                            foreach ($transferDetails as $type2) {
                             ?>
                          <select class="type_input" name="transfertype[]" id="transfer_type<?php echo $i; ?>">
                            <option value="<?php echo $type2->BankTransferId; ?>"><?php echo $type2->BanktransferName; ?></option>
                            <?php 

                            foreach ($transferType as $type) { ?>
                            <option value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                            
                          </select>
                          <input type="text" id="amount<?php echo $i; ?>" class="amount_input" name="amount[]" onkeypress="javascript:return isNumber(event)">
                          <a href="#" class="remove_field" style="margin-left:10px;">Remove</a>
                          <a href="#" class="edit_field" style="margin-left:10px;">Edit</a>
                          <?php 
                          $i++;
                        } ?> 
                        </div>
                      </div>
                    </div>  -->
<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-container">
					 <div class="form-group">
                          <div class="col-md-12">
						  <button class="add-one add_more_button"><i class="fa fa-plus-square" aria-hidden="true"></i> Transfer Type</button>
                          </div>
                        </div>
                    <div class="dynamic-stuff">
                      
                        <?php 
                            $i = 1;
                            foreach ($transferDetails as $type2) {
                             ?>
                             <div class="form-group dynamic-element"><div class="col-md-5">
                          <select class="type_input form-control" name="transfertype[]" id="transfer_type<?php echo $i; ?>" readonly>
                            <option value="<?php echo $type2->BankTransferId; ?>"><?php echo $type2->BanktransferName; ?></option>
                            <?php 

                            foreach ($transferType as $type) { ?>
                            <option value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                            
                          </select></div>
						  <div class="col-md-4 no-padding">
                          <input type="text" id="amount<?php echo $i; ?>" class="amount_input form-control" name="amount[]" value="<?php echo $type2->Amount ?>" onkeypress="javascript:return isNumber(event)" readonly><span class="help-block form-error" id="emailspan<?php echo $i; ?>" value="0"></span></div><div class="col-md-3"><div class="action-icons"><span class="remove_field delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span><span href="#" id="edit_field<?php echo $i; ?>" class="edit_field edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></span></div></div>
                          </div>
						  <script>
    $(document).ready(function() {
		
		$('.dynamic-stuff').on("click","#edit_field<?php echo $i; ?>", function(e){ //user click on remove text links
        e.preventDefault(); 
        $("#amount<?php echo $i; ?>").attr('readonly',false);
        $("#transfer_type<?php echo $i; ?>").attr('readonly',false);
    })
	
	$('input#amount<?php echo $i; ?>').focus();
        $('input#amount<?php echo $i; ?>').blur(function(){
         var amt = $('input#amount<?php echo $i; ?>').val();
         if(amt == ""){
          $('.add_more_button').attr('disabled', true);
            $("#emailspan<?php echo $i; ?>").html('Please enter Amount');  
         }
         else{
          $('.add_more_button').attr('disabled', false);
           // $("#emailspan").html('<font color="#cc0000"></font>');  
           $("#emailspan<?php echo $i; ?>").hide();
         }
        });
	
	
	});
	</script>
						  
                          <?php 
                          $i++;
                        } ?>  
                      
                      </div>
                    <span id="errmsg" class="help-block form-error"></span>
                   </div></div>
                  </div>
                  
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Outward Commission %</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="OutComP" value="<?php echo $result->OctComP; ?>" id="OutComP" placeholder="Outgo Commission %" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Inward Commission Per Transitions</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="InCom" value="<?php echo $result->InCom; ?>" id="InCom" placeholder="Inflow Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
                   
					
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Outward Commission Per Transitions</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="OutCom" value="<?php echo $result->OutCom; ?>" id="OutCom" placeholder="Outgo Commission Per Transitions" />
                        </div>
                      </div>
                    </div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                         <select class="form-control" name="status" id="status">
                            <option selected="selected" value="<?php echo $result->Active; ?>"><?php if( $result->Active == "1"){ echo "Active";}else{ echo "Disabled";}?> </option>
				      <option value="<?php if( $result->Active== "1"){ echo "0";}else{ echo "1";}?>"><?php if( $result->Active == "1"){ echo "Disabled";}else{ echo "Active";}?> </option>     
                          </select>
                        </div>
                      </div>
                      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $transferDetails->Amount; ?>" onkeypress="javascript:return isNumber(event)">
                        </div>
                      </div>
                    </div> -->
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 text-center spacetop2x">
				<div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                  <button type="submit" id="addbankbtn" class="btn-submit transitions">Submit</button>
                  <a href="<?= base_url('configuration/bank');?>" class="btn-reset transitions" style="text-decoration: none;">Cancel</a>
                </div>
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
    var temp = <?php echo json_encode($transferData); ?>;
    console.log(array.length);

    var max_fields_limit      = array.length; //set limit for maximum input fields
    var x = temp.length; //initialize counter for text box
    //var typeid = document.getElementsByClassName("valid");
    //var amt = document.getElementsByClassName("valid");
    //default fields in any starts
    //console.log(temp);
    /*var optn1='';
    $.each( temp, function( key, val1 ) {
      
          //optn1 += '<option value="'+ val1.BankTransferId + '">' + val1.BanktransferName + '</option>';
          optn1 = val1.BankTransferId;
    });*/
    
    /*var optn = '';
        $.each( temp, function( key, val ) {
          //alert( key + ": " + val.BankTransferId );

           var optn1 = [];
           console.log(array);
          

         optn += '<option value="'+ val.BankTransferId + '" selected>' + val.BanktransferName + '</option>';
         $.each( array, function( key, val1 ) {
            optn +=  '<option value="'+ val1.BankTransferId + '" selected>' + val1.BanktransferName + '</option>';
          });
          $('.dynamic-stuff').append('<div><select id="transfer_type'+x+' class="type_input" name="transfertype[]" >'+optn+
        '</select><input type="text" id="amount'+x+'" class="amount_input" name="amount[]" onkeypress="javascript:return isNumber(event)"/><a href="#" class="remove_field" style="margin-left:10px;">Remove</a><a href="#" class="edit_field" style="margin-left:10px;">Edit</a></div><span id="emailspan" value="0"></span>');
        });*/
        
    //default fields in any ends

    $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        if(x < max_fields_limit){ //check conditions
            x++; //counter increment
        var option = '';
        $.each( array, function( key, value ) {
          //alert( key + ": " + value.BankTransferId );
          option += '<option value="'+ value.BankTransferId + '">' + value.BanktransferName + '</option>';

        });
        $('.dynamic-stuff').append('<div class="form-group dynamic-element"><div class="col-md-5"><select id="transfer_type'+x+'" class="form-control type_input" name="transfertype[]" >'+option+
        '</select></div><div class="col-md-4 no-padding"><input type="text" id="amount'+x+'" class="amount_input form-control" name="amount[]" onkeypress="javascript:return isNumber(event)"/><span class="help-block form-error" id="emailspan'+x+'" value="0"></span></div><div class="col-md-3"><div class="action-icons"><span class="remove_field delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span><span href="#" class="edit_field edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></span></div></div></div>'); //add input field
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

    
    

    $('.dynamic-stuff').on("click",".remove_field", function(e){ //user click on remove text links
	
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
                required: true,
                messages: {
                    required: "Amount is required",
                }
            });
    });
    //Add validation rule for dynamically generated email fields
    $('.type_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                //email: true,
                messages: {
                    required: "Type is required",
                    email: "Invalid type",
                  }
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