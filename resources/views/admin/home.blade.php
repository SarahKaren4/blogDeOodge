@extends('layouts.admin')

@section('title', 'Admin Home page')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">



            <div class="row">

                <div class="col-md-4 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><i class="fa fa-user-secret fa-5x"></i></div>
                            <div>
                                <h3>
                                    <a class="home_menu_link" href="{{ route('admin.admins') }}">
                                        @lang('admin/common.menu.admin_users')
                                        <span class="label label-default">{{ $countAdmins }}</span>
                                    </a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><i class="fa fa-user fa-5x"></i></div>
                            <div>
                                <h3>
                                    <a class="home_menu_link" href="{{ route('admin.users') }}">
                                        @lang('admin/common.menu.site_users')
                                        <span class="label label-default">{{ $countUsers }}</span>
                                    </a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><i class="fa fa-unlock-alt fa-5x"></i></div>
                            <div>
                                <h3>
                                    <a class="home_menu_link" href="{{ route('admin.roles') }}">
                                        @lang('admin/common.menu.roles')
                                        <span class="label label-default">{{ $countRoles }}</span>
                                    </a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-4 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><i class="fa fa-pencil fa-5x"></i></div>
                            <div>
                                <h3>
                                    <a class="home_menu_link" href="{{ route('admin.posts') }}">
                                        @lang('admin/common.menu.posts')
                                        <span class="label label-default">{{ $countPosts }}</span>
                                    </a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><i class="fa fa-list fa-5x"></i></div>
                            <div>
                                <h3>
                                    <a class="home_menu_link" href="{{ route('admin.categories') }}">
                                        @lang('admin/common.menu.categories')
                                        <span class="label label-default">{{ $countCategories }}</span>
                                    </a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><i class="fa fa-comment fa-5x"></i></div>
                            <div>
                                <h3>
                                    <a class="home_menu_link" href="{{ route('admin.comments') }}">
                                        @lang('admin/common.menu.comments')
                                        <span class="label label-default">{{ $countComments }}</span>
                                    </a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
