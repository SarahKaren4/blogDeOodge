@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.posts')
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('admin/blog.tables.id')</th>
                                <th>@lang('admin/blog.tables.title')</th>
                                <th>@lang('admin/blog.tables.categories')</th>
                                <th>@lang('admin/blog.tables.user')</th>
                                <th>@lang('admin/blog.tables.comments')</th>
                                <th>@lang('admin/blog.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <ul>
                                            @foreach($post->categories as $category)
                                                <li>{{ $category->title }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->comments->count() }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.post.show', ['id' => $post->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> @lang('admin/common.buttons.view')</a>
                                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> @lang('admin/common.buttons.edit')</a>
                                        <a href="{{ route('admin.post.delete', ['id' => $post->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</a>
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
                        {{ $posts->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
