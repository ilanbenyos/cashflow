<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>Bank Transfer Type</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
          <!-- <div class="add-icon-box"><a href="<?= base_url('add-category') ?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Category</a></div> -->
          <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Bank Transfer Type</a></div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                  <!-- <th>Description</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($transferType as $type){?>
                <tr>
                    <td><?php echo $type->BanktransferName; ?></td>
                    <td><?php if($type->Active== "1" ){ echo '<span class="completed bold">Active</span>' ; }else{ echo  '<span class="pending bold">Disabled</span>' ;} ?></td>
                    <td><a class="grey-icon edit_type" id="type<?php echo $type->BankTransferId?>" data-toggle="modal" data-target="#myModal1" data-action="<?= base_url('configuration/bank/updateBankTransferType/'.$type->BankTransferId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <?php } ?> 
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
              <h2 class="modal-title">Add Bank Transfer Type</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix" method="post" id="type_form">
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['new_type']))
                  {
                    unset($_SESSION['new_type']);
                  }
                  $_SESSION['new_type'] = $token;
                ?>
              <input type="hidden" name="type_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop4x">
                <div class="clearfix">
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                  <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-6 col-sm-6 col-xs-12">Bank Transfer Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="type" id="type" placeholder="Bank Transfer Type" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                </div>
                <div class="col-xs-12 text-center spacetop4x">
                  <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                  <button type="button" class="btn-submit transitions" id="type-submit">Submit</button>
                  <button type="reset" class="btn-reset transitions">Reset</button>
                </div>
              </div>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--edit expense category modal starts  -->
      <div class="modal common-modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Edit Bank Transfer type</h2>
            </div>
            <div class="modal-body">
              
            </div>
          </div>
        </div>
      </div>
      <!--edit expense category modal ends  -->
  </div>
</div>
<script type="text/javascript">
  (function($){
      $('#type').on('blur', function() {
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
  $("#type-submit").click(function(){
      var returnvar = true;
      
      if($("#type").val() ==""){
           $("#type").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if(returnvar == true){  
             $("#type-submit").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('configuration/bank/addBankTransferType')?>",
                    type: "POST",
                    data : $("#type_form").serialize(),
                    dataType: "html",
                   success: function(data) {
                    if(data == 1)
                      {
                        window.location.href = '<?php echo base_url('bank-transfer-type') ?>';

                      }
                      else
                      {
                        window.location.href = '<?php echo base_url('bank-transfer-type') ?>';

                      }
                   }
               });

     }  
     return returnvar;
      });
})(jQuery);
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(document).on('click', '.edit_type', function() {
  
    var load_data2 = $(this).attr('data-action');
           $("#myModal1 .modal-body").load( load_data2 );
   
    });
});

</script>