@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.comment_delete')?
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                        <h3 style="margin:0">@lang('admin/blog.titles.comment_delete')?</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="well">
                                {{ $comment->comment }}
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.comment.destroy', ['id' => $comment->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="text" name="redirect_to" hidden value="{{ URL::previous() }}">
                                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> @lang('admin/common.buttons.delete')</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ URL::previous() }}" class="btn btn-default btn-block">@lang('admin/common.buttons.cancel')</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
