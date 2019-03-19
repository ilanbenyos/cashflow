<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>Bank Transactions</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
            <!-- <div class="add-icon-box"><a href="<?= base_url('add-bank-transaction')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Bank Transaction</a></div> -->
            <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Bank Transaction</a></div>
          </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table id="tablebankTrans" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>From Bank </th>
                  <th>To Bank</th>
                  <th>Amount</th>
                  <th>Date Received</th> 
                  <th>Transfer Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php //$i = 1; ?>
                 <?php foreach ($allTransaction as $trans) { ?>
                 <tr>
                  <td><?php echo $trans->TransId; ?></td>
                  <td><?php echo $trans->fromBank; ?></td>
                  <td><?php echo $trans->toBank; ?></td> 
                  <td><?php echo number_format($trans->Amount, 2, '.', ','); ?></td>
                  <td><?php echo date('d/m/Y', strtotime(str_replace('-','/', $trans->CreatedOn))); ?></td> 
                  <td><?php echo $trans->BanktransferName; ?></td>
                   
                  
                  <td><a class="grey-icon edit_banktrans" id="trans<?php echo $trans->TransId?>" data-toggle="modal" data-target="#myModal1" data-action="<?= base_url('bank_transaction/update/'.$trans->TransId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                 </tr>
             <?php  //$i++; 
           } ?>  
              </tbody>
            </table>
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
              <h2 class="modal-title">Add New Bank Transactions</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix" action="<?php echo base_url ('add-bank-transaction')?>" id="addvendor" method="post" autocomplete="off">
                <?= form_open()?>
                    <?php   
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['bank_transaction']))
                    {
                     unset($_SESSION['bank_transaction']);
                   }
                   $_SESSION['bank_transaction'] = $token;
                   ?>
                   <input type="hidden" name="bank_transaction" value="<?php echo $token;?>">
                   <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
         <div class="row clearfix spacetop4x">
          <div class="clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
            
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group" id="fromBankgroup">
              <label class="col-md-5 col-sm-5 col-xs-12">From Bank</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <select class="form-control" name="fromBank" id="fromBank" onchange="">
                <!-- <option selected="" value="">Select From Bank</option> -->
                            <?php foreach ($banks as $bank1) { ?>

                            <option value="<?php echo $bank1->BankId; ?>"><?php echo $bank1->BankName; ?></option>      
                                  <?php   } ?>
                </select>
                <span id="errmsg1" class="help-block form-error msg"></span>
              </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group" id="toBankgroup">
              <label class="col-md-5 col-sm-5 col-xs-12">To Bank</label>
              <div class="col-md-7 col-sm-7 col-xs-12" id='msg'>
                <select class="form-control" name="toBank" id="toBank" onchange="">
                <!-- <option selected="" value="">Select To Bank</option> -->
                    <?php foreach ($banks as $bank2) { ?>

                    <option value="<?php echo $bank2->BankId; ?>"><?php echo $bank2->BankName; ?></option>      
                          <?php   } ?>
                </select>
               <!--  <span id="errmsg1" class="help-block form-error msg"></span> -->
                <span id="errmsg" class="help-block form-error"></span> 
              </div>
              </div>
            </div>
            </div>
          
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 common-border-box">
            <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                <label class="col-md-5 col-sm-5 col-xs-12">Amount</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="text" class="form-control xyz" name="amount" id="amount" placeholder="Amount" />
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-5 col-sm-5 col-xs-12">Transfer Type</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <!-- <input type="hidden" class="form-control xyz" name="transferAmt" id="transferAmt"> -->
                          <select class="form-control" name="transType" id="transType" onchange="">
                            <option selected="" value="">Select Transfer Type</option>
                            <?php foreach ($transType as $type) { ?>

                            <option value="<?php echo $type->BankTransferId; ?>"><?php echo $type->BanktransferName; ?></option>      
                                  <?php   } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  <div class="col-md-12 col-sm-12 col-xs-12" id="charges" style="display: none">
                     <div class="form-group">
                      <label class="col-md-5 col-sm-5 col-xs-12">Transfer Charges</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" class="form-control xyz" name="transferCharges" id="transferCharges" placeholder="Transfer Charges" readonly />
                      </div>
                    </div>
                  </div>

            </div>
          </div>
          <div class="col-xs-12 text-center spacetop4x">
          <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
            <button type="submit" id="bankTransaction-submit" class="btn-submit transitions">Submit</button>
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
              <h2 class="modal-title">Edit Bank Transaction Type</h2>
            </div>
            <div class="modal-body">
              
            </div>
          </div>
        </div>
      </div>
      <!--edit user modal ends  -->
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){

    //sort by albhabetical order start
    /*var options = $('select#fromBank option');
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
    });

    var options = $('select#toBank option');
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
    /*var fromBankId = $("#fromBank").val();
    $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>"+ fromBankId ,
                    type: "POST",
                    data : {fromBankId:fromBankId},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      console.log(obj.charges);
                      var charges = obj.charges.Amount
                      $("#transferAmt").val(charges);
                    }else{
                      console.log('obj' + obj.charges);
                      var charges = 0;
                      $("#transferAmt").val(charges);
                    }
                   }
               });*/

   /* $('#fromBank').on('change',function() {
        var fromBankId = document.getElementById("fromBank").value;
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>"+ fromBankId ,
                    type: "POST",
                    data : {fromBankId:fromBankId},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      console.log(obj.charges);
                      var charges = obj.charges.Amount
                      $("#transferAmt").val(charges);
                    }else{
                      console.log('obj' + obj.charges);
                      var charges = 0;
                      $("#transferAmt").val(charges);
                    }
                   }
               });

    });*/
    /*$('#toBank').on('change',function() {
        var toBank = document.getElementById("toBank").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>"+ toBank ,
                    type: "POST",
                    data : {toBank:toBank},
                    dataType: "html",
                    success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      console.log(obj.charges);
                      var charges = obj.charges.Amount
                      $("#transferAmt").val(charges);
                    }else{
                      console.log('obj' + obj.charges);
                      var charges = 0;
                      $("#transferAmt").val(charges);
                    }
                   }
               });

    });*/
    /*var fromBankId = $("#fromBank").val();
    alert(fromBankId);*/
    var transType = document.getElementById("transType").value;  
        var fromBankId = document.getElementById("fromBank").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges").show();
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP = obj.charges.Amount
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }else{
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP = 0;
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }
                   }
               });
    $('#transType').on('change',function() {
        var transType = document.getElementById("transType").value;  
        var fromBankId = document.getElementById("fromBank").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges").show();
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      //var charges = obj.charges.Amount
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP =  obj.charges.Amount
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }else{
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP = 0;
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }
                   }
               });

    });
    $('#fromBank').on('change',function() {
        var transType = document.getElementById("transType").value;  
        var fromBankId = document.getElementById("fromBank").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges").show();
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      var amount = $("#amount").val();
                      if (amount == "" && amount == null) {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP = obj.charges.Amount;
                      if (chargesP == "") {
                        chargesP = 0;
                      }
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }else{
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP = 0;
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }
                   }
               });

    });
    $('#amount').on('keyup',function() {
        var transType = document.getElementById("transType").value;  
        var fromBankId = document.getElementById("fromBank").value;  
         $.ajax({
                url:"<?php echo base_url ('bank_transaction/getTransactionCharges/')?>" ,
                    type: "POST",
                    data : {fromBankId:fromBankId,transType:transType},
                    dataType: "html",
                    success: function(data) {
                      $("#charges").show();
                    var obj = JSON.parse(data);
                    if(obj.charges != null){
                      //var charges = obj.charges.Amount
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP =  obj.charges.Amount
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }else{
                      var amount = $("#amount").val();
                      if (amount == "") {
                        amt = 0;
                      }else{
                        amt = amount;
                      }
                      var chargesP = 0;
                      /*var charges = (amt*(chargesP/100));
                      $("#transferCharges").val(charges);*/
                      $("#transferCharges").val(chargesP);
                    }
                   }
               });

    });
  });
