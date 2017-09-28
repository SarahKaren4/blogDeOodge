@extends('layouts.admin')

@section('title')
    @lang('admin/blog.titles.category_edit')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 style="margin:0">@lang('admin/blog.titles.category_edit')</h3>

                </div>
            </div>

            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST">

                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" name="redirect_to" value="{{ old('redirect_to', URL::previous()) }}" hidden>

                <div class="row">
                    <div class="col-md-4">

                        <div class="panel panel-default">
                            <div class="panel-heading"><b>@lang('admin/blog.titles.info'):</b></div>
                            <div class="panel-body">

                                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                    <label for="slug">@lang('admin/blog.labels.slug')</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="@lang('admin/blog.labels.slug')" autofocus>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('slug') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="status">@lang('admin/blog.labels.status')</label><br>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default {{ old('status', $category->status) ? 'active' : '' }}">
                                            <input value="1" name="status" type="radio" autocomplete="off" {{ old('status', $category->status) ? 'checked' : '' }}> <i class="fa fa-check-square-o"></i> Active
                                        </label>
                                        <label class="btn btn-default {{ old('status', $category->status) ? '' : 'active' }}">
                                            <input value="0" name="status" type="radio" autocomplete="off" {{ old('status', $category->status) ? '' : 'checked' }}> <i class="fa fa-ban"></i> Disabled
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
                                                  <input type="text" class="form-control" id="title-{{ $locale }}" name="title-{{ $locale }}" value="{{ old('title-'.$locale.'', $category->getTranslation($locale)->title) }}" placeholder="@lang('admin/blog.labels.title')">
                                                  @if ($errors->has("title-$locale"))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first("title-$locale") }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                              <div class="form-group {{ $errors->has('meta-title-'.$locale.'') ? 'has-error' : '' }}">
                                                  <label for="meta-title-{{ $locale }}">@lang('admin/blog.labels.meta-title')</label>
                                                  <input type="text" class="form-control" id="meta-title-{{ $locale }}" name="meta-title-{{ $locale }}" value="{{ old('meta-title-'.$locale.'', $category->getTranslation($locale)->meta_title) }}" placeholder="@lang('admin/blog.labels.meta-title')">
                                                  @if ($errors->has("meta-title-$locale"))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first("meta-title-$locale") }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                              <div class="form-group {{ $errors->has('meta-description-'.$locale.'') ? 'has-error' : '' }}">
                                                  <label for="meta-description-{{ $locale }}">@lang('admin/blog.labels.meta-description')</label>
                                                  <input type="text" class="form-control" id="meta-description-{{ $locale }}" name="meta-description-{{ $locale }}" value="{{ old('meta-description-'.$locale.'', $category->getTranslation($locale)->meta_description) }}" placeholder="@lang('admin/blog.labels.meta-description')">
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
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> @lang('admin/common.buttons.save')</button>
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
