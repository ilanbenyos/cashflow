<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->

<div id="content">
  <div class="container-fluid">
    <h1>Expense</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="add-icon-box">
            <button type="button" id="generateInvoice" class="cmn-btn transitions margin-right-1x">Generate</button>
            <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>  
            <a href="<?= base_url('call-center-expenses')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Expense</a></div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table id="exptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Transaction Id</th>
                  <th>Expense Name</th>
                  <th>Expense Amount</th>
                  <th>Payment Type</th>
                  <th>Expense Date </th>
                  <th>Invoice</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($expenses as $key => $exp) { 
                  //print_r($exp);
                  ?>
                <tr>
                  <td><?php echo $exp->ExpId; ?></td>
                  <td><?php echo $exp->Category; ?></td>
                  <td><?php echo number_format($exp->ExpAmount); ?></td>
                  <td><?php echo $exp->ExpPaymentType; ?></td>
                  <?php if ($exp->ExpDate != '0000-00-00') { ?>
                  <td><?php echo $exp->ExpDate; ?></td>
                  <?php }else{ ?>
                  <td></td>
                  <?php } ?>
                  <?php if ($exp->IsInvoiceGen == 1 || $exp->IsInvoiceGen == 2) { ?>
                  <td><i class="fa fa-check" aria-hidden="true" style="color: #48ad14"></i></td>
                  <?php }else{ ?>
                  <td><i class="fa fa-times" aria-hidden="true" style="color: #d31c1c"></i></td>
                  <?php } ?>
                  <td><a class="grey-icon" href="<?= base_url('callcenter/Add_expenses/update/'.$exp->ExpId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                </tr>
                <?php   } ?>
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#generateInvoice").click(function(){
      $("#generateInvoice").hide();
      /*$(".page-loader").show();*/
      
      $.ajax({
                url:"<?php echo base_url ('callcenter/add_expenses/generateInvoice')?>",
                    type: "POST",
                    dataType: "html",
                   success: function(data) {
                    console.log(data);
                    if(data == 1){
                      window.location.href = '<?php echo base_url('all-expenses') ?>';
                    }else{
                      window.location.href = '<?php echo base_url('all-expenses') ?>';
                    }
                   }
               });
    })
  });
  /*function myFunction() {
  setTimeout(function(){  }, 3000);
}*/
</script> 
<script type="text/javascript">
  $(document).ready(function(){
    $('#exptabledata').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
     aaSorting: [[4, "desc"]],
     columnDefs: [
   { orderable: false, targets: 6 }
]

  });

});
    
</script> 