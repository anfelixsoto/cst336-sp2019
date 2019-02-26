$(document).ready(function() {
    console.log("running on ready");

    var currentLeft;
    $('#box').click(function() {
        currentLeft = $('#box').css("left");
        $('#box').animate({ left: '250px' });
        setTimeout(function() {
            $('#box').animate({ left: `$(currentLeft)` });
        }, 2000)
    });

});
