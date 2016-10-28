<div style="   position: fixed;
     right: 2%;
     bottom: 2%;
width: 40px">
    <span id="back-top" class="fa fa-angle-double-up" style="
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
">
    </span>
    <a href="/add-article">
    <span id="edit" class="fa fa-pencil" style="
     background-color: #2ca02c;
     width: 40px;
     height: 40px;
     color: #fff;
     line-height: 40px;
     text-align: center;"></span>
    </a>
</div>

<script>
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {

                $('#back-top').fadeIn(200);
            } else {
                $('#back-top').fadeOut(200);
            }
        });

        $('#back-top').click(function () {
            $('html,body').animate({scrollTop: 0}, 300);
        })
    });
</script>