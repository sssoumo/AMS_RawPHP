$(document).ready(function () {

    $("#btn1").click(function () {
        $(".mobile").hide(1000);
        $(".webpage").show(1000);
    });

    $("#btn2").click(function () {
        $(".webpage").hide(1000);
        $(".mobile").show(1000);
    });

    $("#btn3").click(function () {
        $(".webpage").show(1000);
        $(".mobile").show(1000);
    });
});