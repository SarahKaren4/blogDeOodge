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

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">@lang('site/blog.write_comment')</div>
                        <div class="panel-body has-alert">

                            @if(Auth::guard('admin')->check() || Auth::check())
                                <form id="text_comment" action="{{ route('site.comment.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <textarea name="comment" class="form-control" placeholder="@lang('site/blog.comment_placeholder')" rows="3">{{ old('comment') }}</textarea>
                                        <input type="text" name="post" value="{{ $post->id }}" hidden>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-default">@lang('site/common.buttons.send')</button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning" role="alert">@lang('site/blog.unauthorized')</div>
                            @endif
                        </div>
                    </div>

                    <div class="comments">
                    @forelse ($post->comments as $comment)
                            @include('site.partials._comment')
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

        </div>
    </div>
</div>
@endsection

@section('bottom_scripts')
    <script type="text/javascript">
        Echo.channel('comment.{{ $post->id }}')
            .listen('NewComment', (e) => {

                var url = '{{ route("site.comment.show", ":id") }}';
                url = url.replace(':id', e.comment.id);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: url,
                    type: 'POST',
                    cache: false,
                    datatype: 'json',
                    success: function(data) {
                        $('.comments').prepend(data);
                    },
                });

            });

            $('body').on('submit', '#text_comment', function() {

                var url = '{{ route("site.comment.store") }}';
                var form = $(this);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: url,
                    data: form.serialize(),
                    type: 'POST',
                    cache: false,
                    datatype: 'json',
                    success: function(data) {
                        form.find('textarea').val('');
                    },
                });

                return false;

            });
    </script>
@endsection
