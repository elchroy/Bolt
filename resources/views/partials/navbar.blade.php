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
                    Bolt
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <li id="search-list">
                        <form class="" method="GET" action="{{ url('videos/search') }}" id="search-form">
                            <input class="" id="search-videos" name="search" placeholder="Search..." autocomplete="off" autofocus="autofocus" type="search">
                        </form>
                    </li>

                    <li><a href="{{ url('/videos') }}">Videos</a></li>

                    <!-- Authentication Links -->
                    @if (Auth::user())
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="">{{ Auth::user()->name }}</span>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <!-- <li class="dropdown" id="avatar">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="hidden-xs" src="{{ Auth::user()->getAvatar() }}" id="navbar-avatar">
                            </a>
                        </li> -->
                        <!-- <li> <a href="{{ url('/videos/add') }}"><button class="bolt-calling">Upload</button></a></li> -->
                        
                    @endif

                </ul>
                
            </div>
        </div>
    </nav>