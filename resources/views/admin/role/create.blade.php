@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.role_create')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 style="margin:0">@lang('admin/user.titles.role_create')</h3>

                </div>
            </div>

                    <form action="{{ route('admin.role.store') }}" method="POST">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>@lang('admin/user.titles.info'):</b></div>
                                    <div class="panel-body">

                                        {{ csrf_field() }}
                                        <input type="text" name="redirect_to" value="{{ old('redirect_to', URL::previous()) }}" hidden>
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">@lang('admin/user.labels.name')</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="@lang('admin/user.labels.name')" autofocus>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                                            <label for="display_name">@lang('admin/user.labels.display_name')</label>
                                            <input type="text" class="form-control" id="display_name" name="display_name" value="{{ old('display_name') }}" placeholder="@lang('admin/user.labels.display_name')">
                                            @if ($errors->has('display_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('display_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label for="description">@lang('admin/user.labels.description')</label>
                                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="@lang('admin/user.labels.description')">
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 {{ $errors->has('description') ? 'has-error' : '' }}">

                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>@lang('admin/user.titles.permissions'):</b></div>
                                    <div class="panel-body">

                                        <div style="overflow-y:scroll;height:200px;">

                                        @foreach($permissions as $permission)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $permission->id }}" name="permissions[]"
                                                {{ is_array(old("permissions")) && in_array($permission->id, old("permissions")) ? "checked" : "" }}>
                                                {{ $permission->display_name }}
                                            </label>
                                        </div>
                                        @endforeach

                                        </div>

                                        @if ($errors->has('permissions'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('permissions') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ old('redirect_to', URL::previous()) }}" class="btn btn-default btn-block"><i class="fa fa-times"></i> @lang('admin/common.buttons.cancel')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>



        </div>
    </div>
</div>

@endsection
