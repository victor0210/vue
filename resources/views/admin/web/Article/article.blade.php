@extends('admin.layout.dashboard')
@section('page_heading','Articles')
@section('section')
    <div class="col-md-12" id="list-article">
        <table class="table table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Collection</th>
                <th>Date</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary dropdown-toggle search-input-select"
                                            data-toggle="dropdown" onkeyup="search()"
                                            aria-haspopup="true" aria-expanded="false">ID
                                    </button>
                                    <ul class="dropdown-menu search-input">
                                        <li><a href="javascript:void(0)" data-key="id">ID</a></li>
                                        {{--<li><a href="javascript:void(0)" data-key="title">Title</a></li>--}}
                                        {{--<li><a href="javascript:void(0)">Author</a></li>--}}
                                        {{--<li><a href="javascript:void(0)" data-key="collection">Collection</a></li>--}}
                                    </ul>
                                </div>
                                <input type="text" class="form-control search-input" aria-label="..."
                                       placeholder="Search for ...">
                            </div>
                        </div>
                    </div>
                </th>
                <th></th>
            </tr>
            {{--@foreach($articles as $article)--}}
            {{--<tr>--}}
            {{--<td>{{ $article->id }}</td>--}}
            {{--<td><a href="/content/{{ $article->id }}" target="_blank">{{ $article->title }}</a></td>--}}
            {{--<td>{{ $article->user->name }}</td>--}}
            {{--<td>{{ $article->collection ? $article->collection : 'None' }}</td>--}}
            {{--<td>{{ $article->created_at }}</td>--}}
            {{--<td>--}}
            {{--<a href="categories/edit/{{ $article->id }}" class="btn btn-danger"><span--}}
            {{--class="glyphicon glyphicon-remove"></span> Remove</a>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--@endforeach--}}
            <tr v-for="article in articles">
                <td>@{{ article.id }}</td>
                <td><a href="/content/@{{ article.id }}" target="_blank">@{{ article.title }}</a></td>
                <td>@{{ article.user_id}}</td>
                <td>@{{ article.collection@ ? article.collection : 'None' }}</td>
                <td>@{{ article.created_at }}</td>
                <td>
                    <a href="categories/edit/@{{ article.id }}" class="btn btn-danger"><span
                                class="glyphicon glyphicon-remove"></span> Remove</a>
                </td>
            </tr>
        </table>
        <nav aria-label="...">
            <ul class="pagination">
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
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
        var articleList = new Vue({
            el: '#list-article',
            data: {
                articles: ''
            },
            methods: {
                setData: function (data) {
                    this.articles = data;
                }
            }
        });

        $('.search-input').keyup(function () {
            var val = $(this).val();
            getArticle(val);

        });

        var getArticle = function (val) {

            $.ajax('/api/articles', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'get',
                data: {
                    key: 'id',
                    val: val
                },
                success: function (data) {
                    articleList.setData(data);
                },
            });
        };

        getArticle('all')
    </script>
@endsection