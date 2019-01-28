$('#addbankform').validate({ // initialize the plugin
	
        rules: {
            BankName: {
                required: true,
                minlength: 3
            },
            BranchName: {
                required: true,
                minlength: 5
            },
			BankDesc: {
                required: true,
                minlength: 20
            },
			BankAccountNumber: {
                required: true,
                minlength: 10
            },
			Currency: {
                required: true
            },
			SwiftCode: {
                required: true,
				minlength: 4
            },
			Status: {
                required: true
            }
        },
        submitHandler: function (form) { // for demo
            $("#addbankbtn").hide();
            $(".page-loader").show();
            form.submit();
        }
    });
$(document).ready(function(){
	
	
	var $datepicker = $('#date');
    $datepicker.datepicker();
    $datepicker.datepicker('setDate', new Date());
	
	
        // Show hide popover
        $(".user-detail").click(function(){
            $(this).find(".user-dropdown").slideToggle("fast");
        });
    });
    $(document).on("click", function(event){
        var $trigger = $(".user-detail");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".user-dropdown").slideUp("fast");
        }            
    });
	$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
// Dropdown & Sidebar push ends
		
// Upload Files
function initializeFileUploads() {
    $('.file-upload').change(function () {
        var file = $(this).val();
        $(this).closest('.input-group').find('.file-upload-text').val(file);
    });
    $('.file-upload-btn').click(function () {
        $(this).find('.file-upload').trigger('click');
    });
    $('.file-upload').click(function (e) {
        e.stopPropagation();
    });
}
// On document load:
$(function() {
    initializeFileUploads();
});
// Upload Ends