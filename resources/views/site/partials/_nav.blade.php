
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav">
                        <li class="nav-item"><a class="nav-link" href="category.html">@lang('site/blog.categories')</a></li>
                        <li class="nav-item"><a class="nav-link" href="archive.html">Contact</a></li>
                        <li class="nav-item submenu dropdow">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="single-blog.html">Sinlge Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
                            </ul>
                        </li> 
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right header_social ml-auto">
                        @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">@lang('common.login')</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">@lang('common.register')</a></li>

                @else
                <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                         @lang('common.logout')
                    </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li> 
                   
                <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ strtoupper(App::getLocale()) }}</a>

                    <ul class="dropdown-menu">
                        @foreach(config('app.locales') as $key => $value)
                        <li class="nav-item"><a class="nav-link" href="/{{ $key }}/{{ substr(Request::path(), 3) }}">{{ $value }}</a></li>

                    @endforeach
                    </ul>
                </li> 
             
                @endguest
                <li class="nav-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="nav-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="nav-item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
            </ul>      
                    
                </div> 
            </div>
        </nav>
    </div>
    <div class="logo_part">
        <div class="container">
            <a class="logo" href="#">Le blog de Oodge</a>
        </div>
    </div>
