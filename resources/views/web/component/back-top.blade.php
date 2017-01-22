<style>
    input.close {
        padding: 0;
        border-width: 0;
        border-left: none;
        border-right: none;
        width: 0px;
        height: 40px;
        float: right;
        color: #999;
        transition: 0.7s;
    }

    #back-container {
        position: fixed;
        right: 2%;
        bottom: 2%;
        width: 40px;
        z-index: 9999;
    }

    #back-top {
        background-color: #fff;
        font-size: 20px;
        width: 40px;
        height: 39px;
        color: #999999;
        border: 1px solid #eeeeee;
        border-bottom: none;
        line-height: 40px;
        text-align: center;
        display: none;
        cursor: pointer;
    }

    #search {
        background-color: #f0ad4e;
        width: 40px;
        height: 40px;
        color: #fff;
        line-height: 40px;
        text-align: center;
        float: right;
        cursor: pointer;
    }

    #edit {
        background-color: #2ca02c;
        width: 40px;
        height: 40px;
        color: #fff;
        line-height: 40px;
        text-align: center;
    }

    .search-group {
        width: 240px;
        margin-left: -200px;
    }
    #faqs{
        line-height: 40px;
        width: 40px;
        height: 40px;
        background: indianred;
        color: white;
        text-align: center;
    }
</style>

<div id="back-container">
    <span id="back-top" class="glyphicon glyphicon-chevron-up"></span>
    <a href="/faqs"><span id="faqs" class="glyphicon glyphicon-question-sign"></span></a>
    <div class="search-group">
        <form action="/search">
            <input type="text" name="query" class="close" placeholder="输入完成点击回车!" id="search-block">
            <span id="search" class="glyphicon glyphicon-search close-search"></span>
            <input type="submit" style="display: none">
        </form>
    </div>
    <a href="/add-article" target="_blank">
        <span id="edit" class="glyphicon glyphicon-pencil"></span>
    </a>
</div>

<script>
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('#back-top').fadeIn(200).css('display','block');
            } else {
                $('#back-top').fadeOut(200);
            }
        });

        $('#back-top').click(function () {
            $('html,body').animate({scrollTop: 0}, 300);
        });

        $('.close-search').click(function () {
            $('#search-block').css('width', '200px').addClass('open').focus();
        });
        $('#search-block').blur(function () {
            $(this).removeClass('open').width(0);
        })
    });
</script>