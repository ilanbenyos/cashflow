// Dropdown & Sidebar push
$(document).ready(function(){
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