<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
    popup2 ();
}
$this->db->select('RoleId,RoleName');
$this->db->from('rolemaster');
$query = $this->db-> get();
$res = $query->result_array();
?>

<div class="defination-box clearfix">
                <form class="form-horizontal clearfix" id="edit_users" method="post" autocomplete="off">
                <?= form_open()?>
                    <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['edit_userdetails']))
                    {
                     unset($_SESSION['edit_userdetails']);
                   }
                   $_SESSION['edit_userdetails'] = $token;
                   ?>
                   <input type="hidden" name="edit_details" value="<?php echo $token;?>">
                <input type="hidden" name="userid" value="<?php echo $result->UserID?>">
                  <div class="row clearfix">
                 <!--   <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Date</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date" id="date1" name="date1" value="<?php //echo $result->date?>"/>
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Time</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="time1" placeholder="Time" name="time1" value="<?php echo $result->time?>"/>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="name1" placeholder="Name" name="name1" value="<?php echo $result->Name?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Password</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="password1" placeholder="Password" name="password1" value="<?php echo $result->Password?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="email1" placeholder="Email" name="email1" value="<?php echo $result->Email?>" readonly />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Role</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" id="role1" onchange="" name="role1">
                            <?php foreach ($res as $role) { ?>
                           <option <?php if($role['RoleId'] == $result->RoleId){ echo 'selected="selected"'; } ?> value="<?php echo $role['RoleId'] ?>"><?php echo $role['RoleName']?> </option>
                            <?php } ?>    
                            <!-- <option selected="">Admin</option>
                            <option>CEO</option>
                            <option>Book Keeper</option> -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><strong>Associated Priviledges</strong></div>
                        <div class="col-md-9 col-sm-8 col-xs-12">Maintain Bank Details, Maintain PSP, Maintain Expense Categories, Maintain Planned Expense, Maintain Actual Expense, Reports.</div>
                      </div>
                    </div>
                    <div class="col-xs-12 text-center spacetop2x">
                      <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                      <button type="button" class="btn-submit transitions" id="edit-submit">Submit</button>
                      <button type="reset" class="btn-reset transitions">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
              
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   $( function() {
    var $datepicker = $('#date1');
    $datepicker.datepicker();
    $datepicker.datepicker('setDate', new Date());
  } ); 
 </script>
 <script>
  $(document).ready(function(){

    function IsPassword(password)
      {
          var regex = /^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,20}$/;
          return regex.test(password);
      }
      function IsEmail(email) 
      {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
      }
  });

</script>
<script type="text/javascript">
/* $(document).ready(function() {
	var today = new Date();
	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	$("#time1").val(time);
    }); */
</script>
<script type="text/javascript">
  (function($){
    function IsPassword(password)
      {
          var regex = /^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,20}$/;
          return regex.test(password);
      }
      function IsEmail(email) 
      {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
      }
      $('#name1').on('blur', function() {
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
      $('#email1').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="")
        {
          if(!IsEmail($(this).val())){
            $(this).css("border", "1px solid #be1622");
            }
          else {
              $(this).css("border", "1px solid #CCCCCC");
            }
        }
        else if($(this).val()=="") 
        {
          $(this).css("border", "1px solid #be1622");
        }
      })
      $('#password1').on('blur', function() {
            $(this).css("border", "1px solid #CCCCCC");
              if($(this).val()!="")
        {
          if(!IsPassword($(this).val())){
            $(this).css("border", "1px solid #be1622");
          }
        else {
                $(this).css("border", "1px solid #CCCCCC");
              }
        }
        else if($(this).val()=="") {
          $(this).css("border", "1px solid #be1622"); 
      }
        })
  $("#edit-submit").click(function(){
      var returnvar = true;
      
      if($("#name1").val() ==""){
           $("#name1").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if(!IsEmail($("#email1").val())){
            $("#email1").css("border", "1px solid #be1622");
            returnvar = false;
          }
          if(!IsPassword($("#password1").val())){
           $("#password1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#role1").val()==""){                  
           $("#role1").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){ 
           $("#edit-submit").hide();
            $(".page-loader").show(); 
              $.ajax({
                url:"<?php echo base_url ('configuration/users/editUserdata/')?><?php echo $result->UserID ?>",
                    type: "POST",
                    data : $("#edit_users").serialize(),
                    dataType: "html",
                   success: function(data) {
             		//$("#edit_users").hide();
                if(data == 1)
                {
                  window.location.href = '<?php echo base_url('configuration/users') ?>';

                }
                else
                {
                  window.location.href = '<?php echo base_url('configuration/users') ?>';

                }
                	   
                   }
               });

     }  
     return returnvar;
      });
})(jQuery);
</script>