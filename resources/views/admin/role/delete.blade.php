@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.role_delete') "{{ $role->name }}" ?
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                        <h3 style="margin:0">@lang('admin/user.titles.role_delete') "{{ $role->display_name }}" ?</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="alert alert-danger" role="alert">@lang('admin/user.texts.role_relations')</div>

                            <table class="table">
                                <thead>
                                    <th>@lang('admin/user.tables.relation_name')</th>
                                    <th>@lang('admin/user.tables.relations_count')</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>@lang('admin/user.tables.permissions')</td>
                                        <td>{{ $role->permissions()->count() }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin/user.tables.admins')</td>
                                        <td>{{ $role->admins()->count() }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin/user.tables.users')</td>
                                        <td>{{ $role->users()->count() }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.role.destroy', ['id' => $role->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="text" name="redirect_to" hidden value="{{ URL::previous() }}">
                                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ URL::previous() }}" class="btn btn-default btn-block">@lang('admin/common.buttons.cancel')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
