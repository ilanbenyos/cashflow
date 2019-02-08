<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->
<div class="defination-box clearfix">
            <form class="form-horizontal clearfix" method="post" id="editExp_category">
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['edit_category']))
                  {
                    unset($_SESSION['edit_category']);
                  }
                  $_SESSION['edit_category'] = $token;
                ?>
              <input type="hidden" name="editcategory_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop4x">
                <div class="clearfix">
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Category</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="category" id="category" value="<?php echo $cat->Category ?>" placeholder="Category" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                </div>
                <div class="col-xs-12 text-center spacetop4x">
                  <button type="button" class="btn-submit transitions" id="editExpense-submit">Submit</button>
                  <button type="reset" class="btn-reset transitions">Reset</button>
                </div>
              </div>
            </form>
          </div>
<!-- Modal -->
<script type="text/javascript">
  (function($){
     $('#category').on('blur', function() {
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
  });
</script>
<script type="text/javascript">
  (function($){
      $('#category').on('blur', function() {
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
  $("#editExpense-submit").click(function(){
      var returnvar = true;
      /*if($("#category").val() ==""){
           $("#category").css("border", "1px solid #be1622");           
           returnvar = false;
          }*/
          //alert(returnvar);
          if(returnvar == true){  
            //alert(returnvar);
             $("#editExpense-submit").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('configuration/expense_category/update/')?><?php echo $cat->CatId ?>",
                    type: "POST",
                    data : $("#editExp_category").serialize(),
                    dataType: "html",
                   success: function(data) {
                        if(data == 1)
                {
                  window.location.href = '<?php echo base_url('expense-category') ?>';

                }
                else
                {
                  window.location.href = '<?php echo base_url('expense-category') ?>';

                }
                   }
               });

     }  
     return returnvar;
      });
})(jQuery);
</script>

