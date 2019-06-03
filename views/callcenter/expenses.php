<?php 
if (isset ( $_SESSION ['pop_mes'] )) {
   popup2 ();
}
//print_r($Vendor_details);
//print_r($_SESSION);
?>

<!-- Page Content  -->
<!-- <?php if ($_SESSION['user_role'] == "Call Center User") { ?>
<div id="content">
  <div class="container-fluid"> 
  <?php } ?> -->

<div class="row clearfix">
<div class="col-md-4"><h1>Call Center Expenses</h1></div>
<?php  if ($_SESSION['user_role'] == "Call Center User") { ?>
    <div class="col-md-8 current-blnc"><h4>Current Balance : <?php echo number_format($Vendor_details->CallCenterCashBalance, 2, '.', ','); ?></h4></div>
  <?php } ?>
</div><div class="white-bg">
  <div class="row">
    <?php  if ($_SESSION['user_role'] == "Call Center User") { ?>
    <div class="col-md-12 text-right">
      <div class="add-icon-box">
        <button type="button" id="generateInvoice" class="cmn-btn transitions margin-right-1x" style="display:none;">Generate</button>
        <!--Fund Request Modal -->
        <button type="button" data-toggle="modal" data-target="#myModal"  class="cmn-btn transitions margin-right-1x" >Fund Request</button>
        <!--Fund Request Modal -->
        <div class="page-loader" style="display:none;">
          <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
        </div>
        <a href="<?= base_url('call-center-expenses')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Expense</a></div>
    </div>
    <?php  }elseif ($_SESSION['user_role'] == "Admin") { ?>
    <div class="col-md-12 text-right">
      <div class="add-icon-box">
        <button type="button" id="generateInvoiceAdmin" class="cmn-btn transitions margin-right-1x">Generate</button>
        <div class="page-loader" style="display:none;">
          <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
        </div>
        <a href="<?= base_url('call-center-expenses')?>"><span class="plus-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>Add Expense</a></div>
    </div>
    <?php  } ?>
    <div class="col-md-12">
      <div class="table-responsive common-table">
        <?php if($_SESSION['user_role'] == "Admin"){ ?>
        <form id="filterForm" action="<?php echo base_url('callcenter/add_expenses/invoiceForVendor') ?>" method="post">
          <div id="mask"></div>
          <table id="exptabledata" class="table table-hover" cellpadding="0" cellspacing="0">
            <thead>
              <tr> 
                <!-- <th><input name="select_all" value="1" id="example-select-all" type="checkbox" /></th> -->
                <th>Id</th>
                <th>Call Center</th>
                <th>Expense Name</th>
                <th>Expense Amount</th>
                <th>Payment Type</th>
                <th>Expense Date </th>
                <th>Invoice</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allexpenses as $key => $exp) { 
                  ?>
            <input name="expid[]" value="<?php echo $exp->ExpId; ?>" id="expid" type="hidden" />
            <tr> 
              <!-- <td><input name="expid[]" value="<?php echo $exp->ExpId; ?>" id="expid" type="hidden" /></td> -->
              <td><?php echo $exp->ExpId; ?></td>
              <td><?php echo $exp->VendorName; ?></td>
              <td><?php echo $exp->Category; ?></td>
              <td><?php echo number_format($exp->EuroValue); ?></td>
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
              <?php if ($exp->IsInvoiceGen == 0) { ?>
              <td><a class="grey-icon del_bank" href="javascript:void(0);" onclick="myFunction(<?php echo $exp->ExpId;?>);"><i class="fa fa-trash-o" aria-hidden="true"></i></a> <a class="grey-icon" href="<?= base_url('callcenter/Add_expenses/update/'.$exp->ExpId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
              <?php }else{ ?>
              <td><a class="grey-icon" href="<?= base_url('callcenter/Add_expenses/update/'.$exp->ExpId)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
              <?php } ?>
            </tr>
            <?php   } ?>
              </tbody>
            
          </table>
        </form>
        <?php }else if($_SESSION['user_role'] == "Call Center User"){ ?>
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
    <!--  Delete modal starts -->
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
    <!--  Delete modal ends --> 
    <!--  Invoice modal starts -->
    <div class="modal common-modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
      <div class="modal-dialog" role="document">
        <div class="modal-content clearfix">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Notice</h2>
          </div>
          <div class="modal-body clearfix">
            <div class="defination-box clearfix">
              <p>To Generate Invoice, Filter Data For Specific Call Center</p>
            </div>
            <div class="col-xs-12 text-center spacetop2x">
              <button type="button" data-dismiss="modal" class="btn-submit transitions invoice" data-value="1">OK</button>
              <!-- <button type="button" data-dismiss="modal" class="btn-submit transitions invoice" data-value="0">NO</button> --> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  Invoice modal ends --> 
    <!-- Request Fund Modal -->
    <div class="modal common-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content clearfix">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Request for Fund</h2>
          </div>
          <div class="modal-body clearfix">
            <div class="defination-box clearfix">
              <form class="form-horizontal clearfix" method="post" id="request_fund_form">
                <?php 
					  $token = md5(uniqid(rand(), TRUE));
					  if(isset ($_SESSION['new_category']))
					  {
						unset($_SESSION['new_category']);
					  }
					  $_SESSION['new_category'] = $token;
					?>
                <input type="hidden" name="category_token" value="<?php echo $token;?>">
                <input type="hidden" name="VendorID" value="<?php echo $userdetails->CallCenterVendorId; ?>">
                <input type="hidden" name="Currency" value="<?php echo $userdetails->Currency; ?>">
                <input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>">
                <div class="row clearfix spacetop4x">
                  <div class="clearfix">
                    <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12">Fund Amount</label>
                          <div class="col-md-1 col-sm-1"><span><?php echo $userdetails->CurName; ?></span></div>
                          <div class="col-md-7 col-sm-7 col-xs-12"> 
                            <input type="text" class="form-control" name="Amount" id="Amount" placeholder="Amount" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 hidden-md hidden-sm hidden-xs"></div>
                  </div>
                  <div class="col-xs-12 text-center spacetop4x">
                    <div class="page-loader" style="display:none;">
                      <div class="page-wrapper"> <span class="loader"><span class="loader-inner"></span></span> </div>
                    </div>
                    <button type="button" class="btn-submit transitions" id="request_fund_submit">Submit</button>
                    <button type="reset" class="btn-reset transitions">Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Request Fund Modal --> 
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

    /*$("#generateInvoiceAdmin").click(function(){
      $("#generateInvoiceAdmin").hide();
      

      $.ajax({
                url:"<?php echo base_url ('callcenter/add_expenses/generateInvoiceAdmin')?>",
                    type: "POST",
                    dataType: "html",
                   success: function(data) {
                    alert(data);
                    $("#myModal3").modal('show');
                    generateInvoice();
                    
                   }
               });
    })*/
  });
