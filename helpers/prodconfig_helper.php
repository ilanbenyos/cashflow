<?php
/*function popup(){
	if(isset($_SESSION['pop_mes']))
	{ ?>
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(document).ready(function() { 
		$('#showpopup_msg').show();
		 $('#cross_pop').click(function() {
			 $('.pop-msg-wrap').hide();
			      //window.location.reload();
			 });
	});
	</script>
	
	<div class="pop-msg-wrap" id="showpopup_msg">
	  <div class="pop-msg-container">
	    <div class="cross_pop" id="cross_pop"><img src="<?= base_url('Images/button_cancel1.png') ?>" alt="Cross" /></div>
	    <div class="form">
	      <p><?php print $_SESSION['pop_mes']; ?></p>
	      <?php unset($_SESSION['pop_mes']);?>
	    </div>
	  </div>
	</div>
	<?php } 
}*/
function popup2() {
    if (isset ( $_SESSION ['pop_mes'] )) {
        ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript">
	$(document).ready(function() { 
$('#myModal2_popup').modal('show');

	
			 
	});
	</script>
 <div class="modal common-modal" id="myModal2_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Notice</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <p><?php  print $_SESSION ['pop_mes']; ?>
		          <?php unset ( $_SESSION ['pop_mes'] ); ?>
		         </p>

              </div>
              <div class="col-xs-12 text-center spacetop2x">
              <button type="button" data-dismiss="modal" class="btn-submit transitions" id="user-submit">OK</button>
            </div>
            </div>
            
          </div>
        </div>
      </div>

<?php
	}
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED'];
                        else if(isset($_SERVER['REMOTE_ADDR']))
                            $ipaddress = $_SERVER['REMOTE_ADDR'];
                            else
                                $ipaddress = 'UNKNOWN';
                                return $ipaddress;
}
function guidv4($data)
{
  assert(strlen($data) == 16);

  $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

