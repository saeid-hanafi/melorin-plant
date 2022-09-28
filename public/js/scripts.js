$(document).ready(function (){
    // Start Main Navbar Menu Scripts
    var menuLink = $("#main-menu-ul>li").find("a");
    menuLink.click(function (){
        var linkHref = $(this).attr("href");
        menuLink.removeClass("activeMenu");
        $(this).addClass("activeMenu");
    });
    // End Main Navbar Menu Scripts
});
