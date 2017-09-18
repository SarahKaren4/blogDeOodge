@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.posts_create')
@endsection

@section('top_styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 style="margin:0">@lang('admin/blog.titles.posts_create')</h3>

                </div>
            </div>

            <form action="{{ route('admin.post.store') }}" method="POST">

                {{ csrf_field() }}
                <input type="text" name="redirect_to" value="{{ old('redirect_to') ? old('redirect_to') : URL::previous() }}" hidden>

                <div class="row">
                    <div class="col-md-6">

                        <div class="panel panel-default">
                            <div class="panel-heading"><b>@lang('admin/blog.titles.info'):</b></div>
                            <div class="panel-body">

                                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                    <label for="slug">@lang('admin/blog.labels.slug')</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="@lang('admin/blog.labels.slug')" autofocus>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('slug') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('created_at') ? 'has-error' : '' }}">
                                    <label for="created_at">@lang('admin/blog.labels.created_at')</label>
                                    <input type="text" class="form-control" id="created_at" name="created_at" value="{{ old('created_at') ? old('created_at') : date('j.m.Y g:i:s a') }}" placeholder="@lang('admin/blog.labels.created_at')" autofocus>
                                    @if ($errors->has('created_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('created_at') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="panel panel-default">
                            <div class="panel-heading"><b>@lang('admin/blog.titles.categories'):</b></div>
                            <div class="panel-body">

                                <div style="overflow-y:scroll;height:200px;">

                                @foreach($categories as $category)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="{{ $category->id }}" name="categories[]"
                                        {{ is_array(old("categories")) && in_array($category->id, old("categories")) ? "checked" : "" }}>
                                        {{ $category->title }}
                                    </label>
                                </div>
                                @endforeach

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading"><b>@lang('admin/blog.titles.categories'):</b></div>
                            <div class="panel-body">

                                <div>

                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                                  </ul>

                                  <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">fdghfhgfjhg</div>
                                    <div role="tabpanel" class="tab-pane" id="profile">54646456</div>
                                  </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>


            </form>

        </div>
    </div>
</div>

@endsection

@section('bottom_scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/ru.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>

$('#created_at').datetimepicker({

    format: 'D.MM.YYYY hh:mm:SS a',
    dayViewHeaderFormat: 'MMMM YYYY',
    sideBySide: true,
    showClose: true,
    widgetPositioning: {
        horizontal: 'auto',
        vertical: 'bottom',
    },
    locale: '{{ Config::get("app.locale") }}',

});

$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

</script>

@endsection
