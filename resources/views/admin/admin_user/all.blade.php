@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.admin_users')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/user.titles.admin_users')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('admin.admin.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</a>
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
                                <th>@lang('admin/user.tables.first_name')</th>
                                <th>@lang('admin/user.tables.email')</th>
                                <th>@lang('admin/user.tables.role')</th>
                                <th>@lang('admin/user.tables.dates')</th>
                                <th>@lang('admin/user.tables.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @foreach($admin->roles as $role)
                                            {{ $role->display_name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $admin->created_at }}<br>{{ $admin->updated_at }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.admin.show', ['id' => $admin->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> @lang('admin/common.buttons.view')</a>
                                        <a href="{{ route('admin.admin.edit', ['id' => $admin->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> @lang('admin/common.buttons.edit')</a>
                                        <a href="{{ route('admin.admin.delete', ['id' => $admin->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($admins->lastPage() > 1)
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $admins->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
