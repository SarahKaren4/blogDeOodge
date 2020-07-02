@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.posts_create')
@endsection

@section('top_styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
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

            <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                <input type="text" name="redirect_to" value="{{ old('redirect_to', URL::previous()) }}" hidden>

                <div class="row">
                    <div class="col-md-4">

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

                                <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
                                    <label for="slug">@lang('admin/blog.labels.choose_categories')</label>
                                    <select class="js-multiple-select" name="categories[]" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ is_array(old("categories")) && in_array($category->id, old("categories")) ? "selected" : "" }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('categories'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('categories') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                                    <label for="published_at">@lang('admin/blog.labels.published_at')</label>
                                    <input type="text" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', date('j, m, Y | g:i:s a')) }}" placeholder="@lang('admin/blog.labels.published_at')" autofocus>
                                    @if ($errors->has('published_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('published_at') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="status">@lang('admin/blog.labels.status')</label><br>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default {{ old('status') ? 'active' : '' }}">
                                            <input value="1" name="status" type="radio" autocomplete="off" {{ old('status') ? 'checked' : '' }}> <i class="fa fa-check-square-o"></i> Publié
                                        </label>
                                        <label class="btn btn-default {{ old('status') ? '' : 'active' }}">
                                            <input value="0" name="status" type="radio" autocomplete="off" {{ old('status') ? '' : 'checked' }}> <i class="fa fa-ban"></i> Brouillon
                                        </label>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="well {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label for="image">@lang('admin/blog.labels.image')</label>
                                    <input type="file" id="image" name="image">
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="panel panel-default">
                            <div class="panel-heading"><b>@lang('admin/blog.titles.content'):</b></div>
                            <div class="panel-body">

                                <div>

                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs" role="tablist">
                                      @foreach(config('translatable.locales') as $locale)
                                          <li role="presentation" class="{{ $loop->first ? 'active' : '' }}">
                                              <a href="#{{ $locale }}" aria-controls="{{ $locale }}" role="tab" data-toggle="tab">
                                                  <i class="fa fa-language"></i> {{ strtoupper($locale) }}
                                              </a>
                                          </li>
                                      @endforeach
                                  </ul>

                                  <!-- Tab panes -->
                                  <div class="tab-content">
                                      @foreach(config('translatable.locales') as $locale)
                                          <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}" id="{{ $locale }}">

                                              <br>
                                              <div class="form-group {{ $errors->has('title-'.$locale.'') ? 'has-error' : '' }}">
                                                  <label for="title-{{ $locale }}">@lang('admin/blog.labels.title')</label>
                                                  <input type="text" class="form-control" id="title-{{ $locale }}" name="title-{{ $locale }}" value="{{ old('title-'.$locale.'') }}" placeholder="@lang('admin/blog.labels.title')">
                                                  @if ($errors->has("title-$locale"))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first("title-$locale") }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                              <div class="form-group {{ $errors->has('description-'.$locale.'') ? 'has-error' : '' }}">
                                                  <label for="description-{{ $locale }}">@lang('admin/blog.labels.description')</label>
                                                  <textarea style="height:250px;" class="form-control" id="description-{{ $locale }}" name="description-{{ $locale }}" placeholder="@lang('admin/blog.labels.description')">
                                                      {{ old('description-'.$locale.'') }}
                                                  </textarea>
                                                  @if ($errors->has("description-$locale"))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first("description-$locale") }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                              <div class="form-group {{ $errors->has('meta-title-'.$locale.'') ? 'has-error' : '' }}">
                                                  <label for="meta-title-{{ $locale }}">@lang('admin/blog.labels.meta-title')</label>
                                                  <input type="text" class="form-control" id="meta-title-{{ $locale }}" name="meta-title-{{ $locale }}" value="{{ old('meta-title-'.$locale.'') }}" placeholder="@lang('admin/blog.labels.meta-title')">
                                                  @if ($errors->has("meta-title-$locale"))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first("meta-title-$locale") }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                              <div class="form-group {{ $errors->has('meta-description-'.$locale.'') ? 'has-error' : '' }}">
                                                  <label for="meta-description-{{ $locale }}">@lang('admin/blog.labels.meta-description')</label>
                                                  <input type="text" class="form-control" id="meta-description-{{ $locale }}" name="meta-description-{{ $locale }}" value="{{ old('meta-description-'.$locale.'') }}" placeholder="@lang('admin/blog.labels.meta-description')">
                                                  @if ($errors->has("meta-description-$locale"))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first("meta-description-$locale") }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                          </div>
                                      @endforeach
                                  </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> @lang('admin/common.buttons.create')</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ old('redirect_to', URL::previous()) }}" class="btn btn-default btn-block"><i class="fa fa-times"></i> @lang('admin/common.buttons.cancel')</a>
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

<script type="text/javascript" src="{{ asset('js/moment-with-locales.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=prz9vfpgqdelq0k500a5dpabhcdzuvvw9yigzddpy1lj2nd9"></script>

<script>

$('#published_at').datetimepicker({

    format: 'D, MM, YYYY | hh:mm:SS a',
    dayViewHeaderFormat: 'MMMM YYYY',
    sideBySide: true,
    showClose: true,
    widgetPositioning: {
        horizontal: 'auto',
        vertical: 'bottom',
    },
    locale: '{{ Config::get("app.locale") }}',

});

tinymce.init({ selector:'textarea' });

$('.js-multiple-select').select2({
    placeholder: "@lang('admin/blog.labels.choose_categories')",
    allowClear: true,
    width: '100%',
});

</script>

@endsection
