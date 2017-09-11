@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.permissions')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/user.titles.permissions')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('admin.permission.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('admin/user.tables.id')</th>
                                <th>@lang('admin/user.tables.permission')</th>
                                <th>@lang('admin/user.tables.name')</th>
                                <th>@lang('admin/user.tables.description')</th>
                                <th>@lang('admin/user.tables.dates')</th>
                                <th>@lang('admin/user.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>
                                        {{ date('j, m, Y | g:i a', strtotime($permission->created_at)) }}<br>
                                        {{ date('j, m, Y | g:i a', strtotime($permission->created_at)) }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.permission.edit', ['id' => $permission->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> @lang('admin/common.buttons.edit')</a>
                                        <a href="{{ route('admin.permission.delete', ['id' => $permission->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($permissions->lastPage() > 1)
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $permissions->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
