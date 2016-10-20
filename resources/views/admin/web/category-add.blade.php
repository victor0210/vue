@extends('admin.layout.dashboard')
@section('page_heading','Add New Collection')
@section('section')
    <div class="col-md-4">
        <form action="./add-new-collection" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group form-horizontal">
                Name: <input type="text" name="name" class="form-control">
                Image: <input type="file" name="image" accept="image/*" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
@endsection