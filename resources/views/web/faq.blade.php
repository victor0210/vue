@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
    <style>
        img{
            max-width: 50%;
        }
    </style>

    <div class="row connection">
        <div class="col-md-10 col-sm-10">
            <h1 class="page-header">网站新手指南</h1>
            <h2>一.快捷按钮组</h2>
            <h3>1.右下方的按钮组,从上到下.</h3>
            <p>1.1 BackTop:当页面往下滚动一定距离自动出现,点击后返回顶部 <br>
                1.2 FAQ:点击进入新手指南页面 <br>
                1.3 Search:点击弹出搜索框,搜索对应的文章标题即可 <br>
                1.4 Writing:点击进入文章编辑页面 <br><img src="{{ elixir('images/faq-1.png') }}" alt=""></p>
            <h2>二.菜单<small>网站中枢</small></h2>
            <h3>1.电脑用户</h3>
            <p>1.1 点击左上角的菜单按钮弹出菜单 <br>
                <img src="{{ elixir('images/faq-2.png') }}" alt="" data-action="zoom"></p>
            <h3>2.手机用户</h3>
            <p>1.1 点击左上角的菜单按钮弹出菜单 <br>
                <img src="{{ elixir('images/faq-3.png') }}" alt="" data-action="zoom"></p>
        </div>
    </div>
@endsection