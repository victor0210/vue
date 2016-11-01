@extends('admin.layout.dashboard')
@section('page_heading','Audit')
@section('section')
    <div class="col-md-12">
        <table class="table table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>is_active</th>
                <th>remove</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td><a href="/user/{{ $article->user_id }}">{{ $article->user->name }}</a></td>
                    <td><a href="/content/{{ $article->id }}">{{ $article->title }}</a></td>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       {{ $article->isValidated() ? 'checked' : '' }} data-id="{{ $article->id }}">
                            </label>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger" data-id={{ $article->id }}>x</button>
                    </td>
                </tr>
            @endforeach
        </table>
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
        $(function () {
            $('input[type=checkbox]').change(function () {
                var status = $(this)[0].checked ? '1' : '0';
                var id = $(this).data('id');
                $.ajax('/api/article-status', {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        status: status,
                        id: id
                    },
                    success: function () {
                        location.reload();
                    },
                    error: function () {
                        $('#change-status-require').text('Change Failed !').css('color', 'red');
                        $('.modal').modal('show')
                    }
                });
            });

            $('.btn-danger').click(function () {
                $(this).attr('disabled',true);
                var id = $(this).data('id');
                var _this=$(this);
                $.ajax('/api/delete-article', {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function () {
                            location.reload();
                    },
                    error:function () {
                        _this.attr('disabled',false);
                    }
                });
            });
        });
    </script>
@endsection