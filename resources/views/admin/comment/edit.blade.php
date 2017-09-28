@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.comment_edit')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 style="margin:0">@lang('admin/blog.titles.comment_edit')</h3>

                </div>
            </div>

            <form action="{{ route('admin.comment.update', ['id' => $comment->id]) }}" method="POST">

                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" name="redirect_to" value="{{ old('redirect_to', URL::previous()) }}" hidden>

                <div class="panel panel-default">
                    <div class="panel-body">

                        <dl class="dl-horizontal">
                            <dt>@lang('admin/blog.tables.user')</dt>
                            <dd>{{ $comment->user->name }}</dd>

                            <dt>@lang('admin/blog.tables.post')</dt>
                            <dd>{{ $comment->post->title }}</dd>
                        </dl>

                        <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                            <label for="comment">@lang('admin/blog.labels.comment')</label>
                            <textarea style="height:150px;" class="form-control" id="comment" name="comment" placeholder="@lang('admin/blog.labels.comment')">{{ old('comment', $comment->comment) }}</textarea>
                            @if ($errors->has("comment"))
                                <span class="help-block">
                                    <strong>{{ $errors->first("comment") }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label for="status">@lang('admin/blog.labels.status')</label><br>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default {{ old('status', $comment->status) ? 'active' : '' }}">
                                    <input value="1" name="status" type="radio" autocomplete="off" {{ old('status', $comment->status) ? 'checked' : '' }}> <i class="fa fa-check-square-o"></i> Active
                                </label>
                                <label class="btn btn-default {{ old('status', $comment->status) ? '' : 'active' }}">
                                    <input value="0" name="status" type="radio" autocomplete="off" {{ old('status', $comment->status) ? '' : 'checked' }}> <i class="fa fa-ban"></i> Disabled
                                </label>
                            </div>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
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
