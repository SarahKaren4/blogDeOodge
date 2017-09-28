@extends('layouts.site')

@section('title')
    @lang('site/blog.about_us')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="margin:0">@lang('site/blog.about_us')</h2>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    @lang('site/blog.about_text')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
