@extends('admin.layout.dashboard')
@section('page_heading','Collections')
@section('section')
    <div class="col-md-4">
        <form action="./" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group form-horizontal">
                <input type="hidden" name="name" value="{{ $name }}">
                Image: <input type="file" name="image" accept="image/*" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
@endsection