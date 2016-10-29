<script type="text/x-tmpl" id="article-list">
    <li class="list-group-item">
    <div class="row">
        <div class="col-md-10 col-xs-8 col-sm-9 article-list-title">
            <a href="/user/{%=o.user.id%}" class="text-primary">
            {%=o.user.name %}
        <span style="color:#999;margin-bottom: 30px">· {%=o.created %}</span>
            </a>
            <h4 style="margin:10px auto">
                <a href="/content/{%=o.id%}" class="text-gray">
                    {%=o.title%}
                  </a>
            </h4>
        <h6 style="color: #999999">
               浏览({%=o.view%}) · 评论({%=o.comment_count%}) · 赞({%=o.thumb_up%}) <span class="badge">{%=o.collection%}</span>
        </h6>
        </div>
        <div class="col-md-2 col-xs-4 col-sm-3">
        {% if(!!o.avatar[0]) { %}
        <img src="{%=o.avatar[0]%}" alt="" style="border: 1px solid #eeeeee;height: 90px;width: 90px;padding: 2px;border-radius: 5px;">
        {% } %}
        </div>
    </div>
</li>
</script>