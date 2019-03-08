<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

?>

<!-- Page Content  -->
  <div class="container cntr-box">
    <div class="login-box clearfix">
      <div class="col-md-12">
        <div class="site-logo"> <a href="/"><img class="aligncenter img-responsive" src="<?= base_url('application/assets/images/logo.png')?> "></a> </div>
      </div>
      <div class="col-md-12">
        <div class="login-body">
          <h3>LOGIN TO YOUR ACCOUNT</h3>
          <div class="clearfix">
            <form class="form-horizontal clearfix" method="post">
              <div class="row clearfix">
                <div class="col-xs-12">
                  <div class="form-group" id="uname1">
                    <div class="col-xs-12">
                      <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                      <span id="errmsg1" class="help-block form-error msg"></span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group" id="pass1">
                    <div class="col-xs-12">
                      <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                      <span id="errmsg" class="help-block form-error"></span>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="">
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span> Keep me Login</label> 
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-md-6 col-sm-6 col-xs-12 forgot-pass-text"><a href="">Forgot Password</a></div> -->
                <div class="col-xs-12">
                  <div class="form-group">
                    <div class="col-xs-12">
                      <span class="help-block form-error">
                        <?php 
                        echo $this->session->flashdata('error_view');
                        ?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 text-center spacetop1x">
                  <button type="submit" id="login" class="btn-login transitions">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    (function($){
      $('#username').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="")
        { 
          //$(this).css("border", "1px solid #CCCCCC");                         
          $("#errmsg1").html('');
          $('#uname1').removeClass('has-error');
        }
        else if($(this).val()=="") 
        {
          //$(this).css("border", "1px solid #be1622");
           $("#errmsg1").html('Please Enter Valid Username.');
           $('#uname1').addClass('has-error');
        }
      })
      $('#password').on('blur', function() {
        $(this).css("border", "1px solid #CCCCCC");
            if($(this).val()!="")
        { 
          //$(this).css("border", "1px solid #CCCCCC");                         
          $("#errmsg").html('');
          $('#pass1').removeClass('has-error');
        }
        else if($(this).val()=="") 
        {
          //$(this).css("border", "1px solid #be1622");
          $("#errmsg").html('Please Enter Valid Username.');
           $('#pass1').addClass('has-error');
        }
      })

      $("#login").click(function(){

      var returnvar = true;
 
      if($("#username").val() ==""){
           $("#username").css("border", "1px solid #be1622"); 
           //$("#uname").text("Please Enter Valid Username.", "1px solid #be1622");
          $("#errmsg1").html('Please Enter Valid Username.');
           $('#uname1').addClass('has-error');
           returnvar = false;
          }
          if($("#password").val() ==""){
            $("#password").css("border", "1px solid #be1622");
            //$("#pass").text("Please Enter Valid Password.", "1px solid #be1622");
            $("#errmsg").html('Please Enter Valid Password.');
            $('#pass1').addClass('has-error');
            returnvar = false;
          }
          if(returnvar == true){  
             $("#login").hide();
            $(".page-loader").show();
            

     }  
     return returnvar;
      });
    })(jQuery);
  </script>