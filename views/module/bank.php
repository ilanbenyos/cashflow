<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
  //echo $_SESSION ['pop_mes'];
}
?>
<!-- Page Content  -->
  <!-- <div id="content">
    <div class="container-fluid"> -->
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
                      <td><a class="grey-icon edit_user" href="<?= base_url('configuration/bank/update/'.$row->BankId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      <a class="grey-icon del_bank" href="javascript:void(0);" onclick="myFunction(<?php echo $row->BankId;?>);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                     </tr>
                  <?php }?>
				
					
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal common-modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content clearfix">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 class="modal-title">Notice</h2>
            </div>
            <div class="modal-body clearfix">
              <div class="defination-box clearfix">
                <p>Are you sure You want to delete?</p>

              </div>
              <div class="col-xs-12 text-center spacetop2x">
              <button type="button" data-dismiss="modal" class="btn-submit transitions" data-value="1">Yes</button>
              <button type="button" data-dismiss="modal" class="btn-submit transitions" data-value="0">NO</button>
            </div>
            </div>
          </div>
        </div>
      </div>
    <!-- </div>
  </div> -->
  <!-- Modal -->
<script>
 
   $(document).ready(function() {
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
      });
 </script>
<script type="text/javascript">
    var url="<?php echo base_url();?>";
    function myFunction(id){
       //var r=confirm("Do you want to delete this?")
      $("#myModal2").modal('show');
      $('.transitions').click(function(){
        var r = $(this).attr('data-value');
        if (r=="1"){

          window.top.location = url+"/delete/"+id;
        }
        else{
          window.top.location = url;
        }
      });
        
        } 
</script>
<script type="text/javascript">
   $(document).ready(function() {
      $('select').change(function() {
            var val = $(this).val();
            if(val == -1){
              $('#tablebank_previous').css( 'display', 'none' );
              $('#tablebank_next').css( 'display', 'none' );
            }
      });
});
</script> 