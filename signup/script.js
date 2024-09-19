$(document).ready(function() {
    $('#hamburgesa').click(function(e) {
        e.preventDefault();
        $('#menu').toggleClass('active');
        $('.logoCH2').toggleClass('opacity');
        $('.button-control').toggleClass('opacity');
        $('.CodeHarbor').toggleClass('opacity');
        $('.footer').toggleClass('opacity');
        $('#signup-section').toggleClass('opacity');
        $('.ImgBack').toggleClass('opacity');
        const actualRoute = $(this).attr('src');

        if (actualRoute == 'hamburgesa.png') {
            $(this).attr('src', '../cross.png');
        } else {
            $(this).attr('src', '../hamburgesa.png');
        }
    });
});