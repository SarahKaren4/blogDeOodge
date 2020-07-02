@extends('layouts.site')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
<section class="blog_area p_120 single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                   <div class="main_blog_details">
                       <img class="img-fluid" width="750px" src="{{ asset('images/posts/small/' . $post->image) }}" alt="">
                       <a href="#"><h4>{{ $post->title }}</h4></a>
                       <div class="user_details">
                           <div class="float-left">
                               @foreach($post->categories as $category)
                            
                               <a href="{{ route('site.category.show', ['slug' => $category->slug]) }}">{{ $category->title }}</a>{{ !$loop->last ? ',' : ''}}
   
                           @endforeach
                           </div>
                           <div class="float-right">
                               <div class="media">
                                   <div class="media-body">
                                       <h5>{{ $post->user->name }}</h5>
                                       <p>{{ $post->created_at }}</p>
                                   </div>
                                   <div class="d-flex">
                                   </div>
                               </div>
                           </div>
                       </div>
                     <blockquote class="blockquote">
                        {!! $post->description !!}
                        
                    </blockquote>

                     <div class="news_d_footer">
                          
                      </div>
                   </div>
                
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
 <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget search_widget">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                                    </span>
                                </div><!-- /input-group -->
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img img-fluid" src="img/blog/author.png" alt="">
                                <h4>Charlie Barber</h4>
                                <p>Senior blog writer</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-github"></i></a>
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                </div>
                                <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits detractors.</p>
                                <div class="br"></div>
                            </aside>
                          
                            <aside class="single_sidebar_widget"> 
                                <a href="#"><img class="img-fluid" src="img/blog/add.jpg" alt=""></a>
                                <div class="br"></div>
                            </aside>
                           
                            <aside class="single-sidebar-widget tag_cloud_widget">
                                <h4 class="widget_title">Catégories</h4>
                                <ul class="list">
                                    <li><a href="#">Technology</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Architecture</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Technology</a></li>
                                    <li><a href="#">Lifestyle</a></li>
                                    <li><a href="#">Art</a></li>
                                    <li><a href="#">Adventure</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Lifestyle</a></li>
                                    <li><a href="#">Adventure</a></li>
                                </ul>
                            </aside>
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