</script>
<script type="text/javascript">
  (function($){
    $('#fromBank').on('blur', function() {
        var fromBank = $("#fromBank").val();
        var toBank = $("#toBank").val();
            if($(this).val()!="")
        { 
          if(fromBank == toBank)
            {
              $('#fromBankgroup').addClass('has-error');
               $('#toBankgroup').addClass('has-error');
               $("#errmsg").html('Both banks can not be same.');
             
            }else{
              $("#errmsg").html('');
               $('#toBankgroup').removeClass('has-error');
              $('#fromBankgroup').removeClass('has-error');
            }                         
        }
        else if($(this).val()=="") 
        {
           $("#errmsg1").html('From Bank is required');
          $('#fromBankgroup').addClass('has-error');
        }
      })
      
      $('#toBank').on('blur', function() {
        var fromBank = $("#fromBank").val();
        var toBank = $("#toBank").val();
       
            if($(this).val()!="")
        { 
           if(fromBank == toBank)
            {
             $('#toBankgroup').addClass('has-error');
             $('#fromBankgroup').addClass('has-error');
               $("#errmsg").html('Both banks can not be same.');
              
            }else{
             $("#errmsg").html('');
              $('#toBankgroup').removeClass('has-error');
              $('#fromBankgroup').removeClass('has-error');
            }                   
        }
        
        else if($(this).val()=="") 
        {
           $("#errmsg").html('To Bank is required');
          $('#fromBankgroup').addClass('has-error');
        }
      })
      $('#fromBank').on('blur', function() {
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
      $('#toBank').on('blur', function() {
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
      $('#amount').on('blur', function() {
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


      $("#bankTransaction-submit").click(function(){

      var returnvar = true;
 
      if($("#fromBank").val() ==""){
           $("#fromBank").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if($("#toBank").val() ==""){
           $("#toBank").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#amount").val() ==""){
               $("#amount").css("border", "1px solid #be1622");
               returnvar = false;
              }
          if($("#transType").val() ==""){
             $("#transType").css("border", "1px solid #be1622");
             returnvar = false;
            }
            var fromBank = $("#fromBank").val();
            var toBank = $("#toBank").val();
            if (fromBank === toBank) {
                $("#fromBank").css("border", "1px solid #be1622");
                $("#toBank").css("border", "1px solid #be1622");
                  returnvar = false;

                $("#errmsg").text('Both banks can not be same.');
            }
          if(returnvar == true){ 
             $("#bankTransaction-submit").hide();
            $(".page-loader").show();
     }  
     return returnvar;
      });
  })(jQuery);
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(document).on('click', '.edit_banktrans', function() {
  
    var load_data2 = $(this).attr('data-action');
           $("#myModal1 .modal-body").load( load_data2 );
   
    });
});

</script>