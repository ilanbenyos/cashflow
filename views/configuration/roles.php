<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
    popup2 ();
}
//get all roles
$this->db->select('*');
$this->db->from('rolemaster');
$query = $this->db-> get();
$role = $query->result_array();

?>
<!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Roles</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a data-toggle="modal" data-target="#myModal" href="#"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Create Roles</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Priviledges</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($role as $roles){?>
                 <tr>
                    <td><?php echo $roles['RoleName']?></td>
                    <td><?php echo ($roles['Configuration'] == 1 ? 'Configuration' :'') ;?>
                    	<?php echo ($roles['PlannedExp'] == 1 ? 'Maintain Planned Expense' :'') ;?>
                    	<?php echo ($roles['ActualExp'] == 1 ? 'Maintain Actual Expense' :'') ;?>
                    	<?php echo ($roles['Deposits'] == 1 ? 'Maintain Deposits' :'') ;?>
                    	<?php echo ($roles['Reports'] == 1 ? 'Reports' :'') ;?>
                    </td>
                   
                    <td><a class="grey-icon edit_role" id="role<?php echo $roles['RoleId']?>" data-toggle="modal" data-target="#myModal1" data-action="<?php echo base_url('configuration/roles/editrole/')?><?php echo $roles['RoleId']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                  </tr>
                <?php }
                
                ?>
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
              <h2 class="modal-title">Create Roles</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <form class="form-horizontal clearfix" id="addrole" method="post">
                <?= form_open()?>
                    <?php 	
                    $token = md5(uniqid(rand(), TRUE));
                    if(isset ($_SESSION['new_role']))
                    {
                     unset($_SESSION['new_role']);
                   }
                   $_SESSION['new_role'] = $token;
                   ?>
                   <input type="hidden" name="role" value="<?php echo $token;?>">
                  <div class="row clearfix">
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12">Role Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" class="form-control" id="rolename" name="rolename" placeholder="Enter Role Name" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="Configuration">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Configuration </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="PlannedExp">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>Maintain Planned Expense </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="ActualExp">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>Maintain Actual Expense </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="Deposits">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>Maintain Deposits </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="Reports">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span> Reports </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 text-center spacetop2x">
                      <button type="button" id="role_submit" class="btn-submit transitions">Submit</button>
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
  </div>
  <!-- Modal -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
  <script>
  (function($){
  $("#role_submit").click(function(){
      var returnvar = true;
     
      if($("#rolename").val() ==""){
           $("#rolename").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if(returnvar == true){  
              $.ajax({
                url:"<?php echo base_url ('configuration/roles/createRole')?>",
                    type: "POST",
                    data : $("#addrole").serialize(),
                    dataType: "html",
                   success: function(data) {
                        console.log(data);
                   }
               });

     }  
     return returnvar;
      });
})(jQuery);
</script>