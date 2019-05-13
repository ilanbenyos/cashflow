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

<!-- <script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>  
 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script> 
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script> 

<script type="text/javascript">
  jQuery(function ($) {
    $(".sidebar-menu li a").click(function(e) {
            var link = $(this);
            var item = link.parent("li");
            //console.log(item);
        })
        .each(function() {
            var link = $(this);
            /*console.log(link.get(0));
            console.log(location.href);*/
            if (link.get(0).href === location.href) {
                link.addClass("active").parents("li").addClass("active");
                return false;
            }
        });
});
</script>
<script>
$(document).ready(function() {
  
$('#tablevendor').DataTable({
  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
	
	aaSorting: [[2, "asc"]],
     dom: 'lBfrtip',
     columnDefs: [
   { orderable: false, targets: 3 }
]
});
 
});
</script> 
<script type="text/javascript">
   $(document).ready(function() {
      $('select').change(function() {
            var val = $(this).val();
            if(val == -1){
              $('#tablevendor_previous').css( 'display', 'none' );
              $('#tablevendor_next').css( 'display', 'none' );
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
 
$(document).ready(function(){
  $(".xyz").each(function(event) {

    // skip for arrow keys
  if(event.which >= 37 && event.which <= 40){
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
</body></html>