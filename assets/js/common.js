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

$(document).ready(function(){
        // Show hide popover
        $(".notification-detail").click(function(){
            $(this).find(".notification-dropdown").slideToggle("fast");
        });
    });
    $(document).on("click", function(event){
        var $trigger = $(".notification-detail");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".notification-dropdown").slideUp("fast");
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

var url = window.location;

// for sidebar menu entirely
$('.menu-container .crbnMenu .menu li a').click( function(){
    if ( $(this).hasClass('current') ) {
        $(this).removeClass('current');
    } else {
        $('li a.current').removeClass('current');
        $(this).addClass('current');    
    }
});

$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

//Clone the hidden element and shows it
/*
$('.add-one').click(function(){
  $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
  attach_delete();
});


//Attach functionality to delete buttons
function attach_delete(){
  $('.delete').off();
  $('.delete').click(function(){
    console.log("click");
    $(this).closest('.form-group').remove();
  });
}
*/