</script> 
<script type="text/javascript">

  function compare(array) {
    var isSame = true;
    for(var i=0; i < array.length; i++) {
       isSame = array[0] === array[i] ? true : false;
    }
    return isSame;
}

const isUniqueArr = arr => {
  const tmp = new Set(arr);
  if(tmp.size > 1) {
    return false;
  }
  return arr[0];
}
  $(document).ready(function(){
     var user = '<?php echo $_SESSION['user_role']; ?>';
    if (user == "Admin") {
         var table = $('#exptabledata').DataTable( {
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
    }else{
      var table = $('#exptabledata').DataTable( {
          "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
          dom: "lBfrtip",
           aaSorting: [[0, "desc"]],
           columnDefs: [
         { orderable: false, targets: 6 }
      ]

        });
    }

    /*$('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      console.log(rows);
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

$('#exptabledata tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });*/
   	  $("#request_fund_submit").click(function(){
      var returnvar = true;
      
      if($("#Amount").val() ==""){
           $("#Amount").css("border", "1px solid #be1622");           
           returnvar = false;
          }
          if(returnvar == true){  
              $.ajax({
                url:"<?php echo base_url ('callcenter/add_expenses/AddFundReuest')?>",
                    type: "POST",
                    data : $("#request_fund_form").serialize(),
                    dataType: "html",
                   success: function(data) {
						if(data == 1){
                      window.location.href = '<?php echo base_url('all-expenses') ?>';
                    }else{
                      window.location.href = '<?php echo base_url('all-expenses') ?>';
                    }
                   }
               });

     }  
     return returnvar;
      });
   $("#generateInvoiceAdmin").click(function(){
      $("#generateInvoiceAdmin").hide();

           var array = [];
    table.column(1,  { search:'applied' } ).data().each(function(value, index) {
        array.push(value);
    });
    var vendors = isUniqueArr(array);
    //var vendors = compare(array);
    //alert(vendors);
    if (vendors == false) {
      $("#myModal3").modal('show');
      generateInvoice();
    }else{
      //alert('qqq');
      $.ajax({
                url:"<?php echo base_url ('callcenter/add_expenses/invoiceForVendor')?>",
                    type: "POST",
                    dataType: "html",
                    data:{vendor:array},
                   success: function(data) {
                    //console.log(data);
                    if(data == 1){
                      window.location.href = '<?php echo base_url('all-expenses') ?>';
                    }else{
                      window.location.href = '<?php echo base_url('all-expenses') ?>';
                    }
                   }
               });

    }
    
    //alert(vendors);
    //console.log(compare(array));
          /*$.ajax({
                url:"<?php echo base_url ('callcenter/add_expenses/generateInvoiceAdmin')?>",
                    type: "POST",
                    dataType: "html",
                   success: function(data) {
                    alert(data);
                    $("#myModal3").modal('show');
                    generateInvoice();
                    
                   }
               });
*/        //}
      

      
    })

   

});

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
                                     '<a href="#!" onclick="performFilter(this, {1}, \'{2}\');"  class="sml-btn transitions" id="chk">Ok</a>' +
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
<script type="text/javascript">
    var updateUrl="<?php echo base_url('callcenter/add_expenses/delete/');?>";

    var redirectUrl="<?php echo base_url('all-expenses')?>";
   // alert(url);
    function myFunction(id){
      $("#myModal2").modal('show');
      $('.transitions').click(function(){
        var r = $(this).attr('data-value');
        if (r=="1"){
          window.top.location = updateUrl+id;
        }
        else{
          window.top.location = redirectUrl;
        }
      });
        
    } 


    function generateInvoice(){
      $('.invoice').click(function(){
        var r = $(this).attr('data-value');
        //alert(r);
        if (r=="1"){
          window.location.href = '<?php echo base_url('callcenter/add_expenses/allExpenses') ?>';
          /*$.ajax({
                url:"<?php echo base_url ('callcenter/add_expenses/generateInvoice')?>",
                    type: "POST",
                    dataType: "html",
                   success: function(data) {
                    window.location.href = '<?php echo base_url('all-expenses') ?>';
                   }
               });*/
        }/*
        else{
          form.submit()
        }*/
      });
        
    }
</script>