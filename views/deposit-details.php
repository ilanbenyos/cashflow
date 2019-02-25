<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>PSP Income</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
            <div class="add-icon-box"><a href="<?= base_url('add-psp-income')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add PSP Income</a></div>
          </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table id="psptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Bank</th>
                  <th>PSP</th>
                  <th>Description</th>
                  <th>Amount Received</th>
                  <th>Commission</th>
                  <th>Net Amount Received</th>
                  <th>Date Received</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php //$i = 1; ?>
                <?php foreach ($allPspIncome as $psp) {
                 ?>
                 <tr>
                  <td><?php echo $psp->TransId; ?></td>
                  <td><?php echo $psp->BankName; ?></td>
                  <td><?php echo $psp->PspName; ?></td>
                  <td><?php echo $psp->Description; ?></td>
                  <td><?php echo number_format($psp->ActualAmt); ?></td>
                  <td><?php echo number_format($psp->ActualCom); ?></td>
                  <td><?php echo number_format($psp->ActualNetAmt); ?></td>
                  <?php if ($psp->ActualDate != '0000-00-00') { ?>
                  <td><?php echo $psp->ActualDate; ?></td>
                  <?php }else{ ?>
                  <td></td>
                  <?php } ?>
                  <td><a class="grey-icon edit_pspdetails" href="<?= base_url('psp_income/update/'.$psp->TransId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                 </tr>
             <?php  //$i++; 
           } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function numberWithCommas(n) {
    var parts=n.toString().split(".");
    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
}
</script>