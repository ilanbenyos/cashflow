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
		$('#myModal').show();
		 $('.close').click(function() {
			 $('#myModal').hide();
			 
		 })
			 
	});
	</script>
 <div class="modal common-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Success</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <p><?php  print $_SESSION ['pop_mes']; ?>
		          <?php unset ( $_SESSION ['pop_mes'] ); ?>
		         </p>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php
	}
}

