
</div>
<!-- /#wrapper ends -->
<footer class="main-footer">
  <div class="container-fluid">© 2018 All Rights Reserved.</div>
</footer>
<!----- Footer -----> 

<!------------- Common JS -------------> 

<script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('assets/js/additional-methods.js')?>"></script>
<script src="<?= base_url('assets/js/common.js')?>"></script>


<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>"></script>
<script src="<?= base_url('assets/js/SidebarNav.min.js')?>"></script>
 <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>-->



<script>
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
    dom: "Bfrtip",
	aaSorting: [[4, "asc"]],
	//"processing": false,
	//"ajax": '<?= base_url('configuration/bank/listbankdata')?>',
    //data: data,
    //columns: columns
  });
  
   
  
  $('#tablebank').DataTable({
responsive  : true,
	ordering    : false,
	searching: true,
	aaSorting: [[3, "asc"]],
	 "paging": true,
     dom: 'lBfrtip',
     
    
});
  
  
  
});
	
</script>

</body>
</html>