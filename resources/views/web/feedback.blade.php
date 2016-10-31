@extends('layouts.app')

@section('title', 'FAQ')

@section('tab',7)

@section('content')
    <div class="row">
        <div class="col-md-10 col-sm-10">
            <h1 class="page-header">
                <small>
                    意见建议
                </small>
            </h1>
            <div class="form-group">
                <form action="/feedback" method="post">
                    <label for="feedback">在下方写下您想对我们说的话 !</label>
                    <textarea name="feedback" id="feedback" class="form-control"></textarea>
                    <input type="submit" class="btn btn-success form-control" style="margin-top: 20px">
                </form>
            </div>
        </div>
    </div>
@endsection