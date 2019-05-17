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
$(document).ready(function() {
  $('#tabledata').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
    aaSorting: [[4, "asc"],[0, "asc"]],
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

  $('select').change(function() {
            var val = $(this).val();
            if(val == -1){
              alert('in');
              $('#psptabledata_previous').css( 'display', 'none' );
              $('#psptabledata_next').css( 'display', 'none' );
              //$('#tabledata_previous').css( 'display', 'none' );
              //$('#tabledata_next').css( 'display', 'none' );
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

jQuery(document).ready(function ($) {
      var today = new Date();
$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
            endDate: "today",
            maxDate: today
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