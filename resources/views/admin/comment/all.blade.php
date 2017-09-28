@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.comments')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 style="margin:0">@lang('admin/blog.titles.comments')</h3>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('admin/blog.tables.id')</th>
                                <th>@lang('admin/blog.tables.comment')</th>
                                <th>@lang('admin/blog.tables.user')</th>
                                <th>@lang('admin/blog.tables.post')</th>
                                <th>@lang('admin/blog.tables.status')</th>
                                <th style="min-width:210px">@lang('admin/blog.tables.timestamps')</th>
                                <th style="min-width:100px">@lang('admin/blog.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->post->title }}</td>
                                    <td>{!! $comment->status ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-ban text-danger"></i>' !!}</td>
                                    <td>
                                        <i class="fa fa-plus"></i> {{ $comment->created_at }}<br>
                                        <i class="fa fa-refresh"></i> {{ $comment->updated_at }}<br>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.comment.edit', ['id' => $comment->id]) }}" class="btn btn-default btn"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.comment.delete', ['id' => $comment->id]) }}" class="btn btn-danger btn"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($comments->lastPage() > 1)
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $comments->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
