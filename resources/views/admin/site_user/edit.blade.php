@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.site_user_edit')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 style="margin:0">@lang('admin/user.titles.site_user_edit')</h3>

                </div>
            </div>

            <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="POST">

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">

                        <div class="panel panel-default">
                            <div class="panel-heading"><b>@lang('admin/user.titles.info'):</b></div>
                            <div class="panel-body">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="text" name="redirect_to" value="{{ old('redirect_to') ? old('redirect_to') : URL::previous() }}" hidden>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">@lang('admin/user.labels.first_name')</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="@lang('admin/user.labels.first_name')" >
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">@lang('admin/user.labels.email')</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="@lang('admin/user.labels.email')">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="checkbox" id="changePassword">
                                    <label>
                                        <input type="checkbox" name="changePassword" v-on:click="greet" {{ old('changePassword') ? 'checked' : '' }}> @lang('admin/user.labels.change_password')
                                    </label>
                                </div>

                                <div id="new_password" {!! empty(old('changePassword')) ? 'style="display:none"' : '' !!}>

                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">@lang('admin/user.labels.new_password')</label>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="@lang('auth.labels.password')" {!! empty(old('changePassword')) ? 'disabled' : '' !!}>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm">@lang('auth.labels.password_confirm')</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="@lang('auth.labels.password_confirm')" {!! empty(old('changePassword')) ? 'disabled' : '' !!}>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
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
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> @lang('admin/common.buttons.save')</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ old('redirect_to') ? old('redirect_to') : URL::previous() }}" class="btn btn-default btn-block"><i class="fa fa-times"></i> @lang('admin/common.buttons.cancel')</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection
