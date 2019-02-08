<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12">
          <h2 class="modal-title">Add New Category</h2>
          <div class="defination-box clearfix">
            <form class="form-horizontal clearfix" method="post">
              <?php 
                  $token = md5(uniqid(rand(), TRUE));
                  if(isset ($_SESSION['new_category']))
                  {
                    unset($_SESSION['new_category']);
                  }
                  $_SESSION['new_category'] = $token;
                ?>
              <input type="hidden" name="category_token" value="<?php echo $token;?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
              <div class="row clearfix spacetop4x">
                <div class="clearfix">
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Vendor</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control" name="" id="" onchange="">
                            <option selected="">Affiliate</option>
                            <option>Marketing</option>
                            <option>Development</option>
                            <option>Interbank</option>
                          </select>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Category</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" name="category" id="category" placeholder="Category" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 common-border-box">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date" id="" />
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                     <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea class="form-control" name="desc" placeholder="Description"></textarea>
                        </div>
                      </div>
                    </div> 
                  </div> -->
                  <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                </div>
                <div class="col-xs-12 text-center spacetop4x">
                  <button type="submit" class="btn-submit transitions">Submit</button>
                  <button type="reset" class="btn-reset transitions">Reset</button>
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

