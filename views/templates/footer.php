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
<script src="<?= base_url('assets/js/crbnMenu.js')?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>"></script> 
<script src="<?= base_url('assets/js/SidebarNav.min.js')?>"></script> 
<script src="<?= base_url('assets/js/jquery.dataTables.min.js')?>"></script> 
<script src="<?= base_url('assets/js/dataTables.bootstrap.js')?>"></script> 
<script src="<?= base_url('assets/js/pnotify.custom.min.js')?>"></script>
<script>
$(document).ready(function(){
if ($('.sidebar-menu li.treeview:last-child').hasClass('active')){
     $(".sidebar-menu li:first-child .treeview-menu").addClass("fade-in");
}
else{
   $('.sidebar-menu li:first-child .treeview-menu').addClass('rotated')
}
});
</script> 
<script>
        if ($(window)) {
            $(function () {
                $('.menu').crbnMenu({
                    hideActive: true
                });
            });
        }
    </script>
<!--<script>
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    document.getElementByClass('treeview-menu').className = 'slideDown';
  }, 5000);
}, false);
</script>--> 
<script>
    $.sidebarMenu($('.sidebar-menu'))
</script> 
<script>	
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
  /*$('#tabledata').DataTable( {
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
  });*/
  
/*$('#tablebank').DataTable({
  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
	
	aaSorting: [[3, "desc"]],
     dom: 'lBfrtip',

  columnDefs: [
   { orderable: false, targets: 4 },
   { orderable: false, targets: 5 }
]
});*/
/*$('#tablevendor').DataTable({
  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
	
	aaSorting: [[2, "asc"]],
     dom: 'lBfrtip',
     columnDefs: [
   { orderable: false, targets: 3 }
]
});*/
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
 /*$('#tablebankTrans').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
  aaSorting: [[0, "desc"]],
    columnDefs: [
   { orderable: false, targets: 6 }
]
  });*/
 /*$('#tabledataPsp').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
     aaSorting: [[5, "asc"]],

  });*/
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
   /*$(document).ready(function() {
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
});*/
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
$('input.xyz').keyup(function(event) {
            
            
            // When user select text in the document, also abort.
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
                return;
            }
            
            // When the arrow keys are pressed, abort.
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                return;
            }
            
            
            var $this = $( this );
            
            // Get the value.
            var input = $this.val();
            
            var input = input.replace(/[\D\s\._\-]+/g, "");
                    input = input ? parseInt( input, 10 ) : 0;

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "en-IN" );
                    } );
        } );
$(document).ready(function(){
  $(".xyz").each(function(event) {
    // skip for arrow keys
  if(event.which >= 37 && event.which <= 40 && event.which == 9){
    event.preventDefault();
  }

    $(this).val(function(index, value) {
    return value

      //.replace(/\D/g, "")
        //.replace(/([0-9])([0-9]{2})$/, '$1.$2')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
    ;
    //console.log(value);
  });
});
});

$(document).keydown(function(objEvent) {
  //alert(2222);
    if (objEvent.keyCode == 9 && objEvent.keyCode >= 37 && objEvent.keyCode <= 40) {  //tab pressed
        objEvent.preventDefault(); // stops its action

      $('input.xyz').keydown(function(event) {

  $(this).val(function(index, value) {
    return value
      .replace(/\D/g, "")
      .regex(^(0|[1-9]\d*)$)
     // .replace(/([0-9])([0-9]{2})$/, '$1.$2')
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")

    
  });
});
    }
    
})
</script> 
</body></html>