@extends('admin.layout.dashboard')
@section('page_heading','Collection Amount : '.App\Models\Collection::count())
@section('section')
    <div class="col-md-12">
        <table class="table table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image_Url</th>
                <th>Preview</th>
                <th>is_active</th>
                <th></th>
            </tr>
            @foreach($collections as $collection)
                <tr>
                    <td>{{ $collection->id }}</td>
                    <td>{{ $collection->name }}</td>
                    <td>{{ $collection->image }}</td>
                    <td><img src="{{ $collection->image }}" alt="" style="width: 40px;" data-action="zoom"></td>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       {{ $collection->isActive() ? 'checked' : '' }} data-id="{{ $collection->id }}">
                            </label>
                        </div>
                    </td>
                    <td>
                        <a href="categories/edit/{{ $collection->id }}" class="btn btn-warning"><span
                                    class="glyphicon glyphicon-edit"></span> Edit Image</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="categories/add-new-collection" class="btn btn-primary btn-lg">Add New Collection</a>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="change-status-require" class="text-center"></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        $('input[type=checkbox]').change(function () {
            var status = $(this)[0].checked ? '1' : '0';
            var id = $(this).data('id');
            $.ajax('/api/collection-status', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    status: status,
                    id: id
                },
                success: function () {
                    $('#change-status-require').text('Change Success !').css('color','green');
                    $('.modal').modal('show')
                },
                error:function () {
                    $('#change-status-require').text('Change Failed !').css('color','red');
                    $('.modal').modal('show')
                }
            });
        });
    </script>
@endsection