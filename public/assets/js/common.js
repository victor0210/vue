$(function () {
    var ml = 0;
    var moblie_sidenav_eight=250;
    var initAnimation = function () {
        if ($(window).width() < 768) {
            $('body').css('overflowX', 'hidden');
            $('#content-area').css({'display': 'block'});
            $('#user-sidenav').css(
                {
                    'display': 'block',
                    'position': 'relative',
                }
            );
            $('.sidenav-container').css({
                'background-image': 'url("' + $('.sidenav-container').data('src') + '")',
                'background-size': 'cover',
                'background-repeat': 'no-repeat',
                'background-position': 'center'
            });
            $('.sidenav-container').width($(window).width()).height(moblie_sidenav_eight);
            $('.floating').width($(window).width()).height(moblie_sidenav_eight);
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
                'width': $(window).width() / 4.5
            }, 500, function () {
                $('#content-area').fadeIn(1000, function () {
                    $('.sidenav-info').css('top', '25%');
                });
                $('.sidenav-container').css({
                    'background-image': 'url("' + $('.sidenav-container').data('src') + '")',
                    'background-size': 'cover',
                    'background-repeat': 'no-repeat',
                    'background-position': 'center',
                    'transition': '1s'
                });
            });
            $('.sidenav-container').height($(window).height()).width($(window).width()).fadeIn(500).animate({
                'width': $(window).width() / 4.5
            }, 500);
        }
    };
    var resizeScreen = function () {
        $('.sidenav-container').css('transition', 'none');
        $('.navbar').css('left', '-215px');
        $('.glyphicon-menu-hamburger').css({transform: "rotate(0)"});
        ml = 0;

        if ($(window).width() < 768) {
            $('#user-sidenav').css({'position': 'relative'});
            $('.sidenav-container').width($(window).width()).height(moblie_sidenav_eight);
            $('#user-sidenav').width($(window).width()).height(moblie_sidenav_eight);
            $('.floating').width($(window).width()).height(moblie_sidenav_eight);
            $('.container-fluid').css('marginLeft', 0);
            $('.sidenav-info').css({'top': '0%'});
        }
        else {
            $('.container-fluid').css('marginLeft', ml + 'px');
            $('.sidenav-info').css({'top': '25%'});
            $('#user-sidenav').css({'position': 'fixed', 'width': '100%'});
            $('.floating').width($(window).width() / 4.5).height($(window).height());
            $('#user-sidenav').width($(window).width() / 4.5).height($(window).height());
            $('.sidenav-container').height($(window).height()).width($(window).width() / 4.5);
            $('.glyphicon-menu-hamburger').css({transform: "rotate(0deg)"});
            $('.navbar').css('visibility', 'visible');
        }
    };

    var toggledMenu = function () {
        $('.glyphicon-menu-hamburger').click(function () {
            if ($(window).width() > 768) {
                if (ml == 0) {
                    ml = 215;
                    $('.container-fluid').css('marginLeft', ml + 'px');
                    $(this).css({transform: "rotate(90deg)"});
                    $('.navbar').fadeIn(100).css('left', '0px');
                } else {
                    ml = 0;
                    $('.container-fluid').css('marginLeft', ml + 'px');
                    $(this).css({transform: "rotate(0deg)"});
                    $('.navbar').css('left', '-215px');
                }
            } else {
                if (ml == 0) {
                    menuOut();
                } else {
                    menuIn();
                }
            }
        });
    };

    var swipeMenu = function () {
        $('.container-fluid').on('swipeleft', function () {
            if (ml == $(window).width()) {
                menuIn();
            } else {
                return
            }
        });
        $('.container-fluid').on('swiperight', function () {
            if (ml == 0) {
                menuOut();
            } else {
                return
            }
        });
    };

    var menuIn = function () {
        ml = 0;
        $(this).css({transform: "rotate(0deg)"});
        $('.navbar').css({'left': '-215px'});
    };

    var menuOut = function () {
        ml = $(window).width();
        $(this).css({transform: "rotate(90deg)"});
        $('.navbar').fadeIn(100).css('left', '0px');
    };

    initAnimation();
    toggledMenu();
    swipeMenu();
    $(window).resize(function () {
        resizeScreen();
    });
});

//# sourceMappingURL=common.js.map
