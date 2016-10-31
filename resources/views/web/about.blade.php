@extends('layouts.app')

@section('title', 'About Us')

@section('tab','3')

@section('extra-css-js')
    <style>
        .connection span {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row connection">
        <div class="col-md-10 col-sm-10">
            <h1 class="text-left text-gray page-header">About Us !</h1>
            <p class="text-left" style="color: #999">
                这里是一个看起来像博客的交流平台,大家可以在这里留下自己喜欢的文章,发表自己独到的见解。到了这里,可以瞬间拥有一个简易博客,尽情享受吧!</p>
            <p class="text-left" style="color: #999">意见建议请联系:</p>
            <p class="text-left"><span class="fa fa-qq" data-type="qq"> QQ : 305945915</span></p>
            <p class="text-left"><span class="fa fa-weixin" data-type="weixin"> 微信 : HMT19940210</span></p>
            <p class="text-left"><span class="fa fa-weibo" data-type="weibo"> 官方微博 : 河同学姓胡</span></p>
        </div>
    </div>

    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="reply-info" class="text-center"><img src="{{ elixir('images/qq.jpg') }}"
                                                                style="max-width: 100%"></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $('.fa').click(function () {
            var type = $(this).data('type');
            $('.modal-body img').attr('src', '/images/' + type + '.jpg');
            $('.modal').modal();
        })
    </script>
@endsection