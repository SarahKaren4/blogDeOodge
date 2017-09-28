@extends('layouts.error')

@section('title')
    @lang('common.errors.403')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center">403</h2>
                </div>
                <div class="panel-body text-center">
                    <h3>@lang('common.errors.403')</h3>
                    <br>
                    <div>
                        <a class="btn btn-primary btn-lg btn-block" href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> @lang('common.buttons.back_to_previous_page')</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
