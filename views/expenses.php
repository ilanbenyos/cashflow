<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>Expenses</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
            <div class="add-icon-box"><a href="<?= base_url('add-expenses')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Expenses</a></div>
          </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <table id="psptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Transaction Id</th>
                  <th>Vendor</th>
                  <th>Bank</th>
                  <th>Transfer Type </th>
                  <th>Description</th>
                  <th>Actual Amount</th>
                  <th>Shares</th>
                  <th>Final Bank Commission</th>
                  <th>Net From Bank</th>
                  <th>Date Received</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php //$i = 1; ?>
                <?php foreach ($getallExpenses as $exp) {
                 ?>
                 <tr>
                  <td><?php echo $exp->TransId; ?></td>
                  <td><?php echo $exp->VendorName; ?></td>
                  <td><?php echo $exp->BankName; ?></td>
                  <td><?php echo $exp->BanktransferName; ?></td>
                  <td><?php echo $exp->Description; ?></td>
                  <td><?php echo number_format($exp->ActualAmt, 2, '.', ','); ?></td>
                  <td><?php echo number_format($exp->Share, 2, '.', ','); ?></td>
                  <td><?php echo number_format($exp->FinalBankComm, 2, '.', ','); ?></td>
                  <td><?php echo number_format($exp->NetFromBank, 2, '.', ','); ?></td>
                  <?php if ($exp->ActualDate != '0000-00-00') { ?>
                  <td><?php echo $exp->ActualDate; ?></td>
                  <?php }else{ ?>
                  <td></td>
                  <?php } ?>
                  <td><a class="grey-icon" href="<?= base_url('expenses/update/'.$exp->TransId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
