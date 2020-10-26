$('.getMovieInfo').on('click',function () {
    window.location.href = "http://localhost/EndtermProject/movinfo.php?name=" + $('h5',this).html();
});