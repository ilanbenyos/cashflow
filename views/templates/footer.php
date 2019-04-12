</div>
<!-- /#wrapper ends -->

<footer class="main-footer">
  <div class="container-fluid">© 2018 All Rights Reserved.</div>
</footer>
<!----- Footer -----> 

<!------------- Common JS -------------> 


<script src="<?= base_url('assets/js/jquery.validate.min.js')?>"></script> 
<script src="<?= base_url('assets/js/additional-methods.js')?>"></script> 
<script src="<?= base_url('assets/js/common.js')?>"></script> 
<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script> 
<script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>"></script> 
<script src="<?= base_url('assets/js/SidebarNav.min.js')?>"></script> 
<script src="<?= base_url('assets/js/jquery.dataTables.min.js')?>"></script> 
<script src="<?= base_url('assets/js/dataTables.bootstrap.js')?>"></script> 
<script src="<?= base_url('assets/js/pnotify.custom.min.js')?>"></script>

<script>
// Sidebar js
$.sidebarMenu($('.sidebar-menu'))
	
$('#addbankform').validate({ // initialize the plugin
        rules: {
            BankName: {
                required: true,
                minlength: 3
            },
			status: {
                required: true
            }
        },
        submitHandler: function (form) { // for demo
            $("#addbankbtn").hide();
            $(".page-loader").show();
            form.submit();
        }
});
	
$(document).ready(function() {
  $('#tabledata').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
	aaSorting: [[4, "asc"],[0, "asc"]],
	//"processing": false,
	//"ajax": '<?= base_url('configuration/bank/listbankdata')?>',
    //data: data,
    //columns: columns
    columnDefs: [
   { orderable: false, targets: 5 }
]
  });
  
$('#tablebank').DataTable({
  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
	
	aaSorting: [[3, "desc"]],
     dom: 'lBfrtip',

  columnDefs: [
   { orderable: false, targets: 4 },
   { orderable: false, targets: 5 }
]
});
$('#tablevendor').DataTable({
  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
	
	aaSorting: [[2, "asc"]],
     dom: 'lBfrtip',
     columnDefs: [
   { orderable: false, targets: 3 }
]
});
/*var table = $('#psptabledata').DataTable({

  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
  
  aaSorting: [[0, "desc"]],
     dom: 'lBfrtip',

  columnDefs: [
   { orderable: false, targets: 8 },
   { orderable: false, targets: 9},

    {
                "targets": [ 10 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 11 ],
                "visible": false,
                "searchable": false
            }

]

});*/
 $('#tablebankTrans').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
  aaSorting: [[0, "desc"]],
    columnDefs: [
   { orderable: false, targets: 6 }
]
  });
 $('#tabledataPsp').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
     aaSorting: [[5, "asc"]],

  });
 /*$('#exptabledata').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
     aaSorting: [[0, "desc"]],
     columnDefs: [
   { orderable: false, targets: 10 }
]

  });*/

 
});
</script>
<script type="text/javascript">
   $(document).ready(function() {
      $('select').change(function() {
            var val = $(this).val();
            if(val == -1){
              $('#psptabledata_previous').css( 'display', 'none' );
              $('#psptabledata_next').css( 'display', 'none' );
              $('#tabledata_previous').css( 'display', 'none' );
              $('#tabledata_next').css( 'display', 'none' );
              $('#tablebank_previous').css( 'display', 'none' );
              $('#tablebank_next').css( 'display', 'none' );
              $('#tabledata_previous').css( 'display', 'none' );
              $('#tabledata_next').css( 'display', 'none' );
              $('#tablevendor_previous').css( 'display', 'none' );
              $('#tablevendor_next').css( 'display', 'none' );
              $('#tablebankTrans_previous').css( 'display', 'none' );
              $('#tablebankTrans_next').css( 'display', 'none' );
            }
      });
});
</script>
<script type="text/javascript">  // to disable future dates(Actual Date) for PSP Income and Expenses 
  jQuery(document).ready(function ($) {
      var today = new Date();
$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });
  });
</script>
<script type="text/javascript"> // to format numbers i.e 1000 to 1,000
  /*$('input.xyz').keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
      
      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
      
      //console.log(num2);
      
      $this.val(num2);
  });
  function RemoveRougeChar(convertString){
    
    
    if(convertString.substring(0,1) == ","){
        
        return convertString.substring(1, convertString.length)            
        
    }
    return convertString;
    
}*/
$(document).ready(function(){
  $(".xyz").each(function(event) {

    // skip for arrow keys
  if(event.which >= 37 && event.which <= 40){
    event.preventDefault();
  }

    $(this).val(function(index, value) {
    return value

      .replace(/\D/g, "")
      //.replace(/([0-9])([0-9]{2})$/, '$1.$2')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
    ;
    //console.log(value);
  });
});
});
$('input.xyz').keyup(function(event) {
  //alert(12212)
  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40){
    event.preventDefault();
  }

  $(this).val(function(index, value) {
    return value
      .replace(/\D/g, "")
      //.regex(^(0|[1-9]\d*)$)
      //.replace(/([0-9])([0-9]{2})$/, '$1.$2')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
    ;
  });
});
</script>
<script type="text/javascript">
var auto_refreshpopup = setInterval(
function ()
{
  
  
  $.ajax({
      type: 'POST',
      url: '<?php echo base_url('psp_income/get_popup_notification') ?>',
      success: function(msg) {
          if (msg == 'loggedOut') {
            //alert(msg);
              window.location.href = '<?php echo base_url('login/') ?>';
          }
          else
          {
            
               var updateurl = '<?php echo base_url ("psp_income/update_notification" ); ?>';
              
             $.each( JSON.parse(msg), function( key, value ) {
              console.log(value.TransId);
            var output= "<ul>";
             output += "<li><a href="+updateurl+value.TransId+">"+value.Description+"</a></li>";
             output += "<li><a href="+updateurl+value.TransId+">"+value.PlannedAmt+"</a></li>";
             output += "</ul>";
             //$.playSound("<?php //echo base_url('assets/popupnoti/slow-spring-board-longer-tail.mp3') ?>");
             new PNotify({
                  text: value.Description +'<br>'+ 'Amount: '+ value.PlannedAmt,
                  type: 'danger',
            
              });
              });
                
           }
          }
      
  });
}, 20000); // refresh every 10000 milliseconds
</script>
</body></html>