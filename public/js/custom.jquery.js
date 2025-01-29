// public/js/custom.jquery.js

$(document).ready(function () {
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);

        if ($target.length) {
            $('html, body').animate({
                scrollTop: $target.offset().top
            }, 800, function () {
                window.location.hash = target;
            });
        }
    });
});
