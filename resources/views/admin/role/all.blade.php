@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.roles')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/user.titles.roles')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('admin.role.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</a>
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
                                <th>@lang('admin/user.tables.role')</th>
                                <th>@lang('admin/user.tables.name')</th>
                                <th>@lang('admin/user.tables.description')</th>
                                <th>@lang('admin/user.tables.dates')</th>
                                <th>@lang('admin/user.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        {{ $role->created_at }}<br>{{ $role->updated_at }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.role.show', ['id' => $role->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> @lang('admin/common.buttons.view')</a>
                                        <a href="{{ route('admin.role.edit', ['id' => $role->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> @lang('admin/common.buttons.edit')</a>
                                        <a href="{{ route('admin.role.delete', ['id' => $role->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($roles->lastPage() > 1)
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $roles->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
