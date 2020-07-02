@extends('layouts.site')

@section('title')
    @lang('site/blog.title')
@endsection

@section('content')

 <section class="blog_area p_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog_left_sidebar">
                            @foreach($posts as $post)

                            <article class="blog_style1">
                            	<div class="blog_img">
                            		<img class="img-fluid" src="{{ asset('images/posts/small/' . $post->image) }}" width="750px" alt="">
                            	</div>
                            	<div class="blog_text">
									<div class="blog_text_inner">
										<div class="cat">
                                            @foreach($post->categories as $category)
                                            <a class="cat_btn" href="{{ route('site.category.show', ['slug' => $category->slug]) }}">{{ $category->title }}</a>{{ !$loop->last ? ',' : ''}}

                                        @endforeach
											<a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $post->created_at }} par {{ $post->user->name }}</a>
											<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> {{ count($post->comments) }}</a>
										</div>
										<a href="#"><h4>{{ $post->title }}</h4></a>
										<p>{{ mb_substr(strip_tags($post->description), 0, 300) }} ...</p>
										<a class="blog_btn" href="{{ route('site.post.show', ['slug' => $post->slug]) }}">@lang('site/common.buttons.read_more')</a>
									</div>
								</div>
                            </article>
                            <br>
                            <br>
                            <br>

                            @endforeach
                        
        @if($posts->lastPage() > 1)
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    @endif
                     
                            
                         
                   
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
                            <br>
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img img-fluid" src="img/blog/author.png{{ asset('img/blog/author.png') }}" alt="">
                                <h4>Charlie Barber</h4>
                                <p>Senior blog writer</p>
                                <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits detractors.</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-github"></i></a>
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                </div>
                                <div class="br"></div>
                            </aside>
                            
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="widget_title">@lang('site/blog.categories')</h4>
                                <ul class="list cat-list">
                                   
                                    @foreach($categories as $category)
                                    <li class="list-group-item">
                                        <span class="badge">{{ $category->posts()->count() }}</span>
                                        <a href="{{ route('site.category.show', ['slug' => $category->slug]) }}">{{ $category->title }}</a>
                                    </li>
                                
                                @endforeach
                                          															
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
