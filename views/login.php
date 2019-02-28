<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (isset ( $_SESSION ['pop_mes'] )) {
    popup2 ();
}
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
                  <div class="form-group">
                    <div class="col-xs-12">
                      <input type="text" class="form-control" id="" placeholder="Username" name="username">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <div class="col-xs-12">
                      <input type="password" class="form-control" id="" placeholder="Password" name="password">
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
                <div class="col-xs-12 text-center spacetop1x">
                  <button type="submit" class="btn-login transitions">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>