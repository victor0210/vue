@extends('admin.layout.layout')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/admin.css') }}">
@endsection

@section('content')
    <div class="container" id="main-content">
        <div class="row">
            <div class="col-md-3 col-sm-6" id="dashboard-panel">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">Articles</a></li>
                    <li role="presentation"><a href="#">Users</a></li>
                    <li role="presentation"><a href="#">Messages</a></li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-6" id="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            <input type="text" class="form-control" placeholder="Search for...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection