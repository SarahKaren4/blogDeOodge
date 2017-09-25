@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.posts')
@endsection

@section('top_styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/blog.titles.posts')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('admin.post.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="GET" action="{{ route('admin.posts') }}">
                        <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">@lang('admin/blog.labels.title'): </label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ request()->input('title') }}" placeholder="@lang('admin/blog.labels.title')">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="user">@lang('admin/blog.labels.user'): </label>
                                <input type="text" class="form-control" name="user" id="user" value="{{ request()->input('user') }}" placeholder="@lang('admin/blog.labels.user')">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">@lang('admin/blog.labels.status'): </label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">@lang('admin/blog.labels.all')</option>
                                    <option value="1" {{ request()->input('status') === '1' ? 'selected' : '' }}>Anabled</option>
                                    <option value="0" {{ request()->input('status') === '0' ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="category">@lang('admin/blog.labels.category'): </label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">@lang('admin/blog.labels.all')</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="published_at">@lang('admin/blog.labels.published_at'): </label>
                                <input type="text" class="form-control" id="published_at" name="published_at" value="{{ request()->filled('published_at') ? request()->input('published_at') : '' }}" placeholder="@lang('admin/blog.labels.published_at')" >
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> @lang('admin/common.buttons.search')</button>
                            <a href="{{ route('admin.posts') }}" class="btn btn-default btn-block"><i class="fa fa-ban"></i> @lang('admin/common.buttons.cancel')</a>
                        </div>

                        </div>

                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('admin/blog.tables.id')</th>
                                <th>@lang('admin/blog.tables.image')</th>
                                <th>@lang('admin/blog.tables.title')</th>
                                <th>@lang('admin/blog.tables.categories')</th>
                                <th>@lang('admin/blog.tables.user')</th>
                                <th>@lang('admin/blog.tables.status')</th>
                                <th style="min-width:220px">@lang('admin/blog.tables.timestamps')</th>
                                <th style="min-width:150px">@lang('admin/blog.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <img src="{{ asset('images/posts/small/' . $post->image) }}" width="80">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <ul>
                                            @foreach($post->categories as $category)
                                                <li>{{ $category->title }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{!! $post->status ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-ban text-danger"></i>' !!}</td>
                                    <td>
                                        <i class="fa fa-plus"></i> {{ $post->created_at }}<br>
                                        <i class="fa fa-refresh"></i> {{ $post->updated_at }}<br>
                                        <i class="fa fa-calendar-check-o"></i> {{ $post->published_at }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.post.show', ['id' => $post->id]) }}" class="btn btn-default btn"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" class="btn btn-default btn"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.post.delete', ['id' => $post->id]) }}" class="btn btn-danger btn"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($posts->lastPage() > 1)
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $posts->appends(request()->input())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@section('bottom_scripts')

<script type="text/javascript" src="{{ asset('js/moment-with-locales.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>

$('#published_at').datetimepicker({

    format: 'D, MM, YYYY',
    dayViewHeaderFormat: 'MMMM YYYY',
    sideBySide: true,
    showClose: true,
    widgetPositioning: {
        horizontal: 'auto',
        vertical: 'bottom',
    },
    locale: '{{ Config::get("app.locale") }}',

});

</script>

@endsection
