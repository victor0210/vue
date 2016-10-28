$(function () {
    var page_latest = 3;
    var page_hottest = 3;
    $('.thumbnail img').height($('.thumbnail img').width());
    $(window).resize(function () {
        $('.thumbnail img').height($('.thumbnail img').width());
    })

    $('.show-more').click(function () {
        $(this).css('backgroundColor', '#fff').find('span').hide();
        $(this).find('img').show();
        var status = $(this).data('status');
        switch (status) {
            case 'latest':
                var page = page_latest++;
                break;
            case 'hottest':
                var page = page_hottest++;
                break;
        }
        $.ajax('/api/articles-list?page=' + page, {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            data: {status: status},
            success: function (data) {
                if (data.next_page_url == null) {
                        $('.show-more[data-status=' + status + ']').text('No More !').attr('disabled', 'disabled');
                }
                if (data.data != '') {
                    var data = data.data;
                    data.map(function (index) {
                        var text = tmpl('article-list', index);
                        $('#' + status).append(text);
                    });
                    $('.show-more[data-status=' + status + ']').find('span').show();
                    $('.show-more[data-status=' + status + ']').css('backgroundColor', '#5cbe5c').find('img').hide();
                }
            },
            error: function () {
                alert('请求失败');
            }
        });
    });
});

//# sourceMappingURL=article.js.map
