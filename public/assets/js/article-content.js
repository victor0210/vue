/**
 * Created by humengtao on 2017/3/6.
 */
$(function () {
    $('#reply-submit').click(function () {
        $('#reply-form').submit();
    });

    $('.reply').click(function () {
        $('input[name=receiver]').val($(this).data('receiver'));
        $('input[name=comment]').val($(this).data('comment'));
    });
    $('#thumb-up').click(function () {
        var url = '/api/thumbs';
        $.ajax(url, {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            data: {
                'article_id': $('#article-main-content').data('article-id'),
                'user_id': $('#article-main-content').data('user-id')
            },
            success: function (data) {
                $('#thumb-up').html('已赞 <span class="fa fa-thumbs-up"></span>').attr('disabled', 'disabled');
            }
        });
    });
    $('[data-toggle="tooltip"]').tooltip()
})

//# sourceMappingURL=article-content.js.map
