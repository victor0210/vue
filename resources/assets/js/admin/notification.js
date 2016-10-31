$(function () {
    $('.choose-all').click(function () {
        $('input[type=checkbox]').attr('checked', true);
    });
    $('.choose-none').click(function () {
        $('input[type=checkbox]').attr('checked',false);
    });
})