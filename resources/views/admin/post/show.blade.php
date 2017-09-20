@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.posts_show')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h3 style="margin:0">@lang('admin/blog.titles.posts_show')</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-hand-o-left"></i> @lang('admin/blog.buttons.back_posts')</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">

                    <div class="panel panel-default">
                        <div class="panel-heading"><b>@lang('admin/blog.titles.info'):</b></div>
                        <div class="panel-body">

                            <dl>
                                <dt>@lang('admin/blog.labels.slug'):</dt>
                                <dd>{{ $post->slug }}</dd>

                                <dt>@lang('admin/blog.labels.status'):</dt>
                                <dd>{{ $post->status ? __('admin/blog.texts.active') : __('admin/blog.texts.disabled') }}</dd>

                                <dt>@lang('admin/common.labels.created_at'):</dt>
                                <dd>{{ $post->created_at }}</dd>

                                <dt>@lang('admin/common.labels.updated_at'):</dt>
                                <dd>{{ $post->updated_at }}</dd>

                                <dt>@lang('admin/blog.labels.published_at'):</dt>
                                <dd>{{ $post->published_at }}</dd>
                            </dl>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"><b>@lang('admin/blog.labels.image'):</b></div>
                        <div class="panel-body">

                            @if($post->image)
                                <img src="{{ asset('images/posts/small/' . $post->image) }}" style="width:100%">
                            @endif

                        </div>
                    </div>

                </div>
                <div class="col-md-8">

                    <div class="panel panel-default">
                        <div class="panel-heading"><b>@lang('admin/blog.titles.content'):</b></div>
                        <div class="panel-body">

                            <h2 style="margin-top:5px">{{ $post->title }}</h2>
                            <br>
                            <div>{!! $post->description !!}</div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"><b>@lang('admin/blog.titles.meta_data'):</b></div>
                        <div class="panel-body">

                            <div><b>@lang('admin/blog.labels.meta-title'):</b> {{ $post->meta_title }}</div>
                            <br>
                            <div><b>@lang('admin/blog.labels.meta-description'):</b> {{ $post->meta_description }}</div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

@endsection
