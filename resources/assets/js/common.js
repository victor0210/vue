$(function () {
    var ml = 0;

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
                'background-image': 'url("' + $('.sidenav-container').data('src') + '")',
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
                'width': $(window).width() / 3.5
            }, 500, function () {
                $('#content-area').fadeIn(1000, function () {
                    $('.sidenav-info').css('top', '30%');
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
                'width': $(window).width() / 3.5
            }, 500);
        }
    };
    var resizeScreen = function () {
        $('.sidenav-container').css('transition', 'none');
        if ($(window).width() < 768) {
            $('#user-sidenav').css({'position': 'relative'});
            $('.sidenav-info').css({'top': 50});
            $('.sidenav-container').width($(window).width()).height(450);
            $('#user-sidenav').width($(window).width()).height(450);
            $('.floating').width($(window).width()).height(450);
            $('.container-fluid').css('marginLeft', 0);
            ml=0;
        }
        else {
            $('.sidenav-info').css({'top': '30%'});
            $('#user-sidenav').css({'position': 'fixed', 'width': '100%'});
            $('.floating').width($(window).width() / 3.5).height($(window).height());
            $('#user-sidenav').width($(window).width() / 3.5).height($(window).height());
            $('.sidenav-container').height($(window).height()).width($(window).width() / 3.5);
            $('.glyphicon-menu-hamburger').css({transform: "rotate(0deg)"});
            $('.navbar').css('visibility','visible');
        }
    };

    var toggledMenu = function () {
        $('.glyphicon-menu-hamburger').click(function () {
            if (ml == 0) {
                ml = 205;
                $('.container-fluid').css('marginLeft', ml + 'px');
                $(this).css({transform: "rotate(90deg)"});
                $('.navbar').fadeIn(100).css('left','0px');
            } else {
                ml = 0;
                $('.container-fluid').css('marginLeft', ml + 'px');
                $(this).css({transform: "rotate(0deg)"});
                $('.navbar').css('left','-215px');
            }
        });
    };
    initAnimation();
    toggledMenu();
    $(window).resize(function () {
        resizeScreen();
    });
});
