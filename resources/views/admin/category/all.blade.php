@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.categories')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/blog.titles.categories')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</a>
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
                                <th>@lang('admin/blog.tables.status')</th>
                                <th style="min-width:220px">@lang('admin/blog.tables.timestamps')</th>
                                <th style="min-width:350px">@lang('admin/blog.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{!! $category->status ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-ban text-danger"></i>' !!}</td>
                                    <td>
                                        <i class="fa fa-plus"></i> {{ $category->created_at }}<br>
                                        <i class="fa fa-refresh"></i> {{ $category->updated_at }}<br>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.category.show', ['id' => $category->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> @lang('admin/common.buttons.view')</a>
                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> @lang('admin/common.buttons.edit')</a>
                                        <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($categories->lastPage() > 1)
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
