<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 (); 
  //echo $_SESSION ['pop_mes'];
}
    // to get roles
    $this->db->select('RoleId,RoleName');
    $this->db->from('rolemaster');
    $this->db->order_by('RoleName','ASC');
    $query = $this->db-> get();
    $res = $query->result_array();

    // to show users
    $this->db->select('u.UserID,u.Email,u.Active,u.Name,u.Password,u.RoleId,r.RoleName');
    $this->db->from('usermaster u');
    $this->db->join('rolemaster r', 'r.RoleId = u.RoleId');
    $this->db->where('u.IsDelete',1);
    $this->db->order_by ( "u.CreatedOn", "desc" );

    $users = $this->db->get();
    $users = $users->result_array();
    
    //get user data
    $this->db->select('*');
    $this->db->from('usermaster');
    $this->db->where('Email',$_SESSION['user_email']);
    $getusers = $this->db->get();
    $getusers = $getusers->result_array();

//print_r($vendors);
?>
<!-- Page Content  -->
 <!--  <div id="content">
    <div class="container-fluid">-->
      <h1>Users</h1> 
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Users</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table id="tabledata" class="table table-hover" cellpadding="0" cellspacing="0" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
				            <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                
                  <?php foreach ($users as $user) { ?>
                     <tr>
                        <td><?php echo $user['Name']; ?></td>
                        <td><?php echo $user['Email']; ?></td>
                        <td><?php echo $user['Password']; ?></td>
                        <td><?php echo $user['RoleName']; ?></td>
				    <td><?php if($user['Active'] == "1" ){ echo '<span class="completed bold">Active</span>' ; }else{ echo  '<span class="pending bold">Disabled</span>' ;} ?></td>
                        <!-- <a class="td-link deposit_detailsuu" data-action="' + value_5 + '">' + full.acc + '</a> -->
                        <td><a class="grey-icon edit_user" id="euser<?php echo $user['UserID']?>" data-toggle="modal" data-target="#myModal1" data-action="<?php echo base_url('configuration/users/editUser/')?><?php echo $user['UserID']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          <a class="grey-icon del_user" id="euser<?php echo $user['UserID']?>" href="javascript:void(0);" onclick="myFunction(<?php echo $user['UserID'];?>);"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                     </tr>
                  <?php }?>
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
              <h2 class="modal-title">Add New Users</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix" id="addusers" method="post" autocomplete="off">
                <?= form_open()?>
                    <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['new_user']))
                    {
                     unset($_SESSION['new_user']);
                   }
                   $_SESSION['new_user'] = $token;
                   ?>
                   <input type="hidden" name="user_details" value="<?php echo $token;?>">
                  <div class="row clearfix">
                    <!--<div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Date</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Date" id="date" name="date"/>
                            <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
					
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Time</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="time" placeholder="Time" name="time"/>
                        </div>
                      </div>
                    </div>
					-->        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="name" placeholder="Name" name="name"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Password</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="password" class="form-control" id="password" placeholder="Password" name="password"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="email" placeholder="Email" name="email" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Role</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" name="role" id="role" onchange="" name="role">
                            <option selected="" value="">Select Role</option>
                            <?php foreach ($res as $role) { ?>
                            <option value="<?php echo $role['RoleId']; ?>"><?php echo $role['RoleName']; ?></option>      
                                  <?php   } ?>
                            <!-- <option selected="">Admin</option>
                            <option>CEO</option>
                            <option>Book Keeper</option> -->
                          </select>
                        </div>
                      </div>
                    </div>
                    
				            <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
					                <select class="form-control" name="status" id="status">
                            <!-- <option selected="" value="">Select Status</option> -->
                            <option value="1">Active</option>      
                            <option value="0">Disabled</option>      
                          </select>
                       </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="vendor" style="display: none;">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Select Vendor</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <select class="form-control" name="vendor" id="vendor" onchange="">
                            <option selected="" value="">Select Vendor</option>
                            <?php foreach ($vendors as $val) { 
                              ?>
                            <option value="<?php echo $val->VendorId; ?>"><?php echo $val->VendorName; ?></option>   
                                  <?php   } ?>
                            <!-- <option selected="">Admin</option>
                            <option>CEO</option>
                            <option>Book Keeper</option> -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <!--<div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12"><strong>Associated Priviledges</strong></div>
                        <div class="col-md-9 col-sm-8 col-xs-12">Maintain Bank Details, Maintain PSP, Maintain Expense Categories, Maintain Planned Expense, Maintain Actual Expense, Reports.</div>
                      </div>
                    </div>-->
                    <div class="col-xs-12 text-center spacetop2x">
                      <div class="page-loader" style="display:none;">
                        <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                      </div>
                      <button type="button" class="btn-submit transitions" id="user-submit">Submit</button>
                      <button type="reset" class="btn-reset transitions">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
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
      <div class="modal common-modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Notice</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <p>Are you sure You want to delete?</p>

              </div>
              <div class="col-xs-12 text-center spacetop2x">
              <button type="button" data-dismiss="modal" class="btn-submit transitions" data-value="1">Yes</button>
              <button type="button" data-dismiss="modal" class="btn-submit transitions" data-value="0">NO</button>
            </div>
            </div>
          </div>
        </div>
      </div>
      <!--edit user modal ends  -->
   <!--  </div>
  </div> -->
  <!-- Modal -->
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script>
 
   $(document).ready(function() {
    $('#tabledata').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
    aaSorting: [[4, "asc"],[0, "asc"]],
      columnDefs: [
     { orderable: false, targets: 5 }
    ]
    });

  	var today = new Date();
  	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  	$("#time").val(time);
      });
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

      $("#role").on('change',function(){
        var role = $("#role").val(); 
        if (role == 4) {
          $("#vendor").show();
        }else{
          $("#vendor").hide();
        } 
      });  
    /*function IsPassword(password)
      {
          var regex = /^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,20}$/;
          return regex.test(password);
      }
      function IsEmail(email) 
      {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
      }
      $('#name').on('blur', function() {
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
      $('#email').on('blur', function() {
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
      $('#password').on('blur', function() {
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
        })*/
  });

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
      $('#name').on('blur', function() {
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
      $('#email').on('blur', function() {
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
      $('#password').on('blur', function() {
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
  $("#user-submit").click(function(){
      var returnvar = true;
      
      /*if(($("#date").val() == "") || ($("#name").val() == "") || ($("#password").val() == "") || ($("#email").val() == "") || ($("#role").val() == ""))
      {
        returnvar = false;
       
      }
     alert(returnvar);
      return returnvar;*/
      if($("#name").val() ==""){
           $("#name").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if(!IsEmail($("#email").val())){
            $("#email").css("border", "1px solid #be1622");
            returnvar = false;
          }
          if(!IsPassword($("#password").val())){
           $("#password").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if($("#role").val()==""){                  
           $("#role").css("border", "1px solid #be1622");
           returnvar = false;
          }
          if(returnvar == true){  
             $("#user-submit").hide();
            $(".page-loader").show();
              $.ajax({
                url:"<?php echo base_url ('configuration/users/createUser')?>",
                    type: "POST",
                    data : $("#addusers").serialize(),
                    dataType: "html",
                   success: function(data) {
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
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('click', '.edit_user', function() {
	var today = new Date();
	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	$("#time").val(time);
	//$('.edit_user').click(function(event) {
    var load_data2 = $(this).attr('data-action');
           $("#myModal1 .modal-body").load( load_data2 );
           //$("#myModal1").modal('show');
   
    });
});


</script>
<script type="text/javascript">
    var url="<?php echo base_url();?>";
    function myFunction(id){
       //var r=confirm("Do you want to delete this?")
      $("#myModal2").modal('show');
      $('.transitions').click(function(){
        var r = $(this).attr('data-value');
        if (r=="1"){

          window.top.location = url+"/delete/"+id;
        }
        else{
          window.top.location = url;
        }
      });
        
        } 
</script>
<script type="text/javascript">
   $(document).ready(function() {
      $('select').change(function() {
            var val = $(this).val();
            if(val == -1){
              
              $('#tabledata_previous').css( 'display', 'none' );
              $('#tabledata_next').css( 'display', 'none' );
            }
      });
});
</script> 
