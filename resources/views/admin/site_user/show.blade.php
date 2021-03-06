@extends('layouts.admin')

@section('title')
    @lang('admin/user.titles.site_user_show')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/user.titles.site_user_show')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-hand-o-left"></i> @lang('admin/user.buttons.user_back')</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <dl class="dl-horizontal">
                                <dt>@lang('admin/user.labels.first_name'):</dt>
                                <dd>{{ $user->name }}</dd>

                                <dt>@lang('admin/user.labels.email'):</dt>
                                <dd>{{ $user->email }}</dd>

                                <dt>@lang('admin/common.labels.created_at'):</dt>
                                <dd>{{ $user->created_at }}</dd>

                                <dt>@lang('admin/common.labels.updated_at'):</dt>
                                <dd>{{ $user->updated_at }}</dd>
                            </dl>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection
