@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.role_show')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/user.titles.role_show')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-hand-o-left"></i> @lang('admin/user.buttons.role_back')</a>
                        </div>
                    </div>

                </div>
            </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <dl>
                                        <dt>@lang('admin/user.labels.name'):</dt>
                                        <dd>{{ $role->name }}</dd>
                                        <dt>@lang('admin/user.labels.display_name'):</dt>
                                        <dd>{{ $role->display_name }}</dd>
                                        <dt>@lang('admin/user.labels.description'):</dt>
                                        <dd>{{ $role->description }}</dd>
                                    </dl>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 {{ $errors->has('description') ? 'has-error' : '' }}">

                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <b>@lang('admin/user.titles.permissions'):</b>

                                    <ul>
                                        @foreach($role->permissions as $permission)
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
