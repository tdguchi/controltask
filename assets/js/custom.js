$(function () {

    $('#toggle-menu').on('click', function () {
        $('.navbar-menu').toggleClass('menu-collapsed');
        $('.main-content').toggleClass('menu-collapsed');
        $('#page-topbar').toggleClass('menu-collapsed');
    });
});