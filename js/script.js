$('.links').addClass('mt-3');
$("document").ready(function () {
    $('.btn').mouseover(function () {
        $(this).addClass('btn-outline-light text-dark');
        $(this).css('border-color', 'black');
    });

    $('.btn').mouseout(function () {
        $(this).removeClass('btn-outline-light text-dark');
        $(this).css('border-color', 'white');
    });

    $('#go').mouseover(function () {
        $(this).addClass('text-dark');
        $(this).css('background-color', 'white');
    });

    $('#go').mouseout(function () {
        $(this).removeClass('btn-outline-light text-dark');
        $(this).css('background-color', '#1a2a45');
    });

    $('.news').mouseover(function(){
        $(this).css('border','2px solid #ccc');
        $(this).css('border-radius','10px');
    });

    $('.news').mouseout(function(){
        $(this).css('border','none');
    });
});