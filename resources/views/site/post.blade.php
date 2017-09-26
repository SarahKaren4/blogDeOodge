@extends('layouts.site')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="margin:0">{{ $post->title }}</h2>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <small>
                        <i class="fa fa-clock-o"></i> {{ $post->created_at }}&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-user"></i> {{ $post->user->name }}&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-list"></i>
                        @foreach($post->categories as $category)
                            <a href="{{ route('site.category.show', ['slug' => $category->slug]) }}">{{ $category->title }}</a>{{ !$loop->last ? ',' : ''}}

                        @endforeach
                    </small>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <img class="img-thumbnail pull-left" style="width:auto" src="{{ asset('images/posts/small/' . $post->image) }}" alt="">
                    {!! $post->description !!}
                </div>
            </div>


            @forelse ($post->comments as $comment)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <small>
                            <i class="fa fa-clock-o"></i> {{ $comment->created_at }}&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-user"></i> {{ $comment->user->name }}
                            @if($comment->user instanceof App\Models\Admin)
                                <span class="label label-warning">@lang('site/blog.admin')</span>
                            @endif
                        </small>
                    </div>
                    <div class="panel-body">
                        {{ $comment->comment }}
                    </div>
                </div>
            @empty
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>@lang('site/blog.no_comments')</p>
                    </div>
                </div>
            @endforelse


        </div>
    </div>
</div>
@endsection
