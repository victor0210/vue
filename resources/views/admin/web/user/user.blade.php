@extends('admin.layout.dashboard')
@section('page_heading','User Amount : '.App\User::count().' ')
@section('section')
    <style>
        .avatar{
            width: 25px;
            height: 25px;
            border-radius: 50%;
        }
    </style>
    <div class="col-md-12" id="list-user">
        <table class="table table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Register_date</th>
            </tr>
            <tr>
                <th colspan="4">
                    <div class="row">
                        <div class="col-lg-12">
                                <input type="text"
                                       class="form-control search-input"
                                       aria-label="..."
                                       placeholder="Search for ..."
                                >
                        </div>
                    </div>
                </th>
                <th></th>
            </tr>
            <tr v-for="user in users">
                <td>@{{ user.id }}</td>
                <td><a href="/user/@{{ user.id }}" target="_blank">@{{ user.name }}</a></td>
                <td>@{{ user.email }}</td>
                <td><img src="@{{ user.avatar_url }}" alt="ava" class="avatar"></td>
                <td>@{{ user.created_at }}</td>
            </tr>
        </table>
        <nav aria-label="...">
            <ul class="pagination">
                <li>
                    <button title="@{{ previous }}" aria-label="Previous" class="btn btn-primary api-btn"><span
                                aria-hidden="true">&laquo;</span></button>
                </li>
                <li>
                    <button title="@{{ next }}" aria-label="Next" class="btn btn-primary api-btn"><span
                                aria-hidden="true">&raquo;</span></button>
                </li>
            </ul>
        </nav>
    </div>

    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="reply-info" class="text-center"></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        var userArr = [];

        var current = 1;
        var total;

        var userList = new Vue({
            el: '#list-user',
            data: {
                users: '',
                next: '',
                previous: ''
            },
            methods: {
                setData: function (data) {
                    this.users = data;
                },
                setUrl: function (data) {
                    this.next = data.next_page_url;
                    this.previous = data.prev_page_url;
                    this.current = data.current_page;
                },
                getCurrentPage: function () {
                    return this.current;
                }
            }
        });

        $('.search-input').keyup(function () {
            var val = $(this).val();
            getUser('/api/users', val);

        });

        $('.api-btn').click(function () {
            getUserPage($(this)[0].title)
        });
        var getUser= function (url, val) {
            $.ajax(url, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'get',
                data: {
                    val: val
                },
                success: function (data) {
                    console.log(data);
                    userList.setData(data);
                },
            });
        };
        var getUserPage = function (url) {
            if (!!userArr[url.split('=')[1] - 1]) {
                userList.setData(userArr[url.split('=')[1] - 1].data);
                userList.setUrl(userArr[url.split('=')[1] - 1]);
            } else {
                if (!!url.split('=')[1]) {
                    $.ajax(url, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        success: function (data) {
                            userList.setData(data.data);
                            userList.setUrl(data);
                            userArr[data.current_page - 1] = data;
                            total = data.last_page;
                            current = data.current_page;
                        }
                    });
                }
                else
                    return;

            }
        };

        getUserPage('/api/user-page?page=1')
    </script>
@endsection