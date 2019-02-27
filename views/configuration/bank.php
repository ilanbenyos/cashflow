<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
  //echo $_SESSION ['pop_mes'];
}
?>
<!-- Page Content  -->
  <div id="content">
    <div class="container-fluid">
      <h1>Bank Accounts</h1>
      <div class="white-bg">
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="add-icon-box"><a href="<?= base_url('configuration/bank/add')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add New Bank</a></div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive common-table">
              <table id="tablebank" class="table table-hover" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th>Bank Name</th>
                    <th>Balance</th>
                    <th>Currency</th>
					          <th>Created By</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
				
				 <?php 
				 //	print_r($results);
				 foreach ($results as $row) { ?>
                     <tr>
                        <td><?php echo $row->BankName; ?></td>
                        <td class="extra-right-space"><?php echo number_format($row->Balance, 2, '.', ','); ?></td>
                        <td><?php echo $row->CurName; ?></td>
                        <td><?php echo $row->Name; ?></td>
				    <td><?php if($row->Active == "1" ){ echo '<span class="completed bold">Active</span>' ; }else{ echo  '<span class="pending bold">Disabled</span>' ;} ?></td>
                      <td><a class="grey-icon edit_user" href="<?= base_url('configuration/bank/update/'.$row->BankId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                     </tr>
                  <?php }?>
				
					
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
 
