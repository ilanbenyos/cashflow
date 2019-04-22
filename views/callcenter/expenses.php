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
        <?php if ($_SESSION['user_role'] == "Call Center User") { ?>
          <div class="col-md-12 text-right">
          <div class="add-icon-box">
            <button type="button" id="generateInvoice" class="cmn-btn transitions margin-right-1x">Generate</button>
            <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>  
            <a href="<?= base_url('call-center-expenses')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Expense</a></div>
        </div>
       <?php  } ?>
        
        <div class="col-md-12">
          <div class="table-responsive common-table">
            <?php if($_SESSION['user_role'] == "Admin"){ ?>
              <div id="mask"></div>
              <table id="exptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Call Center</th>
                  <th>Expense Name</th>
                  <th>Expense Amount</th>
                  <th>Payment Type</th>
                  <th>Expense Date </th>
                  <th>Invoice</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($allexpenses as $key => $exp) { 
                  //print_r($exp);
                  ?>
                <tr>
                  <td><?php echo $exp->ExpId; ?></td>
                  <td><?php echo $exp->VendorName; ?></td>
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
                  <!-- <td><a class="grey-icon" href="<?= base_url('callcenter/Add_expenses/update/'.$exp->ExpId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td> -->
                </tr>
                <?php   } ?>
              </tbody>
            </table>
            <?php }else{ ?>
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
           <?php  }
            ?>
            
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
     aaSorting: [[0, "desc"]],
     columnDefs: [
   { orderable: false, targets: 6 }
],
initComplete: function () {
  if (user == "Admin") {
    configFilter(this, [1]);
  }
  }

  });

});
    
</script>
<script type="text/javascript">
  var user = '<?php echo $_SESSION['user_role']; ?>';
  if (user == "Admin") {
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
  }
</script>