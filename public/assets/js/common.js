$(function () {
    var initAnimation = function () {
        if ($(window).width() < 768) {
            $('#content-area').css('display', 'block');
            $('#user-sidenav').css(
                {
                    'display': 'block',
                    'position': 'relative',
                }
            );
            $('.sidenav-container').css({
                'background-image': 'url("/images/bg8.jpg")',
                'background-size': 'cover',
                'background-repeat': 'no-repeat',
                'background-position': 'center'
            });
            $('.sidenav-info').css({
                'top': 50
            });
            $('.sidenav-container').width($(window).width()).height(450);
            $('.floating').width($(window).width()).height(450);

        }
        else {
            $('.sidenav-info').css({
                'top': '-1000px',
                'transition': '1s'
            });
            $('#user-sidenav').css(
                {
                    'position': 'fixed',
                    'width': '100%'
                }
            );
            $('#user-sidenav').width($(window).width()).height($(window).height()).fadeIn(500).animate({
                'width': $(window).width() / 3
            }, 500, function () {
                $('#content-area').fadeIn(1000, function () {
                    $('.sidenav-info').css('top', '30%');
                });
                $('.sidenav-container').css({
                    'background-image': 'url("'+ $('.sidenav-container').data('src') +'")',
                    'background-size': 'cover',
                    'background-repeat': 'no-repeat',
                    'background-position': 'center',
                    'transition': '1s'
                });
            });
            $('.sidenav-container').height($(window).height()).width($(window).width()).fadeIn(500).animate({
                'width': $(window).width() / 3
            }, 500);
        }
    };
    var resizeScreen = function () {
        $('.sidenav-container').css('transition', 'none');
        if ($(window).width() < 768) {
            $('#user-sidenav').css(
                {
                    'position': 'relative',
                }
            );
            $('.sidenav-info').css({
                'top': 50
            });
            $('.sidenav-container').width($(window).width()).height(450);
            $('#user-sidenav').width($(window).width()).height(450);
            $('.floating').width($(window).width()).height(450);
        }
        else {
            $('.sidenav-info').css({
                'top': '30%'
            });
            $('#user-sidenav').css(
                {
                    'position': 'fixed',
                    'width': '100%'
                }
            );
            $('.floating').width($(window).width() / 3).height($(window).height());
            $('#user-sidenav').width($(window).width() / 3).height($(window).height());
            $('.sidenav-container').height($(window).height()).width($(window).width() / 3);
        }
    };

    initAnimation();
    $(window).resize(function () {
        resizeScreen();
    });
});

//# sourceMappingURL=common.js.map
