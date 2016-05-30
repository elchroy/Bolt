<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="bolt-logo">
                        <img class="img-responsive" src="{{ asset('img/bolt-logo.png') }}">
                    </div>
                    <!-- Bolt -->
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <li id="search-list">
                        <form class="bolt-form" method="GET" action="{{ url('videos/search') }}" id="search-form">
                            <input class="" required id="search-videos" value="{{ $toSearch or null }}" name="search" placeholder="Search..." autocomplete="off" autofocus="autofocus" type="search">
                        </form>
                    </li>

                    <li><a href="{{ url('/videos') }}">Videos</a></li>
                    <li><a href="{{ url('/categories') }}">Categories</a></li>

                    <!-- Authentication Links -->
                    @if (Auth::user())
                        <li><a style="background: #C52020; color: #333;" href="{{ url('videos/add') }}">Upload</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle truncate" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="">{{ Auth::user()->name }}</span>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/dashboard') }}"> <i class="fa fa-btn fa-user"></i> Dashboard</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li class="dropdown" id="avatar">

                             <a href="{{ url('/dashboard') }}" class="truncate">
                                <img class="hidden-xs hidden-sm" title="{{Auth::user()->name}}" src="{{ Auth::user()->getAvatar() }}" id="navbar-avatar">
                            </a>
                        </li>
                    @else
                        @if(!(Request::is('/')))
                            <li><a style="background: #C52020; color: #333;" href="{{ url('/login') }}">Login</a></li>
                            <li><a style="background: #C52020; color: #333;" href="{{ url('/register') }}">Register</a></li>
                        @endif
                    @endif

                </ul>
                
            </div>
        </div>
        
    </nav>

    <style type="text/css">
        .navbar-nav li form {
            background: #F2F2F2;
            border-radius: 1PX;
            color: #312C32;
            box-shadow: none;
        }

    </style>