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
            <div class="add-icon-box"><a href="<?= base_url('add-expenses')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Expense</a></div>
          </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <div id="mask"></div>
            <table id="exptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#exptabledata').DataTable( {
    "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
    dom: "lBfrtip",
     aaSorting: [[0, "desc"]],
     columnDefs: [
   { orderable: false, targets: 10 }
],
initComplete: function () {
      configFilter(this, [1,2]);
  }

  });

});
    
</script> 
<script type="text/javascript">
  function configFilter($this, colArray) {
            setTimeout(function () {
                var tableName = $this[0].id;
                var columns = $this.api().columns();
                $.each(colArray, function (i, arg) {
                    $('#' + tableName + ' th:eq(' + arg + ')').append('<i class="fa fa-filter filterIcon" onclick="showFilter(event,\'' + tableName + '_' + arg + '\')"></i>');
                });

                var template = '<div class="modalFilter">' +
                                 '<div class="modal-content">' +
                                 '{0}</div>' +
                                 '<div class="modal-footer">' +
                                     '<a href="#!" onclick="clearFilter(this, {1}, \'{2}\');"  class="sml-btn transitions">Clear</a>' +
                                     '<a href="#!" onclick="performFilter(this, {1}, \'{2}\');"  class="sml-btn transitions">Ok</a>' +
                                 '</div>' +
                             '</div>';
                $.each(colArray, function (index, value) {
                    columns.every(function (i) {
                         if (value === i) {
                            var column = this, content = '<input type="text" class="form-control filterSearchText" onkeyup="filterValues(this)" />';
                            var columnName = $(this.header()).text().replace(/\s+/g, "_");
                            var distinctArray = [];
                            column.data().each(function (d, j) {
                                if (distinctArray.indexOf(d) == -1) {
                                    var id = tableName + "_" + columnName + "_" + j; // onchange="formatValues(this,' + value + ');
                                    content += '<div class="checkbox"><label for="' + id + '"><input type="checkbox" value="' + d + '"  id="' + id + '"/> <span class="cr"><i class="cr-icon fa fa-check"></i></span> ' + d + '</label></div>';
                                    distinctArray.push(d);
                                }
                            });
                            var newTemplate = $(template.replace('{0}', content).replace('{1}', value).replace('{1}', value).replace('{2}', tableName).replace('{2}', tableName));
                            $('body').append(newTemplate);
                            modalFilterArray[tableName + "_" + value] = newTemplate;
                            content = '';
                        }
                    });
                });
            }, 50);
        }
        var modalFilterArray = {};
        //User to show the filter modal
        function showFilter(e, index) {
            $('.modalFilter').hide();
            $(modalFilterArray[index]).css({ left: 0, top: 0 });
            var th = $(e.target).parent();
            var pos = th.offset();
            $(modalFilterArray[index]).width(th.width() * 2.5);
            $(modalFilterArray[index]).css({ 'left': pos.left, 'top': pos.top });
            $(modalFilterArray[index]).show();
            //console.log(modalFilterArray);
            $('#mask').show();
            e.stopPropagation();
        }

         //This function is to use the searchbox to filter the checkbox
        function filterValues(node) {
            var searchString = $(node).val().toUpperCase().trim();
            var rootNode = $(node).parent();
            if (searchString == '') {
                rootNode.find('div').show();
            } else {
                rootNode.find("div").hide();
                rootNode.find("div:contains('" + $(node).val() + "')").show();
            }
        }

     //Execute the filter on the table for a given column
        function performFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            var searchString = '', counter = 0;

            rootNode.find('input:checkbox').each(function (index, checkbox) {
                if (checkbox.checked) {
                    searchString += (counter == 0) ? checkbox.value : '|' + checkbox.value;
                    counter++;
                }
            });
            $('#' + tableId).DataTable().column(i).search(
                searchString,
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }


        //Removes the filter from the table for a given column
        function clearFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            rootNode.find(".filterSearchText").val('');
            rootNode.find('input:checkbox').each(function (index, checkbox) {
                checkbox.checked = false;
                $(checkbox).parent().show();
            });
            $('#' + tableId).DataTable().column(i).search(
                '',
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }
</script>
<script src="<?= base_url('assets/js/pnotify.custom.min.js')?>"></script>
<script type="text/javascript">

  function minAlert(){
    var bankName = '<?php echo $_SESSION['bankName']; ?>';
    var minBal = '<?php echo $_SESSION['MinBalance']; ?>';
    var tooltip = new PNotify({
                  text: bankName +  "'s" + ' Balance Is Below Minimum Balance Of ' + minBal,
                  type: 'danger',
            
              });
  }


  <?php if (isset($_SESSION['minBal'])) { ?>
      minAlert();
      //delete minBal;
  <?php unset ( $_SESSION ['minBal'] );
} ?>

</script>