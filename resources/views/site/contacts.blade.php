@extends('layouts.site')

@section('title')
    @lang('site/blog.contacts')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="margin:0">@lang('site/blog.contacts')</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <dl class="dl-horizontal" style="margin:0">
                                <dt>@lang('site/blog.phone')</dt>
                                <dd>888-88-88-88</dd>
                                <dt>@lang('site/blog.email')</dt>
                                <dd>test@gmail.com</dd>
                                <dt>@lang('site/blog.address')</dt>
                                <dd>Israel, Tel-Aviv, Dizengoff 12 st.</dd>
                            </dl>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3380.819482699255!2d34.7778788512205!3d32.07413088109763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d4b83d3a7ed75%3A0x3de4344a1b6ae94d!2sDizengoff+St+12%2C+Tel+Aviv-Yafo%2C+Israel!5e0!3m2!1sen!2sua!4v1506439863719" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
