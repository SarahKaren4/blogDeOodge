@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.admin_user_show')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/user.titles.admin_user_show')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-hand-o-left"></i> @lang('admin/user.buttons.admin_back')</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>@lang('admin/user.titles.info'):</b></div>
                        <div class="panel-body">

                            <dl class="dl-horizontal">
                                <dt>@lang('admin/user.labels.first_name'):</dt>
                                <dd>{{ $admin->name }}</dd>

                                <dt>@lang('admin/user.labels.email'):</dt>
                                <dd>{{ $admin->email }}</dd>

                                <dt>@lang('admin/user.labels.role'):</dt>
                                <dd>
                                    @foreach($admin->roles as $role)
                                        {{ $role->display_name }}
                                    @endforeach
                                </dd>

                                <dt>@lang('admin/common.labels.created_at'):</dt>
                                <dd>{{ $admin->created_at }}</dd>

                                <dt>@lang('admin/common.labels.updated_at'):</dt>
                                <dd>{{ $admin->updated_at }}</dd>
                            </dl>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading"><b>@lang('admin/user.titles.permissions'):</b></div>
                        <div class="panel-body {{ $errors->has('roles') ? 'has-error' : '' }}">

                            <ul>
                            @foreach($admin->allPermissions() as $permission)
                                <li>{{ $permission->display_name }}</li>
                            @endforeach
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
