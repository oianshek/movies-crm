$('.news').on('click', function () {
    window.location.href = "http://localhost/EndtermProject/readNews.php?title=" + $('h5', this).html();
});