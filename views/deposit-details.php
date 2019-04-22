<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
   
}
//print_r($_SESSION);
?>
<!-- Page Content  -->
<div id="content">
  <div class="container-fluid">
    <h1>PSP Income</h1>
    <div class="white-bg">
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="add-icon-box">
            <button type="button" id="hideRR" class="cmn-btn transitions margin-right-1x">Hide rolling reserved</button>
            <button type="button" id="showRR" class="cmn-btn transitions margin-right-1x" style="display: none">Show rolling reserved</button>
            <a href="<?= base_url('add-psp-income')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add PSP Income</a></div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <div id="mask"></div>
            <table id="psptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>PSP</th>
                  <th>Bank</th>
                  <th>Description</th>
                  <th>Proccessed Amount</th>
                  <th>Commission</th>
                  <th>Net Amount Received</th>
                  <th>Date Received</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php //$i = 1; ?>
                <?php foreach ($allPspIncome as $psp) {
                 ?>
                <tr data-user="<?php echo $psp->CRRId; ?>">
                  <td><?php echo $psp->TransId; ?></td>
                  <td><?php echo $psp->PspName; ?></td>
                  <td><?php echo $psp->BankName; ?></td>
                  <td><?php echo $psp->Description; ?></td>
                  <td><?php echo number_format($psp->ActualAmt, 2, '.', ','); ?></td>
                  <td><?php echo number_format($psp->ActualCom, 2, '.', ','); ?></td>
                  <td><?php echo number_format($psp->NetBankAmt, 2, '.', ','); ?></td>
                  <?php if ($psp->ActualDate != '0000-00-00') { ?>
                  <td><?php echo $psp->ActualDate; ?></td>
                  <?php }else{ ?>
                  <td></td>
                  <?php } ?>
                  <?php if ($psp->ActualAmt != 0.00 || $psp->NetBankAmt != 0.00) { ?>
                  <td><i class="fa fa-check" aria-hidden="true" style="color: #48ad14"></i></td>
                  <?php }else{ ?>
                  <td><i class="fa fa-times" aria-hidden="true" style="color: #d31c1c"></i></td>
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
<script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script> 
<script>
$.validate({
    modules : 'toggleDisabled',
    disabledFormFilter : 'form.toggle-disabled',

});         
</script> 
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#psptabledata').DataTable({

  "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
responsive  : true,
  
  aaSorting: [[0, "desc"]],
     dom: 'lBfrtip',

  columnDefs: [
   { orderable: false, targets: 8 },
   { orderable: false, targets: 9},
],
initComplete: function () {
      configFilter(this, [1,2]);
  }

});
    $("#hideRR").click(function() {
      $("#showRR").show();
      $("#hideRR").hide();
    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        //console.log(dataIndex);
          return $(table.row(dataIndex).node()).attr('data-user') == 0;
          myFunction();

        }
    );
    table.draw();
}); 
    $("#showRR").click(function() {
      $("#showRR").hide();
      $("#hideRR").show();
     $.fn.dataTable.ext.search.pop();
    table.draw();
});
  })
  function myFunction() {
  var x = document.getElementById("hideRR");
  if (x.innerHTML === "Hide Rolling Reserved") {
    x.innerHTML = "Show Rolling Reserved";
  } else {
    x.innerHTML = "Hide Rolling Reserved";
  }
} 
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
  function maxAlert(){
    //alert(121212);
    var bankName = '<?php echo $_SESSION['bankName']; ?>';
    var maxBal = '<?php echo $_SESSION['MaxBalance']; ?>';
    var tooltip = new PNotify({
                  text: 'Maximum Bank Balance for ' + bankName + ' is ' + maxBal,
                  type: 'danger',
            
              });
  }

  <?php if (isset($_SESSION['maxBal'])) { ?>
      maxAlert();
  <?php  unset ( $_SESSION ['maxBal'] );
} ?>
</script>