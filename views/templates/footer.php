</div>
<!-- /#wrapper ends -->

<footer class="main-footer">
  <div class="container-fluid">© 2018 All Rights Reserved.</div>
</footer>
<!----- Footer -----> 

<!------------- Common JS -------------> 


<script src="<?= base_url('assets/js/jquery.validate.min.js')?>"></script> 
<script src="<?= base_url('assets/js/additional-methods.js')?>"></script> 
<script src="<?= base_url('assets/js/common.js')?>"></script> 
<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script> 
<script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>"></script> 
<script src="<?= base_url('assets/js/SidebarNav.min.js')?>"></script> 
<script src="<?= base_url('assets/js/jquery.dataTables.min.js')?>"></script> 
<script src="<?= base_url('assets/js/dataTables.bootstrap.js')?>"></script> 
<script>
// Sidebar js
$.sidebarMenu($('.sidebar-menu'))
	
$('#addbankform').validate({ // initialize the plugin
        rules: {
            BankName: {
                required: true,
                minlength: 3
            },
			status: {
                required: true
            }
        },
        submitHandler: function (form) { // for demo
            $("#addbankbtn").hide();
            $(".page-loader").show();
            form.submit();
        }
});
	
$(document).ready(function() {
  $('#tabledata').DataTable( {
    dom: "lBfrtip",
	aaSorting: [[4, "asc"]],
	//"processing": false,
	//"ajax": '<?= base_url('configuration/bank/listbankdata')?>',
    //data: data,
    //columns: columns
  });
  
$('#tablebank').DataTable({
responsive  : true,
	
	aaSorting: [[3, "asc"]],
     dom: 'lBfrtip',
});
$('#tablevendor').DataTable({
responsive  : true,
	
	aaSorting: [[2, "asc"]],
     dom: 'lBfrtip',
});
});
</script>
</body></html>