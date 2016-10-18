$(function () {
    var resizeScreen = function () {
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

        }
        else {
            $('#user-sidenav').css(
                {
                    'position': 'fixed'
                }
            );
            $('.sidenav-info').css({
                'top': '30%',
            });
            $('.sidenav-container').height($(window).height()).width($(window).width()/3);
        }
    };

    var modelInit=function () {
        $(window).resize(function () {
            resizeScreen();
        });
    };


    resizeScreen();
    modelInit();
});
//# sourceMappingURL=common.js.map
