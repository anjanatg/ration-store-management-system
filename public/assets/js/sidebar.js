$(document).ready(function () {

    $(document).on('click', '#sidebarToggle', function () {
        if ($(window).width() <= 991) {
            $('#sidebar').toggleClass('sidebar-open');
        } else {
            $('#sidebar').toggleClass('sidebar-hidden');
            $('.main-content').toggleClass('expanded');
        }
    });

    $(document).on('click', '#sidebarClose', function () {
        $('#sidebar').removeClass('sidebar-open');
    });

});