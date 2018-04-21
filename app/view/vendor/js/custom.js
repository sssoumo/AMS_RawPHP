$(document).ready(function () {

    // Minimize Button in Panels
    $('.minimize').click(function () {
        var t = $(this);
        var p = t.closest('.panel');
        if (!$(this).hasClass('maximize')) {
            p.find('.panel-body, .panel-footer').slideUp(200);
            t.addClass('maximize');
            t.html('<i class="fa fa-plus"></i>');
        } else {
            p.find('.panel-body, .panel-footer').slideDown(200);
            t.removeClass('maximize');
            t.html('<i class="fa fa-minus"></i>');
        }
        return false;
    });
    // Close Button in Panels
    $('.panel .panel-close').click(function () {
        $(this).closest('.panel').fadeOut(200);
        return false;
    });

    // Sidebar Toggle
    $('.menutoggle').click(function (){
        if($('body').hasClass('left-panel-collapse')){
            $('body').removeClass('left-panel-collapse');
        } else{
            $('body').addClass('left-panel-collapse');
        }
    });

    //$('a[href="#"]').attr('href','');
});